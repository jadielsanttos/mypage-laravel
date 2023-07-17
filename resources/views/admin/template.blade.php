<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">
    <link rel="shortcut icon" href="{{url('assets/images/favicon-oficial.png')}}" type="image/x-icon">
    <title>@yield('title')</title>
</head>
<body>

    <div class="left_side_template">
        <div class="area_top_template">
            <a href="{{url('/admin')}}"><img src="{{url('assets/images/MyPage.png')}}" alt="Logo"></a>
        </div>

        <div class="area_links_template">
            <nav>
                <ul>
                    <li><a href="{{url('/admin')}}"><i class="fa-solid fa-house fa-sm"></i> Home</a></li>
                    <li><a href="{{url('/admin/pages')}}"><i class="fa-regular fa-file-lines"></i> Páginas</a></li>
                    <li><a href="{{url('/admin/profile/'.$user->id)}}"><i class="fa-regular fa-user"></i> Perfil</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="container_single">
        <div class="area_static">
            <div class="icon_menu"><i class="fa-solid fa-bars"></i></div>
            <div class="right_side">
                <div class="link_add_page">
                    <a href="{{url('/admin/addpage')}}">Criar página</a>
                </div>
                <div class="profile_img">
                    <img src="{{url('storage/'.$user->profile_img)}}" alt="Imagem de perfil">
                </div>
            </div>
        </div>
        @yield('content')
    </div>

    <script src="{{url('assets/js/script.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://kit.fontawesome.com/e3dc242dae.js" crossorigin="anonymous"></script>
</body>
</html>
