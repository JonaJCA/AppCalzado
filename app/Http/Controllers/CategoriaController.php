<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoriaController extends Controller
{
    public function index()
    {
        return view('base.categorias.index');
    }

    public function create()
    {
        return view('base.categorias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:categorias,nombre',
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.unique'   => 'Esta categoría ya está registrada.',
        ]);
        Categoria::create($validated);
        return redirect()->route('categorias.index')
            ->with('success', 'Categoría registrada correctamente.');
    }

    public function obtenerCategorias(Request $request)
    {
        if (!$request->ajax()) {
            $categorias = Categoria::select('id', 'nombre', 'estado')->get();
            return response()->json($categorias);
        }
        
        // Para peticiones AJAX de DataTables
        $categorias = Categoria::select('id', 'nombre', 'estado');
        
        return DataTables::of($categorias)
            ->addIndexColumn()
            ->addColumn('acciones', function($row) {
                if ($row->estado) {
                    $editUrl = route('categorias.edit', $row->id);
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

    public function edit(Categoria $categoria)
    {
        return view('base.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:categorias,nombre,' . $categoria->id
        ]);
        $categoria->update($validated);
        return redirect()->route('categorias.index')->with('success', 'Categoria actualizada correctamente');
    }

    public function destroy(Categoria $categoria)
    {
        if (!$categoria->estado) {
            return redirect()->route('categorias.index')->with('warning', 'La Categoría ya está eliminada');
        }
        $categoria->update(['estado' => false]);
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente');
    }

    public function restaurar(Categoria $categoria)
    {
        if ($categoria->estado) {
            return redirect()->route('categorias.index')->with('warning', 'La Categoría ya está activada');
        }
        $categoria->update(['estado' => true]);
        return redirect()->route('categorias.index')->with('success', 'Categoría restaurada correctamente');
    }
}
