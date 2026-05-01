<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['figtree', 'sans-serif'],
                        },
                        colors: {
                            primary: {
                                50: '#f0f9ff',
                                100: '#e0f2fe',
                                200: '#bae6fd',
                                300: '#7dd3fc',
                                400: '#38bdf8',
                                500: '#0ea5e9',
                                600: '#0284c7',
                                700: '#0369a1',
                                800: '#075985',
                                900: '#0c4a6e',
                            },
                        }
                    }
                }
            }
        </script>
        <style type="text/tailwindcss">
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob { animation: blob 7s infinite; }
            .animation-delay-2000 { animation-delay: 2s; }
            .animation-delay-4000 { animation-delay: 4s; }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased dark:text-gray-100 dark:bg-gray-900 transition-colors duration-300">
        <div class="min-h-screen relative flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-primary-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 overflow-hidden">
            
            <!-- Background decorative elements -->
            <div class="absolute top-0 -left-40 w-96 h-96 bg-primary-400/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob dark:opacity-20 pointer-events-none"></div>
            <div class="absolute top-0 -right-40 w-96 h-96 bg-indigo-400/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000 dark:opacity-20 pointer-events-none"></div>
            <div class="absolute -bottom-40 left-20 w-96 h-96 bg-cyan-400/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000 dark:opacity-20 pointer-events-none"></div>

            <div class="relative z-10 text-center mb-8">
                <a href="/" class="text-4xl font-extrabold bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent inline-block drop-shadow-sm">
                    HelloTech<span class="text-gray-900 dark:text-white">Blog</span>
                </a>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm font-medium">Welcome to the administration panel.</p>
            </div>

            <div class="relative z-10 w-full sm:max-w-md px-10 py-12 bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-3xl border border-white/40 dark:border-gray-700/50">
                {{ $slot }}
            </div>
            
            <div class="relative z-10 mt-12 text-sm text-gray-500 dark:text-gray-400 font-medium tracking-wide">
                &copy; {{ date('Y') }} HelloTech Blog.
            </div>
        </div>
    </body>
</html>
