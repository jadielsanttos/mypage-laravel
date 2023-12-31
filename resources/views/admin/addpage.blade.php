@extends('admin.template')

@section('title', 'MyPage - Adicionar página')

@section('content')
    <div class="section_add_page">
        <div class="area_title">
            <h1 class="title">Adicionar página</h1>
        </div>
        <div class="area_form">
            <div class="form_add_page">
                <form method="post">
                    @csrf
                    <label for="Nome da página">Nome da página</label>
                    <input type="text" name="slug" placeholder="O que vai ficar na URL...">

                    <label for="Título da página">Título da página</label>
                    <input type="text" name="op_title" placeholder="EX: Rock in rio">

                    <label for="Descrição da página">Descrição da página</label>
                    <input type="text" name="op_description" placeholder="EX: Acompanhe nossos principais canais">

                    <input type="submit" value="Adicionar" class="btn_primary">
                </form>
            </div>
        </div>
    </div>
@endsection
