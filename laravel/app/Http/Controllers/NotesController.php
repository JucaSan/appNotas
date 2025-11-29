<?php

namespace App\Http\Controllers;

use App\Factories\NoteFactory;
use App\Http\Requests\StoreNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotesController extends Controller
{
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
        $note = DB::table('notes')->where('id', $id)->first();
        return view('notes.show', compact('note'));
    }

    public function store(StoreNoteRequest $request)
    {
        $data = NoteFactory::createDataFromRequest($request, Auth::user());

        DB::table('notes')->insert($data);

        return redirect()->route('notes.index')->with('success', 'Nota creada correctamente');
    }


    public function edit($id) {
        $note = DB::table('notes')->where('id', $id)->first();
        return view('notes.edit', compact('note'));
    }

    public function update(StoreNoteRequest $request, $id)
    {
        $data = NoteFactory::updateDataFromRequest($request);
    
        DB::table('notes')->where('id', $id)->update($data);
    
        return redirect()->route('notes.show', $id)
            ->with('success', 'Nota actualizada correctamente');
    }



    public function destroy($id) {
        DB::table('notes')->where('id', $id)->delete();
        return redirect()->route('notes.index');
    }
}
