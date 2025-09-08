<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TallaController extends Controller
{
    public function index()
    {
        return view('base.tallas.index');
    }

    public function create()
    {
        return view('base.tallas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|integer|min:15|unique:tallas,numero',
        ], [
            'numero.required' => 'El número de talla es obligatorio.',
            'numero.integer'  => 'El número de talla debe ser un valor entero.',
            'numero.min'      => 'El número de talla no puede ser negativo.',
            'numero.unique'   => 'Esta talla ya está registrada.',
        ]);
        Talla::create($validated);
        return redirect()->route('tallas.index')
            ->with('success', 'Talla registrada correctamente.');
        
    }

    public function obtenerTallas(Request $request)
    {
        if (!$request->ajax()) {
            $tallas = Talla::select('id', 'numero', 'estado')->get();
            return response()->json($tallas);
        }
        
        // Para peticiones AJAX de DataTables
        $tallas = Talla::select('id', 'numero', 'estado');
        
        return DataTables::of($tallas)
            ->addIndexColumn()
            ->addColumn('acciones', function($row) {
                if ($row->estado) {
                    $editUrl = route('tallas.edit', $row->id);
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

    public function edit(Talla $talla)
    {
        return view('base.tallas.edit', compact('talla'));
    }

    public function update(Request $request, Talla $talla)
    {
        $validated = $request->validate([
            'numero' => 'required|numeric|unique:tallas,numero,' . $talla->id
        ]);

        $talla->update($validated);
        return redirect()->route('tallas.index')->with('success', 'Talla actualizada correctamente');
    }

    public function destroy(Talla $talla)
    {
        if (!$talla->estado) {
            return redirect()->route('tallas.index')->with('warning', 'La talla ya está eliminada');
        }
        $talla->update(['estado' => false]);
        return redirect()->route('tallas.index')->with('success', 'Talla eliminada correctamente');
    }

    public function restaurar(Talla $talla)
    {
        if ($talla->estado) {
            return redirect()->route('tallas.index')->with('warning', 'La talla ya está activada');
        }
        $talla->update(['estado' => true]);
        return redirect()->route('tallas.index')->with('success', 'Talla restaurada correctamente');
    }
}
