@extends('layouts.app')

@section('title', 'Edit Category - Admin Dashboard')

@section('content')
<div class="py-6">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Category</h1>
            <p class="text-gray-500 mt-1">Update category information</p>
        </div>

        <!-- Category Info -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h2>
                    <p class="text-gray-600 text-sm">
                        {{ $category->books_count }} book{{ $category->books_count != 1 ? 's' : '' }} in this category
                    </p>
                </div>
            </div>
            @if($category->description)
            <p class="text-gray-600 mt-2 text-sm">{{ $category->description }}</p>
            @endif
            <p class="text-xs text-gray-500 mt-2">Created: {{ $category->created_at->format('M d, Y') }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-2">Category Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" required placeholder="e.g., Fiction, Non-Fiction, Science, etc.">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-6 pt-6 border-t">
                    <div>
                        <span class="text-sm text-gray-500">Last updated: {{ $category->updated_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Category
                        </button>
                    </div>
                </div>
            </form>

            <!-- Delete Section -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure? This will delete all books in this category.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Delete Category
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
