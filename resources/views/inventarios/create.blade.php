@extends('layouts.admin')

@section('title', 'Registro Inventario - AppCalzado')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registro Inventario - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Realiza el registro del inventario de los productos disponibles en el sistema!</p>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5>Registro de Inventario</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('inventarios.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="fecha_movimiento">Fecha de Movimiento</label>
                                    <input type="date" 
                                        class="form-control" 
                                        id="fecha_movimiento" 
                                        name="fecha_movimiento" 
                                        value="{{ old('fecha_movimiento', date('Y-m-d')) }}" 
                                        required>
                                    @error('fecha_movimiento')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="producto_id" class="form-label">Nombre Producto:</label>
                                    <select class="form-control select2" name="producto_id" id="producto_id" required>
                                        <option value="">Seleccione un producto...</option>
                                        @foreach($productos as $producto)
                                            <option value="{{ $producto->id }}">
                                                {{ $producto->nombre }} - Stock: {{ $producto->stock_actual }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('producto_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="tipo_movimiento" class="form-label">Tipo Movimiento:</label>
                                    <select class="form-select select2 @error('tipo_movimiento') is-invalid @enderror" 
                                        name="tipo_movimiento" 
                                        id="tipo_movimiento" 
                                        required>
                                        <option value="">Seleccionar Tipo</option>
                                        <option value="entrada" {{ old('tipo_movimiento') == 'entrada' ? 'selected' : '' }}>
                                            Entrada
                                        </option>
                                        <option value="salida" {{ old('tipo_movimiento') == 'salida' ? 'selected' : '' }}>
                                            Salida
                                        </option>
                                        <option value="ajuste" {{ old('tipo_movimiento') == 'ajuste' ? 'selected' : '' }}>
                                            Ajuste
                                        </option>                                        
                                    </select>
                                    @error('tipo_movimiento')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="cantidad" class="form-label">Cantidad:</label>
                                    <input class="form-control @error('cantidad') is-invalid @enderror" type="number" name="cantidad" id="cantidad">
                                    @error('cantidad')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="precio_compra" class="form-label">Precio compra:</label>
                                    <input class="form-control @error('precio_compra') is-invalid @enderror" type="text" name="precio_compra" id="precio_compra">
                                    @error('precio_compra')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="precio_venta" class="form-label">Precio venta:</label>
                                    <input class="form-control @error('precio_venta') is-invalid @enderror" type="text" name="precio_venta" id="precio_venta">
                                    @error('precio_venta')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="motivo" class="form-label">Motivo:</label>
                                    <input class="form-control @error('motivo') is-invalid @enderror" type="text" name="motivo" id="motivo">
                                    @error('motivo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                                
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-4 mb-2 mb-md-0">
                                    <button type="submit" class="btn btn-danger w-100"><img src="{{ asset('assets/icons/save.svg') }}" alt="Guardar" width="16" height="16" class="me-1">Guardar</button>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="{{ route('inventarios.index') }}" class="btn btn-warning w-100">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Seleccione un producto...",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection