@extends('layouts.admin')

@section('title', 'Editar Categorías - AppCalzado')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Editar Categorías - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Realiza la edición de las categorías disponibles en el sistema!</p>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5>Editar Categorías</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row align-items-center gap-1">
                                <label for="nombre" class="col-auto">Ingrese Nombre de la categoría:</label>
                                <div class="col-md-2">
                                    <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" id="nombre" value="{{ old('nombre', $categoria->nombre) }}">
                                    @error('nombre')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 col-md-4 mb-2 mb-md-0">
                                    <button type="submit" class="btn btn-danger w-100">Actualizar</button>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="{{ route('categorias.index') }}" class="btn btn-warning w-100">Cancelar</a>
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