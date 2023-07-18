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
                    <label for="Nome da página">Nome da página</label>
                    <input type="text" name="pageName" placeholder="O que vai ficar na URL...">

                    <label for="Título da página">Título da página</label>
                    <input type="text" name="pageTitle" placeholder="EX: Rock in rio">

                    <label for="Descrição da página">Descrição da página</label>
                    <input type="text" name="pageDescription" placeholder="EX: Acompanhe nossos principais canais">

                    <input type="submit" value="Adicionar">
                </form>
            </div>
        </div>
    </div>
@endsection
