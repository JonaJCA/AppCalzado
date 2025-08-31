@extends('layouts.admin')

@section('title', 'Registro Tallas - AppCalzado')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registro Tallas - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Realiza el registro de las tallas disponibles en el sistema!</p>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5>Registro de Tallas</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tallas.store') }}" method="POST">
                            @csrf
                            <div class="row align-items-center gap-1">
                                <label for="numero" class="col-auto">Ingrese Nº Talla:</label>
                                <div class="col-md-2">
                                    <input class="form-control @error('numero') is-invalid @enderror" type="number" name="numero" id="numero">
                                    @error('numero')
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
                                    <a href="{{ route('tallas.index') }}" class="btn btn-warning w-100">Cancelar</a>
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