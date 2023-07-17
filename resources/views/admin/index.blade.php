@extends('admin.template')

@section('title', 'MyPage - Home')

@section('content')
    <div class="section_home">
        <div class="area_title">
            <h1 class="title">Veja alguns exemplos</h1>
        </div>
        <div class="area_example_items">
            <div class="example_item"><img src="{{url('assets/images/admin/ex01.png')}}" alt="Exemplo-1"></div>
            <div class="example_item"><img src="{{url('assets/images/admin/ex02.png')}}" alt="Exemplo-2"></div>
            <div class="example_item"><img src="{{url('assets/images/admin/ex03.png')}}" alt="Exemplo-3"></div>
            <div class="example_item"><img src="{{url('assets/images/admin/ex04.png')}}" alt="Exemplo-4"></div>
        </div>
        <div class="area_updated_items">
            <div class="area_title">
                <h1 class="title">Você atualizou recentemente</h1>
            </div>
        </div>
    </div>
@endsection
