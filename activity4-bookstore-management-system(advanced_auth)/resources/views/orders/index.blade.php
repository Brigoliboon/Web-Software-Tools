@extends('layouts.app')

@section('title', 'My Orders - PageTurner')

@section('header')
    <h1 class="text-3xl font-bold text-gray-900">
        @auth
            @if(auth()->user()->isAdmin())
                All Orders
            @else
                My Orders
            @endif
        @endauth
    </h1>
@endsection

@section('content')
@if($orders->count() > 0)
    <div class="space-y-4">
        @foreach($orders as $order)
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-semibold text-lg">Order #{{ $order->id }}</h3>
                        @auth
                            @if(auth()->user()->isAdmin())
                                <p class="text-gray-600">Customer: {{ $order->user->name }}</p>
                            @endif
                        @endauth
                        <p class="text-gray-500 text-sm">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-xl">${{ number_format($order->total_amount, 2) }}</p>
                        <span class="inline-block px-3 py-1 rounded-full text-sm 
                            @if($order->status == 'completed') bg-green-100 text-green-800
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
                <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-800">
                    View Details →
                </a>
            </div>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $orders->links() }}
    </div>
@else
    <x-alert type="info">
        No orders yet. Start shopping to see your orders here!
    </x-alert>
@endif
@include('partials.flash-messages')
@endsection
