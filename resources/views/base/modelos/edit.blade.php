@extends('layouts.admin')

@section('title', 'Editar Modelos - AppCalzado')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Editar Modelos - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Realiza la edición de los modelos disponibles en el sistema!</p>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5>Editar Modelos</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('modelos.update', $modelo->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="nombre" class="form-label">Nombre del modelo:</label>
                                    <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" id="nombre" value="{{ old('nombre', $modelo->nombre) }}">
                                    @error('nombre')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                                
                                <div class="col-md-4 mb-3">
                                    <label for="descripcion" class="form-label">Descripción del modelo:</label>
                                    <input class="form-control @error('descripcion') is-invalid @enderror" type="text" name="descripcion" id="descripcion" value="{{ old('descripcion', $modelo->descripcion) }}">
                                    @error('descripcion')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="marca_id" class="form-label">Marca:</label>
                                    <select class="form-select" name="marca_id" id="marca_id">
                                        <option value="">Seleccionar marca</option>
                                        @foreach($marcas as $marca)
                                            <option value="{{ $marca->id }}" {{ old('marca_id', $modelo->marca_id) == $marca->id ? 'selected' : '' }}>
                                                {{ $marca->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('marca_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-4 mb-2 mb-md-0">
                                    <button type="submit" class="btn btn-danger w-100"><i class="fa-solid fa-save"></i> Actualizar</button>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="{{ route('modelos.index') }}" class="btn btn-warning w-100"><i class="fa-solid fa-xmark"></i> Cancelar</a>
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