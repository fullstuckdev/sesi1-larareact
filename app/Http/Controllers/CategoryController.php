<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('home.category', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

    
        Category::create([
            'name' => $request->name,
        ]);

        return redirect('/category/create')->with('success', 'Product created successfully.');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);
    
        $category->name = $request->name;

    
        $category->save();
    
        return redirect()->route('category.edit', $category->id)->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
       
        $category->delete();
    
        return redirect('/category')->with('success', 'Product deleted successfully.');
    }
}
