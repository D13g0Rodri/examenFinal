<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-800">

    <!-- Header -->
    <header>
        <nav class="bg-gradient-to-r from-blue-400 to-blue-600 py-4 shadow-lg rounded-b-xl">
            <div class="container mx-auto px-6 flex justify-between items-center">
                <a href="#" class="text-2xl font-bold text-white hover:text-gray-200 transition duration-300 transform hover:scale-105">Logo</a>
                <ul class="flex items-center space-x-6">
                    <li><a href="#" class="text-white hover:text-gray-100 transition duration-300 transform hover:scale-105">Dashboard</a></li>
                    <li><a href="#" class="text-white hover:text-gray-100 transition duration-300 transform hover:scale-105">Settings</a></li>
                    <li><a href="{{ route('logout') }}" class="text-white hover:text-gray-100 transition duration-300 transform hover:scale-105">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <section class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg transform transition-all hover:scale-105 hover:shadow-2xl mb-8">
                <h1 class="text-3xl font-bold text-blue-500 dark:text-blue-400 mb-4">Bienvenido, {{ auth()->user()->name }}!</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400">Estás conectado al sistema.</p>
            </section>

            <section>
                <div class="mt-4">
                    <a href="{{ route('categorias.index') }}" class="btn btn-primary">
                        Administrar Categorías
                    </a>
                </div>
            </section>

            <!-- Pending Tasks Section -->
            <section class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg transform transition-all hover:scale-105 hover:shadow-2xl">
                <h2 class="text-2xl font-bold text-blue-500 dark:text-blue-400 mb-4">Tareas pendientes</h2>

                <a href="{{ route('agregarTarea') }}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar Nueva Tarea</button>
                </a>

                

                <div class="bg-gray-200 dark:bg-gray-600 p-4 rounded-xl shadow-md">
                    @forelse ($tasks as $task)
                        <div class="flex justify-between items-center p-4 bg-white dark:bg-gray-800 mb-2 rounded-lg shadow">
                            <div>
                                <h3 class="text-lg font-bold">{{ $task->title_task }}</h3>
                                <p class="text-gray-600 dark:text-gray-400">{{ $task->description_task }}</p>
                                <p class="text-sm text-gray-500">Categoría: {{ $task->category->name_category }}</p>
                            </div>
                            <div>
                                <form action="{{ route('actualizarTarea', $task->id_task) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-blue-500 hover:underline">Editar</button>
                                </form>
                                <form action="{{ route('eliminarTarea', $task->id_task) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">No hay tareas pendientes.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Tu Compañía. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>