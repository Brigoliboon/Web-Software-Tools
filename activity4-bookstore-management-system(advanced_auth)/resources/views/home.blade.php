@extends('layouts.app')

@section('title', 'PageTurner - Your Premier Online Bookstore')

@section('content')
<!-- Hero Section -->
<div class="bg-primary text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="max-w-3xl">
            <h1 class="font-display text-5xl md:text-6xl font-bold mb-6 leading-tight">
                Where Every Page<br>Becomes an Adventure
            </h1>
            <p class="text-lg text-white/70 mb-8 max-w-2xl">
                Discover handpicked selections from world-class authors. 
                Your next unforgettable journey begins with a single page.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('books.index') }}" class="btn-accent">
                    Explore Collection
                </a>
                <a href="{{ route('categories.index') }}" class="border border-white/30 text-white px-8 py-3 rounded hover:bg-white/10 transition">
                    Browse Categories
                </a>
            </div>
        </div>
        
        <!-- Stats -->
        <div class="flex flex-wrap gap-12 mt-16">
            <div>
                <div class="text-4xl font-bold text-gold">10K+</div>
                <div class="text-white/50 text-sm mt-1">Books Available</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-gold">500+</div>
                <div class="text-white/50 text-sm mt-1">Authors</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-gold">50+</div>
                <div class="text-white/50 text-sm mt-1">Categories</div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<section class="max-w-7xl mx-auto px-6 py-16">
    <div class="flex items-center justify-between mb-8">
        <h2 class="font-display text-3xl font-bold text-primary">Browse by Category</h2>
        <a href="{{ route('categories.index') }}" class="text-accent hover:underline">View All</a>
    </div>
    
    <div class="flex flex-wrap gap-4">
        @foreach($categories as $category)
            <a href="{{ route('categories.show', $category) }}" class="category-pill">
                {{ $category->name }}
                <span class="text-gray-400 ml-1">({{ $category->books_count }})</span>
            </a>
        @endforeach
    </div>
</section>

<!-- Featured Books -->
<section class="max-w-7xl mx-auto px-6 py-16">
    <h2 class="font-display text-3xl font-bold text-primary mb-8">Featured Books</h2>
    
    @if($featuredBooks->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($featuredBooks as $book)
                <div class="card-elegant">
                    <!-- Book Cover -->
                    <div class="h-64 bg-gray-100 relative book-cover">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-50">
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Badges -->
                        @if($book->price < 10)
                            <span class="absolute top-3 left-3 bg-accent text-white text-xs px-3 py-1 rounded-sm">SALE</span>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="p-5">
                        @if($book->category)
                            <span class="text-xs text-gray-400 uppercase tracking-wider">{{ $book->category->name }}</span>
                        @endif
                        
                        <h3 class="font-bold text-lg mt-2 mb-1 line-clamp-2">
                            <a href="{{ route('books.show', $book) }}" class="hover:text-accent transition">{{ $book->title }}</a>
                        </h3>
                        <p class="text-gray-500 text-sm mb-3">by {{ $book->author }}</p>
                        
                        <!-- Rating -->
                        <div class="flex items-center gap-1 mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($book->average_rating))
                                    <svg class="w-4 h-4 star-rating" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-gray-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endif
                            @endfor
                            <span class="text-xs text-gray-400 ml-1">({{ $book->reviews->count() }})</span>
                        </div>
                        
                        <!-- Price -->
                        <div class="flex items-center justify-between">
                            <span class="price-tag text-xl">${{ number_format($book->price, 2) }}</span>
                            
                            @auth
                                @if($book->stock_quantity > 0)
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="text-sm bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition">
                                            Add
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-red-500">Out of Stock</span>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-lg">
            <p class="text-gray-500">No books available yet. Check back soon!</p>
        </div>
    @endif
</section>

<!-- CTA Section -->
<section class="bg-primary text-white py-16">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="font-display text-4xl font-bold mb-4">Ready to Start Reading?</h2>
        <p class="text-white/70 mb-8 max-w-xl mx-auto">
            Join thousands of readers who have discovered their next favorite book at PageTurner.
        </p>
        @guest
            <div class="flex justify-center gap-4">
                <a href="{{ route('register') }}" class="btn-accent">Create Account</a>
                <a href="{{ route('login') }}" class="border border-white/30 text-white px-8 py-3 rounded hover:bg-white/10 transition">Sign In</a>
            </div>
        @else
            <a href="{{ route('books.index') }}" class="btn-accent">Browse Books</a>
        @endguest
    </div>
</section>
@endsection
