<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology'],
            ['name' => 'Design', 'slug' => 'design'],
            ['name' => 'Development', 'slug' => 'development'],
        ];

        foreach ($categories as $cat) {
            $catModels[] = Category::create($cat);
        }

        // Create Tags
        $tags = ['Laravel', 'Tailwind', 'AI', 'UX', 'Mobile'];
        foreach ($tags as $tag) {
            $tagModels[] = Tag::create(['name' => $tag, 'slug' => Str::slug($tag)]);
        }

        // Create Posts
        for ($i = 1; $i <= 10; $i++) {
            $post = Post::create([
                'user_id' => $admin->id,
                'category_id' => $catModels[array_rand($catModels)]->id,
                'title' => "High-Performance Tech Article #$i",
                'slug' => "high-performance-tech-article-$i",
                'content' => "<h2>The Future of Modern Web Development</h2><p>In the rapidly evolving landscape of technology, performance and SEO are no longer optional. They are the bedrock of a successful digital presence. This article explores how Laravel 11 and modern frontend tools can create unparalleled experiences for users across all devices.</p><blockquote>Building for the web in 2026 requires a mobile-first mindset and a relentless focus on Core Web Vitals.</blockquote><p>We've seen a shift towards server-side rendering and hybrid approaches that combine the best of both worlds: the interactivity of SPAs and the SEO benefits of static sites.</p><img src='https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=1000' alt='Tech Image'><p>As we continue to push the boundaries of what's possible, developers must prioritize clean architecture and scalable codebases to ensure long-term maintainability.</p>",
                'thumbnail' => "https://picsum.photos/seed/" . rand(1, 1000) . "/800/600",
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'is_featured' => $i <= 3,
                'reading_time' => rand(5, 15),
            ]);

            // Attach random tags
            $post->tags()->attach(array_rand(array_flip([1, 2, 3, 4, 5]), rand(2, 3)));

            // Add some comments
            for ($j = 1; $j <= rand(2, 5); $j++) {
                Comment::create([
                    'post_id' => $post->id,
                    'user_id' => $admin->id,
                    'body' => "This is a great insight into modern development! Thanks for sharing.",
                    'is_approved' => true,
                ]);
            }
        }
    }
}
