<div wire:poll.5s>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Posts -->
        <div class="group bg-white/40 dark:bg-gray-800/40 backdrop-blur-md rounded-2xl p-6 border border-white/20 dark:border-gray-700/30 hover:bg-white/60 dark:hover:bg-gray-800/60 transition-all duration-300 shadow-lg hover:shadow-primary-500/10">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-primary-500/10 rounded-xl">
                    <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7H20M9 11h4m-4 4h4m-4-4h4"></path></svg>
                </div>
                <span class="text-xs font-bold text-green-500 bg-green-500/10 px-2 py-1 rounded-full">+{{ $stats['published_posts'] }} Live</span>
            </div>
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Posts</h3>
            <div class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_posts'] }}</div>
        </div>

        <!-- Total Users -->
        <div class="group bg-white/40 dark:bg-gray-800/40 backdrop-blur-md rounded-2xl p-6 border border-white/20 dark:border-gray-700/30 hover:bg-white/60 dark:hover:bg-gray-800/60 transition-all duration-300 shadow-lg hover:shadow-indigo-500/10">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-indigo-500/10 rounded-xl">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-indigo-500 bg-indigo-500/10 px-2 py-1 rounded-full">Community</span>
            </div>
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Active Users</h3>
            <div class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_users'] }}</div>
        </div>

        <!-- Total Comments -->
        <div class="group bg-white/40 dark:bg-gray-800/40 backdrop-blur-md rounded-2xl p-6 border border-white/20 dark:border-gray-700/30 hover:bg-white/60 dark:hover:bg-gray-800/60 transition-all duration-300 shadow-lg hover:shadow-pink-500/10">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-pink-500/10 rounded-xl">
                    <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </div>
                <span class="text-xs font-bold text-pink-500 bg-pink-500/10 px-2 py-1 rounded-full">Engagement</span>
            </div>
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">New Comments</h3>
            <div class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_comments'] }}</div>
        </div>

        <!-- Categories -->
        <div class="group bg-white/40 dark:bg-gray-800/40 backdrop-blur-md rounded-2xl p-6 border border-white/20 dark:border-gray-700/30 hover:bg-white/60 dark:hover:bg-gray-800/60 transition-all duration-300 shadow-lg hover:shadow-cyan-500/10">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-cyan-500/10 rounded-xl">
                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                <span class="text-xs font-bold text-cyan-500 bg-cyan-500/10 px-2 py-1 rounded-full">Organized</span>
            </div>
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Categories</h3>
            <div class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_categories'] }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Activity Table -->
        <div class="lg:col-span-2 bg-white/40 dark:bg-gray-800/40 backdrop-blur-md rounded-2xl border border-white/20 dark:border-gray-700/30 overflow-hidden shadow-xl">
            <div class="p-6 border-b border-white/10 dark:border-gray-700/30 flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Recent Articles</h3>
                <a href="/admin/posts" class="text-sm text-primary-500 hover:text-primary-600 font-semibold">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/50 dark:bg-gray-900/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Article</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10 dark:divide-gray-700/30">
                        @foreach($recent_posts as $post)
                        <tr class="hover:bg-white/20 dark:hover:bg-gray-700/20 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $post->thumbnail }}" class="w-10 h-10 rounded-lg object-cover shadow-sm" alt="">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white line-clamp-1">{{ $post->title }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-500/10 text-indigo-500">
                                    {{ $post->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($post->status === 'published')
                                <span class="flex items-center gap-1.5 text-xs font-bold text-green-500">
                                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Published
                                </span>
                                @else
                                <span class="flex items-center gap-1.5 text-xs font-bold text-yellow-500">
                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span> Draft
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400">
                                {{ $post->created_at->diffForHumans() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Side: Quick Actions & Mini Chart -->
        <div class="space-y-8">
            <!-- Fancy Chart Placeholder (Visual enhancement) -->
            <div class="bg-gradient-to-br from-primary-600 to-indigo-700 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path></svg>
                </div>
                <h4 class="text-primary-100 text-xs font-bold uppercase tracking-widest mb-1">Weekly Growth</h4>
                <div class="text-2xl font-bold mb-4">+24% Increase</div>
                
                <div class="flex items-end gap-1 h-12">
                    <div class="flex-1 bg-white/20 rounded-t-sm h-[40%] animate-[bounce_2s_infinite_100ms]"></div>
                    <div class="flex-1 bg-white/30 rounded-t-sm h-[60%] animate-[bounce_2s_infinite_200ms]"></div>
                    <div class="flex-1 bg-white/40 rounded-t-sm h-[50%] animate-[bounce_2s_infinite_300ms]"></div>
                    <div class="flex-1 bg-white/50 rounded-t-sm h-[80%] animate-[bounce_2s_infinite_400ms]"></div>
                    <div class="flex-1 bg-white/60 rounded-t-sm h-[70%] animate-[bounce_2s_infinite_500ms]"></div>
                    <div class="flex-1 bg-white/70 rounded-t-sm h-[90%] animate-[bounce_2s_infinite_600ms]"></div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white/40 dark:bg-gray-800/40 backdrop-blur-md rounded-2xl p-6 border border-white/20 dark:border-gray-700/30 shadow-xl">
                <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="/admin/posts/create" class="flex items-center gap-3 p-3 rounded-xl bg-primary-500/10 text-primary-600 dark:text-primary-400 hover:bg-primary-500 hover:text-white transition group">
                        <div class="w-8 h-8 rounded-lg bg-primary-500/20 flex items-center justify-center group-hover:bg-white/20 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <span class="font-semibold">New Post</span>
                    </a>
                    <a href="/admin/categories/create" class="flex items-center gap-3 p-3 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-500 hover:text-white transition group">
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center group-hover:bg-white/20 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                        </div>
                        <span class="font-semibold">Add Category</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
