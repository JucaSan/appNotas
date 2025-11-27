<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

    <main class="container">

        <h1 class="title">Iniciar en notas</h1>

        @if (session('error'))
            <p style="color: red; font-weight: bold; margin-bottom: 15px;">
                {{ session('error') }}
            </p>
        @endif

        <form action="{{ route('login.note') }}" method="POST" class="form">
            @csrf

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn-create">Iniciar sesión</button>

        </form>

        <p style="margin-top: 15px;">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}">Regístrate</a>
        </p>

    </main>

</body>
</html>
