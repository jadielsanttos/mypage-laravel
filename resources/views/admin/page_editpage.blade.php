@extends('admin.template')

@section('title', 'MyPage - Editar página')

@section('content')
    <header class="header">
        <div class="icon_menu"><i class="fa-solid fa-bars"></i></div>
        <div class="item_logo"><a href="{{url('/admin')}}"><img src="{{url('assets/images/MyPage.png')}}" alt=""></a></div>
    </header>

    <div class="title_page">
        <h2>Editar página</h2>
    </div>
    <div class="area_editpage">
        <div class="area_form_editpage">
            <div class="link_voltar">
                <a href="{{url('/admin')}}"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
            <form method="post" class="form_edit_page" enctype="multipart/form-data">
                @csrf

                <h3>Foto de perfil</h3>
                <img src="{{($page->op_profile_image === 'default.png') ? url('media/default.png') : url('storage/'.$page->op_profile_image)}}" alt="">

                <label for="slug_page">Alterar foto</label>
                <input type="file" name="op_profile_image">

                <label for="slug_page">Nome da página</label>
                <input type="text" name="slug_page" value="{{$page->slug}}">

                <label for="font_color_page">Cor da fonte</label>
                <input type="color" name="font_color_page" value="{{$page->op_font_color}}">

                <label for="bg_color_page">Cor de fundo 1</label>
                <input type="color" name="bg_color_page" value="{{$colors[0]}}">

                <label for="bg_color_page">Cor de fundo 2</label>
                <input type="color" name="bg_color_page_2" value="{{!empty($colors[1])?$colors[1]:$colors[0]}}">

                <label for="title_page">Título</label>
                <input type="text" name="title_page" value="{{$page->op_title}}">

                <label for="description_page">Descrição</label>
                <input type="text" name="description_page" value="{{$page->op_description}}">

                <input type="submit" name="Atualizar" value="Atualizar">
            </form>
        </div>

        <div class="area_iframe">
            <iframe src="{{url('/'.$page->slug)}}" frameborder="0"></iframe>
        </div>
    </div>

@endsection
