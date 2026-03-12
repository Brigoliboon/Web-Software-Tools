<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PageTurner - Discover your next great read">
    <title>@yield('title', 'PageTurner Bookstore')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
    <style>
        :root {
            --color-primary: #1a1a2e;
            --color-secondary: #16213e;
            --color-accent: #e94560;
            --color-gold: #f4a261;
            --color-cream: #faf3e8;
            --color-text: #2d3436;
            --color-text-light: #636e72;
        }
        
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--color-cream);
            color: var(--color-text);
        }
        
        .font-display {
            font-family: 'Cormorant Garamond', serif;
        }
        
        .bg-primary { background-color: var(--color-primary); }
        .bg-secondary { background-color: var(--color-secondary); }
        .bg-accent { background-color: var(--color-accent); }
        .bg-gold { background-color: var(--color-gold); }
        .bg-cream { background-color: var(--color-cream); }
        
        .text-primary { color: var(--color-primary); }
        .text-secondary { color: var(--color-secondary); }
        .text-accent { color: var(--color-accent); }
        .text-gold { color: var(--color-gold); }
        
        .border-primary { border-color: var(--color-primary); }
        
        /* Elegant card style */
        .card-elegant {
            background: white;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-elegant:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }
        
        /* Button styles */
        .btn-elegant {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: white;
            padding: 12px 28px;
            border-radius: 4px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-elegant::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-elegant:hover::before {
            left: 100%;
        }
        
        .btn-elegant:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 26, 46, 0.3);
        }
        
        .btn-accent {
            background: var(--color-accent);
            color: white;
            padding: 12px 28px;
            border-radius: 4px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .btn-accent:hover {
            background: #d63d56;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(233, 69, 96, 0.4);
        }
        
        /* Navigation */
        .nav-link {
            position: relative;
            padding: 8px 0;
            color: var(--color-text);
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--color-accent);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: var(--color-accent);
        }
        
        /* Book cover effect */
        .book-cover {
            position: relative;
            overflow: hidden;
        }
        
        .book-cover::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(26,26,46,0.1) 0%, rgba(233,69,96,0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }
        
        .book-cover:hover::before {
            opacity: 1;
        }
        
        /* Input styles */
        .input-elegant {
            border: 1px solid #e0e0e0;
            padding: 14px 18px;
            border-radius: 4px;
            width: 100%;
            transition: all 0.3s ease;
            background: white;
        }
        
        .input-elegant:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(26, 26, 46, 0.1);
        }
        
        /* Price tag */
        .price-tag {
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            color: var(--color-accent);
        }
        
        /* Category pills */
        .category-pill {
            padding: 8px 20px;
            border-radius: 50px;
            background: white;
            border: 1px solid #e0e0e0;
            color: var(--color-text);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .category-pill:hover {
            background: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
        }
        
        /* Rating stars */
        .star-rating {
            color: var(--color-gold);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--color-cream);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--color-primary);
            border-radius: 4px;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="font-display text-2xl font-bold text-primary">PageTurner</span>
                </a>
                
                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('books.index') }}" class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">Books</a>
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">Categories</a>
                </div>
                
                <!-- Right Side -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('orders.index') }}" class="nav-link text-sm">My Orders</a>
                        <a href="{{ route('cart.index') }}" class="relative p-2">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            @php $cart = session()->get('cart', []); $cartCount = array_sum($cart); @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-1 -right-1 bg-accent text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">{{ $cartCount }}</span>
                            @endif
                        </a>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Log Out</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-link text-sm">Log In</a>
                        <a href="{{ route('register') }}" class="btn-elegant text-sm">Sign Up</a>
                    @endauth
                    
                    <!-- Mobile menu button -->
                    <button class="md:hidden p-2" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-6 py-4 space-y-3">
                <a href="{{ route('home') }}" class="block py-2">Home</a>
                <a href="{{ route('books.index') }}" class="block py-2">Books</a>
                <a href="{{ route('categories.index') }}" class="block py-2">Categories</a>
                @auth
                    <a href="{{ route('orders.index') }}" class="block py-2">My Orders</a>
                    <a href="{{ route('cart.index') }}" class="block py-2">Cart</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-white/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <span class="font-display text-xl font-bold">PageTurner</span>
                    </div>
                    <p class="text-white/60 text-sm">Your destination for extraordinary literary journeys.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Browse</h4>
                    <ul class="space-y-2 text-white/60 text-sm">
                        <li><a href="{{ route('books.index') }}" class="hover:text-white">All Books</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-white">Categories</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Account</h4>
                    <ul class="space-y-2 text-white/60 text-sm">
                        @auth
                            <li><a href="{{ route('orders.index') }}" class="hover:text-white">My Orders</a></li>
                            <li><a href="{{ route('profile.edit') }}" class="hover:text-white">Profile</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-white">Login</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white">Register</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <p class="text-white/60 text-sm">hello@pageturner.com</p>
                </div>
            </div>
            <div class="border-t border-white/10 mt-8 pt-8 text-center text-white/40 text-sm">
                &copy; {{ date('Y') }} PageTurner. All rights reserved.
            </div>
        </div>
    </footer>
    
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
