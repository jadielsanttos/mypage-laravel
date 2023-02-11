@extends('admin.page')

@section('body')
    <div class="link_voltar">
        <a href="{{url('/admin')}}"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
    
    <a href="{{url('/admin/'.$page->slug.'/newlink')}}" class="big_button">Novo link</a>

    @if(count($links) === 0)
        <div class="verify_qtd_links">
            <p>Você não possui nenhum link nessa página...</p>
        </div>
    @else
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
                        <a href="{{url('/admin/'.$page->slug.'/editlink/'.$link->id)}}" class="link_edit_link"><i class="fa-solid fa-pen"></i></a>
                        <a href="{{url('/admin/'.$page->slug.'/dellink/'.$link->id)}}" class="link_delete_link" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

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
