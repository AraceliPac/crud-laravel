<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Todo;

class Category extends Model
{
    use HasFactory;
    //establecer la relacion 1:n(hasMany) en el metodo se devuelven todos los to do de esa categoria (muchos)
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
