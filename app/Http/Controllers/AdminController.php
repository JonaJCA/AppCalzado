<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function dashboard()
    {
        $estadisticas = [
            'totalProductos' => Producto::count(),
            'totalCategorias' => Categoria::count(),
        ];

        $ultimasSalidas = Inventario::with('producto')
                        ->where('tipo_movimiento', 'salida')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get()
                        ->map(function ($salida) {
                            $precioCompraReal = $salida->precio_compra;

                            if (!$precioCompraReal || $precioCompraReal == 0) {
                                // Buscar última entrada
                                $ultimaEntrada = Inventario::where('producto_id', $salida->producto_id)
                                    ->where('tipo_movimiento', 'entrada')
                                    ->whereNotNull('precio_compra')
                                    ->orderBy('id', 'desc')
                                    ->first();
                                    
                                $precioCompraReal = $ultimaEntrada ? 
                                    $ultimaEntrada->precio_compra : 
                                    $salida->producto->precio_compra;
                            }
                            // Calculamos la ganancia por unidad
                            $gananciaPorUnidad = $salida->precio_venta - $precioCompraReal;
                            
                            // Calculamos la ganancia total (ganancia por unidad × cantidad)
                            $gananciaTotal = $gananciaPorUnidad * $salida->cantidad;
                            
                            // Agregamos los campos calculados al objeto
                            $salida->precio_compra_mostrar = $precioCompraReal;
                            $salida->ganancia_por_unidad = $gananciaPorUnidad;
                            $salida->ganancia_total = $gananciaTotal;
                            
                            return $salida;
                        });

        return view('admin.dashboard', compact('estadisticas', 'ultimasSalidas'));
    }

    public function listarUsuarios()
    {
        return view('admin.usuarios');
    }

    public function obtenerUsuarios(Request $request)
    {
        if (!$request->ajax()) {
            $usuarios = User::select('id', 'name', 'email', 'estado')->get();
            return response()->json($usuarios);
        }
        
        // Para peticiones AJAX de DataTables
        $usuarios = User::select('id', 'name', 'email', 'estado');
        
        return DataTables::of($usuarios)
            ->addIndexColumn()
            ->addColumn('acciones', function($row) {
                if ($row->estado) {                    
                    return '
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

    public function crearUsuario()
    {
        return view('admin.crear-usuario');
    }

    public function guardarUsuario(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.usuarios')->with('success', 'Usuario creado exitosamente');
    }

    public function destroy(User $user)
    {
        if (!$user->estado) {
            return redirect()->route('admin.usuarios')->with('warning', 'El Usuario ya está deshabilitado');
        }
        $user->update(['estado' => false]);
        return redirect()->route('admin.usuarios')->with('success', 'Usuario deshabilitado correctamente');
    }

    public function restaurar(User $user)
    {
        if ($user->estado) {
            return redirect()->route('admin.usuarios')->with('warning', 'El Usuario ya está habilitado');
        }
        $user->update(['estado' => true]);
        return redirect()->route('admin.usuarios')->with('success', 'Usuario restaurado correctamente');
    }
}
