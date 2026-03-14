<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin can see all orders
            $orders = Order::with('user', 'orderItems.book')->orderBy('created_at', 'desc')->paginate(10);
        } else {
            // Customers can only see their own orders
            $orders = $user->orders()->with('orderItems.book')->orderBy('created_at', 'desc')->paginate(10);
        }
        
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        // For now, redirect to books page - could be enhanced with a shopping cart
        return redirect()->route('books.index');
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        // Check stock
        if ($book->stock_quantity < $validated['quantity']) {
            return back()->with('error', 'Not enough stock available!');
        }

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $book->price * $validated['quantity'],
            'status' => 'pending',
        ]);

        // Create order item
        OrderItem::create([
            'order_id' => $order->id,
            'book_id' => $book->id,
            'quantity' => $validated['quantity'],
            'unit_price' => $book->price,
        ]);

        // Reduce stock
        $book->stock_quantity -= $validated['quantity'];
        $book->save();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load('orderItems.book', 'user');
        
        // Ensure user can only view their own orders (or admin)
        $user = Auth::user();
        if (!$user->isAdmin() && $order->user_id !== $user->id) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Update the specified order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order status updated successfully!');
    }

    /**
     * Checkout - create order from cart.
     */
    public function checkout(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        // Validate stock for all items
        foreach ($cart as $bookId => $quantity) {
            $book = Book::find($bookId);
            if (!$book || $book->stock_quantity < $quantity) {
                return redirect()->route('cart.index')
                    ->with('error', 'Not enough stock for: ' . ($book ? $book->title : 'Unknown Book'));
            }
        }

        // Calculate total
        $totalAmount = 0;
        foreach ($cart as $bookId => $quantity) {
            $book = Book::find($bookId);
            $totalAmount += $book->price * $quantity;
        }

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        // Create order items and reduce stock
        foreach ($cart as $bookId => $quantity) {
            $book = Book::find($bookId);
            
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $book->id,
                'quantity' => $quantity,
                'unit_price' => $book->price,
            ]);

            // Reduce stock
            $book->stock_quantity -= $quantity;
            $book->save();
        }

        // Clear cart
        Session::forget('cart');

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }

    /**
     * Display all pending orders (admin only).
     */
    public function pendingOrders()
    {
        $pendingOrders = Order::with('user', 'orderItems.book')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.orders.pending', compact('pendingOrders'));
    }

    /**
     * Approve a pending order (admin only).
     */
    public function approve(Request $request, Order $order)
    {
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending orders can be approved.');
        }

        $order->update(['status' => 'processing']);

        return redirect()->route('admin.orders.pending')
            ->with('success', 'Order #' . $order->id . ' has been approved and is now being processed.');
    }
}
