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

    public function edit(Color $colore)
    {
        return view('base.colores.edit', compact('colore'));
    }

    public function update(Request $request, Color $colore)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:colores,nombre,' . $colore->id
        ]);

        $colore->update($validated);
        return redirect()->route('colores.index')->with('success', 'Color actualizado correctamente');
    }

    public function destroy(Color $colore)
    {
        if (!$colore->estado) {
            return redirect()->route('colores.index')->with('warning', 'El color ya está eliminado');
        }
        $colore->update(['estado' => false]);
        return redirect()->route('colores.index')->with('success', 'Color eliminado correctamente');
    }

    public function restaurar(Color $colore)
    {
        if ($colore->estado) {
            return redirect()->route('colores.index')->with('warning', 'El color ya está activado');
        }
        $colore->update(['estado' => true]);
        return redirect()->route('colores.index')->with('success', 'Color restaurado correctamente');
    }
}
