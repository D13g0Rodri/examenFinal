<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $primaryKey = 'id_category';


    
    protected $fillable = ['name_category']; 

    // Relación con tareas
    public function tasks()
    {
        return $this->hasMany(Task::class, 'fk_id_category');
    }
}
