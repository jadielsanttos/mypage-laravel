@extends('admin.template')

@section('title', 'Mylinks - Perfil')

@section('content')

    <header class="header">
        <div class="icon_menu"><i class="fa-solid fa-bars"></i></div>
        <div class="item_logo"><img src="{{url('assets/images/MyLinks.png')}}" alt=""></div>
    </header>
    <div class="title_page">
        <h2>Editar perfil</h2>
    </div>
    <div class="link_voltar">
        <a href="{{url('/admin')}}"><i class="fa-solid fa-arrow-left"></i></a>
    </div>

    <div class="container_profile">
        <div class="area_profile_img">
            @if ($user->profile_img != null)
                <div class="card_img">
                    <img src="{{url('storage/'.$user->profile_img)}}" alt="">
                    <button class="btn_open_modal">Alterar foto <i class="fa-solid fa-cloud-arrow-up"></i></button>
                </div>
            @else
                <div class="card_default">
                    <h1>{{substr($user->name,0,1)}}</h1>
                    <div class="effect_hover">
                        <button class="btn_open_modal">Alterar foto</button>
                    </div>
                </div>
            @endif
                <div class="modal_upload_img">
                    <div class="modal_header">
                        <h3>Alterar imagem de perfil</h3>
                        <span class="close_modal"><i class="fa-solid fa-xmark"></i></span>
                    </div>
                    <form method="post" action="{{url('/admin/profile/'.$user->id.'/upload')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="profileImgEdit">
                        <span>*Arquivos aceitos: jpg, png, jpeg</span>
                        <div class="area_img_upload">
                            <img src="{{url('assets/images/cloud-upload.jpg')}}" alt="">
                        </div>
                        <Button class="btn_upload">Enviar</Button>
                    </form>
                </div>
                <div class="shadow_modal"></div>
        </div>

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
    </div>
@endsection
