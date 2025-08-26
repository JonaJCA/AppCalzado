@extends('layouts.admin')

@section('title', 'Dashboard - AppCalzado')

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
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="fs-4 fw-semibold">150</div>
                                        <div>Productos</div>
                                    </div>
                                    <div class="fs-1">
                                        <i class="cui-basket"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="fs-4 fw-semibold">45</div>
                                        <div>Clientes</div>
                                    </div>
                                    <div class="fs-1">
                                        <i class="cui-people"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="fs-4 fw-semibold">25</div>
                                        <div>Pedidos</div>
                                    </div>
                                    <div class="fs-1">
                                        <i class="cui-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="fs-4 fw-semibold">$12,350</div>
                                        <div>Ventas</div>
                                    </div>
                                    <div class="fs-1">
                                        <i class="cui-dollar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <th>ID</th>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Zapatilla Deportiva</td>
                                        <td>$89.99</td>
                                        <td>25</td>
                                        <td><span class="badge bg-success">Disponible</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Bota de Cuero</td>
                                        <td>$159.99</td>
                                        <td>12</td>
                                        <td><span class="badge bg-warning">Poco Stock</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Sandalia Casual</td>
                                        <td>$45.99</td>
                                        <td>0</td>
                                        <td><span class="badge bg-danger">Agotado</span></td>
                                    </tr>
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