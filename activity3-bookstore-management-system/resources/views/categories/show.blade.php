@extends('layouts.app')

@section('title', $category->name . ' - PageTurner')

@section('header')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">{{ $category->name }}</h1>
            @if($category->description)
                <p class="text-lg text-gray-500 mt-2">{{ $category->description }}</p>
            @endif
        </div>
        <a href="{{ route('categories.index') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300 transform hover:-translate-y-1 shadow-md hover:shadow-lg font-medium inline-flex items-center">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Categories
        </a>
    </div>
@endsection

@section('content')
@if($books->count() > 0)
    <div class="grid gap-6">
        <div class="grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($books as $book)
                <div class="group">
                    <x-book-card :book="$book" class="hover:shadow-xl transition-shadow duration-300"/>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $books->links() }}
        </div>
    </div>
@else
    <div class="text-center py-16">
        <div class="h-12 w-12 text-gray-300 mx-auto mb-4">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3 3m0 0l3-3m-3 3V8m0 4h8a2 2 0 002-2V6c0-1.1-.9-2-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">No books in this category yet</h3>
        <p class="text-gray-600">Explore other categories to find your next read.</p>
        <a href="{{ route('categories.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-all duration-300 transform hover:-translate-y-1 shadow-md hover:shadow-lg font-medium inline-block mt-4">
            Browse Categories
        </a>
    </div>
@endif
@include('partials.flash-messages')
@endsection
