@extends('admin.template')

@section('title', 'MyPage - Links')

@section('content')
    <div class="area_total">
        <div class="left_side">
            <header>
                <div class="icon_menu">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="item_logo">
                    <a href="{{url('/admin')}}"><img src="{{url('assets/images/MyPage.png')}}" alt=""></a>
                </div>
                <ul>
                    <li @if($menu==='links') class="active" @endif><a href="{{url('/admin/'.$page->slug.'/links')}}">Links</a></li>
                    <li @if($menu==='stats') class="active" @endif><a href="{{url('/admin/'.$page->slug.'/stats')}}">Estatísticas</a></li>
                </ul>
            </header>

            @yield('body')
        </div>

        <div class="right_side">
            <iframe src="{{url('/'.$page->slug)}}" frameborder="0"></iframe>
        </div>
    </div>
@endsection
