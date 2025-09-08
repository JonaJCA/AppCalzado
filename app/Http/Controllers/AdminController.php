<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;

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
                        ->get();

        return view('admin.dashboard', compact('estadisticas', 'ultimasSalidas'));
    }
}
