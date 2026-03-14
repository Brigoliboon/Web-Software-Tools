@extends('layouts.app')

@section('title', 'My Dashboard - PageTurner')

@section('header')
    <h1 class="text-3xl font-bold text-gray-900">My Dashboard</h1>
@endsection

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Message -->
        <div class="bg-white shadow rounded-lg mb-6 p-6">
            <h2 class="text-xl font-semibold text-gray-900">Welcome back, {{ Auth::user()->name }}!</h2>
            <p class="text-gray-500 mt-1">Here's an overview of your account activity.</p>
        </div>

        <!-- Order Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white overflow-hidden shadow rounded-lg p-5">
                <div class="text-sm font-medium text-gray-500">Total Orders</div>
                <div class="text-3xl font-semibold text-gray-900">{{ $orderSummary['total_orders'] }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg p-5">
                <div class="text-sm font-medium text-gray-500">Total Spent</div>
                <div class="text-3xl font-semibold text-gray-900">${{ number_format($orderSummary['total_spent'], 2) }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg p-5">
                <div class="text-sm font-medium text-gray-500">Pending</div>
                <div class="text-3xl font-semibold text-yellow-600">{{ $orderSummary['pending'] }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg p-5">
                <div class="text-sm font-medium text-gray-500">Delivered</div>
                <div class="text-3xl font-semibold text-green-600">{{ $orderSummary['delivered'] }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Orders -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Orders</h3>
                    <a href="{{ route('orders.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">View All</a>
                </div>
                <div class="border-t border-gray-200">
                    @if($recentOrders->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recentOrders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">
                                        #{{ $order->id }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($order->total_amount, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                        @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                                        @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="p-6 text-center text-gray-500">
                        <p>You haven't placed any orders yet.</p>
                        <a href="{{ route('books.index') }}" class="text-indigo-600 hover:text-indigo-900 mt-2 inline-block">Start Shopping</a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Recent Reviews -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">My Reviews</h3>
                </div>
                <div class="border-t border-gray-200">
                    @if($recentReviews->count() > 0)
                    <ul class="divide-y divide-gray-200">
                        @foreach($recentReviews as $review)
                        <li class="px-4 py-4">
                            <div class="flex items-center justify-between">
                                <a href="{{ route('books.show', $review->book) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">
                                    {{ $review->book->title }}
                                </a>
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @else
                                            <svg class="h-4 w-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $review->comment }}</p>
                            <p class="text-xs text-gray-400 mt-2">{{ $review->created_at->format('M d, Y') }}</p>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="p-6 text-center text-gray-500">
                        <p>You haven't written any reviews yet.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Account Status -->
        <div class="mt-8 bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Account Status</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-gray-600">Email Verified</span>
                </div>
                <div class="flex items-center">
                    @if(Auth::user()->two_factor_enabled)
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-gray-600">Two-Factor Authentication Enabled</span>
                    @else
                    <svg class="h-5 w-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-gray-600">Two-Factor Authentication Not Enabled</span>
                    @endif
                </div>
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-gray-600">Role: {{ ucfirst(Auth::user()->role) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
