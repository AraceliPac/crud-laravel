<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/tareas', function () {
    return view('todos.index');
});
//ruta de post para guardar insercion en tabla Todo, hacer referencia al controlador :: para especificar toda la clase, especifica método como arreglo
//con name asigno nombre a la ruta y luego puedo modificar rutas sin tener que tocar todo
Route::post('/tareas', [TodosController::class, 'store'])->name('todos');
//nueva ruta para index : mostrar lista de todos
Route::get('/tareas', [TodosController::class, 'index'])->name('todos');
//nueva ruta para mostrar elem indivudalmente show
Route::get('/tareas/{id}', [TodosController::class, 'show'])->name('todos-edit');
Route::patch('/tareas/{id}', [TodosController::class, 'update'])->name('todos-update');
//nueva ruta para delete
Route::delete('/tareas/{id}', [TodosController::class, 'destroy'])->name('todos-destroy');

//mandar a llamar rutas categorias 
Route::resource('categories', CategoriesController::class);
