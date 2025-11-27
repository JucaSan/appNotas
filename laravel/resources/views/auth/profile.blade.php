<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi Perfil</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

    <main class="container">

        <a href="{{ route('notes.index') }}">← Volver a notas</a>

        <h1 class="title">Mi Perfil</h1>

        <section class="profile-box">
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </section>

        <h2>Cambiar contraseña</h2>

        @if (session('success'))
            <p class="alert-success">
                {{ session('success') }}
            </p>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="form">
            @csrf

            <div class="form-group">
                <label>Contraseña actual:</label>
                <input type="password" name="current_password">
            </div>

            <div class="form-group">
                <label>Nueva contraseña:</label>
                <input type="password" name="password">
            </div>

            <div class="form-group">
                <label>Confirmar contraseña nueva:</label>
                <input type="password" name="password_confirmation">
            </div>

            <button type="submit" class="btn-create">Actualizar contraseña</button>
        </form>

    </main>

</body>
</html>
