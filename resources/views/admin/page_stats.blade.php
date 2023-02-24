@extends('admin.page')

@section('title', 'Estatísticas - Mylinks')

@section('body')
    <div class="link_voltar">
        <a href="{{url('/admin')}}"><i class="fa-solid fa-arrow-left"></i></a>
    </div>

    <div class="welcome_to_user">
        <h1>Bem-vindo(a), {{$user->email}}</h1>
        <p>Essa é sua página de estatísticas</p>
    </div>

    <div class="views_page_area">
        <div class="card_stats">
            <h1>{{$views}} <i class="fa-solid fa-eye"></i></h1>
            <h4>Visitas a sua página</h4>
        </div>

        <div class="card_stats">
            <h1>{{$clicks}} <i class="fa-solid fa-computer-mouse"></i></h1>
            <h4>Total de clicks</h4>
        </div>
    </div>
@endsection

