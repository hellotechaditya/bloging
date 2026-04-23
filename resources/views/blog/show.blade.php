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
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": "{{ $post->title }}",
      "image": [
        "{{ $post->thumbnail ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085' }}"
       ],
      "datePublished": "{{ $post->published_at->toIso8601String() }}",
      "dateModified": "{{ $post->updated_at->toIso8601String() }}",
      "author": [{
          "@type": "Person",
          "name": "{{ $post->user->name }}"
        }]
    }
    </script>
@endsection

@section('content')
<article class="bg-white dark:bg-gray-950">
    <!-- Header -->
    <header class="py-16 md:py-24 border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <a href="#" class="text-primary-600 font-bold uppercase tracking-wider text-sm mb-6 inline-block">
                {{ $post->category->name }}
            </a>
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 dark:text-white leading-tight mb-8">
                {{ $post->title }}
            </h1>
            
            <div class="flex items-center justify-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 font-bold">
                        {{ substr($post->user->name, 0, 1) }}
                    </div>
                    <div class="text-left">
                        <p class="font-bold text-gray-900 dark:text-white">{{ $post->user->name }}</p>
                        <p class="text-gray-500 text-sm">{{ $post->published_at->format('M d, Y') }} &bull; {{ $post->reading_time ?? '5' }} min read</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($post->thumbnail)
        <div class="mb-16 -mx-4 sm:-mx-0">
            <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-[500px] object-cover rounded-2xl shadow-2xl">
        </div>
        @endif

        <div class="blog-content font-serif text-xl">
            {!! $post->content !!}
        </div>

        <!-- Tags -->
        @if($post->tags->count() > 0)
        <div class="mt-16 pt-8 border-t border-gray-100 dark:border-gray-800">
            <div class="flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                <a href="#" class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-full text-sm hover:bg-primary-600 hover:text-white transition">
                    #{{ $tag->name }}
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Social Share -->
        <div class="mt-12 flex items-center justify-between border-y border-gray-100 dark:border-gray-800 py-6">
            <span class="font-bold text-gray-500 uppercase tracking-widest text-xs">Share this story</span>
            <div class="flex gap-4">
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" target="_blank" class="p-2 bg-gray-100 dark:bg-gray-800 rounded-full hover:bg-blue-600 hover:text-white transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="p-2 bg-gray-100 dark:bg-gray-800 rounded-full hover:bg-indigo-600 hover:text-white transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.761 0 5-2.239 5-5v-14c0-2.761-2.239-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                </a>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="mt-16 pt-16 border-t border-gray-100 dark:border-gray-800">
            <h3 class="text-2xl font-bold mb-12">Responses ({{ $post->comments->where('is_approved', true)->count() }})</h3>
            
            <div class="space-y-12 mb-16">
                @foreach($post->comments->where('is_approved', true) as $comment)
                <div class="flex gap-6">
                    <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-800 flex-shrink-0 flex items-center justify-center font-bold">
                        {{ substr($comment->user->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="font-bold">{{ $comment->user->name }}</span>
                            <span class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $comment->body }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            @auth
            <div class="bg-gray-50 dark:bg-gray-900 p-8 rounded-2xl">
                <h4 class="font-bold mb-6">Leave a response</h4>
                <form action="#" class="space-y-6">
                    <textarea placeholder="What are your thoughts?" rows="4" class="w-full bg-white dark:bg-gray-950 border-none rounded-xl px-4 py-4 text-sm focus:ring-2 focus:ring-primary-500"></textarea>
                    <button class="bg-primary-600 text-white font-bold px-8 py-3 rounded-full hover:bg-primary-700 transition">Publish Response</button>
                </form>
            </div>
            @else
            <div class="text-center bg-gray-50 dark:bg-gray-900 p-12 rounded-2xl">
                <p class="text-gray-600 dark:text-gray-400 mb-6">Sign in to join the conversation.</p>
                <a href="{{ route('login') }}" class="bg-gray-900 dark:bg-white dark:text-gray-900 text-white px-8 py-3 rounded-full font-bold inline-block">Sign In</a>
            </div>
            @endauth
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
                <img src="{{ $rPost->thumbnail ?? 'https://images.unsplash.com/photo-1504639725590-34d0984388bd' }}" alt="{{ $rPost->title }}" class="w-full h-48 object-cover">
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
