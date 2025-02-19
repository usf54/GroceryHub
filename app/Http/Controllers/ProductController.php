<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::take(10)->get();

        return view('home', compact('products'));
    }

    public function showAllProducts()
    {
        $products = Product::all();

        return view('products-list', compact('products'));
    }


    // Show a specific product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-details', compact('product')); 
    }

    // Admin: Show the form to create a new product
    public function create()
    {
        $categories = Category::all(); // Get all categories to associate with the product
        return view('products.create', compact('categories'));
    }

    // Admin: Store a new product
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create the product
        Product::create($validatedData);

        // Redirect to the product list
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    // Admin: Show the form to edit an existing product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Get all categories to update the product
        return view('products.edit', compact('product', 'categories'));
    }

    // Admin: Update the product
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Find the product and update it
        $product = Product::findOrFail($id);
        $product->update($validatedData);

        // Redirect to the product list
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // Admin: Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // Redirect to the product list
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
