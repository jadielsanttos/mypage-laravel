@extends('admin.template')

@section('title', 'Adicionar página - Mylinks')

@section('content')

    <header class="header">
        <div class="icon_menu"><i class="fa-solid fa-bars"></i></div>
    </header>
    <div class="title_page">
        <h2>Nova página</h2>
    </div>
    <div class="link_voltar">
        <a href="{{url('/admin')}}"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
    <form method="post" class="form_add_page">
        @csrf

        <label for="name_page">Nome da página</label>
        <input type="text" name="name_page" placeholder="O que vai ficar na URL...">

        <label for="title_page">Título da página</label>
        <input type="text" name="title_page" placeholder="Ex: Maria Luiza">

        <label for="desc_page">Descrição da página</label>
        <input type="text" name="desc_page" placeholder="Ex: Aprenda a falar Inglês comigo">

        <input type="submit" name="adicionar" value="Adicionar">

    </form>
@endsection
