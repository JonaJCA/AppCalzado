@extends('layouts.admin')

@section('title', 'Inventario - AppCalzado')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables/datatables.min.css') }}">
    <style>
        #tabla-inventarios thead th {
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
                <h4 class="card-title">Inventario - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Revisa el inventario de los productos disponibles en el sistema!</p>
                    <a href="{{ route('inventarios.create') }}" class="btn btn-success btn-sm mb-2 text-white fw-bold">
                        <i class="cil-save"></i> Registrar Nuevo
                    </a>
                </div>
                <!-- Tabla de ejemplo -->
                <div class="card">
                    <div class="card-header">
                        <h5>Inventario</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabla-inventarios" class="table table-striped table-hover" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nº</th>
                                        <th>Fecha</th>
                                        <th>Tipo movimiento</th>
                                        <th>Cantidad</th>
                                        <th>Nombre Producto</th>
                                        <th>Stock Actual</th>
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

<!-- Modal para ver detalles de inventario -->
<div class="modal fade" id="modalDetalles" tabindex="-1" aria-labelledby="modalDetallesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalDetallesLabel">
                    <i class="fas fa-info-circle me-2"></i>Detalles del Movimiento
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Loading spinner -->
                <div id="loadingDetalles" class="text-center">
                    <div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="mt-2">Cargando detalles...</p>
                </div>

                <!-- Contenido de detalles -->
                <div id="contenidoDetalles" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-box me-1"></i>Información del Producto</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Producto:</strong> <span id="detalle-producto"></span></p>
                                    <p><strong>Cantidad:</strong> <span id="detalle-cantidad"></span></p>
                                    <p><strong>Fecha:</strong> <span id="detalle-fecha"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-exchange-alt me-1"></i>Información del Movimiento</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Tipo:</strong> <span id="detalle-tipo" class="badge"></span></p>
                                    <p><strong><span id="detalle-tipo-precio"></span>:</strong> <span id="detalle-precio" class="text-success fw-bold"></span></p>
                                    <p><strong>Motivo:</strong> <span id="detalle-motivo"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Error message -->
                <div id="errorDetalles" style="display: none;" class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <span id="mensajeError"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cerrar
                </button>
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
            $('#tabla-inventarios').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('inventarios.data')}}",
                    type: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Fuerza que sea AJAX
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'fecha_movimiento', name: 'fecha_movimiento' },
                    { data: 'tipo_movimiento', name: 'tipo_movimiento', orderable: false },
                    { data: 'cantidad', name: 'cantidad' },
                    { data: 'producto', name: 'producto' },
                    { data: 'stock_producto', name: 'stock_producto', orderable: false, },
                    { data: 'acciones', name: 'acciones', orderable: false, searchable: false },
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

        //Función para mostrar Modal con información detallada
        function verDetalle(id) {
            const modal = new bootstrap.Modal(document.getElementById('modalDetalles'));
            modal.show();
            $('#loadingDetalles').show();
            $('#contenidoDetalles').hide();
            $('#errorDetalles').hide();
            // petición AJAX
            $.ajax({
                url: '{{ url("inventarios/detalle") }}/' + id,
                method: 'GET',
                success: function(response) {
                    $('#loadingDetalles').hide();
                    $('#detalle-producto').text(response.producto);
                    $('#detalle-cantidad').text(response.cantidad);
                    $('#detalle-fecha').text(response.fecha);
                    $('#detalle-tipo').text(response.tipo_movimiento);
                    $('#detalle-tipo-precio').text(response.tipo_precio);
                    $('#detalle-precio').text(response.precio);
                    $('#detalle-motivo').text(response.motivo);
                    
                    const badge = $('#detalle-tipo');
                    badge.removeClass('bg-success bg-danger bg-warning');
                    if (response.tipo_movimiento === 'Entrada') {
                        badge.addClass('bg-success');
                    } else if (response.tipo_movimiento === 'Salida') {
                        badge.addClass('bg-danger');
                    } else {
                        badge.addClass('bg-warning');
                    }
                    $('#contenidoDetalles').show();
                },
                error: function(xhr) {
                    $('#loadingDetalles').hide();
                    $('#mensajeError').text('Error al cargar los detalles de la transacción');
                    $('#errorDetalles').show();
                }
            });
        }
    </script>
@endsection