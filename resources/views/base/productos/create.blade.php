@extends('layouts.admin')

@section('title', 'Registro Productos - AppCalzado')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registro Productos - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Realiza el registro de los productos disponibles en el sistema!</p>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5>Registro de Productos</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('productos.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre del producto:</label>
                                    <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" id="nombre">
                                    @error('nombre')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="taco" class="form-label">Nº Taco:</label>
                                    <input class="form-control @error('taco') is-invalid @enderror" type="text" name="taco" id="taco">
                                    @error('taco')
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
                                    <label for="stock_actual" class="form-label">Stock actual:</label>
                                    <input class="form-control @error('stock_actual') is-invalid @enderror" type="text" name="stock_actual" id="stock_actual">
                                    @error('stock_actual')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="modelo_id" class="form-label">Modelo:</label>
                                    <select class="form-select @error('modelo_id') is-invalid @enderror" name="modelo_id" id="modelo_id">
                                        <option value="">Seleccionar modelo</option>
                                        @foreach($modelos as $modelo)
                                            <option value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('modelo_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="categoria_id" class="form-label">Categoría:</label>
                                    <select class="form-select @error('categoria_id') is-invalid @enderror" name="categoria_id" id="categoria_id">
                                        <option value="">Seleccionar categoria</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('categoria_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="talla_id" class="form-label">Talla:</label>
                                    <select class="form-select @error('talla_id') is-invalid @enderror" name="talla_id" id="talla_id">
                                        <option value="">Seleccionar talla</option>
                                        @foreach($tallas as $talla)
                                            <option value="{{ $talla->id }}">{{ $talla->numero }}</option>
                                        @endforeach
                                    </select>
                                    @error('talla_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="color_id" class="form-label">Color:</label>
                                    <select class="form-select @error('color_id') is-invalid @enderror" name="color_id" id="color_id">
                                        <option value="">Seleccionar Color</option>
                                        @foreach($colores as $color)
                                            <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('color_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-4 mb-2 mb-md-0">
                                    <button type="submit" class="btn btn-danger w-100"><i class="fa-solid fa-save"></i> Guardar</button>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="{{ route('productos.index') }}" class="btn btn-warning w-100"><i class="fa-solid fa-xmark"></i> Cancelar</a>
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