<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar nota</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

    <main class="container">
        <h1 class="title">Editar nota</h1>
    
        @if ($errors->any())
            <div style="color: red;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form action="{{ route('notes.update', $note->id) }}" method="POST" class="form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titulo de nota:</label>
                <input type="text" id="title" name="title" value="{{ old('title', $note->title) }}"><br>
            </div>

            <div class="form-group">
                <label for="content">Detalles:</label>
                <textarea id="content" cols="30" rows="10" name="content">{{old('content', $note->content)}}</textarea>
            </div>
    
    
            <button class="btn-create" type="submit">Editar nota</button>
        </form>
    </main>
</body>
</html>