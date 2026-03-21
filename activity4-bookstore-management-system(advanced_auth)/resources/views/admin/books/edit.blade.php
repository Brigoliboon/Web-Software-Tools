@extends('layouts.app')

@section('title', 'Edit Book - Admin Dashboard')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Book</h1>
            <p class="text-gray-500 mt-1">Update book information</p>
        </div>

        <!-- Current Book Info -->
        <div class="bg-white rounded-lg shadow p-4 mb-6 flex items-center gap-4">
            @if($book->cover_thumbnail)
                <img src="{{ asset('storage/' . $book->cover_thumbnail) }}" alt="{{ $book->title }}" class="w-16 h-24 object-cover rounded-lg">
            @else
                <div class="w-16 h-24 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            @endif
            <div>
                <h2 class="text-lg font-semibold text-gray-900">{{ $book->title }}</h2>
                <p class="text-gray-600">by {{ $book->author }}</p>
                <div class="flex gap-3 mt-2 text-sm">
                    <span class="text-gray-500">ISBN: {{ $book->isbn }}</span>
                    <span class="text-gray-500">Current Price: ${{ number_format($book->price, 2) }}</span>
                    <span class="text-gray-500">Stock: {{ $book->stock_quantity }}</span>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-gray-700 font-medium mb-2">Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror" required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div class="md:col-span-2">
                        <label for="author" class="block text-gray-700 font-medium mb-2">Author *</label>
                        <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        @error('author')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-gray-700 font-medium mb-2">Category *</label>
                        <select name="category_id" id="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('category_id') border-red-500 @enderror" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ISBN -->
                    <div>
                        <label for="isbn" class="block text-gray-700 font-medium mb-2">ISBN *</label>
                        <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('isbn') border-red-500 @enderror" required>
                        @error('isbn')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-gray-700 font-medium mb-2">Price ($) *</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">$</span>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $book->price) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('price') border-red-500 @enderror pl-7" required>
                        </div>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock Quantity -->
                    <div>
                        <label for="stock_quantity" class="block text-gray-700 font-medium mb-2">Stock Quantity *</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $book->stock_quantity) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('stock_quantity') border-red-500 @enderror" required>
                        @error('stock_quantity')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cover Image -->
                    <div class="md:col-span-2">
                        <label for="cover_image" class="block text-gray-700 font-medium mb-2">Cover Image</label>
                        <input type="file" name="cover_image" id="cover_image" accept="image/*" class="w-full border-gray-300 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-500 mt-1">Leave blank to keep current image. Supported formats: JPG, PNG, GIF (Max: 2MB)</p>
                        @error('cover_image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-6 pt-6 border-t">
                    <div>
                        <span class="text-sm text-gray-500">Created: {{ $book->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.books.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Book
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Delete Section -->
        <div class="bg-white rounded-lg shadow p-6 mt-6 border-l-4 border-red-500">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Delete Book</h3>
            <p class="text-sm text-gray-500 mb-4">This action cannot be undone. This will permanently delete the book and all associated data.</p>
            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure? This will permanently delete this book.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Delete Book
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
