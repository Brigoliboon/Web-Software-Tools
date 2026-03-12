@extends('layouts.app')

@section('title', 'Categories - PageTurner')

@section('header')
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Categories</h1>
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                    Add Category
                </a>
            @endif
        @endauth
    </div>
@endsection

@section('content')
@if($categories->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-xl text-gray-800">{{ $category->name }}</h3>
                <p class="text-gray-600 mt-2">{{ $category->description }}</p>
                <p class="text-sm text-gray-500 mt-4">{{ $category->books_count }} books</p>
                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('categories.show', $category) }}" class="text-indigo-600 hover:text-indigo-800">View Books</a>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-yellow-600 hover:text-yellow-800">Edit</a>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $categories->links() }}
    </div>
@else
    <x-alert type="info">
        No categories available yet.
    </x-alert>
@endif
@include('partials.flash-messages')
@endsection
