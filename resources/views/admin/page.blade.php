@extends('admin.template')

@section('title', 'Mylinks - '.$page->op_title.'(Links)')

@section('content')
    <div class="area_total">
        <div class="left_side">
            <header>
                <ul>
                    <li @if($menu==='links') class="active" @endif><a href="{{url('/admin/'.$page->slug.'/links')}}">Links</a></li>
                    <li @if($menu==='design') class="active" @endif><a href="{{url('/admin/'.$page->slug.'/design')}}">Aparência</a></li>
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
