<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('assets/css/admin.login.css')}}">
    <link rel="shortcut icon" href="{{url('assets/images/favicon-oficial.png')}}" type="image/x-icon">
    <title>Mylinks - Cadastro</title>
</head>
<body>

    <div class="area_login">
        <div class="left_side">
            <div class="link_voltar"><a href="/"><i class="fa-solid fa-arrow-left"></i> Home</a></div>
            <div class="title"><h1>Cadastro</h1></div>
        @if ($error)
            <div class="error_msg">{{$error}}</div>
        @endif
        <div class="area_form">
            <form method="post">
                @csrf
                <input type="text" name="name" placeholder="Nome">
                <input type="email" name="email" placeholder="Email">
                <input id="pass" type="password" name="password" placeholder="Senha"><span class="single_span"><i class="fa-solid fa-eye"></i></span>
                <input type="submit" name="entrar" value="Cadastrar">
                <span>Ja tem sua conta? <a href="{{url('admin/login')}}">Faça Login</a></span>
            </form>
        </div>
        </div>
        <div class="right_side">
            <a href="/"><img src="{{url('assets/images/MyLinks.png')}}" alt=""></a>
        </div>
    </div>

    <script>
        document.querySelector('.single_span').addEventListener('click', () => {
            let input = document.querySelector('#pass');

            if(input.getAttribute('type') === 'text') {
                document.querySelector('.single_span i').style.color = '#ccc';
                input.setAttribute('type', 'password');
            }else {
                document.querySelector('.single_span i').style.color = '#000';
                input.setAttribute('type', 'text');
            }
        });
    </script>
    <script src="https://kit.fontawesome.com/e3dc242dae.js" crossorigin="anonymous"></script>
</body>
</html>
