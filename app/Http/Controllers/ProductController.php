<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function home()
    {
        $products = Product::take(10)->get();

        return view('home', compact('products'));
    }

    public function showAllProducts(Request $request)
{
    $categories = Category::all();
    $query = Product::query();

    // Map category names to IDs
    $categoryMapping = [
        'fruits' => 1,
        'vegetables' => 2,
        'Meats' => 8,
        'Bakery' => 6,
        'seafood' => 16,
    ];

    // Filter by category name
    if ($request->has('category') && array_key_exists($request->category, $categoryMapping)) {
        $query->where('category_id', $categoryMapping[$request->category]);
    }

    // Filter by price range
    if ($request->has('price') && !empty($request->price)) {
        $query->where('price', '<=', $request->price);
    }

    // Paginate and retain filters
    $products = $query->paginate(12)->appends($request->query());

    return view('products-list', compact('products', 'categories'));
}



    // Show a specific product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-details', compact('product')); 
    }

    // Manage Products
    public function index()
    {
        $products = Product::all();
        
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

         // Handle image upload
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        
        if ($request->hasFile('img')) {
            if ($product->img) {
                Storage::disk('public')->delete($product->img);
            }
            $data['img'] = $request->file('img')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->img) {
            Storage::disk('public')->delete($product->img);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}


