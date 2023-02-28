@extends('admin.template')

@section('title', 'Mylinks - Home')

@section('content')

    <header class="header">
        <div class="icon_menu"><i class="fa-solid fa-bars"></i></div>
    </header>

    <div class="title_page">
        <h2>Suas páginas</h2>
    </div>
    <a href="{{url('/admin/addpage')}}" class="link_add_page">Adicionar página</a>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th class="th_actions">Ações <i class="fa-solid fa-angle-down"></i></th>
            </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>{{$page->op_title}} ({{$page->slug}})
                    <div class="links_td_page">
                        <a href="{{url('/admin/'.$page->slug.'/editpage/'.$page->id)}}" class="link_edit_page"><i class="fa-solid fa-pen"></i></a>
                        <a href="{{url('/admin/'.$page->slug.'/delpage/'.$page->id)}}" class="link_delete_page" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa-solid fa-trash"></i></a>
                    </div>
                    {{-- <i class="fa-solid fa-ellipsis" id="icon_actions"></i> --}}
                </td>
                <td class="td_actions">
                    <a href="{{url('/'.$page->slug)}}" target="_blank">Ver página</a>
                    <a href="{{url('/admin/'.$page->slug.'/links')}}">Links</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
