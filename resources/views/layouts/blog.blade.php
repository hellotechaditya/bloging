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

    <!-- Styles & Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
    
    <style type="text/tailwindcss">
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
        <nav x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="/" class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent">
                            HelloTech<span class="text-gray-900 dark:text-white">Blog</span>
                        </a>
                    </div>

                    <!-- Desktop Nav -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="/" class="hover:text-primary-600 transition font-medium">Home</a>
                        <a href="/#categories" class="hover:text-primary-600 transition font-medium">Categories</a>
                        <a href="#about" class="hover:text-primary-600 transition font-medium">About</a>
                        
                        <div class="flex items-center space-x-4 border-l pl-8 border-gray-200 dark:border-gray-700">
                            <button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                <!-- Sun Icon -->
                                <svg id="sun-icon" class="hidden w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.071 16.071l.707.707M7.757 7.757l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z" /></svg>
                                <!-- Moon Icon -->
                                <svg id="moon-icon" class="hidden w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                            </button>
                            
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-sm font-bold bg-primary-50 dark:bg-primary-900/30 text-primary-600 px-5 py-2 rounded-full hover:bg-primary-100 transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="bg-gray-900 dark:bg-white dark:text-gray-900 text-white px-6 py-2.5 rounded-full text-sm font-bold hover:shadow-lg transition-all hover:-translate-y-0.5">Sign In</a>
                            @endauth
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center space-x-2">
                        <button id="theme-toggle-mobile" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                        </button>
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 transition focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                            <svg x-show="mobileMenuOpen" style="display: none;" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Dropdown Menu Content -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="md:hidden absolute w-full bg-white dark:bg-gray-950 border-b border-gray-100 dark:border-gray-800 shadow-xl"
                 style="display: none;">
                <div class="px-4 pt-2 pb-6 space-y-2">
                    <a href="/" class="block px-4 py-3 rounded-xl text-lg font-bold hover:bg-gray-50 dark:hover:bg-gray-900 transition text-gray-900 dark:text-white">Home</a>
                    <a href="/#categories" class="block px-4 py-3 rounded-xl text-lg font-bold hover:bg-gray-50 dark:hover:bg-gray-900 transition text-gray-900 dark:text-white">Categories</a>
                    <a href="#about" class="block px-4 py-3 rounded-xl text-lg font-bold hover:bg-gray-50 dark:hover:bg-gray-900 transition text-gray-900 dark:text-white">About</a>
                    <div class="pt-4 mt-2 border-t border-gray-100 dark:border-gray-800">
                        @auth
                            <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-center text-lg font-bold bg-primary-600 text-white hover:bg-primary-700 transition shadow-lg shadow-primary-500/30">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl text-center text-lg font-bold bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-gray-800 transition shadow-lg">Sign In / Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer id="about" class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 py-12 pb-24 md:pb-12">
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

        <!-- Mobile Bottom App Navigation Bar -->
        <div class="md:hidden fixed bottom-0 left-0 w-full bg-white/90 dark:bg-gray-950/90 backdrop-blur-xl border-t border-gray-200 dark:border-gray-800 z-50 pb-safe shadow-[0_-10px_40px_rgba(0,0,0,0.05)]">
            <div class="flex justify-around items-center h-16">
                <!-- Home -->
                <a href="/" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('blog.index') && !request()->has('category') && !request()->has('search') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400 hover:text-primary-600' }} transition group">
                    <div class="relative">
                        <svg class="w-6 h-6 mb-1 group-hover:-translate-y-1 transition-transform" fill="{{ request()->routeIs('blog.index') && !request()->has('category') && !request()->has('search') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        @if(request()->routeIs('blog.index') && !request()->has('category') && !request()->has('search'))
                            <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-1 h-1 bg-primary-600 dark:bg-primary-400 rounded-full"></span>
                        @endif
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-widest mt-0.5">Home</span>
                </a>
                
                <!-- Explore (Categories) -->
                <a href="/#categories" class="flex flex-col items-center justify-center w-full h-full text-gray-500 dark:text-gray-400 hover:text-primary-600 transition group">
                    <svg class="w-6 h-6 mb-1 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="text-[10px] font-bold uppercase tracking-widest mt-0.5">Explore</span>
                </a>
                
                <!-- Bookmark/Saved (Just a dummy visual for fancy feel) -->
                <button onclick="alert('Bookmarks coming soon!')" class="flex flex-col items-center justify-center w-full h-full text-gray-500 dark:text-gray-400 hover:text-primary-600 transition group">
                    <svg class="w-6 h-6 mb-1 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                    <span class="text-[10px] font-bold uppercase tracking-widest mt-0.5">Saved</span>
                </button>

                <!-- Profile / Auth -->
                @auth
                <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('dashboard') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400 hover:text-primary-600' }} transition group">
                    <div class="relative">
                        <svg class="w-6 h-6 mb-1 group-hover:-translate-y-1 transition-transform" fill="{{ request()->routeIs('dashboard') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        @if(request()->routeIs('dashboard'))
                            <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-1 h-1 bg-primary-600 dark:bg-primary-400 rounded-full"></span>
                        @endif
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-widest mt-0.5">Profile</span>
                </a>
                @else
                <a href="{{ route('login') }}" class="flex flex-col items-center justify-center w-full h-full text-gray-500 dark:text-gray-400 hover:text-primary-600 transition group">
                    <svg class="w-6 h-6 mb-1 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    <span class="text-[10px] font-bold uppercase tracking-widest mt-0.5">Login</span>
                </a>
                @endauth
            </div>
        </div>
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
