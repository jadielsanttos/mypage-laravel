<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Page;
use App\Models\Link;
use Illuminate\Queue\RedisQueue;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except'=>[
            'login',
            'register',
            'loginAction',
            'registerAction'
        ]]);
    }

    public function login(Request $request) {
        return view('admin.login', [
            'error' => $request->session()->get('error')
        ]);
    }

    public function loginAction(Request $request) {
        $creds = $request->only('email', 'password');

        if(Auth::attempt($creds)) {
            return redirect('/admin');
        }else {
            $request->session()->flash('error', 'Dados incorretos!');
            return redirect('/admin/login');
        }
    }

    public function register(Request $request) {
        return view('admin.register', [
            'error' => $request->session()->get('error')
        ]);
    }

    public function registerAction(Request $request) {
        $creds = $request->only('email', 'password');

        $hasEmail = User::where('email', $creds['email'])->count();

        if($hasEmail === 0) {

            $newUser = new User();
            $newUser->email = $creds['email'];
            $newUser->password = password_hash($creds['password'], PASSWORD_DEFAULT);
            $newUser->save();

            Auth::login($newUser);
            return redirect('/admin');

        }else {
            $request->session()->flash('error', 'Já existe um usuário com este email');
            return redirect('/admin/register');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/admin');
    }

    public function index() {
        $user = Auth::user();

        $pages = Page::where('id_user', $user->id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.index',[
            'pages' => $pages
        ]);
    }

    public function pageLinks($slug) {
        $user = Auth::user();
        $page = Page::where('slug', $slug)
            ->where('id_user', $user->id)
            ->first();

        if($page) {
            $links = Link::where('id_page', $page->id)
                ->orderBy('order', 'ASC')
                ->get();

            return view('admin.page_links',[
                'menu' => 'links',
                'page' => $page,
                'links' => $links
            ]);
        }else {
            return redirect('/admin');
        }

    }

    public function linkOrderUpdate($linkid, $pos) {
        $user = Auth::user();

        // 1 - verificar se o link pertence a uma página do usuário logado

        // 2 - lógica para trocar ORDER no banco de dados

        $link = Link::find($linkid);
        $myPages = [];
        $myPagesQuery = Page::where('id_user', $user->id)->get();
        foreach($myPagesQuery as $pageItem) {
            $myPages[] = $pageItem->id;
        }

        if(in_array($link->id_page, $myPages)) {

            if($link->order > $pos) {
                // item subiu
                // jogou os próximos para baixo
                $afterLinks = Link::where('id_page', $link->id_page)
                    ->where('order', '>=', $pos)
                    ->get();

                foreach($afterLinks as $afterLink) {
                    $afterLink->order++;
                    $afterLink->save();
                }
            }else if($link->order < $pos) {
                // item desceu
                // jogou os anteriores para cima
                $beforeLinks = Link::where('id_page', $link->id_page)
                    ->where('order', '<=', $pos)
                    ->get();

                foreach($beforeLinks as $beforeLink) {
                    $beforeLink->order--;
                    $beforeLink->save();
                }
            }

            // Posicionando o item
            $link->order = $pos;
            $link->save();

            // Corrigindo as posições
            $allLinks = Link::where('id_page', $link->id_page)
                ->orderBy('order', 'ASC')
                ->get();
            foreach($allLinks as $linkKey => $linkItem) {
                $linkItem->order = $linkKey;
                $linkItem->save();
            }

        }

        return [];
    }

    public function newlink($slug) {
        $user = Auth::user();
        $page = Page::where('id_user', $user->id)
            ->where('slug', $slug)
            ->first();

        if($page) {

            return view('admin.page_editlink',[
                'menu' => 'links',
                'page' => $page
            ]);

        }else {
            return redirect('/admin');
        }
    }

    public function newLinkAction($slug, Request $request) {
        $user = Auth::user();
        $page = Page::where('id_user', $user->id)
            ->where('slug', $slug)
            ->first();

            if($page) {

                $fields = $request->validate([
                    'status' => ['required', 'boolean'],
                    'title' => ['required', 'min: 2'],
                    'href' => ['required', 'url'],
                    'op_bg_color' => ['required', 'regex:/^[#][0-9A-F]{3,6}$/i'],
                    'op_text_color' => ['required', 'regex:/^[#][0-9A-F]{3,6}$/i'],
                    'op_border_type' => ['required', Rule::in('square', 'rounded')]
                ]);

                $totalLinks = Link::where('id_page', $page->id)->count();
                $newLink = new Link();
                $newLink->id_page = $page->id;
                $newLink->status = $fields['status'];
                $newLink->title = $fields['title'];
                $newLink->href = $fields['href'];
                $newLink->op_bg_color = $fields['op_bg_color'];
                $newLink->op_text_color = $fields['op_text_color'];
                $newLink->op_border_type = $fields['op_border_type'];
                $newLink->order = $totalLinks;
                $newLink->save();

                return redirect('/admin/'.$page->slug.'/links');

            }else {
                return redirect('/admin');
            }

    }

    public function editLink($slug, $linkid) {
        $user = Auth::user();
        $page = Page::where('id_user', $user->id)
            ->where('slug', $slug)
            ->first();

        if($page) {
            $link = Link::where('id_page', $page->id)
                ->where('id', $linkid)
                ->first();

            if($link) {
                return view('admin.page_editlink',[
                    'menu' => 'links',
                    'page' => $page,
                    'link' => $link
                ]);
            }
        }

        return redirect('/admin');
    }

    public function editLinkAction($slug, $linkid, Request $request) {
        $user = Auth::user();
        $page = Page::where('id_user', $user->id)
            ->where('slug', $slug)
            ->first();

        if($page) {
            $link = Link::where('id_page', $page->id)
                ->where('id', $linkid)
                ->first();

            if($link) {

                $fields = $request->validate([
                    'status' => ['required', 'boolean'],
                    'title' => ['required', 'min: 2'],
                    'href' => ['required', 'url'],
                    'op_bg_color' => ['required', 'regex:/^[#][0-9A-F]{3,6}$/i'],
                    'op_text_color' => ['required', 'regex:/^[#][0-9A-F]{3,6}$/i'],
                    'op_border_type' => ['required', Rule::in('square', 'rounded')]
                ]);

                $link->status = $fields['status'];
                $link->title = $fields['title'];
                $link->href = $fields['href'];
                $link->op_bg_color = $fields['op_bg_color'];
                $link->op_text_color = $fields['op_text_color'];
                $link->op_border_type = $fields['op_border_type'];
                $link->save();

                return redirect('/admin/'.$page->slug.'/links');

            }
        }

        return redirect('/admin');
    }

    public function delLink($slug, $linkid) {
        $user = Auth::user();
        $page = Page::where('id_user', $user->id)
            ->where('slug', $slug)
            ->first();

        if($page) {
            $link = Link::where('id_page', $page->id)
                ->where('id', $linkid)
                ->first();

            if($link) {
                $link->delete();

                // Corrigindo as posições
                $allLinks = Link::where('id_page', $link->id_page)
                    ->orderBy('order', 'ASC')
                    ->get();
                foreach($allLinks as $linkKey => $linkItem) {
                    $linkItem->order = $linkKey;
                    $linkItem->save();
                }

                return redirect('/admin/'.$page->slug.'/links');
            }
        }

        return redirect('/admin');
    }

    public function addPage() {
        $user = Auth::user();

        return view('admin.page_addpage');
    }

    public function addPageAction(Request $request) {
        $user = Auth::user();

        $fields = $request->validate([
            'name_page' => ['required'],
            'title_page' => ['required'],
            'desc_page' => ['required']
        ]);

        $newPage = new Page();
        $newPage->id_user = $user->id;
        $newPage->slug = strtolower($fields['name_page']);
        $newPage->op_title = $fields['title_page'];
        $newPage->op_description = $fields['desc_page'];
        $newPage->save();

        return redirect('/admin');
    }

    public function editPage($slug, $pageID) {
        $user = Auth::user();
        $page = Page::where('slug', $slug)
            ->where('id', $pageID)
            ->where('id_user', $user->id)
            ->first();

        if($page) {
            $colors = explode(',', $page->op_bg_value);

            return view('admin.page_editpage',[
                'page' => $page,
                'colors' => $colors
            ]);
        }else {
            return redirect('/admin');
        }

    }

    public function editPageAction($slug, $pageID, Request $request) {
        $user = Auth::user();
        $page = Page::where('slug', $slug)
            ->where('id', $pageID)
            ->where('id_user', $user->id)
            ->first();

        if($page) {
            $fields = $request->validate([
                'slug_page' => ['required'],
                'font_color_page' => ['required', 'regex:/^[#][0-9A-F]{3,6}$/i'],
                'bg_color_page' => ['required', 'regex:/^[#][0-9A-F]{3,6}$/i'],
                'bg_color_page_2' => ['required', 'regex:/^[#][0-9A-F]{3,6}$/i'],
                'title_page' => ['required'],
                'description_page' => ['required']
            ]);

            $bgColors = $fields['bg_color_page'].','.$fields['bg_color_page_2'];

            $page->slug = $fields['slug_page'];
            $page->op_font_color = $fields['font_color_page'];
            $page->op_bg_value = $bgColors;
            $page->op_title = $fields['title_page'];
            $page->op_description = $fields['description_page'];
            $page->save();

            return redirect('/admin/'.$page->slug.'/editpage/'.$page->id);
        }else {
            return redirect('/admin');
        }
    }

    public function delPage($slug, $pageID) {
        $user = Auth::user();
        $page = Page::where('id_user', $user->id)
            ->where('slug', $slug)
            ->where('id', $pageID)
            ->first();

        if($page) {
            $page->delete();
            return redirect('/admin');
        }else {
            echo "<script>alert('Algo deu errado')</script>";
            echo "<script>window.location.href = '/admin'</script>";
        }
    }

    public function pageDesign($slug) {
        $user = Auth::user();
        $page = Page::where('id_user', $user->id)
            ->where('slug', $slug)
            ->first();
        return view('admin.page_design',[
            'menu' => 'design',
            'page' => $page
        ]);
    }

    public function pageStats($slug) {
        return view('admin.page_stats',[
            'menu' => 'stats'
        ]);
    }
}
