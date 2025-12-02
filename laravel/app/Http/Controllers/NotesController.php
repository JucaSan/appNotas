<?php

namespace App\Http\Controllers;

use App\Builders\AdvancedNoteBuilder;
use App\Builders\IntermediateNoteBuilder;
use App\Builders\NoteExportDirector;
use App\Builders\SimpleNoteBuilder;
use App\Factories\NoteFactory;
use App\Http\Requests\StoreNoteRequest;
use App\Models\Note;
use App\Services\NoteSyncService;
use App\Services\SincronizadorNotas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotesController extends Controller
{

    private function getUserNote($id)
    {
        $userId = Auth::id();

        $note = DB::table('notes')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (! $note) {
            abort(403, 'No tienes permiso para acceder a esta nota.');
        }

        return $note;
    }


    public function index() {
        $userId = Auth::id();

        $notes = DB::table('notes')->where('user_id', $userId)->get();
        return view('notes.index', compact('notes'));
    }

    public function create(){
        return view('notes.create');
    }

    public function show($id)
    {
        $note = $this->getUserNote($id);
        return view('notes.show', compact('note'));
    }

    public function store(StoreNoteRequest $request)
    {
        $noteType = NoteFactory::make($request);

        $noteData = $noteType->build([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'reminder_date' => $request->reminder_date,
        ]);

        $noteId = DB::table('notes')->insertGetId($noteData);

        SincronizadorNotas::enviar($noteData);

        return redirect()->route('notes.index')->with('success', 'Nota creada correctamente');
    }



    public function edit($id) {
        $note = $this->getUserNote($id);
        return view('notes.edit', compact('note'));
    }

    public function update(StoreNoteRequest $request, $id)
    {
        $note = $this->getUserNote($id);

        $noteType = NoteFactory::make($request);

        $data = $noteType->buildForUpdate([
            'title' => $request->title,
            'content' => $request->content,
            'reminder_date' => $request->reminder_date,
        ]);

        DB::table('notes')->where('id', $id)->update($data);

        return redirect()->route('notes.show', $id)
            ->with('success', 'Nota actualizada correctamente');
    }




    public function destroy($id) {
        $note = $this->getUserNote($id);
        DB::table('notes')->where('id', $id)->delete();
        return redirect()->route('notes.index');
    }


    public function export($id)
    {
        $note = (array) DB::table('notes')->where('id', $id)->first();

        $metadata = json_decode($note['metadata'], true);
        $style = $metadata['export_style'] ?? 'simple';

        $director = new NoteExportDirector();

        switch ($style) {
            case 'simple':
                $builder = new SimpleNoteBuilder();
                $data = $director->buildSimple($builder, $note);
                break;

            case 'intermediate':
                $builder = new IntermediateNoteBuilder();
                $data = $director->buildIntermediate($builder, $note);
                break;

            case 'advanced':
                $builder = new AdvancedNoteBuilder();
                $data = $director->buildAdvanced($builder, $note);
                break;
        }

        return response()->json($data);
    }

    public function sync($id) {
        $note = (array) DB::table('notes')->where('id', $id)->first();
        dd(SincronizadorNotas::enviar($note));
    }
}
