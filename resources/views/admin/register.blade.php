<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mylinks - Cadastro</title>
    <link rel="stylesheet" href="{{url('assets/css/admin.login.css')}}">
</head>
<body>

    <div class="area_login">
        <h1>Cadastro</h1>

        @if ($error)
            <div class="error_msg">{{$error}}</div>
        @endif

        <div class="area_form_resgiter_user">
            <form method="post">
                @csrf
                <input type="text" name="name" placeholder="Nome">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Senha">
                <input type="submit" name="entrar" value="Cadastrar">
                <span>Ja tem sua conta? <a href="{{url('admin/login')}}">Faça Login</a></span>
            </form>
        </div>
    </div>

</body>
</html>
