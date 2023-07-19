@extends('admin.template')

@section('title', 'MyPage - links')

@section('content')
    <div class="section_links_list">
        <div class="area_title">
            <h1 class="title">Adicionar página</h1>
        </div>
    </div>


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
