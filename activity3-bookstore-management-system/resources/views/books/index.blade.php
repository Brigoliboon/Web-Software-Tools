@extends('layouts.app')

@section('title', 'All Books - PageTurner')

@section('content')
<div class="bg-primary text-white py-12">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="font-display text-4xl font-bold">Our Collection</h1>
        <p class="text-white/60 mt-2">Explore {{ $books->total() }} books across various categories</p>
    </div>
</div>

<!-- Search & Filter -->
<div class="max-w-7xl mx-auto px-6 -mt-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('books.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Search by title, author, ISBN..." 
                        class="input-elegant">
                </div>
                
                <!-- Category -->
                <div>
                    <select name="category" class="input-elegant">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Sort -->
                <div>
                    <select name="sort" class="input-elegant">
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest</option>
                        <option value="price" {{ request('sort') == 'price' && request('order') == 'asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price" {{ request('sort') == 'price' && request('order') == 'desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Top Rated</option>
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title A-Z</option>
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Price Range -->
                <div class="md:col-span-2 flex items-center gap-2">
                    <span class="text-gray-500">Price:</span>
                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="input-elegant">
                    <span class="text-gray-400">-</span>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="input-elegant">
                </div>
                
                <input type="hidden" name="order" value="{{ request('order', 'desc') }}">
                
                <div class="flex gap-2">
                    <button type="submit" class="btn-elegant flex-1">Search</button>
                    @if(request()->anyFilled(['search', 'category', 'min_price', 'max_price', 'sort']))
                        <a href="{{ route('books.index') }}" class="px-4 py-3 border border-gray-300 rounded hover:bg-gray-50 transition">Clear</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Books Grid -->
<div class="max-w-7xl mx-auto px-6 py-12">
    @if($books->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($books as $book)
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
        
        <!-- Pagination -->
        <div class="mt-12">
            {{ $books->withQueryString()->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-lg">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <h3 class="text-xl font-bold text-gray-800 mb-2">No books found</h3>
            <p class="text-gray-500 mb-6">Try adjusting your search or filters</p>
            <a href="{{ route('books.index') }}" class="btn-elegant">Clear Filters</a>
        </div>
    @endif
</div>
@include('partials.flash-messages')
@endsection
