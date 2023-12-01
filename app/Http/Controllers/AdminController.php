<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use App\Models\Page;
use App\Models\Link;

use App\Repositories\ClickRepository;
use App\Repositories\LinkRepository;
use App\Repositories\UserRepository;
use App\Repositories\PageRepository;
use App\Repositories\ViewRepository;

use DateTime;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();

        $dataList = $this->verifyDateDifference();

        return view('admin.index',[
            'user' => $user,
            'dataList' => $dataList,
            'activeMenu' => 'home'
        ]);
    }

    public function verifyDateDifference() {
        $user = Auth::user();

        $newList = [
            'list' => []
        ];

        $pages = PageRepository::getAllPagesOrderByUpdatedAt($user->id);

        foreach($pages as $page) {
            $originalTime = $page->updated_at;
            $targetTime = New DateTime('now');

            if($page->updated_at !== null) {
                $interval = $originalTime->diff($targetTime);

                $intervalValidate = '';

                if($interval->format('%a') > '0') {
                    $intervalValidate = $interval->format('%a').'d atrás';
                }else if($interval->format('%h') > '0') {
                    $intervalValidate = $interval->format('%h').'h atrás';
                }else if($interval->format('%i') > '0') {
                    $intervalValidate = $interval->format('%i').'m atrás';
                }else {
                    $intervalValidate = 'agora mesmo';
                }

                $listItem = [
                    'id' => $page->id,
                    'slug' => $page->slug,
                    'img' => $page->op_profile_image,
                    'title' => $page->op_title,
                    'description' => $page->op_description,
                    'timeMsg' => $intervalValidate
                ];

                array_push($newList['list'], $listItem);
            }
        }

        return $newList['list'];
    }

    public function profileUser($userId) {
        $user = Auth::user();

        if($userId == $user->id) {
            return view('admin.profile', [
                'user' => $user,
                'activeMenu' => 'profile'
            ]);
        }else {
            return redirect('/admin');
        }
    }

    public function profileUserEditAction($userID, Request $request) {
        $user = Auth::user();

        if($user->id == $userID) {
            $userEdit = UserRepository::findByID($userID);

            if($request->hasFile('profileImgEdit')) {
                if($userEdit->profile_img != null) {
                    Storage::disk('public')->delete($userEdit->profile_img);
                }
                $userEdit->profile_img = $request->file('profileImgEdit')->store('imagesProfileUser', 'public');
            }

            if(!$request['nameEdit'] == '') {
                $userEdit->name = $request['nameEdit'];
            }

            if(!$request['passEdit'] == '') {
                $userEdit->password = password_hash($request['passEdit'], PASSWORD_DEFAULT);
            }

            $userEdit->save();

            return redirect('/admin/profile/'.$user->id);

        }else {
            return redirect('/admin');
        }

    }

    public function pageLinks($slug) {
        $user = Auth::user();
        $page = PageRepository::getPageBySlugAndUser($slug, $user->id);

        if($page) {
            $links = LinkRepository::getAllLinksOrderByOrder($page->id);

            return view('admin.links',[
                'menu' => 'links',
                'page' => $page,
                'links' => $links,
                'user' => $user,
                'activeMenu' => 'links'
            ]);
        }else {
            return redirect('/admin');
        }

    }

    public function linkOrderUpdate($linkID, $position) {
        $user = Auth::user();

        // Verificar se o link pertence a uma página do usuário logado
        $link = LinkRepository::findById($linkID);
        $myPages = [];
        $myPagesQuery = PageRepository::getAllPagesByUser($user->id);
        foreach($myPagesQuery as $pageItem) {
            $myPages[] = $pageItem->id;
        }

        if(in_array($link->id_page, $myPages)) {

            if($link->order > $position) {
                // item subiu
                // jogou os outros para baixo
                $afterLinks = LinkRepository::getAfterLinks($link->id_page, $position);

                foreach($afterLinks as $afterLink) {
                    $afterLink->order++;
                    $afterLink->save();
                }
            }else if($link->order < $position) {
                // item desceu
                // jogou os outros para cima
                $beforeLinks = LinkRepository::getBeforeLinks($link->id_page, $position);

                foreach($beforeLinks as $beforeLink) {
                    $beforeLink->order--;
                    $beforeLink->save();
                }
            }

            // Posicionando o item
            $link->order = $position;
            $link->save();

            // Corrigindo as posições
            $allLinks = LinkRepository::getAllLinksOrderByOrder($link->id_page);
            foreach($allLinks as $linkKey => $linkItem) {
                $linkItem->order = $linkKey;
                $linkItem->save();
            }

        }

        return [];
    }

    public function newlink($slug) {
        $user = Auth::user();
        $page = PageRepository::getPageBySlugAndUser($slug, $user->id);

        if($page) {
            return view('admin.editlink',[
                'menu' => 'links',
                'page' => $page,
                'user' => $user,
                'activeMenu' => 'links'
            ]);
        }else {
            return redirect('/admin');
        }
    }

    public function newLinkAction($slug, Request $request) {
        $user = Auth::user();
        $page = PageRepository::getPageBySlugAndUser($slug, $user->id);

            if($page) {
                $fields = $request->validate([
                    'status' => ['required', 'boolean'],
                    'title' => ['required', 'min: 2'],
                    'href' => ['required', 'url'],
                    'op_bg_color' => ['required', 'regex:/^[#][0-9A-F]{3,6}$/i'],
                    'op_text_color' => ['required', 'regex:/^[#][0-9A-F]{3,6}$/i'],
                    'op_border_type' => ['required', Rule::in('square', 'rounded')]
                ]);

                $totalLinks = LinkRepository::getTotalLinksByPageId($page->id);
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

    public function editLink($slug, $linkID) {
        $user = Auth::user();
        $page = PageRepository::getPageBySlugAndUser($slug, $user->id);

        if($page) {
            $link = LinkRepository::getLinkByPageIdAndLinkId($page->id, $linkID);

            if($link) {
                return view('admin.editlink',[
                    'page' => $page,
                    'link' => $link,
                    'user' => $user,
                    'activeMenu' => 'links'
                ]);
            }
        }

        return redirect('/admin');
    }

    public function editLinkAction($slug, $linkID, Request $request) {
        $user = Auth::user();
        $page = PageRepository::getPageBySlugAndUser($slug, $user->id);

        if($page) {
            $link = LinkRepository::getLinkByPageIdAndLinkId($page->id, $linkID);

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

    public function delLink($slug, $linkID) {
        $user = Auth::user();
        $page = PageRepository::getPageBySlugAndUser($slug, $user->id);

        if($page) {
            $link = LinkRepository::getLinkByPageIdAndLinkId($page->id, $linkID);

            if($link) {
                $link->delete();

                // Corrigindo as posições
                $allLinks = LinkRepository::getAllLinksOrderByOrder($page->id);
                foreach($allLinks as $linkKey => $linkItem) {
                    $linkItem->order = $linkKey;
                    $linkItem->save();
                }

                return redirect('/admin/'.$page->slug.'/links');
            }
        }

        return redirect('/admin');
    }

    public function getPages() {
        $user = Auth::user();

        $pages = PageRepository::getAllPagesOrderById($user->id);

        return view('admin.pages',[
            'user' => $user,
            'pages' => $pages,
            'activeMenu' => 'pages'
        ]);
    }

    public function addPage() {
        $user = Auth::user();

        return view('admin.addpage',[
            'user' => $user,
            'activeMenu' => ''
        ]);
    }

    public function addPageAction(Request $request) {
        $user = Auth::user();
        $page = PageRepository::getPageBySlug($request['slug']);

        $fields = $request->validate([
            'slug' => ['required'],
            'op_title' => ['required'],
            'op_description' => ['required']
        ]);

        if($page == null) {
            $newPage = new Page();
            $newPage->id_user = $user->id;
            $newPage->slug = strtolower($fields['slug']);
            $newPage->op_title = $fields['op_title'];
            $newPage->op_description = $fields['op_description'];
            $newPage->save();
        }

        return redirect('/admin/pages');
    }

    public function editPage($slug, $pageID) {
        $user = Auth::user();
        $page = PageRepository::getPageBySlugByIdByUser($slug, $pageID, $user->id);

        if($page) {
            $colors = explode(',', $page->op_bg_value);

            return view('admin.editpage',[
                'page' => $page,
                'colors' => $colors,
                'user' => $user,
                'activeMenu' => ''
            ]);
        }else {
            return redirect('/admin');
        }

    }

    public function editPageAction($slug, $pageID, Request $request) {
        $user = Auth::user();
        $page = PageRepository::getPageBySlugByIdByUser($slug, $pageID, $user->id);

        if($page) {
            //Validando os campos
            $fields = $request->validate([
                'slug_page' => ['required'],
                'font_color_page' => ['required', 'regex:/^[#][0-9A-F]{3,6}$/i'],
                'bg_color_page' => ['required', 'regex:/^[#][0-9A-F]{3,6}$/i'],
                'bg_color_page_2' => ['required', 'regex:/^[#][0-9A-F]{3,6}$/i'],
                'title_page' => ['required'],
                'description_page' => ['required']
            ]);

            //salvando as 2 cores em uma variável
            $bgColors = $fields['bg_color_page'].','.$fields['bg_color_page_2'];

            // pegando a imagem e fazendo o upload
            if($request->hasFile('op_profile_image')) {
                // deletando do sistema a imagem atual
                Storage::disk('public')->delete($page->op_profile_image);

                // fazendo upload e salvando no banco de dados a nova imagem
                $profileImagePath = $request->file('op_profile_image')->store('images', 'public');
                $page->op_profile_image = $profileImagePath;
            }

            $page->slug = $fields['slug_page'];
            $page->op_font_color = $fields['font_color_page'];
            $page->op_bg_value = $bgColors;
            $page->op_title = $fields['title_page'];
            $page->op_description = $fields['description_page'];
            $page->save();
        }

        return redirect('/admin');

    }

    public function delPage($slug, $pageID) {
        $user = Auth::user();
        $page = PageRepository::getPageBySlugByIdByUser($slug, $pageID, $user->id);

        if($page) {
            $page->delete();
        }

        return redirect('/admin/pages');
    }

    public function pageStats($slug) {
        $user = Auth::user();
        $page = PageRepository::getPageBySlugAndUser($slug, $user->id);

        if($page) {
            // puxando as views da página
            $views = ViewRepository::getTotalViewsOfPage($page->id);

            // puxando os clicks nos links da página
            $clicks = ClickRepository::getTotalClicksOfPage($page->id);

            // puxando as páginas que mais receberam acesso dentro de X período
            $dateLimit = date('Y-m-d H:i:s', strtotime('- 2880 minutes'));
            $mostViews = ViewRepository::getTotalViewsOfPageInTheLast48Hours($dateLimit, $page->id);

            return view('admin.stats',[
                'page' => $page,
                'views' => $views,
                'clicks' => $clicks,
                'user' => $user,
                'mostViews' => $mostViews,
                'activeMenu' => 'stats'
            ]);
        }else {
            return redirect('/admin');
        }
    }
}
