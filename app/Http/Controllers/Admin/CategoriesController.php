<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoriesController extends Controller
{
    new PostsController();
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        Shema::create();
        Category::create($request->all());
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', ['category'=>$category]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required'
            ]);   
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('categories.index');
    }
}
