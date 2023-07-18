@extends('admin.template')

@section('title', 'MyPage - Suas páginas')

@section('content')
    <div class="section_pages_list">
        <div class="area_title">
            <h1 class="title">Suas páginas</h1>
            <div class="area_btn_add_page">
                <a href="{{url('/admin/addpage')}}"><i class="fa-solid fa-plus"></i> Adicionar</a>
            </div>
        </div>
        <div class="area_table_list">
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Editado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page)
                        <tr>
                            <td>
                                <a href="{{url('/'.$page->slug)}}" target="_blank">
                                    <img src="{{url('storage/'.$page->op_profile_image)}}" alt="Imagem da página">
                                </a>
                                <span>{{$page->op_title}}</span>
                            </td>
                            <td>2 minutos atrás...</td>
                            <td data-id="{{$page->id}}"><div class="area_toggle_icon"><i class="fa-solid fa-ellipsis-vertical"></i></div></td>
                            <td data-id="{{$page->id}}" class="single_td">
                                <div class="content_modal">
                                    <div class="link_item_modal">
                                        <a href="{{url('/'.$page->slug)}}" target="_blank">
                                            <div class="left"><i class="fa-regular fa-eye"></i></div>
                                            <div class="right"><span>Ver página</span></div>
                                        </a>
                                    </div>
                                    <div class="link_item_modal">
                                        <a href="{{url('/admin/'.$page->slug.'/links')}}">
                                            <div class="left"><i class="fa-solid fa-link"></i></div>
                                            <div class="right"><span>Links</span></div>
                                        </a>
                                    </div>
                                    <div class="link_item_modal">
                                        <a href="{{url('/admin/'.$page->slug.'/stats')}}">
                                            <div class="left"><i class="fa-solid fa-chart-simple"></i></div>
                                            <div class="right"><span>Estatísticas</span></div>
                                        </a>
                                    </div>
                                    <div class="link_item_modal">
                                        <a href="{{url('/admin/'.$page->slug.'/editpage/'.$page->id)}}">
                                            <div class="left"><i class="fa-solid fa-pen"></i></div>
                                            <div class="right"><span>Editar</span></div>
                                        </a>
                                    </div>
                                    <div class="link_item_modal">
                                        <a href="{{url('/admin/'.$page->slug.'/delpage/'.$page->id)}}" onclick="return confirm('Tem certeza que deseja excluir?')">
                                            <div class="left"><i class="fa-solid fa-trash"></i></div>
                                            <div class="right"><span>Deletar</span></div>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>

        let modal = document.querySelectorAll('.single_td');
        let areaToggleIcon = document.querySelectorAll('.area_toggle_icon');

        function closeModal() {
           modal.forEach((item) => {
                item.style.display = 'none';
           });

           document.removeEventListener('click', closeModal);
        }

        areaToggleIcon.forEach((item) => {
            item.addEventListener('click', () => {
               let id = item.closest('td').getAttribute('data-id');

               modal.forEach((itemModal) => {
                    if(itemModal.getAttribute('data-id') === id) {
                        closeModal();

                        itemModal.style.display = 'block';

                        setTimeout(() => {
                            document.addEventListener('click', closeModal);
                        }, 300);
                    }
               });
            });
        });

    </script>
@endsection
