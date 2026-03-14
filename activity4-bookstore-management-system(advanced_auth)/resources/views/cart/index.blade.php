@extends('layouts.app')

@section('title', 'Shopping Cart - PageTurner')

@section('content')
<div class="bg-primary text-white py-12">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="font-display text-4xl font-bold">Shopping Cart</h1>
        <p class="text-white/60 mt-2">{{ count($cartItems) }} {{ count($cartItems) == 1 ? 'item' : 'items' }} in your cart</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 py-12">
@auth
    @if(count($cartItems) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                    <div class="card-elegant p-6 flex gap-6">
                        <!-- Book Image -->
                        <div class="w-24 h-32 bg-gray-100 flex-shrink-0">
                            @if($item['book']->cover_image)
                                <img src="{{ asset('storage/' . $item['book']->cover_image) }}" alt="{{ $item['book']->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-50">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Details -->
                        <div class="flex-1">
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="font-bold text-lg">
                                        <a href="{{ route('books.show', $item['book']) }}" class="hover:text-accent transition">{{ $item['book']->title }}</a>
                                    </h3>
                                    <p class="text-gray-500 text-sm">by {{ $item['book']->author }}</p>
                                </div>
                                <form action="{{ route('cart.remove', $item['book']->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            
                            <div class="flex items-center justify-between mt-4">
                                <!-- Quantity -->
                                <form action="{{ route('cart.update', $item['book']->id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <span class="text-sm text-gray-500">Qty:</span>
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['book']->stock_quantity }}" class="w-16 text-center border border-gray-200 rounded py-1">
                                    <button type="submit" class="text-sm text-accent hover:underline">Update</button>
                                </form>
                                
                                <!-- Price -->
                                <div class="text-right">
                                    <span class="price-tag text-xl">${{ number_format($item['subtotal'], 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Summary -->
            <div class="lg:col-span-1">
                <div class="card-elegant p-6 sticky top-24">
                    <h2 class="font-display text-xl font-bold mb-6">Order Summary</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Shipping</span>
                            <span class="text-green-600">Free</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between font-bold">
                            <span>Total</span>
                            <span class="price-tag text-2xl">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('orders.create') }}" class="block w-full btn-accent text-center">
                        Proceed to Checkout
                    </a>
                    
                    <a href="{{ route('books.index') }}" class="block text-center mt-4 text-gray-500 hover:text-accent transition">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold mb-4">Your cart is empty</h2>
            <p class="text-gray-500 mb-8">Start adding books to your cart!</p>
            <a href="{{ route('books.index') }}" class="btn-elegant">Browse Books</a>
        </div>
    @endif
@else
    <!-- Guest -->
    <div class="text-center py-16 bg-white rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Sign in to view your cart</h2>
        <p class="text-gray-500 mb-8">Create an account or sign in to start shopping.</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('login') }}" class="btn-elegant">Sign In</a>
            <a href="{{ route('register') }}" class="border border-gray-300 px-6 py-3 rounded hover:bg-gray-50 transition">Create Account</a>
        </div>
    </div>
@endauth
</div>
@include('partials.flash-messages')
@endsection
