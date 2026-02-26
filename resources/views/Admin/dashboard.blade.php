<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - EasyColoc</title>

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
                        <h2 class="text-sm font-semibold text-slate-400 hidden sm:block">Admin Management</h2>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-xs font-bold text-slate-900 dark:text-white leading-none">{{ Auth::user()->name }}</p>
                            <span class="text-[10px] text-[#FF750F] font-bold uppercase tracking-wider italic">Global Admin</span>
                        </div>
                        <div class="w-10 h-10 bg-slate-900 dark:bg-white rounded-xl flex items-center justify-center font-bold text-white dark:text-slate-900 shadow-md">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-6 sm:p-10 max-w-[1600px] mx-auto w-full">
                
                <div class="mb-10">
                    <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Overview</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-1 italic">Statistiques générales de la plateforme EasyColoc.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white dark:bg-[#151515] p-6 rounded-[2rem] border border-slate-200/60 dark:border-white/5 shadow-sm">
                        <div class="w-12 h-12 bg-orange-50 dark:bg-orange-500/10 rounded-2xl flex items-center justify-center text-[#FF750F] mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">{{ $stats['users_count'] }}</div>
                        <p class="text-sm font-medium text-slate-400 mt-1 uppercase tracking-tighter italic">Total Utilisateurs</p>
                    </div>

                    <div class="bg-white dark:bg-[#151515] p-6 rounded-[2rem] border border-slate-200/60 dark:border-white/5 shadow-sm">
                        <div class="w-12 h-12 bg-blue-50 dark:bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <div class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">{{ $stats['colocations_count'] }}</div>
                        <p class="text-sm font-medium text-slate-400 mt-1 uppercase tracking-tighter italic">Colocations Créées</p>
                    </div>

                    <div class="bg-white dark:bg-[#151515] p-6 rounded-[2rem] border border-slate-200/60 dark:border-white/5 shadow-sm border-b-4 border-b-[#FF750F]">
                        <div class="w-12 h-12 bg-green-50 dark:bg-green-500/10 rounded-2xl flex items-center justify-center text-green-500 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">{{ $stats['active_memberships'] }}</div>
                        <p class="text-sm font-medium text-slate-400 mt-1 uppercase tracking-tighter italic">Demandes Actives</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#151515] rounded-[2.5rem] border border-slate-200/60 dark:border-white/5 shadow-sm p-10">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-8">Flux d'Activité</h3>
                    <div class="flex flex-col items-center justify-center py-20 bg-slate-50/30 dark:bg-white/5 rounded-[2rem] border-2 border-dashed border-slate-100 dark:border-white/5">
                        <div class="w-16 h-16 bg-white dark:bg-slate-800 rounded-full flex items-center justify-center shadow-sm mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-slate-500 font-medium">En attente de nouvelles données...</p>
                    </div>
                </div>

            </main>
        </div>
    </div>

</body>
</html>

