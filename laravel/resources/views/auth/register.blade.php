<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrarse</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

    <main class="container">

        <h1 class="title">Crear nueva cuenta</h1>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <h3>Errores:</h3>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.note') }}" method="POST" class="form">
            @csrf

            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password">
            </div>

            <button type="submit" class="btn-create">Registrarse</button>

        </form>

        <p style="margin-top: 15px;">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}">Inicia sesión</a>
        </p>

    </main>

</body>
</html>
