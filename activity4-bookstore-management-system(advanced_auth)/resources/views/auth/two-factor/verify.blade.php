<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication - PageTurner</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            background-color: var(--color-cream);
        }
        .font-display {
            font-family: 'Cormorant Garamond', serif;
        }
        .bg-primary { background-color: var(--color-primary); }
        .bg-accent { background-color: var(--color-accent); }
        .text-primary { color: var(--color-primary); }
        .text-accent { color: var(--color-accent); }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center py-12 px-4">
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
            <h2 class="font-display text-3xl font-bold text-center mb-6">Two-Factor Authentication</h2>

            <div class="mb-6 p-4 bg-blue-50 text-blue-700 rounded-lg">
                <p class="text-sm">We've sent a verification code to your email. Please enter the code below.</p>
            </div>

            <form method="POST" action="{{ route('two-factor.verify') }}">
                @csrf

                <div class="mb-4">
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Authentication Code</label>
                    <input id="code" type="text" name="code" required maxlength="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                        placeholder="123456">
                    @error('code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-secondary transition">
                    Verify
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 mb-3">Don't have your phone?</p>
                <a href="#" onclick="event.preventDefault(); document.getElementById('recovery-form').classList.toggle('hidden');"
                   class="text-sm text-gray-600 hover:text-primary">
                    Use a recovery code
                </a>
            </div>

            <form id="recovery-form" method="POST" action="{{ route('two-factor.verify') }}" class="mt-4 hidden">
                @csrf
                <div class="mb-4">
                    <label for="recovery_code" class="block text-sm font-medium text-gray-700 mb-1">Recovery Code</label>
                    <input id="recovery_code" type="text" name="code"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                        placeholder="ABCD1234">
                    @error('code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-gray-600 text-white py-3 rounded-lg font-medium hover:bg-gray-700 transition">
                    Use Recovery Code
                </button>
            </form>
        </div>
    </div>
</body>
</html>