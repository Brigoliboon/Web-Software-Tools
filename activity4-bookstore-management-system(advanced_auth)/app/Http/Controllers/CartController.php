<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $bookId => $quantity) {
            $book = Book::find($bookId);
            if ($book) {
                $cartItems[] = [
                    'book' => $book,
                    'quantity' => $quantity,
                    'subtotal' => $book->price * $quantity
                ];
                $total += $book->price * $quantity;
            }
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add a book to the cart.
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $book = Book::findOrFail($validated['book_id']);

        // Check stock
        if ($book->stock_quantity < $validated['quantity']) {
            return back()->with('error', 'Not enough stock available!');
        }

        $cart = Session::get('cart', []);

        // Add to cart or update quantity
        if (isset($cart[$book->id])) {
            $newQuantity = $cart[$book->id] + $validated['quantity'];
            if ($book->stock_quantity < $newQuantity) {
                return back()->with('error', 'Not enough stock available!');
            }
            $cart[$book->id] = $newQuantity;
        } else {
            $cart[$book->id] = $validated['quantity'];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Book added to cart!');
    }

    /**
     * Update the quantity of a book in the cart.
     */
    public function update(Request $request, $bookId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $book = Book::findOrFail($bookId);
        
        // Check stock
        if ($book->stock_quantity < $validated['quantity']) {
            return back()->with('error', 'Not enough stock available!');
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$bookId])) {
            $cart[$bookId] = $validated['quantity'];
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Cart updated!');
    }

    /**
     * Remove a book from the cart.
     */
    public function remove($bookId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$bookId])) {
            unset($cart[$bookId]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Book removed from cart!');
    }

    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        Session::forget('cart');

        return redirect()->route('cart.index')
            ->with('success', 'Cart cleared!');
    }

    /**
     * Get cart count for display in navbar.
     */
    public function getCartCount()
    {
        $cart = Session::get('cart', []);
        return array_sum($cart);
    }
}
