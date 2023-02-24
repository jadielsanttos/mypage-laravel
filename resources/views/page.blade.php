<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <title>{{$title}}</title>
</head>
<body style="background: {{$bg}}">

    <div class="main" style="color: {{$font_color}};">
        <div class="area_profile_image">
            <img class="profile_img" src="{{$profile_image}}">
        </div>

        <div class="area_title">
            <h2>{{$title}}</h2>
        </div>

        <div class="area_description">
            <p>{{$description}}</p>
        </div>

        <div class="area_links">
            @foreach($links as $link)
                <div class="area-link">
                    <a
                    data-id="{{$link->id}}"
                    onclick="addClick(this)"
                    class="btn link_{{$link->op_border_type}}"
                    style="
                    background-color: {{$link->op_bg_color}};
                    color: {{$link->op_text_color}};"
                    target="_blank"
                    href="{{$link->href}}">{{$link->title}}</a>
                </div>
            @endforeach
        </div>

        <div class="area_copy">
            <span>&copy; MyLinks</span>
        </div>
    </div>

    <script>
        function addClick(e) {
            let slug = '{{$page->slug}}';
            let id = $(e).attr('data-id');
            let url = `{{url('/${slug}/addclick')}}`;

            $.ajax({
                type: 'POST',
                url: url,
                data:{slug:slug,id:id,_token:'{{ csrf_token() }}'}
            })
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="{{url('assets/js/script.js')}}"></script>
</body>
</html>
