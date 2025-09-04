@extends('layouts.admin')

@section('title', 'Editar Productos - AppCalzado')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Editar Productos - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Realiza la edición de los productos disponibles en el sistema!</p>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5>Editar Productos</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre del producto:</label>
                                    <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}">
                                    @error('nombre')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="taco" class="form-label">Nº Taco:</label>
                                    <input class="form-control @error('taco') is-invalid @enderror" type="text" name="taco" id="taco" value="{{ old('taco', $producto->taco) }}">
                                    @error('taco')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="precio_compra" class="form-label">Precio compra:</label>
                                    <input class="form-control @error('precio_compra') is-invalid @enderror" type="text" name="precio_compra" id="precio_compra" value="{{ old('precio_compra', $producto->precio_compra) }}">
                                    @error('precio_compra')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="stock_actual" class="form-label">Stock actual:</label>
                                    <input class="form-control @error('stock_actual') is-invalid @enderror" type="text" name="stock_actual" id="stock_actual" value="{{ old('stock_actual', $producto->stock_actual) }}">
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
                                            <option value="{{ $modelo->id }}"
                                                {{ old('modelo_id', $producto->modelo_id) == $modelo->id ? 'selected' : '' }}>
                                                {{ $modelo->nombre }}
                                                {{ old('modelo_id', $producto->modelo_id) == $modelo->id ? ' ✓ (Actual)' : '' }}
                                            </option>
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
                                            <option value="{{ $categoria->id }}"
                                                {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                                {{ $categoria->nombre }}
                                                {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? ' ✓ (Actual)' : '' }}
                                            </option>
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
                                            <option value="{{ $talla->id }}"
                                                {{ old('talla_id', $producto->talla_id) == $talla->id ? 'selected' : '' }}>
                                                {{ $talla->numero }}
                                                {{ old('talla_id', $producto->talla_id) == $talla->id ? ' ✓ (Actual)' : '' }}
                                            </option>
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
                                            <option value="{{ $color->id }}"
                                                {{ old('color_id', $producto->color_id) == $color->id ? 'selected' : '' }}>
                                                {{ $color->nombre }}
                                                {{ old('color_id', $producto->color_id) == $color->id ? ' ✓ (Actual)' : '' }}
                                            </option>
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
                                    <button type="submit" class="btn btn-danger w-100">Actualizar</button>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="{{ route('productos.index') }}" class="btn btn-warning w-100">Cancelar</a>
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