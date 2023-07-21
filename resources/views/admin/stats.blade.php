@extends('admin.template')

@section('title', 'MyPage - Estatísticas')

@section('content')
    <div class="section_page_stats">
        <div class="area_title_stats">
            <h1 class="title_stats">Olá, {{$user->name}}</h1>
            <h4>essa é sua página de estatísticas...</h4>
        </div>
        <div class="area_content_stats">
            <div class="stats_item">
                <div class="area_content_top">
                    <div class="views_data"><h1>{{$views}}</h1></div>
                    <div class="area_icon"><i class="fa-regular fa-eye"></i></div>
                </div>
                <div class="area_content_bottom">
                    <div class="label_item">
                        <p>Total de visitas</p>
                    </div>
                </div>
            </div>
            <div class="stats_item">
                <div class="area_content_top">
                    <div class="views_data"><h1>{{$mostViews}}</h1></div>
                    <div class="area_icon"><i class="fa-regular fa-clock"></i></div>
                </div>
                <div class="area_content_bottom">
                    <div class="label_item">
                        <p>Visitas nas últimas 48h</p>
                    </div>
                </div>
            </div>
            <div class="stats_item">
                <div class="area_content_top">
                    <div class="views_data"><h1>{{$clicks}}</h1></div>
                    <div class="area_icon"><i class="fa-solid fa-arrow-pointer"></i></div>
                </div>
                <div class="area_content_bottom">
                    <div class="label_item">
                        <p>Total de cliques</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

