<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Color;
use App\Models\Modelo;
use App\Models\Producto;
use App\Models\Talla;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductoController extends Controller
{
    public function index()
    {
        return view('base.productos.index');
    }

    public function create()
    {
        $modelos = Modelo::all();
        $categorias = Categoria::all();
        $tallas = Talla::all();
        $colores = Color::all();
        return view('base.productos.create', compact('modelos', 'categorias', 'tallas', 'colores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function obtenerProductos(Request $request)
    {
        if (!$request->ajax()) {
            $productos = Producto::with('modelo:id,nombre')
                        ->select('id', 'modelo_id', 'nombre', 'stock_actual', 'estado')
                        ->get();
            return response()->json($productos);
        }
        
        // Para peticiones AJAX de DataTables
        $productos = Producto::with('modelo:id,nombre')->select('id', 'modelo_id', 'nombre', 'stock_actual', 'estado');
        
        return DataTables::of($productos)
            ->addIndexColumn()
            ->addColumn('modelo', function ($row) {
                return $row->modelo ? $row->modelo->nombre : '—';
            })
            ->addColumn('acciones', function($row) {
                if ($row->estado) {
                    $editUrl = route('productos.edit', $row->id);
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
