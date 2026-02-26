<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Utilisateurs | EasyColoc Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" /> 
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#F8F9FA] dark:bg-[#0E0E0E] text-slate-900 dark:text-slate-200">

    <div class="flex min-h-screen" x-data="{ mobileMenu: false }">
        
        <aside :class="mobileMenu ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 z-50 w-72 bg-white dark:bg-[#151515] border-r border-slate-200/60 dark:border-white/5 transition-transform duration-300 transform sm:translate-x-0 sm:static sm:inset-0 flex flex-col shadow-xl sm:shadow-none overflow-y-auto">
            
            <div class="p-8 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#FF750F] to-[#ff9d52] rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/20">
                        <span class="text-white font-bold text-xl">E</span>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight dark:text-white uppercase">Easy<span class="text-[#FF750F]">Coloc</span></span>
                </div>
                <button @click="mobileMenu = false" class="sm:hidden text-slate-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="flex-1 px-4 space-y-1.5">
                <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Administration</p>
                
                <a href="{{ route('admin.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.index') ? 'text-[#FF750F] bg-orange-50/80 dark:bg-orange-500/10' : 'text-slate-500 hover:bg-slate-50 dark:hover:bg-white/5' }} rounded-xl font-bold transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span>Tableau de Bord</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'text-[#FF750F] bg-orange-50/80 dark:bg-orange-500/10' : 'text-slate-500 hover:bg-slate-50 dark:hover:bg-white/5' }} rounded-xl font-bold transition-all group">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-[#FF750F]' : 'group-hover:text-[#FF750F]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Utilisateurs</span>
                </a>
            </nav>

            <div class="p-4 mt-auto border-t border-slate-100 dark:border-white/5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-xl font-bold transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Quitter l'Admin</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            
            <header class="bg-white/80 dark:bg-[#151515]/80 backdrop-blur-md sticky top-0 z-20 border-b border-slate-200/60 dark:border-white/5 px-6 sm:px-10 py-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <button @click="mobileMenu = true" class="sm:hidden p-2 bg-slate-100 dark:bg-white/5 rounded-lg text-slate-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest hidden sm:block italic">EasyColoc / Utilisateurs</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-[11px] font-bold text-slate-900 dark:text-white leading-none">{{ Auth::user()->name }}</p>
                        <span class="text-[9px] text-[#FF750F] font-bold uppercase tracking-wider italic">Administrateur</span>
                    </div>
                    <div class="w-10 h-10 bg-slate-900 dark:bg-white rounded-xl flex items-center justify-center font-bold text-white dark:text-slate-900 shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <main class="p-6 sm:p-10 max-w-[1600px] mx-auto w-full">
                
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
                         class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 rounded-2xl flex items-center gap-3 text-emerald-600 dark:text-emerald-400 text-sm font-bold animate-fade-in-down">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight italic">Utilisateurs</h1>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1 italic uppercase tracking-tighter">Gestion des comptes et des accès.</p>
                    </div>
                    
                    <div class="relative">
                        <input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2.5 bg-white dark:bg-[#151515] border border-slate-200/60 dark:border-white/5 rounded-2xl text-sm w-full md:w-64 focus:ring-2 focus:ring-orange-500/20 focus:border-[#FF750F] transition-all shadow-sm">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#151515] rounded-[2.5rem] border border-slate-200/60 dark:border-white/5 shadow-sm overflow-hidden transition-all duration-300">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50/50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
                                <tr>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Membre</th>
                                    <th class="px-6 py-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Score</th>
                                    <th class="px-6 py-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Rôle</th>
                                    <th class="px-6 py-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Statut</th>
                                    <th class="px-6 py-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Date</th>
                                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-white/5">
                                @foreach($users as $user)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.02] transition-colors group">
                                    <td class="px-8 py-6 text-sm">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 bg-slate-900 dark:bg-white rounded-xl flex items-center justify-center font-bold text-white dark:text-slate-900 text-xs shadow-md">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900 dark:text-white leading-none mb-1">{{ $user->name }}</p>
                                                <p class="text-[11px] text-slate-400 font-medium">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 font-bold text-sm">
                                        <span class="text-[#FF750F]">★</span> {{ $user->reputation_score }}
                                    </td>
                                    <td class="px-6 py-6">
                                        <span class="text-[10px] font-bold uppercase px-2.5 py-1 rounded-lg italic tracking-tighter {{ $user->role === 'admin' ? 'bg-orange-50 dark:bg-orange-500/10 text-[#FF750F] border border-orange-100 dark:border-orange-500/20' : 'bg-slate-100 dark:bg-white/5 text-slate-400' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 text-xs font-bold uppercase tracking-tighter">
                                        @if($user->is_banned)
                                            <span class="text-red-500 flex items-center gap-1.5 italic"><span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span> Banni</span>
                                        @else
                                            <span class="text-emerald-500 flex items-center gap-1.5 italic"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Actif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-6 text-[11px] font-bold text-slate-400 italic">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-8 py-6 text-right">
    <div class="flex justify-end gap-2 transition-all duration-200">
        
        <form action="{{ route('admin.users.toggleBan', $user) }}" method="POST">
            @csrf
            @method('PATCH')
            
            @if($user->is_banned)
                <button type="submit" title="Débannir" 
                        class="p-2 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 hover:bg-emerald-500 hover:text-white rounded-lg transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04M3.581 10.581A11.955 11.955 0 0112 21.056a11.955 11.955 0 018.419-10.475"></path></svg>
                </button>
            @else
                <button type="submit" title="Bannir" 
                        class="p-2 bg-orange-50 dark:bg-orange-500/10 text-[#FF750F] hover:bg-[#FF750F] hover:text-white rounded-lg transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                </button>
            @endif
        </form>

        <button class="p-2 bg-slate-100 dark:bg-white/5 text-slate-400 hover:text-slate-600 rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
        </button>
    </div>
</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>