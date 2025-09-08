@extends('layouts.admin')

@section('title', 'Registro Categorías - AppCalzado')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registro Categorías - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Realiza el registro de las categorías disponibles en el sistema!</p>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5>Registro de Categorías</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categorias.store') }}" method="POST">
                            @csrf
                            <div class="row align-items-center gap-1">
                                <label for="nombre" class="col-auto">Ingrese Nombre de la categoría:</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" id="nombre">
                                    @error('nombre')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 col-md-4 mb-2 mb-md-0">
                                    <button type="submit" class="btn btn-danger w-100"><i class="fa-solid fa-save"></i> Guardar</button>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="{{ route('categorias.index') }}" class="btn btn-warning w-100"><i class="fa-solid fa-xmark"></i> Cancelar</a>
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