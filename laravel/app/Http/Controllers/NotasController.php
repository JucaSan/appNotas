<?php

namespace App\Http\Controllers;

use App\Builders\NotaExportDirector;
use App\Http\Requests\StoreNoteRequest;
use App\Services\SincronizadorNotas;
use Illuminate\Support\Facades\Auth;
use App\Services\NotasService;
use Illuminate\Http\Request;


class NotasController extends Controller
{
    protected $service;

    public function __construct(NotasService $service)
    {
        $this->service = $service;
    }


    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            $filters['user_id'] = Auth::id();

            $notes = $this->service->listarNotas($filters);
            return view('notes.index', compact('notes'));

        } catch (\Exception $e) {
            return back()->with('error', 'Error al listar notas.');
        }
    }


    public function create()
    {
        return view('notes.create');
    }

    public function show($id)
    {
        try {
            $userId = Auth::id();
            $note = $this->service->obtenerNota($id, $userId);

            if(!$note) {
                flash()->info('La nota no es de tu autoría o no existe');
                return back();
            }

            return view('notes.show', compact('note'));

        } catch(\Exception $e) {
            return back()->with('error', 'Error al obtener la nota');
        }
    }

    public function store(StoreNoteRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();

            $this->service->agregarNota($data);

            return redirect()->route('notes.index')
                ->with('success', 'Nota creada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear la nota');
        }
    }

    public function edit($id) {
        try {
            $userId = Auth::id();

            $note = $this->service->obtenerNota($id, $userId);

            if(!$note) {
                flash()->info('La nota no es de tu autoría o no existe');
            }

            return view('notes.edit', compact('note'));
        } catch(\Exception $e) {
            return back()->with('error', 'Error al crear la nota');
        }
    }

    public function update(StoreNoteRequest $request, $id)
    {
       try {
            $data['updated_by'] = Auth::id();
            $data = $request->validated();
            $this->service->actualizarNota($id, $data);

           return redirect()->route('notes.show', $id)
                ->with('success', 'Nota actualizada correctamente');

       } catch (\Exception $e) {
           return back()->with('error', 'Error al actualizar la nota');
       }
    }

    public function destroy($id) {
        try {
            $this->service->eliminarNota($id, Auth::id());
    
            return redirect()->route('notes.index')
                ->with('success', 'Nota eliminada');
    
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la nota');
        }
    }

    public function export($id)
    {
        try {
            $userId = Auth::id();
            $note = $this->service->obtenerNota($id, $userId);

            if(!$note) {
                return back()->with('error', 'Nota no encontrada o no autorizada.');
            }

            $noteArray = (array) $note;

            $metadata = json_decode($noteArray['metadata'], true);
            $style = $metadata['export_style'] ?? 'simple';

            $director = new NotaExportDirector();
            $data = $director->build($style, $noteArray);

            return response()->json($data);
        } catch(\Exception $e) {
            return back()->with('Error', 'nota no encontrada o no autorizada');
        }
    }

    public function sync($id) 
    {
        try {
            $userId = Auth::id();
    
            $note = $this->service->obtenerNota($id, $userId);
    
            if (!$note) {
                return back()->with('error', 'Nota no encontrada o no autorizada.');
            }
    
            $noteArray = (array) $note;
    
            $sync = new SincronizadorNotas();
            $response = $sync->enviar($noteArray);
    
            return response()->json([
                'status' => 'success',
                'sync_result' => $response
            ]);
    
        } catch (\Exception $e) {
            return back()->with('error', 'Error al sincronizar la nota.');
        }
    }
}
