<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the appropriate dashboard based on user role.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }
        
        return $this->userDashboard();
    }

    /**
     * Admin Dashboard - View statistics and recent orders.
     */
    protected function adminDashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_books' => Book::count(),
            'total_categories' => Category::count(),
            'total_orders' => Order::count(),
        ];

        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $orderStatusSummary = Order::select('status')
            ->selectRaw('count(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        return view('dashboard.admin', compact('stats', 'recentOrders', 'orderStatusSummary'));
    }

    /**
     * User Dashboard - View order summary and review activity.
     */
    protected function userDashboard()
    {
        $user = Auth::user();
        
        $orderSummary = [
            'total_orders' => $user->orders()->count(),
            'pending' => $user->orders()->where('status', 'pending')->count(),
            'processing' => $user->orders()->where('status', 'processing')->count(),
            'shipped' => $user->orders()->where('status', 'shipped')->count(),
            'delivered' => $user->orders()->where('status', 'delivered')->count(),
            'cancelled' => $user->orders()->where('status', 'cancelled')->count(),
            'total_spent' => $user->orders()->where('status', '!=', 'cancelled')->sum('total_amount'),
        ];

        $recentOrders = $user->orders()
            ->with('orderItems.book')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentReviews = $user->reviews()
            ->with('book')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.user', compact('orderSummary', 'recentOrders', 'recentReviews'));
    }
}
