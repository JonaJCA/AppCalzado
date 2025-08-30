@extends('layouts.admin')

@section('title', 'Listado Tallas - AppCalzado')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables/datatables.min.css') }}">
    <style>
        #tabla-tallas thead th {
            background-color: #212529 !important;
            color: #fff !important;
            border-color: #32383e !important;
        }
    </style>
@endsection

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
                            <table id="tabla-tallas" class="table table-striped table-hover" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nº</th>
                                        <th>Numero Talla</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

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

@section('js')
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-tallas').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('tallas.data')}}",
                    type: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Fuerza que sea AJAX
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'numero', name: 'numero' },
                    { data: 'estado', name: 'estado' },
                    { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
                ],
                language: {
                    processing: "Procesando...",
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros",
                    info: "Mostrando de _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron datos",
                    emptyTable: "No hay datos disponibles",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Último"
                    }
                },
                pageLength: 10
            });
        });
    </script>
@endsection