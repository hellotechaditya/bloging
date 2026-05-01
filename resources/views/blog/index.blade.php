@extends('layouts.blog')

@section('content')
<!-- Hero / Featured Section -->
<section class="bg-white dark:bg-gray-950 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($featuredPosts->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            @php $mainFeatured = $featuredPosts->first(); @endphp
            <div class="relative group overflow-hidden rounded-2xl">
                <a href="{{ route('blog.show', $mainFeatured->slug) }}" class="block">
                    <img src="{{ $mainFeatured->thumbnail ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=1000' }}" 
                         alt="{{ $mainFeatured->title }}" 
                         class="w-full h-[500px] object-cover transition duration-500 group-hover:scale-105">
                </a>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent pointer-events-none"></div>
                <div class="absolute bottom-0 p-8">
                    <span class="bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase mb-4 inline-block">Featured</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                        <a href="{{ route('blog.show', $mainFeatured->slug) }}" class="hover:underline">{{ $mainFeatured->title }}</a>
                    </h2>
                    <div class="flex items-center text-gray-300 text-sm">
                        <span>{{ $mainFeatured->user->name }}</span>
                        <span class="mx-2">&bull;</span>
                        <span>{{ $mainFeatured->published_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                @foreach($featuredPosts->skip(1) as $fPost)
                <div class="flex gap-6 items-center">
                    <a href="{{ route('blog.show', $fPost->slug) }}" class="flex-shrink-0">
                        <img src="{{ $fPost->thumbnail ?? 'https://images.unsplash.com/photo-1504639725590-34d0984388bd?auto=format&fit=crop&q=80&w=300' }}" 
                             alt="{{ $fPost->title }}" 
                             class="w-32 h-32 rounded-xl object-cover hover:opacity-90 transition">
                    </a>
                    <div>
                        <span class="text-primary-600 text-xs font-bold uppercase">{{ $fPost->category->name }}</span>
                        <h3 class="text-xl font-bold mt-2 mb-2">
                            <a href="{{ route('blog.show', $fPost->slug) }}" class="hover:text-primary-600 transition">{{ $fPost->title }}</a>
                        </h3>
                        <p class="text-gray-500 text-sm line-clamp-2">{{ Str::limit(strip_tags($fPost->content), 100) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="text-center py-20">
            <h2 class="text-4xl font-bold text-gray-400">No posts found yet.</h2>
            <p class="text-gray-500 mt-4 text-xl">Start your blogging journey by adding your first post in the admin panel.</p>
        </div>
        @endif
    </div>
</section>

<!-- Main Feed -->
<section class="bg-gray-50 dark:bg-gray-900/50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Posts Column -->
            <div class="lg:w-2/3 space-y-12">
                <h2 class="text-2xl font-bold mb-8 flex items-center">
                    <span class="w-8 h-1 bg-primary-600 mr-4 rounded"></span>
                    Latest Stories
                </h2>

                @forelse($posts as $post)
                <article class="flex flex-col md:flex-row gap-8 bg-white dark:bg-gray-950 p-6 rounded-2xl border border-gray-100 dark:border-gray-800 hover:shadow-xl transition-all duration-300">
                    <div class="md:w-1/3">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block h-full">
                            <img src="{{ $post->thumbnail ?? 'https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?auto=format&fit=crop&q=80&w=500' }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-48 md:h-full object-cover rounded-xl hover:opacity-90 transition">
                        </a>
                    </div>
                    <div class="md:w-2/3 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-4 mb-3">
                                <span class="bg-primary-50 dark:bg-primary-900/30 text-primary-600 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                    {{ $post->category->name }}
                                </span>
                                <span class="text-gray-400 text-xs">{{ $post->reading_time ?? '5' }} min read</span>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 hover:text-primary-600 transition">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 line-clamp-3 mb-4">
                                {{ Str::limit(strip_tags($post->content), 200) }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between mt-auto">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold">
                                    {{ substr($post->user->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $post->user->name }}</span>
                            </div>
                            <span class="text-gray-400 text-xs">{{ $post->published_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </article>
                @empty
                <!-- Handled by empty state in featured section or here if desired -->
                @endforelse

                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:w-1/3 space-y-12">
                <!-- Search -->
                <div class="bg-white dark:bg-gray-950 p-8 rounded-2xl border border-gray-100 dark:border-gray-800">
                    <h3 class="font-bold text-lg mb-6">Search</h3>
                    <form action="{{ route('blog.index') }}" method="GET" class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search posts..." class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-500">
                        <button type="submit" class="absolute right-3 top-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                    </form>
                </div>

                <!-- Categories -->
                <div id="categories" class="bg-white dark:bg-gray-950 p-8 rounded-2xl border border-gray-100 dark:border-gray-800">
                    <h3 class="font-bold text-lg mb-6">Categories</h3>
                    <div class="space-y-4">
                        @foreach($categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}" class="flex justify-between items-center {{ request('category') === $category->slug ? 'text-primary-600 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-primary-600' }} transition">
                            <span>{{ $category->name }}</span>
                            <span class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded text-xs">{{ $category->posts_count }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="bg-gradient-to-br from-primary-600 to-indigo-700 p-8 rounded-2xl text-white shadow-xl shadow-primary-500/20">
                    <h3 class="font-bold text-2xl mb-4">Stay Inspired</h3>
                    <p class="text-primary-100 mb-6 text-sm">Join 10,000+ readers and get the best tech insights delivered to your inbox.</p>
                    <form action="javascript:void(0)" class="space-y-4" onsubmit="alert('Newsletter subscription functionality to be implemented!');">
                        <input type="email" placeholder="Your email address" class="w-full bg-white/10 border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:ring-2 focus:ring-white">
                        <button type="submit" class="w-full bg-white text-primary-600 font-bold py-3 rounded-xl hover:bg-primary-50 transition">Subscribe</button>
                    </form>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
