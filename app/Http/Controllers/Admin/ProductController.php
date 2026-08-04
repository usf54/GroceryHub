<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $products = Product::take(10)->get();
        $randomProducts = Product::inRandomOrder()->take(10)->get();
        $latestProducts = Product::latest()->take(10)->get();

        return view('home', compact('categories','products','randomProducts','latestProducts'));
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

        $prices = Product::selectRaw('MIN(price) as min_price, MAX(price) as max_price')
            ->first();

        $minPrice = (float) $prices->min_price;
        $maxPrice = (float) $prices->max_price;

        $request->validate([
            'category' => 'nullable|integer|exists:categories,id',
        ]);

        $query = Product::query();

        if ($request->filled('category')) {
            $query->where('category_id', (int) $request->category);
        }

        $selectedPrice = $maxPrice;

        // Price filter
        if ($request->filled('price') && is_numeric($request->price)) {

            $price = (float) $request->price;

            // Only apply the filter if the price is within the valid range
            if ($price >= $minPrice && $price <= $maxPrice) {
                $selectedPrice = $price;
                $query->where('price', '<=', $price);
            }
        }

        $products = $query
            ->paginate(12)
            ->appends($request->query());

        return view('products-list', [
            'products'      => $products,
            'categories'    => $categories,
            'minPrice'      => $minPrice,
            'maxPrice'      => $maxPrice,
            'selectedPrice' => $selectedPrice,
        ]);
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


