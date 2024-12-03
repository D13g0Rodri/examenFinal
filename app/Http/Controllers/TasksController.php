<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\TasksService;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index(TasksService $tasksService)
    {
        $tasks = $tasksService->getTasks();  // Obtener todas las tareas
        return view('dashboard', compact('tasks'));
    }

    public function create()
{
    $categories = Category::all();  // Obtener todas las categorías
    return view('formularioAgregarTarea', compact('categories'));  // Pasar categorías a la vista
}

    public function store(Request $request, TasksService $tasksService)
    {
        $validatedData = $request->validate([
            'title_task' => 'required|max:255',
            'description_task' => 'required',
            'fk_id_category' => 'required|exists:categories,id_category',
        ]);

        $tasksService->createTask($validatedData);  // Crear tarea

        return redirect()->route('dashboard')->with('success', 'Tarea creada exitosamente');
    }

    public function update(Request $request, $id, TasksService $tasksService)
    {
        $validatedData = $request->validate([
            'title_task' => 'required|max:255',
            'description_task' => 'required',
            'fk_id_category' => 'required|exists:categories,id_category',
        ]);

        $tasksService->updateTask($id, $validatedData);  // Actualizar tarea

        return redirect()->route('dashboard')->with('success', 'Tarea actualizada exitosamente');
    }

    public function destroy($id, TasksService $tasksService)
    {
        $tasksService->deleteTask($id);  // Eliminar tarea
        return redirect()->route('dashboard')->with('success', 'Tarea eliminada exitosamente');
    }
}