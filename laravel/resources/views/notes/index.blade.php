<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
</head>

<body>

<header class="top-bar">
    <h1 class="title">Notas creadas</h1>

    <div class="elements">
        <a href="{{ route('profile') }}">Mi Perfil</a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Cerrar sesión</button>
        </form>
    </div>
</header>

<main class="container">

    {{-- ===========================
         FORMULARIO DE FILTROS
    ============================ --}}
    <form method="GET" action="{{ route('notes.index') }}" class="filters">

        <input type="text"
               name="search"
               placeholder="Buscar por título"
               value="{{ request('search') }}">

        <input type="date"
               name="date_from"
               value="{{ request('date_from') }}">

        <input type="date"
               name="date_to"
               value="{{ request('date_to') }}">

        <select name="orden_columna">
            <option value="created_at" {{ request('orden_columna') == 'created_at' ? 'selected' : '' }}>
                Fecha
            </option>
            <option value="title" {{ request('orden_columna') == 'title' ? 'selected' : '' }}>
                Título
            </option>
        </select>

        <select name="orden_direccion">
            <option value="desc" {{ request('orden_direccion') == 'desc' ? 'selected' : '' }}>
                Descendente
            </option>
            <option value="asc" {{ request('orden_direccion') == 'asc' ? 'selected' : '' }}>
                Ascendente
            </option>
        </select>

        <button type="submit" class="btn-filter">Aplicar filtros</button>

    </form>


    {{-- ===========================
         LISTADO DE NOTAS
    ============================ --}}
    <ul class="list">
        @forelse ($notes as $note)
            <li class="list_element">

                <a href="{{ route('notes.show', $note->id) }}"
                   class="list_element_link
                    @if($note->is_important) important-bg @endif
                    @if($note->reminder_date) reminder-bg @endif">

                    {{ $note->title }}

                    {{-- Badge de importante --}}
                    @if($note->is_important)
                        <span class="badge">Importante</span>
                    @endif

                    {{-- Badge de recordatorio --}}
                    @if ($note->reminder_date)
                        <span class="badge_show badge_reminder">
                            <i class="fa-regular fa-clock"></i>
                            {{ \Carbon\Carbon::parse($note->reminder_date)->format('d/m/Y H:i') }}
                        </span>
                    @endif
                </a>

            </li>
        @empty
            <p>No hay notas con los filtros seleccionados.</p>
        @endforelse
    </ul>

    <a href="{{ route('notes.create') }}" class="btn-create">Crear nueva nota</a>

</main>

</body>
</html>
