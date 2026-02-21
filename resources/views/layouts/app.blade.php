<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    </head>
    <body class="font-sans antialiased bg-[#0F172A] text-slate-200 overflow-x-hidden">
        <div class="min-h-screen flex" x-data="{ sidebarOpen: true }">
            <!-- Sidebar -->
            <aside 
                class="fixed inset-y-0 left-0 z-50 w-72 transition-all duration-300 transform lg:static lg:inset-0"
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:w-0 lg:opacity-0'"
            >
                <div class="h-full glass border-r border-white/10 flex flex-col">
                    <div class="p-6 flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-purple-500 rounded-xl flex items-center justify-center neon-glow-cyan animate-pulse">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">ExpenseTrack</span>
                    </div>

                    <nav class="flex-1 px-4 space-y-2 py-4">
                        <x-nav-link-sidebar :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="home">
                            Dashboard
                        </x-nav-link-sidebar>
                        <x-nav-link-sidebar :href="route('incomes.index')" :active="request()->routeIs('incomes.*')" icon="plus">
                            Incomes
                        </x-nav-link-sidebar>
                        <x-nav-link-sidebar :href="route('expenses.index')" :active="request()->routeIs('expenses.*')" icon="chart">
                            Expenses
                        </x-nav-link-sidebar>
                        <x-nav-link-sidebar href="#" :active="false" icon="target">
                            Budgets
                        </x-nav-link-sidebar>
                    </nav>

                    <div class="p-4 mt-auto">
                        <div class="glass-card p-4 border-cyan-500/20">
                            <p class="text-xs text-slate-400 mb-1">Savings Streak</p>
                            <div class="flex items-center gap-2">
                                <div class="flex-1 h-1.5 bg-white/10 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-cyan-500 to-purple-500 w-[65%]"></div>
                                </div>
                                <span class="text-xs font-bold text-cyan-400">12 Days</span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0">
                <!-- Top Navbar -->
                <header class="h-20 flex items-center justify-between px-8 glass border-b border-white/10 sticky top-0 z-40">
                    <div class="flex items-center gap-4">
                        <button @click="sidebarOpen = !sidebarOpen" class="p-2 hover:bg-white/5 rounded-lg transition-colors">
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                        <div class="hidden md:flex relative group">
                            <input type="text" placeholder="Search insights..." class="bg-white/5 border-none rounded-xl px-4 py-2 w-64 focus:ring-2 focus:ring-cyan-500/50 transition-all text-sm">
                            <div class="absolute right-3 top-2.5 text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                        <button class="relative p-2 hover:bg-white/5 rounded-lg transition-colors group">
                            <svg class="w-6 h-6 text-slate-400 group-hover:shake" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border border-[#0F172A]"></span>
                        </button>

                        <div class="h-8 w-px bg-white/10"></div>

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-3 p-1.5 hover:bg-white/5 rounded-xl transition-all group">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-slate-700 to-slate-900 border border-white/10 flex items-center justify-center overflow-hidden">
                                        <span class="text-xs font-bold text-slate-300">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <div class="text-left hidden lg:block">
                                        <p class="text-sm font-medium leading-none">{{ Auth::user()->name }}</p>
                                        <p class="text-[10px] text-slate-500 mt-1">Premium Plan</p>
                                    </div>
                                    <svg class="w-4 h-4 text-slate-500 group-hover:text-slate-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 p-8 overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
        </div>
        
        <style>
            .shake { animation: shake 0.5s infinite; }
            @keyframes shake {
                0% { transform: rotate(0deg); }
                25% { transform: rotate(5deg); }
                50% { transform: rotate(0deg); }
                75% { transform: rotate(-5deg); }
                100% { transform: rotate(0deg); }
            }
        </style>
    </body>
</html>
