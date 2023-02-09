<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            background: {{$bg}};
        }
        .main {
            width: 300px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: {{$font_color}};
        }
        .main .area_profile_image .profile_img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }
        .main .area_links {
            width: 300px;
        }
        .main .area_links a {
            display: block;
            text-decoration: none;
            text-align: center;
            margin-bottom: 10px;
            padding: 10px;
        }
        .main .area_links a.link_rounded {
            border-radius: 50px;
        }
        .main .area_links a.link_square {
            border-radius: 0;
        }
        .main .area_copy {
            margin-top: 20px;
        }

    </style>

</head>
<body>

    <div class="main">
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
                <a
                class="link_{{$link->op_border_type}}"
                style="
                background-color: {{$link->op_bg_color}};
                color: {{$link->op_text_color}};"
                target="_blank"
                href="{{$link->href}}">{{$link->title}}</a>
            @endforeach
        </div>

        <div class="area_copy">
            <span>&copy; Jadiel Santos</span>
        </div>
    </div>

</body>
</html>
