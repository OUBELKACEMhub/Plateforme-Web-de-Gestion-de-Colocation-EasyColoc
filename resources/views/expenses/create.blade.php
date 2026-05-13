@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0F0F0F] py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center" x-data="{ showNewCategory: false }">
    <div class="max-w-6xl w-full space-y-8">
        
        {{-- 1. Back Link --}}
        <div class="animate-fade-in">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-3 text-slate-500 hover:text-[#FF750F] transition-all font-black text-[10px] uppercase tracking-[0.2em] italic group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour au Dashboard
            </a>
        </div>

        {{-- 2. Main Horizontal Card --}}
        <div class="bg-[#151515] rounded-[3rem] border border-white/5 shadow-2xl overflow-hidden animate-slide-up flex flex-col md:flex-row">
            
            {{-- Section à gauche : Info (1/3 width) --}}
            <div class="md:w-1/3 p-12 bg-white/[0.02] border-r border-white/5 flex flex-col justify-center items-center text-center">
                <div class="w-20 h-20 bg-[#FF750F]/10 rounded-3xl flex items-center justify-center mb-6 border border-[#FF750F]/20">
                    <svg class="w-10 h-10 text-[#FF750F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-white uppercase italic tracking-tighter leading-tight">
                    Nouvelle <br> <span class="text-[#FF750F]">Dépense</span>
                </h2>
                <div class="mt-8 p-4 rounded-2xl bg-black/20 border border-white/5 w-full">
                    <p class="text-slate-500 text-[9px] font-black italic uppercase tracking-[0.2em] mb-1">Espace Actif</p>
                    <p class="text-white font-bold text-sm uppercase italic">{{ $activeColocation->name }}</p>
                </div>
            </div>

            {{-- Section à droite : Formulaire (2/3 width) --}}
            <form action="{{ route('expenses.store') }}" method="POST" class="flex-1 p-12 space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Désignation --}}
                    <div class="space-y-3 md:col-span-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 italic ml-4">Désignation de la dépense</label>
                        <input type="text" name="title" required placeholder="Ex: Facture d'électricité, Courses..." 
                               class="w-full bg-[#1A1A1A] border border-white/5 rounded-[1.5rem] p-5 text-sm font-bold text-white focus:ring-2 focus:ring-[#FF750F] transition-all outline-none">
                    </div>

                    {{-- Payeur (C'est lui qui a payé) --}}
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 italic ml-4">Payé par (Membre)</label>
                        <div class="relative">
                            <select name="user_id" required 
                                    class="w-full bg-[#1A1A1A] border border-white/5 rounded-[1.5rem] p-5 text-sm font-bold text-white focus:ring-2 focus:ring-[#FF750F] outline-none appearance-none cursor-pointer">
                                @foreach($activeColocation->users as $member)
                                    <option value="{{ $member->id }}" {{ $member->id == auth()->id() ? 'selected' : '' }}>
                                        {{ $member->name }} {{ $member->id == auth()->id() ? '(Moi)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-[#FF750F]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Montant --}}
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 italic ml-4">Montant (MAD)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="amount" required placeholder="0.00" 
                                   class="w-full bg-[#1A1A1A] border border-white/5 rounded-[1.5rem] p-5 text-sm font-bold text-white focus:ring-2 focus:ring-[#FF750F] transition-all outline-none">
                            <span class="absolute right-6 top-1/2 -translate-y-1/2 font-black text-[10px] text-slate-700 uppercase italic">DH</span>
                        </div>
                    </div>

                    {{-- Date --}}
                    <div class="space-y-3 md:col-span-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 italic ml-4">Date du paiement</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}" required 
                               class="w-full bg-[#1A1A1A] border border-white/5 rounded-[1.5rem] p-5 text-sm font-bold text-white focus:ring-2 focus:ring-[#FF750F] transition-all outline-none [color-scheme:dark]">
                    </div>
                </div>

                {{-- Catégories --}}
                <div class="space-y-4">
                    <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 italic ml-4">Catégorie</label>
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach($categories as $category)
                            <label class="relative cursor-pointer group" @click="showNewCategory = false">
                                <input type="radio" name="category_id" value="{{ $category->id }}" class="peer sr-only" required>
                                <div class="p-4 text-center bg-[#1A1A1A] border border-white/5 rounded-[1.2rem] peer-checked:border-[#FF750F] peer-checked:bg-[#FF750F]/5 transition-all hover:bg-white/[0.02]">
                                    <span class="text-[9px] font-black uppercase text-slate-500 peer-checked:text-[#FF750F] italic">
                                        {{ $category->name }}
                                    </span>
                                </div>
                            </label>
                        @endforeach

                        <label class="relative cursor-pointer group" @click="showNewCategory = true">
                            <input type="radio" name="category_id" value="new" class="peer sr-only">
                            <div class="p-4 text-center bg-[#1A1A1A] border border-dashed border-white/10 rounded-[1.2rem] peer-checked:border-[#FF750F] peer-checked:bg-[#FF750F]/5 transition-all">
                                <span class="text-[9px] font-black uppercase text-slate-500 peer-checked:text-[#FF750F] italic">
                                    + Créer
                                </span>
                            </div>
                        </label>
                    </div>

                    {{-- Input New Category --}}
                    <div x-show="showNewCategory" x-transition.duration.300ms class="mt-4 animate-fade-in">
                        <input type="text" name="new_category_name" placeholder="Nom de la nouvelle catégorie..." 
                               class="w-full bg-[#202020] border-2 border-[#FF750F]/30 rounded-[1.5rem] p-5 text-xs font-bold text-white focus:border-[#FF750F] outline-none">
                    </div>
                </div>

                {{-- Bouton Submit --}}
                <div class="pt-6">
                    <button type="submit" class="w-full py-6 bg-[#FF750F] hover:bg-[#FF852D] text-white rounded-[2rem] font-black uppercase italic tracking-tighter shadow-2xl shadow-[#FF750F]/20 transition-all active:scale-95 flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                        Enregistrer la dépense
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @keyframes slideUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    .animate-slide-up { animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    .animate-fade-in { animation: fadeIn 1s ease-out; }
</style>
@endsection