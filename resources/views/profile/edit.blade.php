<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Decorative glow for profile page -->
            <div class="absolute top-20 left-10 w-72 h-72 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="p-6 sm:p-10 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-white/40 dark:border-gray-700/50 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="max-w-xl relative z-10">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-white/40 dark:border-gray-700/50 relative overflow-hidden">
                <div class="absolute bottom-0 right-10 w-32 h-32 bg-indigo-500/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="max-w-xl relative z-10">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 bg-red-50/80 dark:bg-red-900/10 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-red-100 dark:border-red-900/30 relative overflow-hidden">
                <div class="max-w-xl relative z-10">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
