<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    public function index()
    {
        return view('base.colores.index');
    }

    public function create()
    {
        return view('base.colores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:colores,nombre',
        ], [
            'nombre.required' => 'El nombre del color es obligatorio.',
            'nombre.unique'   => 'Este color ya está registrado.',
        ]);
        Color::create($validated);
        return redirect()->route('colores.index')
            ->with('success', 'Color registrado correctamente.');
    }

    public function obtenerColores(Request $request)
    {
        if (!$request->ajax()) {
            $colores = Color::select('id', 'nombre', 'estado')->get();
            return response()->json($colores);
        }
        
        // Para peticiones AJAX de DataTables
        $colores = Color::select('id', 'nombre', 'estado');
        
        return DataTables::of($colores)
            ->addIndexColumn()
            ->addColumn('acciones', function($row) {
                if ($row->estado) {
                    $editUrl = route('colores.edit', $row->id);
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
