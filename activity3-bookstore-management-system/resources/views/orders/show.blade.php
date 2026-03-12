@extends('layouts.app')

@section('title', 'Order #' . $order->id . ' - PageTurner')

@section('header')
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
        <a href="{{ route('orders.index') }}" class="text-indigo-600 hover:text-indigo-800">
            Back to Orders
        </a>
    </div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="grid grid-cols-2 gap-6">
        <div>
            <h3 class="font-semibold text-lg mb-2">Order Information</h3>
            <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
            <p><strong>Status:</strong> 
                <span class="inline-block px-3 py-1 rounded-full text-sm 
                    @if($order->status == 'completed') bg-green-100 text-green-800
                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                    @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                    @else bg-yellow-100 text-yellow-800
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            @auth
                @if(auth()->user()->isAdmin())
                    <p><strong>Customer:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                @endif
            @endauth
        </div>
        <div class="text-right">
            <h3 class="font-semibold text-lg mb-2">Total Amount</h3>
            <p class="text-3xl font-bold text-indigo-600">${{ number_format($order->total_amount, 2) }}</p>
        </div>
    </div>
    
    <!-- Admin: Update Status -->
    @auth
        @if(auth()->user()->isAdmin())
            <div class="mt-6 pt-6 border-t">
                <h3 class="font-semibold text-lg mb-2">Update Status</h3>
                <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="flex gap-4">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                        Update
                    </button>
                </form>
            </div>
        @endif
    @endauth
</div>

<!-- Order Items -->
<h2 class="text-2xl font-bold mb-4">Order Items</h2>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Book</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($order->orderItems as $item)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->book->title }}</div>
                                <div class="text-sm text-gray-500">by {{ $item->book->author }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->quantity }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($item->unit_price, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">${{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('partials.flash-messages')
@endsection
