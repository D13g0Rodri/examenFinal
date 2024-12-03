<?php

namespace App\Services;

use App\Models\Task;

class TasksService
{
    public function getTasks()
    {
        return Task::with('category')->get(); // Relación de categoría
    }

    public function createTask($data)
    {
        return Task::create($data);
    }

    public function updateTask($id, $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
}