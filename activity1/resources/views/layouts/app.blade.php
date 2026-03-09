<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Laravel Concept: Blade Sections --}}
    {{-- @yield allows child views to inject content into this placeholder --}}
    {{-- The second parameter is a default value if no content is provided --}}
    <title>@yield('title', 'Portfolio - Boon Jefferson S. Brigoli')</title>
    
    {{-- Google Fonts - Inter for clean, modern typography --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- Laravel Concept: asset() helper --}}
    {{-- asset() generates a URL for assets in the public directory --}}
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
</head>
<body>
    {{-- Navigation Bar --}}
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-content">
                {{-- Laravel Concept: Named Routes --}}
                {{-- route() helper generates URLs for named routes defined in web.php --}}
                <div class="nav-brand">
                    <a href="{{ route('home') }}">Boon Jefferson</a>
                </div>
                
                {{-- Desktop Navigation Links --}}
                <ul class="nav-links" id="navLinks">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                    <li><a href="{{ route('projects') }}" class="{{ request()->routeIs('projects') ? 'active' : '' }}">Projects</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
                
                {{-- Mobile Menu Toggle Button --}}
                <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle mobile menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>
    
    {{-- Main Content Area --}}
    <main>
        {{-- Laravel Concept: Content Injection --}}
        {{-- Child views inject their content here using @section('content') --}}
        @yield('content')
    </main>
    
    {{-- Footer --}}
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-left">
                    <p>&copy; {{ date('Y') }} Boon Jefferson S. Brigoli. All rights reserved.</p>
                    <p class="footer-subtitle">Built with Laravel & Blade</p>
                </div>
                <div class="footer-right">
                    <div class="social-links">
                        <a href="https://github.com/Brigoliboon" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                        <a href="https://linkedin.com/in/boon-jefferson-brigoli-a1a4a628a" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    {{-- JavaScript --}}
    <script>
        // Mobile menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const navLinks = document.getElementById('navLinks');
            const navbar = document.getElementById('navbar');
            
            // Toggle mobile menu
            mobileMenuToggle.addEventListener('click', function() {
                navLinks.classList.toggle('active');
                mobileMenuToggle.classList.toggle('active');
            });
            
            // Close mobile menu when clicking a link
            const navLinkItems = navLinks.querySelectorAll('a');
            navLinkItems.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.classList.remove('active');
                    mobileMenuToggle.classList.remove('active');
                });
            });
            
            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInsideNav = navbar.contains(event.target);
                if (!isClickInsideNav && navLinks.classList.contains('active')) {
                    navLinks.classList.remove('active');
                    mobileMenuToggle.classList.remove('active');
                }
            });
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            // Add scroll effect to navbar
            let lastScroll = 0;
            window.addEventListener('scroll', function() {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
                
                lastScroll = currentScroll;
            });
        });
    </script>
    
    {{-- Laravel Concept: Additional Scripts Section --}}
    {{-- Child views can inject additional JavaScript here --}}
    @yield('scripts')
</body>
</html>
