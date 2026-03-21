<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::withCount('books')->paginate(10);
        // Check if this is an admin request (admin categories index has search)
        if (request()->has('search') || request()->routeIs('admin.categories.*')) {
            return view('admin.categories.index', compact('categories'));
        }
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        // Admin create view
        if (request()->routeIs('admin.categories.*')) {
            return view('admin.categories.create');
        }
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        // Redirect based on route type
        if (request()->routeIs('admin.categories.*')) {
            return redirect()->route('admin.categories.index')
                ->with('success', 'Category created successfully!');
        }
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        $books = $category->books()->paginate(12);
        return view('categories.show', compact('category', 'books'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        if (request()->routeIs('admin.categories.*')) {
            return view('admin.categories.edit', compact('category'));
        }
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        if (request()->routeIs('admin.categories.*')) {
            return redirect()->route('admin.categories.index')
                ->with('success', 'Category updated successfully!');
        }
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        if (request()->routeIs('admin.categories.*')) {
            return redirect()->route('admin.categories.index')
                ->with('success', 'Category deleted successfully!');
        }
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
