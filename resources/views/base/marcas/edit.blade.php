@extends('layouts.admin')

@section('title', 'Editar Marcas - AppCalzado')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Editar Marcas - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Realiza la edición de las marcas disponibles en el sistema!</p>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5>Editar Marcas</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('marcas.update', $marca->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row align-items-center gap-1">
                                <label for="descripcion" class="col-auto">Ingrese Nombre de marca:</label>
                                <div class="col-md-2">
                                    <input class="form-control @error('descripcion') is-invalid @enderror" type="text" name="descripcion" id="descripcion" value="{{ old('descripcion', $marca->descripcion) }}">
                                    @error('descripcion')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 col-md-4 mb-2 mb-md-0">
                                    <button type="submit" class="btn btn-danger w-100"><i class="fa-solid fa-save"></i> Actualizar</button>
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