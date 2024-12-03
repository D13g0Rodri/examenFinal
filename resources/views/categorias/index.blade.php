<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Gestión de Categorías</h1>

        <!-- Mensajes de éxito -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Formulario para agregar categorías -->
        <form action="{{ route('categorias.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="name_category">Nombre de la categoría</label>
                <input type="text" name="name_category" id="name_category" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-2">Agregar Categoría</button>
        </form>

        <!-- Tabla de categorías -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tareas Asociadas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id_category }}</td>
                        <td>{{ $categoria->name_category }}</td>
                        <td>{{ $categoria->tasks->count() }}</td>
                        <td>
                            <!-- Botón para actualizar -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarModal{{ $categoria->id_category }}">Editar</button>

                            <!-- Botón para eliminar -->
                            <form action="{{ route('categorias.destroy', $categoria->id_category) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal para editar -->
                    <div class="modal fade" id="editarModal{{ $categoria->id_category }}" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('categorias.update', $categoria->id_category) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarModalLabel">Editar Categoría</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name_category">Nombre de la categoría</label>
                                            <input type="text" name="name_category" id="name_category" class="form-control" value="{{ $categoria->name_category }}" required>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
