@extends('admin.template')

@section('title', 'MyPage - Perfil')

@section('content')
    <div class="section_profile_user">
        <div class="area_title">
            <h1 class="title">Dados do seu perfil</h1>
        </div>
        <div class="area_profile_user">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="area_card_inputs">
                    <div class="area_form_left">
                        <div class="area_img">
                            <img src="{{$user->profile_img === null ? url('/media/default.png') : url('/storage/'.$user->profile_img)}}" alt="Imagem de perfil">
                            <label>
                                Alterar foto
                                <input type="file" name="profileImgEdit">
                            </label>
                        </div>
                    </div>
                    <div class="area_form_right">
                        <div class="row">
                            <label for="Nome">
                                Nome
                                <input type="text" name="nameEdit" value="{{$user->name}}">
                            </label>
                            <label for="Senha">
                                Senha
                                <input type="password" name="passEdit">
                            </label>
                        </div>
                        <div class="row">
                            <label for="Nome">
                                Email
                                <input type="email" value="{{$user->email}}" disabled>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="area_input_save">
                    <input type="submit" value="Salvar alterações">
                </div>
            </form>
        </div>
    </div>
@endsection
