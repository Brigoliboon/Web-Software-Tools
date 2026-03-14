@extends('layouts.app')

@section('title', 'User Details - Admin Dashboard')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="text-indigo-600 hover:text-indigo-900 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Users
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- User Info -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">User Information</h2>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-500">Name</label>
                        <p class="text-gray-900 font-medium">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Email</label>
                        <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Role</label>
                        <p class="text-gray-900 font-medium">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Member Since</label>
                        <p class="text-gray-900 font-medium">{{ $user->created_at->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Email Verified</label>
                        <p class="text-gray-900 font-medium">
                            @if($user->email_verified_at)
                                <span class="text-green-600">Verified</span>
                            @else
                                <span class="text-red-600">Not Verified</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="mt-6 flex gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="flex-1 text-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Edit
                    </a>
                    @if($user->id !== auth()->id())
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            <!-- User Orders -->
            <div class="bg-white shadow rounded-lg p-6 lg:col-span-2">
                <h2 class="text-xl font-bold text-gray-900 mb-4">User Orders ({{ $user->orders->count() }})</h2>
                @if($user->orders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Order ID</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Total</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Status</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($user->orders as $order)
                                <tr>
                                    <td class="px-4 py-2 text-sm">#{{ $order->id }}</td>
                                    <td class="px-4 py-2 text-sm">${{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-4 py-2 text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                            @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                                            @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">No orders yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
