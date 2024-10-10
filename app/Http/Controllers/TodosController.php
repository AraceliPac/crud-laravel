<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Todo; //traer objeto Todo


class TodosController extends Controller
{
    //Guardar nuevos datos en la tabla y validar los campos
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3'
        ]);
        $todo = new Todo;
        //rellenar los campos
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        //guardar
        $todo->save();
        //return direcciona a la ruta x, el met with para mandar mensaje clave-valor
        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }
    //obtener todos los elementos de la tabla, llamar metod estatico all
    public function index()
    {
        $todos = Todo::all(); //no necesita crear nuevo objeto, es una consulta
        $categories = Category::all();
        //representar datos
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }

    public function show($id)
    {
        $todo = Todo::find($id); //no necesita crear nuevo objeto, es una consulta
        //representar datos
        return view('todos.show', ['todo' => $todo]);
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::find($id); //no necesita crear nuevo objeto, es una consulta
        $todo->title = $request->title; //el name input es title del form
        $todo->save();
        // return view('todos.index', ['success' => 'Tarea actualizada']);
        return redirect()->route('todos')->with('success', 'Tarea actualizada!');
    }

    public function destroy($id)
    {
        $todo = Todo::find($id); //no necesita crear nuevo objeto, es una consulta
        $todo->delete();
        return redirect()->route('todos')->with('success', 'La tarea ha sido eliminada!');
    }
}
