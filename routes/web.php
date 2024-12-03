<?php

use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TasksController;
use App\Http\Controllers\CategoriesController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas por middleware auth
Route::middleware(['auth'])->group(function () {
    

    Route::get('/dashboard', [TasksController::class, 'index'])->name('dashboard');
    Route::get('/formularioAgregarTarea', [TasksController::class, 'create'])->name('agregarTarea'); // Redirige aquí
    Route::post('/tareas', [TasksController::class, 'store'])->name('guardarTarea');
    Route::put('/tareas/{id}', [TasksController::class, 'update'])->name('actualizarTarea');
    Route::delete('/tareas/{id}', [TasksController::class, 'destroy'])->name('eliminarTarea');


    //SECCION DE CATEGORIAS
     // Vista principal del CRUD de categorías
     Route::get('/categorias', [CategoriesController::class, 'index'])->name('categorias.index');
     // Crear categoría
     Route::post('/categorias', [CategoriesController::class, 'store'])->name('categorias.store');
     // Editar categoría
     Route::put('/categorias/{id_category}', [CategoriesController::class, 'update'])->name('categorias.update');
     // Eliminar categoría
     Route::delete('/categorias/{id_category}', [CategoriesController::class, 'destroy'])->name('categorias.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
