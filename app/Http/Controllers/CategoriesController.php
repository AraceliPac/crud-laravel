<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Symfony\Contracts\Service\Attribute\Required;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //return \Illuminate\Http\Response
    public function index()
    {
        $categories = category::all();
        //nom carpeta categories.index + parametro
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'color' => 'required|max:7'
        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->route('categories.index')->with('sucess', 'Nueva categoria agregada!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);

        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $category)
    {
        $category = Category::find($category);

        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Categoria actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category)
    {
        $category = Category::find($category);
        $category->todos()->each(function ($todo) {
            $todo->delete();
        });
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category eliminada!');
    }
}
