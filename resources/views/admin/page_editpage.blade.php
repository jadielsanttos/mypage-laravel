@extends('admin.template')

@section('content')
    <header class="header">
        <h2>Editar página</h2>
    </header>

    <form method="post" class="form_edit_page">
        @csrf

        <label for="slug_page">Nome da página</label>
        <input type="text" name="slug_page" value="{{$page->slug}}">

        <label for="font_color_page">Cor da fonte</label>
        <input type="color" name="font_color_page" value="{{$page->op_font_color}}">

        <label for="bg_color_page">Cor de fundo</label>
        <input type="color" name="bg_color_page" value="{{$page->op_bg_value}}">

        <label for="title_page">Título</label>
        <input type="text" name="title_page" value="{{$page->op_title}}">

        <label for="description_page">Descrição</label>
        <input type="text" name="description_page" value="{{$page->op_description}}">

        <input type="submit" name="Atualizar" value="Atualizar">
    </form>

@endsection
