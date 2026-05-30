<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
    'name'        => 'required',
    'price'       => 'required|numeric',
    'stock'       => 'required|integer|min:0',
    'description' => 'nullable',
    'image'       => 'nullable|url',
]);

Product::create([
    'name'        => $request->name,
    'price'       => $request->price,
    'stock'       => $request->stock,
    'description' => $request->description,
    'image'       => $request->image,
]);

        return redirect()->route('products.index')
            ->with('success', 'Ice cream flavor added successfully! 🍦');
    }

    // Show edit form
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
    'name'        => 'required',
    'price'       => 'required|numeric',
    'stock'       => 'required|integer|min:0',
    'description' => 'nullable',
    'image'       => 'nullable|url',
]);

$product->update([
    'name'        => $request->name,
    'price'       => $request->price,
    'stock'       => $request->stock,
    'description' => $request->description,
    'image'       => $request->image,
]);

        return redirect()->route('products.index')
            ->with('success', 'Ice cream flavor updated successfully! 🍦');
    }

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Ice cream flavor deleted successfully!');
    }
}