<?php

namespace App\Http\Controllers;

use App\Models\Click;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Link;
use App\Models\View;

class PageController extends Controller
{
    public function index($slug) {

        $page = Page::where('slug', $slug)->first();

        if($page) {

            // background
            $bg = '#FFFFFF,#FFFFFF';

            switch($page->op_bg_type) {
                case 'image':
                    $bg = "url(".url('media/uploads').'/'.$page->op_bg_value.")";
                break;
                case 'color':
                    $colors = explode(',', $page->op_bg_value);
                    $bg = 'linear-gradient(145deg,';
                    $bg .= $colors[0].',';
                    $bg .= !empty($colors[1]) ? $colors[1] : $colors[0];
                    $bg .= ')';
                break;
            }

            // links
            $links = Link::where('id_page', $page->id)
                    ->where('status', 1)
                    ->orderBy('order')
                    ->get();

            // registrar as views
            $view = View::firstOrNew(
                ['id_page' => $page->id, 'view_date' => date('Y-m-d')]
            );
            $view->total++;
            $view->save();

            return view('page', [
                'font_color' => $page->op_font_color,
                'profile_image' => url('storage/'.$page->op_profile_image),
                'title' => $page->op_title,
                'description' => $page->op_description,
                'bg' => $bg,
                'links' => $links,
                'page' => $page
            ]);

        }else {
            return view('notfound');
        }

    }

    public function addClick(Request $request) {
        // verifico o slug da página
        $page = Page::where('slug', $request->slug)->first();

       if($page) {
            $click = Click::firstOrNew(
                ['id_link' => $request->id, 'id_page' => $page->id, 'click_date' => date('Y-m-d')]
            );
            $click->total++;
            $click->save();
       }
    }
}
