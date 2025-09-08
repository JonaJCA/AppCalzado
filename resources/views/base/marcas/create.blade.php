@extends('layouts.admin')

@section('title', 'Registro Marcas - AppCalzado')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registro Marcas - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Realiza el registro de las marcas disponibles en el sistema!</p>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5>Registro de Marcas</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('marcas.store') }}" method="POST">
                            @csrf
                            <div class="row align-items-center gap-1">
                                <label for="descripcion" class="col-auto">Ingrese Nombre de marca:</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('descripcion') is-invalid @enderror" type="text" name="descripcion" id="descripcion">
                                    @error('descripcion')
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
                                    <a href="{{ route('marcas.index') }}" class="btn btn-warning w-100"><i class="fa-solid fa-xmark"></i> Cancelar</a>
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