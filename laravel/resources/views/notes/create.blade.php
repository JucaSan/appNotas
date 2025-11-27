<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear nueva nota</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

    <main class="container">

        <h1 class="title">Crear nueva nota</h1>

        <a href="{{ route('notes.index') }}">← Volver a notas</a>

        <form action="{{ route('notes.store') }}" method="POST" class="form">
            @csrf

            <div class="form-group">
                <label for="title">Título de la nota</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="content">Detalles</label>
                <textarea id="content" name="content" rows="6">{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn-create">Crear nueva nota</button>

        </form>

    </main>

</body>
</html>
