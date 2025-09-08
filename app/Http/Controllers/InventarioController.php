<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

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
        $request->validate([
            'producto_id'      => 'required|exists:productos,id',
            'tipo_movimiento'  => 'required|in:entrada,salida,ajuste',
            'cantidad'         => 'required|numeric|min:1',
            'fecha_movimiento' => 'required|date',
            'motivo'           => 'required|string|max:255',
            'precio_compra'    => 'nullable|numeric|min:0',
            'precio_venta'     => 'nullable|numeric|min:0',
        ]);

        $producto = Producto::findOrFail($request->producto_id);
    
        // Validar stock suficiente para salidas
        if ($request->tipo_movimiento === 'salida') {
            if ($producto->stock_actual < $request->cantidad) {
                return back()
                    ->withErrors(['cantidad' => 'Stock insuficiente. Stock actual: ' . $producto->stock_actual])
                    ->withInput();
            }
        }

        $inventario = Inventario::create([
            'producto_id'      => $request->producto_id,
            'tipo_movimiento'  => $request->tipo_movimiento,
            'cantidad'         => $request->cantidad,
            'fecha_movimiento' => $request->fecha_movimiento,
            'motivo'           => $request->motivo,
            'precio_compra'    => $request->precio_compra,
            'precio_venta'     => $request->precio_venta,
        ]);

        switch ($request->tipo_movimiento) {
            case 'entrada':
                $producto->stock_actual += $request->cantidad;
                break;
            case 'salida':
                $producto->stock_actual -= $request->cantidad;
                break;
            case 'ajuste':
                // Para ajuste, la cantidad ES el nuevo stock
                $producto->stock_actual = $request->cantidad;
                break;
        }
        
        $producto->save();
        return redirect()->route('inventarios.index')
        ->with('success', 'Movimiento de inventario registrado correctamente. Stock actualizado: ' . $producto->stock_actual);
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
            ->addColumn('fecha_movimiento', function ($row) {
                return Carbon::parse($row->fecha_movimiento)->format('d-m-Y');
            })
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
                            <i class="fa-solid fa-eye"></i>
                        </button>';
            })
            ->rawColumns(['stock_producto', 'acciones'])
            ->make(true);
    }

    public function obtenerDetalle($id)
    {
        $transaccion = Inventario::find($id);
        
        if (!$transaccion) {
            return response()->json(['error' => 'Transacción no encontrada'], 404);
        }
        
        // Determinar qué precio mostrar según el tipo de movimiento
        $precio = null;
        $tipo_precio = '';
        
        if ($transaccion->tipo_movimiento == 'entrada') {
            $precio = $transaccion->precio_compra;
            $tipo_precio = 'Precio de Compra';
        } elseif ($transaccion->tipo_movimiento == 'salida') {
            $precio = $transaccion->precio_venta;
            $tipo_precio = 'Precio de Venta';
        } elseif ($transaccion->tipo_movimiento == 'ajuste') {
            $precio = null;
            $tipo_precio = 'Ajuste de Inventario';
        }
        
        return response()->json([
            'id'              => $transaccion->id,
            'producto'        => $transaccion->producto->nombre,
            'tipo_movimiento' => ucfirst($transaccion->tipo_movimiento),
            'cantidad'        => $transaccion->cantidad,
            'precio'          => $precio ? 'S/ ' . number_format($precio, 2) : 'No especificado',
            'tipo_precio'     => $tipo_precio,
            'motivo'          => $transaccion->motivo ?? 'Sin motivo especificado',
            'fecha'           => $transaccion->created_at->format('d/m/Y H:i:s')
        ]);
    }
}
