<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - PageTurner</title>
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
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h2 class="font-display text-2xl font-bold text-primary">Verify Your Email</h2>
                <p class="text-gray-600 mt-2">
                    We've sent a verification code to<br>
                    <span class="font-medium text-primary">{{ $email }}</span>
                </p>
            </div>

            @if(session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('two-factor.verify-registration.post') }}">
                @csrf

                <div class="mb-6">
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-2">Verification Code</label>
                    <input id="code" type="text" name="code" maxlength="6" required autofocus
                        placeholder="Enter 6-digit code"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-center text-2xl tracking-widest">
                    <p class="text-xs text-gray-500 mt-2">Enter the 6-digit code from your email</p>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-secondary transition">
                    Verify & Continue
                </button>
            </form>

            <div class="mt-6 text-center">
                <form method="POST" action="{{ route('two-factor.resend-code') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-primary hover:underline">
                        Didn't receive the code? Resend
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-6 text-center text-sm text-gray-500">
            <p>Please check your email inbox and spam folder for the verification code.</p>
        </div>
    </div>
</body>
</html>
