<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // Display all categories
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Show the form to create a new category
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $data = $request->only('name');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Show the form to edit a category
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Update a category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $data = $request->only('name');

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            // Store new image
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete a category
    public function destroy(Category $category)
    {
        // Delete image from storage
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
