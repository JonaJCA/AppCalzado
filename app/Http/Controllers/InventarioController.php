<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InventarioController extends Controller
{
    public function index()
    {
        return view('inventarios.index');
    }

    public function create()
    {
        $productos = Producto::all();
        return view('inventarios.create', compact('productos'));
    }

    public function store(Request $request)
    {
        //
    }

    public function obtenerInventarios(Request $request)
    {
        if (!$request->ajax()) {
            $inventarios = Inventario::with(['producto:id,nombre,stock_actual'])
                ->select('id', 'fecha_movimiento', 'tipo_movimiento', 'cantidad', 'producto_id', 'motivo')
                ->get();
            return response()->json($inventarios);
        }

        // Para peticiones AJAX de DataTables
        $inventarios = Inventario::with(['producto:id,nombre,stock_actual'])->select('id', 'fecha_movimiento', 'tipo_movimiento', 'cantidad', 'producto_id', 'motivo')
                        ->orderBy('fecha_movimiento', 'desc');

        return DataTables::of($inventarios)
            ->addIndexColumn()
            ->addColumn('producto', function ($row) {
                return $row->producto ? $row->producto->nombre : '—';
            })
            ->addColumn('stock_producto', function ($row) {
                $stock = $row->producto ? $row->producto->stock_actual : 0;
                if ($stock == 0) {
                    $pill = '<span class="badge bg-danger ms-2">Agotado</span>';
                } elseif ($stock <= 15) {
                    $pill = '<span class="badge bg-warning ms-2">Bajo</span>';
                } else {
                    $pill = '<span class="badge bg-success ms-2">Disponible</span>';
                }
                return $stock . $pill;
            })
            ->addColumn('acciones', function ($row) {
                return '<button class="btn btn-sm btn-info" onclick="verDetalle(' . $row->id . ')" title="Ver detalles">
                            <i class="fas fa-eye"></i>
                        </button>';
            })
            ->rawColumns(['stock_producto', 'acciones'])
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
