@extends('layouts.admin')

@section('title', 'Dashboard - AppCalzado')

@section('css')
    <style>
        .card-link {
            transition: all 0.3s ease-in-out;
            display: block;
        }

        .card-link:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .card-link .card {
            transition: all 0.3s ease-in-out;
            border: none;
            overflow: hidden;
        }

        .card-link:hover .card-body {
            font-weight: bold;
        }

        .card-link:hover .card {
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .card-link:hover .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            pointer-events: none;
        }
    </style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Dashboard - AppCalzado</h4>
            </div>
            <div class="card-body">
                <p>¡Bienvenido al sistema de gestión de calzado!</p>
                
                <!-- Tarjetas de estadísticas -->
                <div class="row mb-4">
                    <div class="col-sm-6 col-lg-3">
                        <a href="{{ route('productos.index') }}" class="text-decoration-none card-link">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="fs-4 fw-semibold">{{ $estadisticas['totalProductos'] }}</div>
                                        <div>Productos</div>
                                    </div>
                                    <div class="fs-1">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    
                    <div class="col-sm-6 col-lg-3">
                        <a href="{{ route('categorias.index') }}" class="text-decoration-none card-link">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="fs-4 fw-semibold">{{ $estadisticas['totalCategorias'] }}</div>
                                            <div>Categorías</div>
                                        </div>
                                        <div class="fs-1">
                                            <i class="fa-solid fa-tag"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>                    
                </div>
                
                <!-- Tabla de ejemplo -->
                <div class="card">
                    <div class="card-header">
                        <h5>Últimos Productos</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ultimasSalidas as $index => $salida)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $salida->producto->nombre }}</td>
                                            <td>{{ $salida->cantidad }}</td>
                                            <td>${{ number_format($salida->precio_venta, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection