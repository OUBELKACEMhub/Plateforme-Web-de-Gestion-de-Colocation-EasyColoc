@extends('layouts.app')

@section('title', 'Admin Dashboard - EasyColoc')

@section('content')
    {{-- Header Dynamic --}}
    <div class="mb-12 flex flex-col md:flex-row md:items-center justify-between gap-6 animate-slide-up">
        <div>
            <h1 class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter italic uppercase leading-none">
                Overview <span class="text-[#FF750F]">Admin</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-3 italic font-medium tracking-wide">
                {{ now()->format('d M Y') }} — Suivi en temps réel de la plateforme.
            </p>
        </div>
        
        <div class="flex items-center gap-4">
            <div class="hidden sm:flex flex-col text-right">
                <span class="text-[9px] font-black text-slate-500 uppercase italic">Status Serveur</span>
                <span class="text-emerald-500 font-black italic text-xs uppercase tracking-widest">Opérationnel</span>
            </div>
            <div class="w-12 h-12 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center shadow-inner group">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_10px_#10b981]"></span>
            </div>
        </div>
    </div>

    {{-- Stats Cards Grid - Premium Dark Style --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        
        <div class="bg-white dark:bg-[#151515] p-8 rounded-[2.5rem] border border-slate-200/60 dark:border-white/5 shadow-2xl relative overflow-hidden group hover:border-[#FF750F]/50 transition-all duration-500">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-[#FF750F]/5 blur-3xl rounded-full group-hover:scale-150 transition-transform"></div>
            <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] italic mb-4">Utilisateurs</p>
            <div class="flex items-end justify-between">
                <span class="text-5xl font-black text-slate-900 dark:text-white italic tracking-tighter">{{ $stats['users_count'] }}</span>
                <span class="text-emerald-500 text-[10px] font-black mb-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    New
                </span>
            </div>
        </div>

        <div class="bg-white dark:bg-[#151515] p-8 rounded-[2.5rem] border border-slate-200/60 dark:border-white/5 shadow-2xl group hover:border-blue-500/50 transition-all duration-500">
            <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] italic mb-4">Espaces Coloc</p>
            <div class="flex items-end justify-between">
                <span class="text-5xl font-black text-slate-900 dark:text-white italic tracking-tighter">{{ $stats['colocations_count'] }}</span>
                <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-[#151515] p-8 rounded-[2.5rem] border border-slate-200/60 dark:border-white/5 shadow-2xl group hover:border-emerald-500/50 transition-all duration-500">
            <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] italic mb-4">Transactions (MAD)</p>
            <div class="flex items-end justify-between">
                <span class="text-4xl font-black text-emerald-500 italic tracking-tighter">{{ number_format($stats['total_expenses_sum'] ?? 0, 0) }}</span>
                <span class="text-slate-500 text-[10px] font-black mb-1 italic">GLOBAL</span>
            </div>
        </div>

        <div class="bg-white dark:bg-[#151515] p-8 rounded-[2.5rem] border border-slate-200/60 dark:border-white/5 shadow-2xl group hover:border-red-500/50 transition-all duration-500 border-b-4 border-b-[#FF750F]">
            <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] italic mb-4">Dettes Pending</p>
            <div class="flex items-end justify-between">
                <span class="text-5xl font-black text-white italic tracking-tighter">{{ $stats['pending_settlements_count'] ?? 0 }}</span>
                <span class="text-red-500 animate-pulse"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
            </div>
        </div>
    </div>

    {{-- Layout Mixed --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Activity Flux - Now showing Real Data --}}
        <div class="lg:col-span-2 bg-white dark:bg-[#151515] rounded-[3.5rem] border border-slate-200/60 dark:border-white/5 shadow-2xl overflow-hidden animate-slide-up">
            <div class="px-10 py-10 border-b border-white/5 flex items-center justify-between bg-white/[0.01]">
                <h3 class="text-xl font-black text-slate-900 dark:text-white italic uppercase tracking-tighter">Flux d'Activité Global</h3>
                <div class="flex gap-2">
                    <span class="w-1.5 h-1.5 bg-white/20 rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white/20 rounded-full"></span>
                </div>
            </div>
            
            <div class="p-4 space-y-2 max-h-[500px] overflow-y-auto custom-scrollbar">
                @forelse($recent_activities ?? [] as $activity)
                    <div class="flex items-center justify-between p-6 hover:bg-white/[0.02] rounded-[2.5rem] transition-all group border border-transparent hover:border-white/5">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#FF750F] to-[#FF4500] text-white flex items-center justify-center font-black text-lg italic shadow-xl shadow-[#FF750F]/20 group-hover:rotate-6 transition-transform">
                                {{ substr($activity->payer->name ?? 'U', 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-white italic uppercase tracking-tight">
                                    {{ $activity->payer->name ?? 'Membre' }} a ajouté <span class="text-[#FF750F]">"{{ $activity->title }}"</span>
                                </p>
                                <p class="text-[10px] text-slate-500 font-bold italic mt-1">
                                    {{ $activity->created_at->diffForHumans() }} • {{ number_format($activity->amount, 2) }} MAD
                                </p>
                            </div>
                        </div>
                        <div class="opacity-0 group-hover:opacity-100 transition-all transform translate-x-4 group-hover:translate-x-0">
                            <svg class="w-5 h-5 text-[#FF750F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                @empty
                    <div class="py-24 text-center">
                        <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-700 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-slate-600 font-black italic uppercase text-xs tracking-[0.4em]">En attente de transactions...</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Top Reputation - Glassmorphism --}}
        <div class="flex flex-col gap-6">
            <div class="bg-gradient-to-b from-[#FF750F] to-[#E65C00] rounded-[3.5rem] p-10 shadow-2xl shadow-[#FF750F]/30 relative overflow-hidden group flex-1">
                <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-white/10 blur-3xl rounded-full group-hover:scale-150 transition-transform duration-1000"></div>
                
                <h3 class="text-2xl font-black text-white italic uppercase tracking-tighter mb-10 relative z-10">Membres <br><span class="text-[#0F0F0F]">Elite</span></h3>
                
                <div class="space-y-4 relative z-10">
                    @forelse($top_users ?? [] as $user)
                        <div class="flex items-center justify-between bg-white/10 p-5 rounded-3xl backdrop-blur-xl border border-white/20 hover:bg-white/20 transition-all group/item">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-[#0F0F0F] flex items-center justify-center text-[#FF750F] font-black italic text-xs border border-white/10 group-hover/item:scale-110 transition-transform">
                                    #{{ $loop->iteration }}
                                </div>
                                <span class="text-xs font-black italic text-white uppercase">{{ $user->name }}</span>
                            </div>
                            <span class="text-sm font-black italic text-[#0F0F0F] bg-white px-3 py-1 rounded-xl shadow-lg">
                                ⭐ {{ $user->reputation_score }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <p class="text-white/60 font-black italic uppercase text-[10px] tracking-widest">Aucun Leader</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
            {{-- Quick Stats Bottom --}}
            <div class="bg-[#151515] rounded-[2.5rem] border border-white/5 p-8">
                <p class="text-[9px] font-black text-slate-600 uppercase italic tracking-widest mb-2">Health Check</p>
                <div class="h-2 w-full bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 w-[95%]"></div>
                </div>
                <p class="text-[8px] text-slate-500 mt-2 font-bold italic italic">95% des dettes sont réglées sous 48h.</p>
            </div>
        </div>

    </div>
@endsection