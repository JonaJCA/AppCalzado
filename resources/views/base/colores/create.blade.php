@extends('layouts.admin')

@section('title', 'Registro Colores - AppCalzado')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registro Colores - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Realiza el registro de los colores disponibles en el sistema!</p>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5>Registro de Colores</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('colores.store') }}" method="POST">
                            @csrf
                            <div class="row align-items-center gap-1">
                                <label for="nombre" class="col-auto">Ingrese Nombre del Color:</label>
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
                                    <button type="submit" class="btn btn-danger w-100"><img src="{{ asset('assets/icons/save.svg') }}" alt="Guardar" width="16" height="16" class="me-1">Guardar</button>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="{{ route('colores.index') }}" class="btn btn-warning w-100">Cancelar</a>
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