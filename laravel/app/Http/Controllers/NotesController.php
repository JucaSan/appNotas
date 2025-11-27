<?php

namespace App\Http\Controllers;

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

    public function store(StoreNoteRequest $request){
        $userId = Auth::id();

        DB::table('notes')->insert([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('notes.index')->with('success', 'Nota creada correctamente');
    }

    public function edit($id) {
        $note = DB::table('notes')->where('id', $id)->first();
        return view('notes.edit', compact('note'));
    }

    public function update(StoreNoteRequest $request, $id) {;
        DB::table('notes')
        ->where('id', $id)
        ->update([
            'title' => $request->title,
            'content' => $request->content,
            'updated_at' => now(),
        ]);

        return redirect()->route('notes.show', $id)
            ->with('success', 'Nota actualizada correctamente');
    }

    public function destroy($id) {
        DB::table('notes')->where('id', $id)->delete();
        return redirect()->route('notes.index');
    }
}
