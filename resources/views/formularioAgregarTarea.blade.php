<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar nueva tarea</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Agregar nueva tarea</h2>

        <form action="{{ route('guardarTarea') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title_task">Título de la tarea</label>
                <input type="text" class="form-control" id="title_task" name="title_task" required>
            </div>
            <div class="form-group">
                <label for="description_task">Descripción</label>
                <textarea class="form-control" id="description_task" name="description_task" required></textarea>
            </div>
            <div class="form-group">
                <label for="fk_id_category">Categoría</label>
                <select class="form-control" id="fk_id_category" name="fk_id_category" required>
                    <!-- Asumiendo que las categorías se pasan desde el controlador a la vista -->
                    @foreach ($categories as $category)
                    <option value="{{ $category->id_category }}">{{ $category->name_category }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar tarea</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
