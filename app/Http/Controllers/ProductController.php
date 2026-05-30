<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ProductController extends Controller
{
    // Show only logged-in user's products
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->latest()->get();
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
            'user_id'     => Auth::id(),
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
        // Make sure user can only edit their own products
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('products.index')
                ->with('error', 'Unauthorized action!');
        }
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        // Make sure user can only update their own products
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('products.index')
                ->with('error', 'Unauthorized action!');
        }

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
        // Make sure user can only delete their own products
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('products.index')
                ->with('error', 'Unauthorized action!');
        }

        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Ice cream flavor deleted successfully!');
    }
}