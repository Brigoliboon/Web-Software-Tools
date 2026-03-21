<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup Codes - PageTurner</title>
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
            <h2 class="font-display text-3xl font-bold text-center mb-6">Backup Codes</h2>

            <div class="mb-6 p-4 bg-yellow-50 text-yellow-700 rounded-lg">
                <p class="text-sm">Save these backup codes in a secure place. Each code can only be used once.</p>
            </div>

            <!-- Backup Codes -->
            <div class="mb-6">
                <div class="grid grid-cols-2 gap-3">
                    @foreach($recovery_codes as $code)
                        <div class="p-3 bg-gray-50 rounded font-mono text-center">
                            {{ $code }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-6">
                <button onclick="window.print()" class="w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-secondary transition mb-3">
                    Print Backup Codes
                </button>
                <a href="{{ route('profile.edit') }}" class="w-full inline-block text-center bg-gray-200 text-gray-800 py-3 rounded-lg font-medium hover:bg-gray-300 transition">
                    Done
                </a>
            </div>

            <div class="text-center text-sm text-gray-500">
                <p>Store these codes somewhere safe. They can be used to access your account if you lose your phone.</p>
            </div>
        </div>
    </div>
</body>
</html>