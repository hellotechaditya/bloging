<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400">
                {{ __('Analytics Dashboard') }}
            </h2>
            <div class="flex items-center gap-2 text-sm text-gray-500 bg-white/50 dark:bg-gray-800/50 px-4 py-2 rounded-full border border-white/20">
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                Live Updates Enabled
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative overflow-hidden">
        <!-- Background Orbs -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-500/5 rounded-full blur-[120px] -z-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-indigo-500/5 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                        Hello, {{ explode(' ', Auth::user()->name)[0] }}! 👋
                    </h1>
                    <p class="text-gray-500 dark:text-gray-400 mt-2 text-lg">
                        Everything is running smoothly. Your blog is reaching more people today.
                    </p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="bg-white dark:bg-gray-800 p-3 rounded-xl shadow-sm border border-white/20 hover:shadow-md transition group">
                        <svg class="w-6 h-6 text-gray-500 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </button>
                    <a href="/admin/posts/create" class="flex items-center gap-2 bg-gradient-to-r from-primary-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-primary-500/25 hover:scale-105 transition active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Create Post
                    </a>
                </div>
            </div>

            <!-- Livewire Stats Component -->
            <livewire:dashboard-stats />

            <!-- Detailed Analytics Section -->
            <div class="mt-12 grid grid-cols-1 lg:grid-cols-1 gap-8">
                <div class="bg-white/40 dark:bg-gray-800/40 backdrop-blur-md rounded-2xl p-8 border border-white/20 dark:border-gray-700/30 shadow-2xl">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Performance Overview</h3>
                            <p class="text-gray-500 text-sm">Engagement and reach over the last 30 days</p>
                        </div>
                        <select class="bg-white/50 dark:bg-gray-900/50 border-none rounded-lg text-sm font-semibold focus:ring-primary-500 transition cursor-pointer">
                            <option>Last 7 Days</option>
                            <option selected>Last 30 Days</option>
                            <option>Last 12 Months</option>
                        </select>
                    </div>
                    
                    <div class="h-[400px] w-full">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js and Animation Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('performanceChart').getContext('2d');
            
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(14, 165, 233, 0.2)');
            gradient.addColorStop(1, 'rgba(14, 165, 233, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Post Views',
                        data: [1200, 1900, 3000, 2500, 4200, 3800, 5100, 4800, 6200, 5900, 7500, 8432],
                        borderColor: '#0ea5e9',
                        borderWidth: 4,
                        backgroundColor: gradient,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 6,
                        pointBackgroundColor: '#0ea5e9',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(156, 163, 175, 0.1)' },
                            ticks: { color: '#9ca3af' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#9ca3af' }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
