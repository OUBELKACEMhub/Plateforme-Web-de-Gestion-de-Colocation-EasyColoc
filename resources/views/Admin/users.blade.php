@extends('layouts.admin')

@section('title', 'Utilisateurs')
@section('page_name', 'User Management')

@section('content')
    {{-- Success Alert --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
             class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 rounded-2xl flex items-center gap-3 text-emerald-600 dark:text-emerald-400 text-sm font-bold animate-fade-in-down">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Page Header & Search --}}
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

    {{-- Users Table Card --}}
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
                            <div class="flex justify-end gap-2">
                                <form action="{{ route('admin.users.toggle-ban', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($user->is_banned)
                                        <button type="submit" title="Débannir" class="p-2 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 rounded-lg hover:bg-emerald-500 hover:text-white transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944"></path></svg>
                                        </button>
                                    @else
                                        <button type="submit" title="Bannir" class="p-2 bg-orange-50 dark:bg-orange-500/10 text-[#FF750F] rounded-lg hover:bg-[#FF750F] hover:text-white transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                        </button>
                                    @endif
                                </form>

                                <button title="Modifier" class="p-2 bg-slate-100 dark:bg-white/5 text-slate-400 hover:text-slate-600 dark:hover:text-white rounded-lg transition-colors shadow-sm">
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
@endsection