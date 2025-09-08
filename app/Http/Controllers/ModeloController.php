<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ModeloController extends Controller
{
    public function index()
    {
        return view('base.modelos.index');
    }

    public function create()
    {
        $marcas = Marca::all();
        return view('base.modelos.create', compact('marcas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|unique:modelos,nombre',
            'descripcion' => 'nullable|string',
            'marca_id'    => 'required|exists:marcas,id',
        ], [
            'nombre.required'   => 'El nombre del modelo es obligatorio.',
            'nombre.unique'     => 'Este modelo ya está registrado.',
            'marca_id.required' => 'Debe seleccionar una marca.',
            'marca_id.exists'   => 'La marca seleccionada no es válida.',
        ]);
        Modelo::create($validated);
        return redirect()->route('modelos.index')
            ->with('success', 'Modelo registrado correctamente.');
    }

    public function obtenerModelos(Request $request)
    {
        if (!$request->ajax()) {
            $modelos = Modelo::with('marca:id,descripcion')
                        ->select('id', 'marca_id', 'nombre', 'descripcion', 'estado', 'marca_id')
                        ->get();
            return response()->json($modelos);
        }
        
        // Para peticiones AJAX de DataTables
        $modelos = Modelo::with('marca:id,descripcion')->select('id', 'marca_id', 'nombre', 'descripcion', 'estado');
        
        return DataTables::of($modelos)
            ->addIndexColumn()
            ->addColumn('acciones', function($row) {
                if ($row->estado) {
                    $editUrl = route('modelos.edit', $row->id);
                    return '<a href="'.$editUrl.'" class="btn btn-sm btn-warning">
                                <i class="fa-solid fa-pen text-white"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion('.$row->id.')">
                                <i class="fa-solid fa-trash text-white"></i>
                            </button>';
                } else {
                    // Si está inactivo: mostrar solo botón Restaurar
                    return '<button class="btn btn-sm btn-success" onclick="confirmarRestauracion('.$row->id.')">
                                <i class="fa-solid fa-rotate-right text-white"></i>
                            </button>';
                }   
            })
            ->addColumn('estado', function($row) {
                if ($row->estado) {
                    return '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    return '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }
            })
            ->rawColumns(['acciones', 'estado'])
            ->make(true);
    }

    public function edit(Modelo $modelo)
    {
        $marcas = Marca::all();
        return view('base.modelos.edit', compact('modelo', 'marcas'));
    }

    public function update(Request $request, Modelo $modelo)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|unique:modelos,nombre,' . $modelo->id,
            'descripcion' => 'nullable|string',
            'marca_id'    => 'required|exists:marcas,id',
        ]);
        $modelo->update($validated);
        return redirect()->route('modelos.index')->with('success', 'Modelo actualizado correctamente');
    }

    public function destroy(Modelo $modelo)
    {
        if (!$modelo->estado) {
            return redirect()->route('modelos.index')->with('warning', 'El modelo ya está eliminado');
        }
        $modelo->update(['estado' => false]);
        return redirect()->route('modelos.index')->with('success', 'Modelo eliminado correctamente');
    }

    public function restaurar(Modelo $modelo)
    {
        if ($modelo->estado) {
            return redirect()->route('modelos.index')->with('warning', 'El modelo ya está activado');
        }
        $modelo->update(['estado' => true]);
        return redirect()->route('modelos.index')->with('success', 'Modelo restaurado correctamente');
    }
}
