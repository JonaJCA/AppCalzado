@extends('layouts.admin')

@section('title', 'Listado Marcas - AppCalzado')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables/datatables.min.css') }}">
    <style>
        #tabla-marcas thead th {
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
                <h4 class="card-title">Listado Marcas - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Revisa el listado de las marcas disponibles en el sistema!</p>
                    <a href="{{ route('marcas.create') }}" class="btn btn-success btn-sm mb-2 text-white fw-bold">
                        <i class="fa-solid fa-save"></i> Registrar Nuevo
                    </a>
                </div>
                <!-- Tabla de ejemplo -->
                <div class="card">
                    <div class="card-header">
                        <h5>Listado de Marcas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabla-marcas" class="table table-striped table-hover" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nombre Marca</th>
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
            $('#tabla-marcas').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('marcas.data')}}",
                    type: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Fuerza que sea AJAX
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'descripcion', name: 'descripcion' },
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

        //Función para eliminar logicamente
        function confirmarEliminacion(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta Marca se marcará como inactivo",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Crear formulario dinámico para enviar DELETE
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/AppCalzado/public/marcas/${id}`;
                    
                    // Token CSRF
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    // Method spoofing para DELETE
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    
                    // Agregar campos al formulario
                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    
                    // Enviar formulario
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        //Funcion para restaura un registro
        function confirmarRestauracion(id) {
            Swal.fire({
                title: '¿Restaurar Marca?',
                text: "Esta marca se marcará como activo nuevamente",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, restaurar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/AppCalzado/public/marcas/${id}/restaurar`;
                    
                    // Token CSRF
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    // Method spoofing para PATCH
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'PATCH';
                    
                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection