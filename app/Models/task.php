<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $primaryKey = 'id_task';
    protected $fillable = ['title_task', 'description_task', 'fk_id_category', 'completed'];


    public function category()
{
    return $this->belongsTo(Category::class, 'fk_id_category');
}
}

