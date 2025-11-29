<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notas</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                    <a href="{{route('notes.show', $note->id)}}" class="list_element_link">
                        {{ $note->title }}
                    
                        @if ($note->is_important)
                            <span class="badge">Importante</span>
                        @endif

                        
                    
                        @if ($note->reminder_date)
                            <span class="badge_show badge_reminder">
                                <i class="fa-regular fa-clock"></i>
                                {{ \Carbon\Carbon::parse($note->reminder_date)->format('d/m/Y H:i') }}
                            </span>
                        @endif
                        
                        
                    </a>
                </li>
            @endforeach



            </ul>

        <a href="{{route('notes.create')}}" class="btn-create">Crear nueva nota</a>
    </main>

</body>
</html>