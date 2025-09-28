@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Crear Nuevo Usuario</h2>
        
        <form method="POST" action="{{ route('admin.guardar-usuario') }}">
            @csrf
            
            <div class="mb-3">
                <label>Nombre:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label>Contraseña:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Confirmar Contraseña:</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Crear Usuario</button>
        </form>
    </div>
@endsection