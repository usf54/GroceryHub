<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Category;
use Illuminate\Http\Request;

class PackController extends Controller
{
    // Display all packs
    public function index()
    {
        $packs = Pack::with('category')->get();
        return view('admin.packs.index', compact('packs'));
    }

    // Show the form to create a new pack
    public function create()
    {
        $categories = Category::all();
        return view('admin.packs.create', compact('categories'));
    }

    // Store a new pack
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Pack::create($request->all());

        return redirect()->route('admin.packs.index')->with('success', 'Pack created successfully.');
    }

    // Show the form to edit a pack
    public function edit(Pack $pack)
    {
        $categories = Category::all();
        return view('admin.packs.edit', compact('pack', 'categories'));
    }

    // Update a pack
    public function update(Request $request, Pack $pack)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $pack->update($request->all());

        return redirect()->route('admin.packs.index')->with('success', 'Pack updated successfully.');
    }

    // Delete a pack
    public function destroy(Pack $pack)
    {
        $pack->delete();

        return redirect()->route('admin.packs.index')->with('success', 'Pack deleted successfully.');
    }
}