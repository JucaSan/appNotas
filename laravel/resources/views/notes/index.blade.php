<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notas</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <header class="top-bar">
        <h1 class="title">Notas creadas</h1>

        <div class="elements">
            <a href="{{route('profile')}}">Mi Perfil</a>
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Cerrar sesión</button>
            </form>
        </div>
    </header>


    <main class="container">
        <ul class="list">
            @foreach ($notes as $note)
                <li class="list_element">
                    <a href="{{route('notes.show', $note->id)}}">
                        {{$note->title}}
                    </a>
                </li>
            @endforeach
            </ul>

        <a href="{{route('notes.create')}}" class="btn-create">Crear nueva nota</a>
    </main>

</body>
</html>