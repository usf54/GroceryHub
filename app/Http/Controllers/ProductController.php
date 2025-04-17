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
        $randomProducts = Product::inRandomOrder()->take(10)->get();
        $latestProducts = Product::latest()->take(10)->get();

        return view('home', compact('products','randomProducts','latestProducts'));
    }

    public function liveSearch(Request $request)
    {
        $query = $request->input('query');
    
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'img']); 

        return response()->json($products);
    }
    
    public function showAllProducts(Request $request)
    {
        $categories = Category::all();
        $query = Product::query();

        // Filter by category ID
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by price range
        if ($request->filled('price')) {
            $query->where('price', '<=', $request->price);
        }

        // Paginate and retain filters
        // appends($request->query()) ensures that filters (category, price) persist in pagination links.
        $products = $query->paginate(12)->appends($request->query());

        return view('products-list', compact('products', 'categories'));
    }

    // Show a specific product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Get recommended products (same category, excluding current product, random order)
        $recommendedProducts = Product::where('category_id', $product->category_id)
                                    ->where('id', '!=', $id)
                                    ->inRandomOrder()
                                    ->limit(4)
                                    ->get();
        
        // If not enough products in same category, fill with random products
        if ($recommendedProducts->count() < 4) {
            $additionalProducts = Product::where('category_id', '!=', $product->category_id)
                                        ->where('id', '!=', $id)
                                        ->inRandomOrder()
                                        ->limit(4 - $recommendedProducts->count())
                                        ->get();
            
            $recommendedProducts = $recommendedProducts->merge($additionalProducts);
        }
        
        return view('product-details', compact('product', 'recommendedProducts')); 
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


