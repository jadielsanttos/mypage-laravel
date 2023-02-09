@extends('admin.page')

@section('body')
    <a href="{{url('/admin/'.$page->slug.'/newlink')}}" class="big_button">Novo link</a>

    <ul id="links">
        @foreach($links as $link)
            <li class="link_item_list" data-id="{{$link->id}}">
                <div class="link_item_order">
                    <i class="fa-solid fa-sort"></i>
                </div>
                <div class="link_item_info">
                    <div class="item_link_title"><strong>{{$link->title}}</strong></div>
                    <div class="item_link_href">{{$link->href}}</div>
                </div>
                <div class="link_item_buttons">
                    <a href="{{url('/admin/'.$page->slug.'/editlink/'.$link->id)}}">Editar</a>
                    <a href="{{url('/admin/'.$page->slug.'/dellink/'.$link->id)}}" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </div>
            </li>
        @endforeach
    </ul>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        new Sortable(document.querySelector('#links'), {
            animation: 150,
            onEnd: async(e) => {
                let id = e.item.getAttribute('data-id');
                let link = `{{url('/admin/linkorder/${id}/${e.newIndex}')}}`;
                await fetch(link);
                window.location.href = window.location.href;
            }
        });
    </script>
@endsection
