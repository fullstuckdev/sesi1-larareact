<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('public/images', $imageName);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => 'images/' . $imageName,
        ]);

        return redirect('/products/create')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $product->image = str_replace('public/', '', $imagePath);
        }
    
        $product->save();
    
        return redirect()->route('products.edit', $product->id)->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
{
    if (Storage::exists($product->image)) {
        Storage::delete($product->image);
    }

    $product->delete();

    return redirect('/products')->with('success', 'Product deleted successfully.');
}
}
