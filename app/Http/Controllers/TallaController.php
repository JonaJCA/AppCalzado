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
                return '<button class="btn btn-sm btn-warning">Editar</button> <button class="btn btn-sm btn-danger">Eliminar</button>';
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
