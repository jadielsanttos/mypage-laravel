@extends('admin.template')

@section('title', 'MyPage - Editar página')

@section('content')
    <div class="section_edit_page">
        <div class="area_title">
            <h1 class="title">Editar página</h1>
        </div>

        <div class="area_subtitle">
            <h3 class="subtitle">Informações gerais</h3>
        </div>

        <div class="area_form_global">
            <form method="post" class="form_single" enctype="multipart/form-data">
                @csrf
                <div class="area_first_session">
                    <div class="area_upload_img">
                        <div class="area_img">
                            <img src="{{$page->op_profile_image === 'default.png' ? '/media/default.png' : url('storage/'.$page->op_profile_image)}}" alt="Imagem">
                            <label>
                                Alterar foto
                                <input type="file" class="input_file" name="op_profile_image">
                            </label>
                        </div>
                    </div>
                    <div class="area_inputs">
                        <div class="row_1">
                            <label for="Nome da página">
                                Nome da página
                                <input type="text" id="input_slug" name="slug_page" value="{{$page->slug}}">
                            </label>

                            <label for="Título da página">
                                Título da página
                                <input type="text" id="input_title_page" name="title_page" value="{{$page->op_title}}">
                            </label>
                        </div>

                        <div class="row_2">
                            <label for="Descrição da página">
                                Descrição da página
                                <input type="text" id="input_description_page" name="description_page" value="{{$page->op_description}}">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="area_subtitle">
                    <h3 class="subtitle">Informações visuais</h3>
                </div>
                <div class="area_second_session">
                    <div class="col_item">
                        <label for="Cor da fonte">Cor da fonte</label>
                        <input type="color" id="input_font_color" name="font_color_page" value="{{$page->op_font_color}}">
                    </div>
                    <div class="col_item">
                        <label for="Cor de fundo 1">Cor de fundo 1</label>
                        <input type="color" id="input_color_page" name="bg_color_page" value="{{$colors[0]}}">
                    </div>
                    <div class="col_item">
                        <label for="Cor de fundo 2">Cor de fundo 2</label>
                        <input type="color" id="input_color_page_2" name="bg_color_page_2" value="{{empty($colors[1]) ? $colors[0] : $colors[1]}}">
                    </div>
                </div>

                <div class="area_input_save">
                    <input type="submit" class="input_save" name="save" value="Salvar alterações">
                </div>
            </form>
        </div>
    </div>
@endsection
