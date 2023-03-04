@extends('admin.template')

@section('title', 'Mylinks - Perfil')

@section('content')

    <header class="header">
        <div class="icon_menu"><i class="fa-solid fa-bars"></i></div>
    </header>
    <div class="title_page">
        <h2>Editar perfil</h2>
    </div>
    <div class="link_voltar">
        <a href="{{url('/admin')}}"><i class="fa-solid fa-arrow-left"></i></a>
    </div>

    <div class="container_profile">
        <div class="area_profile_data">
            <form method="post">
                @csrf

                <label for="nameEdit">Nome</label>
                <input type="text" name="nameEdit" value="{{$user->name}}">

                <label for="emailEdit">Email</label>
                <input type="email" name="emailEdit" value="{{$user->email}}" disabled="">

                <label for="passEdit">Redefinir senha</label>
                <input type="password" name="passEdit">

                <input type="submit" value="Salvar">
            </form>
        </div>
        <div class="area_profile_img">
            @if ($user->profile_img != null)
                <img src="{{url('storage/images/default.png')}}" alt="">
            @else
                <div class="card_img">
                    <h1>{{substr($user->name,0,1)}}</h1>
                </div>
            @endif
                <form method="post">
                    <input type="file" name="profileImgEdit">
                </form>
        </div>
    </div>
@endsection
