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
        $modelos    = Modelo::all();
        $categorias = Categoria::all();
        $tallas     = Talla::all();
        $colores    = Color::all();
        return view('base.productos.create', compact('modelos', 'categorias', 'tallas', 'colores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'modelo_id'     => 'required|exists:modelos,id',
            'categoria_id'  => 'required|exists:categorias,id',
            'talla_id'      => 'required|exists:tallas,id',
            'color_id'      => 'required|exists:colores,id',
            'nombre'        => 'required|string|max:255',
            'taco'          => 'nullable|string|max:100',
            'precio_compra' => 'required|numeric|min:0',
            'stock_actual'  => 'required|integer|min:0',
        ]);

        $producto = Producto::create($validated);
        $codigoProducto = 'SKU-' . str_pad($producto->id, 5, '0', STR_PAD_LEFT);
        
        $producto->update(['codigo_producto' => $codigoProducto]);
        return redirect()->route('productos.index')
            ->with('success', 'Producto registrado correctamente con código: ' . $codigoProducto);
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
            ->addColumn('acciones', function ($row) {
                if ($row->estado) {
                    $editUrl = route('productos.edit', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-sm btn-warning">
                                <img src="' . asset('assets/icons/pencil.svg') . '" alt="Editar" width="16" height="16">
                            </a>
                            <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion(' . $row->id . ')">
                                <img src="' . asset('assets/icons/trash.svg') . '" alt="Eliminar" width="16" height="16" style="filter: brightness(0) invert(1);">
                            </button>';
                } else {
                    // Si está inactivo: mostrar solo botón Restaurar
                    return '<button class="btn btn-sm btn-success" onclick="confirmarRestauracion(' . $row->id . ')">
                                <img src="' . asset('assets/icons/sync.svg') . '" alt="Restaurar" width="16" height="16">
                            </button>';
                }
            })
            ->addColumn('estado', function ($row) {
                if ($row->estado) {
                    return '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    return '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }
            })
            ->rawColumns(['acciones', 'estado'])
            ->make(true);
    }

    public function edit(Producto $producto)
    {
        $modelos    = Modelo::all();
        $categorias = Categoria::all();
        $tallas     = Talla::all();
        $colores    = Color::all();
        return view('base.productos.edit', compact('producto', 'modelos', 'categorias', 'tallas', 'colores'));
    }

    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'modelo_id'     => 'required|exists:modelos,id',
            'categoria_id'  => 'required|exists:categorias,id',
            'talla_id'      => 'required|exists:tallas,id',
            'color_id'      => 'required|exists:colores,id',
            'nombre'        => 'required|string|max:255',
            'taco'          => 'nullable|string|max:100',
            'precio_compra' => 'required|numeric|min:0',
            'stock_actual'  => 'required|integer|min:0',
        ]);

        $producto->update($validated);

        return redirect()->route('productos.index')
        ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        if (!$producto->estado) {
            return redirect()->route('productos.index')->with('warning', 'El producto ya está eliminado');
        }
        $producto->update(['estado' => false]);
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }

    public function restaurar(Producto $producto)
    {
        if ($producto->estado) {
            return redirect()->route('productos.index')->with('warning', 'El producto ya está activado');
        }
        $producto->update(['estado' => true]);
        return redirect()->route('productos.index')->with('success', 'Producto restaurado correctamente');
    }
}
