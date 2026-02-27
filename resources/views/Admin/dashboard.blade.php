@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_name', 'Overview')

@section('content')
    {{-- Header de la section --}}
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Overview</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1 italic">Statistiques générales de la plateforme EasyColoc.</p>
    </div>

    {{-- Stats Cards Grid --}}
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

    {{-- Activity Feed Section --}}
    <div class="bg-white dark:bg-[#151515] rounded-[2.5rem] border border-slate-200/60 dark:border-white/5 shadow-sm p-10">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-8">Flux d'Activité</h3>
        
        <div class="flex flex-col items-center justify-center py-20 bg-slate-50/30 dark:bg-white/5 rounded-[2rem] border-2 border-dashed border-slate-100 dark:border-white/5">
            <div class="w-16 h-16 bg-white dark:bg-slate-800 rounded-full flex items-center justify-center shadow-sm mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-slate-500 font-medium">En attente de nouvelles données...</p>
        </div>
    </div>
@endsection