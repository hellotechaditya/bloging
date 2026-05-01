@extends('layouts.blog')

@section('title', $post->meta_title ?? $post->title)

@section('meta')
    <meta name="description" content="{{ $post->meta_description ?? Str::limit(strip_tags($post->content), 160) }}">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->meta_description ?? Str::limit(strip_tags($post->content), 160) }}">
    <meta property="og:image" content="{{ $post->thumbnail ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085' }}">
    <meta property="og:type" content="article">
    <meta name="twitter:card" content="summary_large_image">
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Article",
      "headline": "{{ $post->title }}",
      "image": [
        "{{ $post->thumbnail ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085' }}"
       ],
      "datePublished": "{{ $post->published_at->toIso8601String() }}",
      "dateModified": "{{ $post->updated_at->toIso8601String() }}",
      "author": [{
          "@@type": "Person",
          "name": "{{ $post->user->name }}"
        }]
    }
    </script>
@endsection

@section('content')
<article class="bg-white dark:bg-gray-950">
    <!-- Ultra-Premium Hero Header -->
    <header class="relative w-full min-h-[75vh] flex items-center justify-center pt-32 pb-24 px-4 sm:px-6 lg:px-8 overflow-hidden bg-gray-950">
        <!-- Background Layer -->
        @if($post->thumbnail)
            <div class="absolute inset-0 w-full h-full overflow-hidden">
                <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="absolute inset-0 w-full h-full object-cover transform scale-105 hover:scale-110 transition-transform duration-[30s] ease-out">
                <!-- Dark, vivid gradient overlay instead of milky white -->
                <div class="absolute inset-0 bg-gradient-to-b from-gray-900/90 via-gray-900/60 to-gray-950/95 mix-blend-multiply"></div>
                <!-- Subtle color dodge glow for magic feel -->
                <div class="absolute inset-0 bg-indigo-500/10 mix-blend-color-dodge"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-gray-950 via-gray-900 to-indigo-950"></div>
            <!-- Decorative shapes -->
            <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-primary-500/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob pointer-events-none"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-indigo-500/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob animation-delay-2000 pointer-events-none"></div>
        @endif

        <!-- Content Layer -->
        <div class="relative z-20 max-w-5xl mx-auto text-center mt-8">
            
            <!-- Category Pill -->
            <div class="mb-10 flex justify-center">
                <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" class="group relative inline-flex items-center gap-2.5 px-6 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-xl hover:bg-white/10 transition-all duration-300 shadow-[0_0_30px_rgba(255,255,255,0.05)] hover:shadow-[0_0_30px_rgba(255,255,255,0.15)] hover:-translate-y-0.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-primary-400 shadow-[0_0_10px_rgba(56,189,248,0.8)] animate-pulse"></span>
                    <span class="text-white/90 font-bold uppercase tracking-[0.2em] text-xs group-hover:text-white transition-colors">{{ $post->category->name }}</span>
                </a>
            </div>
            
            <!-- Epic Title -->
            <h1 class="text-5xl md:text-7xl lg:text-[5rem] font-black text-transparent bg-clip-text bg-gradient-to-b from-white via-white/90 to-white/60 leading-[1.1] mb-12 drop-shadow-2xl px-4">
                {{ $post->title }}
            </h1>
            
            <!-- Author & Meta Glass Pill -->
            <div class="flex items-center justify-center">
                <div class="flex flex-col sm:flex-row items-center gap-5 bg-white/5 backdrop-blur-2xl px-8 py-5 rounded-3xl sm:rounded-full border border-white/10 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.5)] group hover:bg-white/10 hover:border-white/20 transition-all duration-500">
                    
                    <div class="relative">
                        <div class="absolute inset-0 bg-primary-500 rounded-full blur-md opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative w-14 h-14 rounded-full bg-gradient-to-br from-primary-400 to-indigo-600 flex items-center justify-center text-white text-xl font-black ring-2 ring-white/20 group-hover:ring-white/40 transition-all">
                            {{ substr($post->user->name, 0, 1) }}
                        </div>
                    </div>
                    
                    <div class="text-center sm:text-left">
                        <p class="font-bold text-lg text-white tracking-wide mb-1">{{ $post->user->name }}</p>
                        <div class="flex flex-wrap justify-center sm:justify-start items-center gap-3 text-white/60 text-sm font-medium">
                            <span class="flex items-center gap-1.5 group-hover:text-white/80 transition-colors">
                                <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $post->published_at->format('M d, Y') }} 
                            </span>
                            <span class="w-1.5 h-1.5 rounded-full bg-white/20 hidden sm:block"></span>
                            <span class="flex items-center gap-1.5 group-hover:text-white/80 transition-colors">
                                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $post->reading_time ?? '5' }} min read
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Smooth fade into main content area -->
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-white dark:from-gray-950 to-transparent z-10 pointer-events-none"></div>
    </header>

    <!-- Main Layout -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex flex-col lg:flex-row gap-16">
            
            <!-- Left Column: Article Content & Comments -->
            <div class="lg:w-2/3">
                
                <div class="blog-content font-serif text-xl md:text-2xl leading-loose text-gray-800 dark:text-gray-300">
                    {!! $post->content !!}
                </div>

                <!-- Tags -->
                @if($post->tags->count() > 0)
                <div class="mt-16 pt-8 border-t border-gray-100 dark:border-gray-800">
                    <div class="flex flex-wrap gap-3">
                        @foreach($post->tags as $tag)
                        <a href="{{ route('blog.index', ['search' => $tag->name]) }}" class="px-5 py-2.5 bg-gray-100 dark:bg-gray-800/50 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium hover:bg-primary-600 hover:text-white hover:shadow-lg transition-all duration-300">
                            #{{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Comments Section -->
                <div class="mt-16 pt-16 border-t border-gray-100 dark:border-gray-800">
                    <h3 class="text-3xl font-extrabold mb-12">Responses ({{ $post->comments->where('is_approved', true)->count() }})</h3>
                    
                    <div class="space-y-10 mb-16">
                        @foreach($post->comments->where('is_approved', true) as $comment)
                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 flex-shrink-0 flex items-center justify-center font-bold text-gray-600 dark:text-gray-300 shadow-inner">
                                {{ substr($comment->user->name, 0, 1) }}
                            </div>
                            <div class="flex-1 bg-gray-50 dark:bg-gray-900/50 p-6 rounded-2xl rounded-tl-none border border-transparent group-hover:border-gray-200 dark:group-hover:border-gray-800 transition-colors">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="font-bold text-lg">{{ $comment->user->name }}</span>
                                    <span class="text-gray-400 text-sm font-medium">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $comment->body }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @auth
                    <div class="bg-white dark:bg-gray-900 p-8 sm:p-10 rounded-3xl shadow-2xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/10 rounded-full blur-3xl pointer-events-none"></div>
                        <h4 class="text-xl font-bold mb-6">Leave a response</h4>
                        <form action="javascript:void(0)" class="space-y-6 relative z-10" onsubmit="alert('Comments functionality to be implemented!');">
                            <textarea placeholder="What are your thoughts?" rows="4" class="w-full bg-gray-50 dark:bg-gray-950 border-gray-200 dark:border-gray-800 rounded-2xl px-6 py-5 focus:ring-4 focus:ring-primary-500/20 focus:border-primary-500 transition-all"></textarea>
                            <button class="bg-primary-600 text-white font-bold px-10 py-4 rounded-xl hover:bg-primary-700 hover:shadow-xl hover:shadow-primary-500/30 transition-all duration-300 w-full sm:w-auto">Publish Response</button>
                        </form>
                    </div>
                    @else
                    <div class="text-center bg-gray-50 dark:bg-gray-900/50 p-16 rounded-3xl border border-gray-100 dark:border-gray-800">
                        <div class="w-20 h-20 mx-auto bg-gray-200 dark:bg-gray-800 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        </div>
                        <h4 class="text-2xl font-bold mb-4">Join the conversation</h4>
                        <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-sm mx-auto">Sign in to share your thoughts, reply to others, and join our growing community of developers.</p>
                        <a href="{{ route('login') }}" class="bg-gray-900 dark:bg-white dark:text-gray-900 text-white px-10 py-4 rounded-xl font-bold inline-block hover:shadow-xl transition-all duration-300 hover:-translate-y-1">Sign In to Comment</a>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- Right Column: Sticky Sidebar -->
            <aside class="lg:w-1/3">
                <div class="sticky top-32 space-y-10">
                    
                    <!-- Author Card -->
                    <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 border border-gray-100 dark:border-gray-800 shadow-2xl shadow-gray-200/50 dark:shadow-none relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-gradient-to-br from-primary-500/20 to-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
                        <div class="relative z-10">
                            <div class="flex items-center gap-5 mb-6">
                                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-500 to-indigo-600 flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                    {{ substr($post->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="font-extrabold text-xl">{{ $post->user->name }}</h3>
                                    <p class="text-primary-600 dark:text-primary-400 text-sm font-bold uppercase tracking-wider mt-1">Author</p>
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                                Writing high-performance insights for the modern web. Exploring Laravel, Tailwind CSS, and scalable architecture.
                            </p>
                            <button class="w-full bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white font-bold py-3.5 rounded-xl hover:bg-primary-600 hover:text-white transition-all duration-300 border border-transparent hover:border-primary-500">
                                View Profile
                            </button>
                        </div>
                    </div>

                    <!-- Share Widget -->
                    <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 border border-gray-100 dark:border-gray-800 shadow-xl shadow-gray-200/50 dark:shadow-none text-center">
                        <span class="font-bold text-gray-900 dark:text-white uppercase tracking-widest text-sm block mb-6">Share this story</span>
                        <div class="flex justify-center gap-4">
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" target="_blank" class="w-12 h-12 flex items-center justify-center bg-gray-50 dark:bg-gray-800 rounded-full hover:bg-[#1DA1F2] hover:text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-12 h-12 flex items-center justify-center bg-gray-50 dark:bg-gray-800 rounded-full hover:bg-[#1877F2] hover:text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.761 0 5-2.239 5-5v-14c0-2.761-2.239-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" target="_blank" class="w-12 h-12 flex items-center justify-center bg-gray-50 dark:bg-gray-800 rounded-full hover:bg-[#0A66C2] hover:text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.761 0 5-2.239 5-5v-14c0-2.761-2.239-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                        </div>
                    </div>

                </div>
            </aside>
            
        </div>
    </div>
</article>

<!-- Related Posts -->
<section class="bg-gray-50 dark:bg-gray-900/50 py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-12 text-center">More from HelloTech Blog</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedPosts as $rPost)
            <article class="bg-white dark:bg-gray-950 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-xl transition duration-300">
                <a href="{{ route('blog.show', $rPost->slug) }}" class="block">
                    <img src="{{ $rPost->thumbnail ?? 'https://images.unsplash.com/photo-1504639725590-34d0984388bd' }}" alt="{{ $rPost->title }}" class="w-full h-48 object-cover hover:opacity-90 transition">
                </a>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4 line-clamp-2">
                        <a href="{{ route('blog.show', $rPost->slug) }}" class="hover:text-primary-600 transition">{{ $rPost->title }}</a>
                    </h3>
                    <div class="flex items-center gap-3">
                         <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-xs font-bold">{{ substr($rPost->user->name, 0, 1) }}</div>
                         <span class="text-sm text-gray-600 dark:text-gray-400">{{ $rPost->user->name }}</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
