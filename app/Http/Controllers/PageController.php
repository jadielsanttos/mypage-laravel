<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PageRepository;
use App\Repositories\ClickRepository;
use App\Repositories\LinkRepository;
use App\Repositories\ViewRepository;

class PageController extends Controller
{
    public function index($slug) {
        // Verificando o slug da página
        $page = PageRepository::getPageBySlug($slug);

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

            // Pegando links
            $links = LinkRepository::getAllLinksWithStatus1($page->id);

            // Registrando view
            $view = ViewRepository::firstOrNew($page->id);
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
        // Verificando o slug da página
        $page = PageRepository::getPageBySlug($request->slug);

        if($page) {
            $click = ClickRepository::firstOrNew($request->id, $page->id);
            $click->total++;
            $click->save();
        }
    }
}
