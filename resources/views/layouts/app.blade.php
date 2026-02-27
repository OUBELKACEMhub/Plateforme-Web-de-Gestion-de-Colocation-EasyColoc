<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F8F9FA] dark:bg-[#0E0E0E]">
        <div class="flex min-h-screen">
           <aside class="w-72 bg-white dark:bg-[#151515] border-r border-slate-200/60 dark:border-white/5 flex flex-col fixed h-full z-30 hidden sm:flex">
    <div class="p-8 flex items-center gap-3">
        <div class="w-10 h-10 bg-gradient-to-br from-[#FF750F] to-[#ff9d52] rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/20 shrink-0">
            <span class="text-white font-bold text-xl">E</span>
        </div>
        <span class="text-xl font-extrabold tracking-tight dark:text-white">Easy<span class="text-[#FF750F]">Coloc</span></span>
    </div>

    <nav class="flex-1 px-4 space-y-1">
        <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Main Menu</p>
        
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'text-[#FF750F] bg-orange-50/80 dark:bg-orange-500/10 shadow-sm shadow-orange-500/5' : 'text-slate-500 hover:bg-slate-50 dark:hover:bg-white/5' }} rounded-xl font-semibold transition-all group">
            <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-[#FF750F]' : 'group-hover:text-[#FF750F]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('colocations.create') }}" 
           class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('colocations.create') ? 'text-[#FF750F] bg-orange-50/80 dark:bg-orange-500/10' : 'text-slate-500 hover:bg-slate-50 dark:hover:bg-white/5' }} rounded-xl font-semibold transition-all group">
            <svg class="w-5 h-5 {{ request()->routeIs('colocations.create') ? 'text-[#FF750F]' : 'group-hover:text-[#FF750F]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Créer une Coloc</span>
        </a>

        

        @if(Auth::user()->is_global_admin) <div class="pt-4 mt-4 border-t border-slate-100 dark:border-white/5">
            <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Administration</p>
            <a href="{{ route('admin.index') }}" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 dark:hover:bg-white/5 rounded-xl font-semibold transition-all group">
                <svg class="w-5 h-5 group-hover:text-[#FF750F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span>Utilisateurs</span>
            </a>
        </div>
        @endif
    </nav>
</aside>


            <div class="flex-1 flex flex-col min-w-0">
                @include('layouts.navigation')

                <main class="flex-1 sm:ml-72 p-6 sm:p-10">
                   <main class="flex-1 sm:ml-72 p-6 sm:p-10">
    @if(isset($slot))
        {{ $slot }}
    @elseif(View::hasSection('content'))
        @yield('content')
    @endif
</main>
                </main>
            </div>
        </div>
    </body>
</html>