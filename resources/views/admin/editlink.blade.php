@extends('admin.template')

@section('title', isset($link)?'MyPage'.' - Editar link':'MyPage'.' - Novo link')

@section('content')
    <div class="section_edit_link">
        <div class="area_title">
            <h1 class="title">{{isset($link) ? 'Editar link' : 'Adicionar link' }}</h1>
        </div>

        <div class="area_subtitle">
            <h3 class="subtitle">Informações gerais</h3>
        </div>
        <div class="area_form_global_edit_link">
            <form method="post">
                @csrf
                <div class="area_first_card">
                    <div class="row_item">
                        <label for="Status">
                            Status
                            <select name="status">
                                <option value="1" {{isset($link) ? ($link->status === '1' ? 'selected' : '') : ''}}>Ativo</option>
                                <option value="0" {{isset($link) ? ($link->status === '0' ? 'selected' : '') : ''}}>Inativo</option>
                            </select>
                        </label>
                        <label for="Status">
                            Título
                            <input type="text" name="title" value="{{isset($link) ? $link->title : ''}}" placeholder="Insira o título do link">
                        </label>
                    </div>
                    <div class="row_item">
                        <label for="URL">
                            URL
                            <input type="text" name="href" value="{{isset($link) ? $link->href : ''}}" placeholder="Insira a URL de destino do link">
                        </label>
                        <label for="Tipo de borda">
                            Tipo de borda
                            <select name="op_border_type">
                                <option value="square" {{isset($link) ? ($link->op_border_type === 'square' ? 'selected' : '') : ''}}>Quadrada</option>
                                <option value="rounded" {{isset($link) ? ($link->op_border_type === 'rounded' ? 'selected' : '') : ''}}>Arredondada</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="area_subtitle">
                    <h3 class="subtitle">Informações visuais do link</h3>
                </div>
                <div class="area_second_card">
                    <div class="info_color_item">
                        <label for="Cor do texto">Cor do texto</label>
                        <input type="color" name="op_text_color" value="{{$link->op_text_color ?? '#000000'}}">
                    </div>
                    <div class="info_color_item">
                        <label for="Cor de fundo">Cor de fundo</label>
                        <input type="color" name="op_bg_color" value="{{$link->op_bg_color ?? '#FFFFFF'}}">
                    </div>
                </div>

                <div class="area_btn_save">
                    <input type="submit" value="{{isset($link) ? 'Salvar alterações' : 'Adicionar'}}">
                </div>
            </form>
        </div>
    </div>
@endsection
