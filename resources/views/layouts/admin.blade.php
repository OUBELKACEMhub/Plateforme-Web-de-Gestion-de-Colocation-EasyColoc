<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - EasyColoc</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#F8F9FA] dark:bg-[#0E0E0E]">

    <div class="flex min-h-screen" x-data="{ mobileMenu: false }">
        
        <aside :class="mobileMenu ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 z-50 w-72 bg-white dark:bg-[#151515] border-r border-slate-200/60 dark:border-white/5 transition-transform duration-300 transform sm:translate-x-0 sm:static sm:inset-0 flex flex-col shadow-xl sm:shadow-none">
            
            <div class="p-8 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#FF750F] to-[#ff9d52] rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/20">
                        <span class="text-white font-bold text-xl">E</span>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight dark:text-white">Easy<span class="text-[#FF750F]">Coloc</span></span>
                </div>
                <button @click="mobileMenu = false" class="sm:hidden text-slate-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="flex-1 px-4 space-y-1 mt-4">
                <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Administration</p>
                
                <a href="{{ route('admin.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.index') ? 'text-[#FF750F] bg-orange-50/80 dark:bg-orange-500/10' : 'text-slate-500 hover:bg-slate-50 dark:hover:bg-white/5' }} rounded-xl font-semibold transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span>Tableau de Bord</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'text-[#FF750F] bg-orange-50/80 dark:bg-orange-500/10' : 'text-slate-500 hover:bg-slate-50 dark:hover:bg-white/5' }} rounded-xl font-semibold transition-all group">
                    <svg class="w-5 h-5 group-hover:text-[#FF750F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Utilisateurs</span>
                </a>
            </nav>

            <div class="p-4 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-xl font-bold transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white/80 dark:bg-[#151515]/80 backdrop-blur-md sticky top-0 z-20 border-b border-slate-200/60 dark:border-white/5 px-6 sm:px-10 py-4">
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-4">
            <button @click="mobileMenu = true" class="sm:hidden text-slate-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <h2 class="text-sm font-semibold text-slate-400 hidden sm:block">@yield('page_name', 'Admin Management')</h2>
        </div>

        <div class="flex items-center gap-5">
            @php
                $pendingCount = \App\Models\Invitation::where('email', Auth::user()->email)
                                ->where('status', 'pending')
                                ->count();
            @endphp
            
            <a href="{{ route('colocations.received') }}" class="relative p-2.5 text-slate-500 hover:text-[#FF750F] bg-slate-50 dark:bg-white/5 hover:bg-orange-50 dark:hover:bg-orange-500/10 rounded-xl border border-slate-200/60 dark:border-white/5 transition-all duration-200 group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                
                @if($pendingCount > 0)
                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-[#FF750F] text-white text-[10px] font-black rounded-full flex items-center justify-center shadow-md shadow-orange-500/30 animate-pulse border-2 border-white dark:border-[#151515]">
                        {{ $pendingCount > 9 ? '9+' : $pendingCount }}
                    </span>
                @endif
            </a>

            <div class="flex items-center gap-4 pl-4 border-l border-slate-200 dark:border-white/10">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-slate-900 dark:text-white leading-none">{{ Auth::user()->name }}</p>
                    <span class="text-[10px] text-[#FF750F] font-bold uppercase tracking-wider italic">Global Admin</span>
                </div>
                <div class="w-10 h-10 bg-slate-900 dark:bg-white rounded-xl flex items-center justify-center font-bold text-white dark:text-slate-900 shadow-md">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </div>
</header>

            <main class="p-6 sm:p-10 max-w-[1600px] mx-auto w-full">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>