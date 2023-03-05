<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('assets/css/admin.template.css')}}">
    <title>@yield('title')</title>
</head>
<body>

    <nav>
        <div class="nav__top">
            <a href="{{url('/admin')}}"><i class="fa-solid fa-house"></i></a>
        </div>

        <div class="nav_bottom">
            <div class="area_icon_profile">
                @if ($user->profile_img == null)
                    <div class="fake_img_profile">
                        {{substr($user->name,0,1)}}
                    </div>
                @else
                    <div class="area_img_profile">
                        <img src="{{url('storage/'.$user->profile_img)}}" alt="">
                    </div>
                @endif
            </div>

            <div class="modal_options_to_user">
                <a href="{{url('/admin/profile/'.$user->id)}}"><i class="fa-solid fa-user"></i> Perfil</a>
                <a href="{{url('/admin/logout')}}"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
            </div>
        </div>
    </nav>

    <section class="container_single">
        @yield('content')
    </section>

    <script src="{{url('assets/js/script.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://kit.fontawesome.com/e3dc242dae.js" crossorigin="anonymous"></script>
</body>
</html>
