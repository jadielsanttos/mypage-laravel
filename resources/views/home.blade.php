<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="{{url('assets/images/favicon-oficial.png')}}" type="image/x-icon">
    <title>MyPage</title>
</head>
<body>

    <header class="section_header">
        <div class="area_header">
            <div class="area_logo">
                <a href="/"><img src="{{url('assets/images/MyPage.png')}}" alt="logo"></a>
            </div>
            <div class="area_menu_desktop">
                <nav>
                    <a href="{{url('/admin/login')}}">Entrar</a>
                    <a href="{{url('/admin/register')}}" class="btn_register">Começar grátis</a>
                </nav>
            </div>
            <div class="area_menu_mobile">
                <div class="btn_close_menu_mobile">
                    <span><i class="fa-solid fa-xmark"></i></span>
                </div>
                <nav>
                    <a href="{{url('/admin/login')}}">Entrar</a>
                    <a href="{{url('/admin/register')}}" class="btn_register">Começar grátis</a>
                </nav>
            </div>
            <div class="btn_toggle_menu_mobile">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </header>

    <section class="section_banner">
        <div class="area_banner">
            <div class="area_banner_left_side">
                <div class="title"><h1>Crie sua conta e tenha agora mesmo sua página de links personalizável</h1></div>
                <div class="area_btn_cta"><a href="{{url('/admin/login')}}">Começar</a></div>
            </div>
            <div class="area_banner_right_side">
                <div class="area_img">
                    <img src="{{url('assets/images/tablets.png')}}" alt="Tablets">
                </div>
            </div>
        </div>
    </section>

    <section class="section_panel">
        <div class="area_container">
            <div class="left_side">
                <div class="area_img">
                    <img class="img_desktop" src="{{url('assets/images/painel_mypage.png')}}" alt="Foto-painel">
                </div>
            </div>
            <div class="right_side">
                <div class="content_right_side">
                    <div class="title">
                        <h2>Gerencie seus links</h2>
                    </div>
                    <div class="description">
                        <p>Tenha controle de tudo em um só lugar. Cores, posições  e estatísticas.</p>
                    </div>
                    <div class="area_btn_cta">
                        <a class="btn_cta" href="{{url('/admin/register')}}">Criar conta</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_stats">
        <div class="area_section_stats">
            <div class="area_left_side">
                <div class="content_left_side">
                    <div class="title">
                        <h2>Veja as estatísticas em tempo real</h2>
                    </div>
                    <div class="description">
                        <p>Saiba se sua página está engajada, quantas visitas nas últimas horas, total de cliques, e muito mais...</p>
                    </div>
                    <div class="area_btn_cta">
                        <a class="btn_cta" href="{{url('/admin/register')}}">Criar página</a>
                    </div>
                </div>
            </div>
            <div class="area_right_side">
                <div class="area_img">
                    <img src="{{url('assets/images/stats.png')}}" alt="Estatísticas">
                </div>
            </div>
        </div>
    </section>

    <footer class="section_footer">
        <div class="area_footer">
            <div class="footer_left">
                <img src="{{url('assets/images/MyPage.png')}}" alt="">
            </div>

            <div class="footer_right">
                <div class="area_copy">
                    <p>MyPage 2023 - &copy; Todos os direitos reservados</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.querySelector('.btn_toggle_menu_mobile').addEventListener('click', () => {
            document.querySelector('.area_menu_mobile').style.width = '60vw';
        });

        document.querySelector('.btn_close_menu_mobile').addEventListener('click', () => {
            document.querySelector('.area_menu_mobile').style.width = '0vw';
        });
    </script>
    <script src="https://kit.fontawesome.com/e3dc242dae.js" crossorigin="anonymous"></script>
</body>
</html>
