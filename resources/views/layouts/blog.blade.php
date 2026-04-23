<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'HelloTech Blog'))</title>
    @yield('meta')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Lora', 'serif'],
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
    
    <style>
        .blog-content p { @apply mb-6 leading-relaxed text-lg text-gray-800 dark:text-gray-300; }
        .blog-content h2 { @apply text-3xl font-bold mt-12 mb-6 dark:text-white; }
        .blog-content h3 { @apply text-2xl font-bold mt-8 mb-4 dark:text-white; }
        .blog-content img { @apply rounded-xl my-8 shadow-lg mx-auto; }
        .blog-content blockquote { @apply border-l-4 border-primary-500 pl-6 italic text-xl my-8 text-gray-600 dark:text-gray-400; }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased text-gray-900 bg-white dark:bg-gray-950 dark:text-gray-100 transition-colors duration-300">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="sticky top-0 z-50 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="/" class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent">
                            HelloTech<span class="text-gray-900 dark:text-white">Blog</span>
                        </a>
                    </div>

                    <!-- Desktop Nav -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="/" class="hover:text-primary-600 transition">Home</a>
                        <a href="{{ route('blog.index') }}" class="hover:text-primary-600 transition">Categories</a>
                        <a href="{{ route('blog.index') }}" class="hover:text-primary-600 transition">About</a>
                        
                        <div class="flex items-center space-x-4 border-l pl-8 border-gray-200 dark:border-gray-700">
                            <button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                <!-- Sun Icon -->
                                <svg id="sun-icon" class="hidden w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.071 16.071l.707.707M7.757 7.757l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z" /></svg>
                                <!-- Moon Icon -->
                                <svg id="moon-icon" class="hidden w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                            </button>
                            
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:text-primary-600 transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium hover:text-primary-600 transition">Sign In</a>
                                <a href="{{ route('register') }}" class="bg-gray-900 dark:bg-white dark:text-gray-900 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-gray-800 transition">Get Started</a>
                            @endauth
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center space-x-4">
                        <button id="theme-toggle-mobile" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                             <!-- Icons same as above -->
                        </button>
                        <button class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <a href="/" class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent mb-4 block">
                            HelloTech Blog
                        </a>
                        <p class="text-gray-600 dark:text-gray-400 max-w-sm">
                            High-performance insights for the modern developer. Scalable, professional, and SEO-optimized blogging platform.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Platform</h4>
                        <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                            <li><a href="{{ route('blog.index') }}" class="hover:text-primary-600 transition">About</a></li>
                            <li><a href="{{ route('blog.index') }}" class="hover:text-primary-600 transition">Authors</a></li>
                            <li><a href="{{ route('blog.index') }}" class="hover:text-primary-600 transition">Newsletter</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Legal</h4>
                        <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                            <li><a href="{{ route('blog.index') }}" class="hover:text-primary-600 transition">Privacy</a></li>
                            <li><a href="{{ route('blog.index') }}" class="hover:text-primary-600 transition">Terms</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-800 text-center text-gray-500 text-sm">
                    &copy; {{ date('Y') }} HelloTech Blog. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    <!-- Theme Toggle Script -->
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            sunIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            moonIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            sunIcon.classList.toggle('hidden');
            moonIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
