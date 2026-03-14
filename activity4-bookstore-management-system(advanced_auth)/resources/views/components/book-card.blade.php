<div {{ $attributes->merge(['class' => 'card-elegant']) }}>
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
        
        <!-- Price & Actions -->
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
