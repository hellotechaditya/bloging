<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'user'])
            ->where('status', 'published');

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $posts = $query->orderBy('published_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $featuredPosts = \Illuminate\Support\Facades\Cache::remember('featured_posts', 60*60, function () {
            return Post::where('is_featured', true)
                ->where('status', 'published')
                ->take(3)
                ->get();
        });

        $categories = \Illuminate\Support\Facades\Cache::remember('categories_with_count', 60*60, function () {
            return Category::withCount('posts')->get();
        });

        return view('blog.index', compact('posts', 'featuredPosts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::with(['category', 'user', 'tags', 'comments.user'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedPosts = \Illuminate\Support\Facades\Cache::remember('related_posts_' . $post->id, 60*60, function () use ($post) {
            return Post::where('category_id', $post->category_id)
                ->where('id', '!=', $post->id)
                ->where('status', 'published')
                ->take(3)
                ->get();
        });

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
