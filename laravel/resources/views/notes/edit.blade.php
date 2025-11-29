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
                <label for="title">Título de nota</label>
                <input type="text" id="title" name="title" value="{{ old('title', $note->title) }}">
            </div>

            <div class="form-group">
                <label for="content">Detalles</label>
                <textarea id="content" name="content" rows="6">{{ old('content', $note->content) }}</textarea>
            </div>


            <div>
                <label for="is_important">¿Prioridad alta?</label>
                <input 
                    type="checkbox" 
                    id="is_important"
                    name="is_important" 
                    onchange="toggleReminder()"
                    value="1"
                >
            </div>
            
            <div id="reminder_input">
                <label>Fecha de recordatorio:</label><br>
                <input 
                    type="datetime-local" 
                    name="reminder_date"
                    id="reminder_date"
                >
            </div>

            <button class="btn-create" type="submit">Guardar cambios</button>
        </form>
    </main>

    <script>
        function toggleReminder() {
            const isImportant = document.getElementById('is_important').checked;
            const reminderDiv = document.getElementById('reminder_input');
            const reminderInput = document.getElementById('reminder_date');

            if (isImportant) {
                reminderDiv.classList.add('hidden');
                reminderInput.value = "";
            } else {
                reminderDiv.classList.remove('hidden');
            }
        }

    </script>

</body>
</html>
