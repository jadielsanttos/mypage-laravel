@extends('admin.template')

@section('title', 'MyPage - Meus links')

@section('content')
    <div class="section_links_list">
        <div class="area_title">
            <h1 class="title">Meus links</h1>
            <div class="area_btn_add_link">
                <a class="btn_secondary" href="{{url('/admin/'.$page->slug.'/newlink')}}"><i class="fa-solid fa-plus"></i> Adicionar</a>
            </div>
        </div>

        <div class="area_list">
            @foreach($links as $link)
                <div class="list_item" data-id="{{$link->id}}">
                    <div class="left_side">
                        <div class="area_icon_sort"><i class="fa-solid fa-sort"></i></div>
                        <div class="area_info_content">
                            <div class="link_title"><h3>{{$link->title}}</h3></div>
                            <div class="link_url"><span>{{$link->href}}</span></div>
                        </div>
                    </div>
                    <div class="right_side">
                        <div class="area_icon_options" data-id="{{$link->id}}"><i class="fa-solid fa-ellipsis"></i></div>
                    </div>
                    <div class="popup_link_item" data-id="{{$link->id}}">
                        <div class="area_links_popup">
                            <ul>
                                <li><a href="{{url('/admin/'.$page->slug.'/editlink/'.$link->id)}}"><i class="fa-solid fa-pen"></i> Editar</a></li>
                                <li><a href="{{url('/admin/'.$page->slug.'/dellink/'.$link->id)}}" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa-solid fa-trash"></i> Deletar</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>

        const areaPopUpLink = document.querySelectorAll('.popup_link_item')
        const iconOpenPupUpLink = document.querySelectorAll('.area_icon_options')

        function closePopUpLink() {
            areaPopUpLink.forEach((item) => {
                item.style.display = 'none'
            })
            document.removeEventListener('click', closePopUpLink)
        }

        iconOpenPupUpLink.forEach((icon) => {
            icon.addEventListener('click', () => {
                let id = icon.getAttribute('data-id')

                areaPopUpLink.forEach((popUpItem) => {
                    if(popUpItem.getAttribute('data-id') === id) {
                        closePopUpLink()

                        popUpItem.style.display = 'block'

                        setTimeout(() => {
                            document.addEventListener('click', closePopUpLink)
                        }, 300)
                    }
                })

            })
        })

        // ordenação dos links
        new Sortable(document.querySelector('.area_list'), {
            animation: 150,
            onEnd: async(e) => {
                let id = e.item.getAttribute('data-id')
                let link = `{{url('/admin/linkorder/${id}/${e.newIndex}')}}`
                await fetch(link)
                window.location.href = window.location.href
            }
        })
    </script>
@endsection
