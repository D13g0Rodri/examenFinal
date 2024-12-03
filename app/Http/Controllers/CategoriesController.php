<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Mostrar la tabla de categorías
    public function index()
    {
        // Incluimos las tareas relacionadas si es necesario
        $categorias = Category::with('tasks')->get(); // Asegúrate de que la relación tasks esté bien definida
        return view('categorias.index', compact('categorias'));
    }

    // Guardar una nueva categoría
    public function store(Request $request)
    {
        $request->validate([
            'name_category' => 'required|string|max:255',
        ]);

        Category::create([
            'name_category' => $request->name_category,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    // Actualizar una categoría existente
    public function update(Request $request, $id_category)
    {
        $request->validate([
            'name_category' => 'required|string|max:255',
        ]);

        $categoria = Category::findOrFail($id_category);
        $categoria->update([
            'name_category' => $request->name_category,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    // Eliminar una categoría
    public function destroy($id_category)
    {
        $categoria = Category::findOrFail($id_category);

        // Opcional: Verifica si tiene tareas relacionadas
        if ($categoria->tasks()->count() > 0) {
            return redirect()->route('categorias.index')->with('error', 'No puedes eliminar una categoría con tareas asociadas.');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}