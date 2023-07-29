@extends('admin.template')

@section('title', 'MyPage - Dashboard')

@section('content')
    <div class="section_home">
        <div class="area_title">
            <h1 class="title">Veja alguns exemplos</h1>
        </div>
        <div class="area_row">
            <div class="btn_prev"><span><i class="fa-solid fa-chevron-left"></i></span></div>
            <div class="btn_next"><span><i class="fa-solid fa-chevron-right"></i></span></div>

            <div class="area_example_items">
                <div class="area_example_list">
                    <div class="example_item"><img src="{{url('assets/images/admin/ex01.png')}}" alt="Exemplo-1"></div>
                    <div class="example_item"><img src="{{url('assets/images/admin/ex02.png')}}" alt="Exemplo-2"></div>
                    <div class="example_item"><img src="{{url('assets/images/admin/ex03.png')}}" alt="Exemplo-3"></div>
                    <div class="example_item"><img src="{{url('assets/images/admin/ex04.png')}}" alt="Exemplo-4"></div>
                    <div class="example_item"><img src="{{url('assets/images/admin/ex01.png')}}" alt="Exemplo-5"></div>
                    <div class="example_item"><img src="{{url('assets/images/admin/ex03.png')}}" alt="Exemplo-6"></div>
                    <div class="example_item"><img src="{{url('assets/images/admin/ex02.png')}}" alt="Exemplo-7"></div>
                    <div class="example_item"><img src="{{url('assets/images/admin/ex01.png')}}" alt="Exemplo-8"></div>
                    <div class="example_item"><img src="{{url('assets/images/admin/ex04.png')}}" alt="Exemplo-9"></div>
                    <div class="example_item"><img src="{{url('assets/images/admin/ex03.png')}}" alt="Exemplo-10"></div>
                    <div class="example_item"><img src="{{url('assets/images/admin/ex01.png')}}" alt="Exemplo-11"></div>
                    <div class="example_item"><img src="{{url('assets/images/admin/ex02.png')}}" alt="Exemplo-12"></div>
                </div>
            </div>
        </div>
        <div class="area_updated_items">
            <div class="area_title">
                <h1 class="title">Editado recentemente</h1>
            </div>

            @if(!empty($dataList))
                <div class="area_list">
                    <div class="area_list_top">
                        <div class="left">Título</div>
                        <div class="mid">Descrição</div>
                        <div class="right">Editado</div>
                    </div>
                    @foreach($dataList as $item)
                        <div class="list_item">
                            <a href="{{url('/admin/'.$item['slug'].'/editpage/'.$item['id'])}}">
                                <div class="left_content">
                                    <div class="page_img">
                                        <img src="{{$item['img'] === 'default.png' ? url('/media/default.png') : url('/storage/'.$item['img'])}}" alt="Imagem da página">
                                    </div>
                                    <div class="page_title">
                                        <span>{{$item['title']}}</span>
                                    </div>
                                </div>
                                <div class="mid_content"><span>{{$item['description']}}</span></div>
                                <div class="right_content">
                                    <span>{{$item['timeMsg']}}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <span>Você ainda não editou nenhuma página...</span>
            @endif
        </div>
    </div>
@endsection
