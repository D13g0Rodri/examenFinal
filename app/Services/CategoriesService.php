<?php 
namespace App\Services;
use App\Models\Category;

class CategoriesService{
    public function getCategories(){
        $categories = Category::all();
        return $categories;
    }
}
?>