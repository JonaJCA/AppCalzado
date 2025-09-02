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
                                <img src="'.asset('assets/icons/pencil.svg').'" alt="Editar" width="16" height="16">
                            </a>
                            <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion('.$row->id.')">
                                <img src="'.asset('assets/icons/trash.svg').'" alt="Eliminar" width="16" height="16" style="filter: brightness(0) invert(1);">
                            </button>';
                } else {
                    // Si está inactivo: mostrar solo botón Restaurar
                    return '<button class="btn btn-sm btn-success" onclick="confirmarRestauracion('.$row->id.')">
                                <img src="'.asset('assets/icons/sync.svg').'" alt="Restaurar" width="16" height="16">
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
