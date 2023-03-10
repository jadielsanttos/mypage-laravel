@extends('admin.page')

@section('title', isset($link)?'MyPage'.' - Editar link':'MyPage'.' - Novo link')

@section('body')
    <div class="link_voltar">
        <a href="{{url('/admin/'.$page->slug.'/links')}}"><i class="fa-solid fa-arrow-left"></i></a>
    </div>

    <h3>{{isset($link) ? 'Editar Link' : 'Novo Link'}}</h3>

    <form method="post">
        @csrf
        <label for="">
            Status<br>
            <select name="status">
                <option value="1" {{isset($link) ? ($link->status === '1' ? 'selected' : '') : ''}}>Ativo</option>
                <option value="0" {{isset($link) ? ($link->status === '0' ? 'selected' : '') : ''}}>Inativo</option>
            </select>
        </label>

        <label for="">
            Título<br>
            <input type="text" name="title" value="{{$link->title ?? ''}}">
        </label>

        <label for="">
            URL do link<br>
            <input type="text" name="href" value="{{$link->href ?? ''}}">
        </label>

        <label for="">
            Cor do fundo<br>
            <input type="color" name="op_bg_color" value="{{$link->op_bg_color ?? '#FFFFFF'}}">
        </label>

        <label for="">
            Cor do texto<br>
            <input type="color" name="op_text_color" value="{{$link->op_text_color ?? '#000000'}}">
        </label>

        <label for="">
            Tipo de borda<br>
            <select name="op_border_type">
                <option value="square" {{isset($link) ? ($link->op_border_type === 'square' ? 'selected' : '') : ''}}>Quadrada</option>
                <option value="rounded" {{isset($link) ? ($link->op_border_type === 'rounded' ? 'selected' : '') : ''}}>Arredondada</option>
            </select>
        </label>

        <label for="">
            <input type="submit" value="{{isset($link) ? 'Atualizar' : 'Adicionar'}}">
        </label>
    </form>
@endsection
