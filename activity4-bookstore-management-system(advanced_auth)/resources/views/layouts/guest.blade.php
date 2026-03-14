<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PageTurner') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#1a1a2e',
                            secondary: '#16213e',
                            accent: '#e94560',
                            gold: '#f4a261',
                            cream: '#faf3e8',
                        },
                        fontFamily: {
                            display: ['Cormorant Garamond', 'serif'],
                        }
                    }
                }
            }
        </script>

        <style>
            :root {
                --color-primary: #1a1a2e;
                --color-secondary: #16213e;
                --color-accent: #e94560;
                --color-gold: #f4a261;
                --color-cream: #faf3e8;
            }
            body {
                font-family: 'DM Sans', sans-serif;
            }
            .font-display {
                font-family: 'Cormorant Garamond', serif;
            }
        </style>
    </head>
    <body class="min-h-screen flex items-center justify-center py-12 px-4" style="background-color: var(--color-cream);">
        <div class="max-w-md w-full">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <div class="w-12 h-12 bg-primary flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="font-display text-3xl font-bold text-primary">PageTurner</span>
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
