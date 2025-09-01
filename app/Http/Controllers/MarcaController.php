<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MarcaController extends Controller
{
    public function index()
    {
        return view('base.marcas.index');
    }

    public function create()
    {
        return view('base.marcas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|unique:marcas,descripcion',
        ], [
            'descripcion.required' => 'El nombre de la marca es obligatorio.',
            'descripcion.unique'   => 'Esta marca ya está registrada.',
        ]);
        Marca::create($validated);
        return redirect()->route('marcas.index')
            ->with('success', 'Marca registrada correctamente.');
    }

    public function obtenerMarcas(Request $request)
    {
        if (!$request->ajax()) {
            $marcas = Marca::select('id', 'descripcion', 'estado')->get();
            return response()->json($marcas);
        }
        
        // Para peticiones AJAX de DataTables
        $marcas = Marca::select('id', 'descripcion', 'estado');
        
        return DataTables::of($marcas)
            ->addIndexColumn()
            ->addColumn('acciones', function($row) {
                if ($row->estado) {
                    $editUrl = route('marcas.edit', $row->id);
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

    public function edit(Marca $marca)
    {
        return view('base.marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|unique:marcas,descripcion,' . $marca->id
        ]);

        $marca->update($validated);
        return redirect()->route('marcas.index')->with('success', 'Marca actualizada correctamente');
    }

    public function destroy(Marca $marca)
    {
        if (!$marca->estado) {
            return redirect()->route('marcas.index')->with('warning', 'La Marca ya está eliminada');
        }
        $marca->update(['estado' => false]);
        return redirect()->route('marcas.index')->with('success', 'Marca eliminada correctamente');
    }

    public function restaurar(Marca $marca)
    {
        if ($marca->estado) {
            return redirect()->route('marcas.index')->with('warning', 'La Marca ya está activada');
        }
        $marca->update(['estado' => true]);
        return redirect()->route('marcas.index')->with('success', 'Marca restaurada correctamente');
    }
}
