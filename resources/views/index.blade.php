@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Gestión de Categorías</h1>

    <!-- Mensajes de éxito -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Formulario para agregar categorías -->
    <form action="{{ route('categorias.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre de la categoría</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Agregar Categoría</button>
    </form>

    <!-- Tabla de categorías -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>
                        <!-- Botón para actualizar -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarModal{{ $categoria->id }}">Editar</button>

                        <!-- Botón para eliminar -->
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal para editar -->
                <div class="modal fade" id="editarModal{{ $categoria->id }}" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarModalLabel">Editar Categoría</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nombre">Nombre de la categoría</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection