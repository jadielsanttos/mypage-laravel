<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mylinks - Login</title>
    <link rel="stylesheet" href="{{url('assets/css/admin.login.css')}}">
</head>
<body>

    <div class="area_login">
        <h1>Login</h1>

        @if ($error)
            <div class="error_msg">{{$error}}</div>
        @endif

        <form method="post">
            @csrf

            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Senha">
            <input type="submit" name="entrar" value="Entrar">
            <span>Ainda não tem conta? <a href="{{url('admin/register')}}">Cadastre-se</a></span>
        </form>
    </div>

</body>
</html>
