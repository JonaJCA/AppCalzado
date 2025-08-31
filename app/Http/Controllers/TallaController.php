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
                $editUrl = route('tallas.edit', $row->id);
                $deleteUrl = route('tallas.destroy', $row->id);
                return '<a href="'.$editUrl.'" class="btn btn-sm btn-warning">
                            <img src="'.asset('assets/icons/pencil.svg').'" alt="Editar" width="16" height="16">
                        </a>
                        <button class="btn btn-sm btn-danger">
                            <img src="'.asset('assets/icons/trash.svg').'" alt="Eliminar" width="16" height="16" style="filter: brightness(0) invert(1);">
                        </button>';
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
