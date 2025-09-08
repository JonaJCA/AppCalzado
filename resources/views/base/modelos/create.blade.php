@extends('layouts.admin')

@section('title', 'Registro Modelos - AppCalzado')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registro Modelos - AppCalzado</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">¡Realiza el registro de los modelos disponibles en el sistema!</p>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5>Registro de Modelos</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('modelos.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="nombre" class="form-label">Nombre del modelo:</label>
                                    <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" id="nombre">
                                    @error('nombre')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="descripcion" class="form-label">Descripción del modelo:</label>
                                    <input class="form-control @error('descripcion') is-invalid @enderror" type="text" name="descripcion" id="descripcion">
                                    @error('descripcion')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="marca_id" class="form-label">Marca:</label>
                                    <select class="form-select @error('marca_id') is-invalid @enderror" name="marca_id" id="marca_id">
                                        <option value="">Seleccionar marca</option>
                                        @foreach($marcas as $marca)
                                            <option value="{{ $marca->id }}">{{ $marca->descripcion }}</option>
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
                                    <button type="submit" class="btn btn-danger w-100"><i class="fa-solid fa-save"></i> Guardar</button>
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