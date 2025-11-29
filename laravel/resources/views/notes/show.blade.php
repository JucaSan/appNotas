<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota {{ $note->title }}</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

    <main class="container">

        <a href="{{ route('notes.index') }}">← Volver a todas las notas</a>

        @if (session('success'))
            <p style="color: green; font-weight: bold; margin: 10px 0;">
                {{ session('success') }}
            </p>
        @endif

        <div class="list_element note_show_card">

            <h1 class="note_show_title">Título: {{ $note->title }}</h1>
        
            {{-- BADGES SPECIAL --}}
            <div class="note_show_badges">
                @if ($note->is_important)
                    <span class="badge_show badge_important">Importante</span>
                @endif
        
                @if ($note->reminder_date)
                    <span class="badge_show badge_reminder">
                        Recordatorio: {{ \Carbon\Carbon::parse($note->reminder_date)->format('d/m/Y H:i') }}
                    </span>
                @endif
            </div>
        
            <p class="note_show_subtitle">Detalles:</p>
        
            <p class="note_show_content">
                {{ $note->content }}
            </p>
        
        </div>
        
        <div style="margin-top: 20px; display: flex; gap: 10px;">

            <a href="{{ route('notes.edit', $note->id) }}" class="btn-create">
                Editar nota
            </a>

            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta nota?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-logout" >
                    Eliminar nota
                </button>
            </form>

        </div>

    </main>

</body>
</html>
