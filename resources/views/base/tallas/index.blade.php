@extends('layouts.admin')

@section('title', 'Listado Tallas - AppCalzado')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Listado Tallas - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Revisa el listado de las tallas disponibles en el sistema!</p>
                    <a href="{{ route('tallas.create') }}" class="btn btn-success btn-sm mb-2">
                        <i class="cil-save"></i> Registrar Nuevo
                    </a>
                </div>
                <!-- Tabla de ejemplo -->
                <div class="card">
                    <div class="card-header">
                        <h5>Listado de Tallas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Numero</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>35</td>
                                        <td><span class="badge bg-danger">Agotado</span></td>
                                        <td>Editar - Eliminar</td>
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