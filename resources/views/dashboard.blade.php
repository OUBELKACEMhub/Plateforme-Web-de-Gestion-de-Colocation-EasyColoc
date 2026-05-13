@extends('layouts.app')

@section('content')
{{-- W-full bach t-ched l-blasa kamla d l-ecran --}}
<div class="w-full min-h-screen bg-[#0F0F0F] text-white py-10 px-6 lg:px-12 space-y-12">
    
    @if($activeColocation)
        @php
            $currentUserPivot = $activeColocation->users->where('id', auth()->id())->first();
            $isOwner = $currentUserPivot && $currentUserPivot->pivot->role === 'owner';
            // Bach n-tfadaw error dial sum() on null ila makanch l-expenses
            $totalExpenses = $activeColocation->expenses ? $activeColocation->expenses->sum('amount') : 0;
        @endphp

        {{-- 1. Header & Quick Actions --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 border-b border-white/5 pb-10">
            <div class="space-y-3">
                <div class="flex items-center gap-4">
                    <h1 class="text-5xl font-black tracking-tighter uppercase italic text-white">
                        {{ $activeColocation->name }}
                    </h1>
                    <span class="px-4 py-1 text-[10px] font-black bg-[#FF750F]/10 text-[#FF750F] border border-[#FF750F]/20 rounded-full uppercase italic">
                        ● Live
                    </span>
                </div>
                <p class="text-slate-400 font-medium italic text-base max-w-3xl leading-relaxed">
                    {{ $activeColocation->description }}
                </p>
            </div>
            
            <div class="flex flex-wrap items-center gap-4">
                {{-- Nouvelle dépense --}}
                <a href="{{ route('expenses.create') }}" 
                   class="flex items-center gap-3 px-10 py-5 bg-[#FF750F] hover:bg-[#FF852D] text-white text-sm font-black rounded-[2rem] transition-all shadow-2xl shadow-[#FF750F]/20 active:scale-95 uppercase italic">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                    <span>Nouvelle dépense</span>
                </a>

                @if($isOwner)
                    <a href="{{ route('colocations.invite', $activeColocation) }}" 
                       class="px-8 py-5 bg-white/5 hover:bg-white/10 text-white text-xs font-black rounded-[2rem] border border-white/10 transition-all uppercase italic">
                        Inviter
                    </a>

                    <form action="{{ route('colocations.destroy', $activeColocation) }}" method="POST" onsubmit="return confirm('Dissoudre la colocation ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-8 py-5 bg-red-500/10 hover:bg-red-600 text-red-500 hover:text-white text-xs font-black rounded-[2rem] border border-red-500/20 transition-all uppercase italic">
                            Dissoudre
                        </button>
                    </form>
                @else
                    <form action="{{ route('colocations.leave', $activeColocation) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment quitter ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-8 py-5 bg-white/5 hover:bg-red-600 text-slate-300 hover:text-white text-xs font-black rounded-[2rem] border border-white/10 transition-all uppercase italic group">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Quitter l'espace
                            </span>
                        </button>
                    </form> 
                @endif
            </div>
        </div>

        {{-- 2. Stats Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-[#151515] p-10 rounded-[2.5rem] border border-white/5 group hover:border-[#FF750F]/30 transition-all">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] italic mb-4">Membres</p>
                <p class="text-5xl font-black text-white italic tracking-tighter">{{ $activeColocation->users->count() }}</p>
            </div>
            <div class="bg-[#151515] p-10 rounded-[2.5rem] border border-white/5 group hover:border-[#FF750F]/30 transition-all">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] italic mb-4">Réputation</p>
                <p class="text-5xl font-black text-[#FF750F] italic tracking-tighter">⭐ {{ auth()->user()->reputation_score ?? 0 }}</p>
            </div>
            <div class="bg-[#151515] p-10 rounded-[2.5rem] border border-white/5 group hover:border-[#FF750F]/30 transition-all">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] italic mb-4">Total Dépenses</p>
                <p class="text-3xl font-black text-emerald-500 italic tracking-tighter">{{ number_format($totalExpenses, 2) }} <span class="text-xs">MAD</span></p>
            </div>
            <div class="bg-[#151515] p-10 rounded-[2.5rem] border border-white/5 group hover:border-[#FF750F]/30 transition-all">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] italic mb-4">Statut Compte</p>
                <p class="text-5xl font-black text-white italic tracking-tighter uppercase">OK</p>
            </div>
        </div>

        {{-- 3. Table des Membres --}}
        <div class="bg-[#151515] rounded-[3rem] border border-white/5 overflow-hidden shadow-2xl animate-slide-up">
            <div class="px-10 py-10 border-b border-white/5 flex items-center justify-between bg-white/[0.01]">
                <h3 class="text-xl font-black text-white italic uppercase tracking-tighter">Équipage actuel</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-500 uppercase tracking-[0.4em] bg-white/[0.02]">
                            <th class="px-12 py-8">Utilisateur / Email</th>
                            <th class="px-8 py-8 text-center">Rôle</th>
                            <th class="px-8 py-8 text-center">Reputation</th>
                            <th class="px-8 py-8 text-center">État</th>
                            @if($isOwner) <th class="px-12 py-8 text-right">Actions</th> @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($activeColocation->users as $user)
                            <tr class="group hover:bg-white/[0.01] transition-all">
                                <td class="px-12 py-10">
                                    <div class="flex items-center gap-5">
                                        <div class="w-14 h-14 rounded-2xl bg-white text-[#0F0F0F] flex items-center justify-center font-black text-lg shadow-xl group-hover:rotate-3 transition-transform">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-black text-white text-lg uppercase tracking-tight">{{ $user->name }}</p>
                                            <p class="text-sm text-slate-500 font-bold italic">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-10 text-center">
                                    <span class="px-5 py-2 text-[10px] font-black rounded-xl bg-[#FF750F]/10 text-[#FF750F] border border-[#FF750F]/20 uppercase italic">
                                        {{ $user->pivot->role ?? 'Membre' }}
                                    </span>
                                </td>
                                <td class="px-8 py-10 text-center font-black text-xl italic text-white">
                                    ⭐ {{ $user->reputation_score ?? 0 }}
                                </td>
                                <td class="px-8 py-10 text-center text-emerald-500 font-black text-[10px] uppercase italic">
                                    @if($user->is_banned) <span class="text-red-500">Banni</span> @else Actif @endif
                                </td>
                                @if($isOwner && auth()->id() !== $user->id)
                                    <td class="px-12 py-10 text-right">
                                        <form action="{{ route('colocations.members.remove', [$activeColocation, $user]) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-4 bg-white/5 hover:bg-red-500 hover:text-white rounded-2xl transition-all border border-white/10">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 4. Table des Dépenses --}}
        <div class="bg-[#151515] rounded-[3rem] border border-white/5 overflow-hidden shadow-2xl animate-slide-up mt-12">
            <div class="px-10 py-10 border-b border-white/5 flex items-center justify-between bg-white/[0.01]">
                <h3 class="text-xl font-black text-white italic uppercase tracking-tighter">Historique des Dépenses</h3>
                <span class="text-[#FF750F] font-black text-sm italic">Total: {{ number_format(($activeColocation->expenses ? $activeColocation->expenses->sum('amount') : 0), 2) }}  MAD</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-500 uppercase tracking-[0.4em] bg-white/[0.02]">
                            <th class="px-12 py-8">Désignation / Date</th>
                            <th class="px-8 py-8 text-center">Catégorie</th>
                            <th class="px-8 py-8 text-center">Payé par</th>
                            <th class="px-8 py-8 text-center">Montant</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($activeColocation->expenses ?? [] as $expense)
                            <tr class="group hover:bg-white/[0.01] transition-all">
                                <td class="px-12 py-8">
                                    <p class="font-black text-white text-base uppercase tracking-tight">{{ $expense->title }}</p>
                                    <p class="text-[11px] text-slate-500 font-bold italic">{{ \Carbon\Carbon::parse($expense->date)->format('d M, Y') }}</p>
                                </td>
                                <td class="px-8 py-8 text-center">
                                    <span class="px-4 py-1.5 text-[9px] font-black rounded-lg bg-white/5 text-slate-400 border border-white/10 uppercase italic">
                                        {{ $expense->categorie->name ?? 'Général' }}
                                    </span>
                                </td>
                                <td class="px-8 py-8 text-center font-bold text-white italic">
                                    {{ $expense->payer->name ?? 'Inconnu' }}
                                </td>
                                <td class="px-8 py-8 text-center font-black text-[#FF750F] italic">
                                    {{ number_format($expense->amount, 2) }} MAD
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-12 py-20 text-center text-slate-600 font-bold italic uppercase tracking-widest text-xs">Aucune dépense enregistrée.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    @else
        {{-- Empty State - Rejoindre ou Créer --}}
        <div class="w-full py-20 flex flex-col items-center justify-center bg-[#151515] rounded-[4rem] border border-dashed border-white/10 animate-slide-up">
            <h2 class="text-4xl font-black text-white italic uppercase tracking-tighter mb-4 text-center leading-tight">Aucune colocation <br><span class="text-[#FF750F]">détectée</span></h2>
            <p class="text-slate-500 mb-10 italic text-sm font-medium">Rejoignez un espace avec un token ou lancez le vôtre.</p>

            <div class="flex flex-col md:flex-row items-center gap-6 w-full max-w-2xl px-6 text-center">
                <form action="{{ route('colocations.rejoindre') }}" method="POST" class="flex-1 w-full relative group">
                    @csrf
                    <input type="text" name="token" required placeholder="Coloc Token (Ex: ABC-123)..." 
                           class="w-full bg-white/5 border border-white/10 rounded-[2rem] px-8 py-5 text-white text-sm font-bold focus:border-[#FF750F] focus:ring-4 focus:ring-[#FF750F]/10 outline-none transition-all placeholder:text-slate-700">
                    <button type="submit" class="md:absolute right-2 md:top-2 md:bottom-2 mt-4 md:mt-0 px-8 py-4 md:py-0 bg-[#FF750F] text-white rounded-[1.8rem] font-black italic uppercase text-[10px] transition-all active:scale-95 shadow-lg shadow-[#FF750F]/20">Rejoindre</button>
                </form>

                <div class="text-slate-700 font-black italic text-xs uppercase">OU</div>

                <a href="{{ route('colocations.create') }}" 
                   class="px-12 py-5 bg-white/5 hover:bg-white/10 text-white rounded-[2rem] font-black italic uppercase text-[10px] border border-white/10 transition-all hover:border-[#FF750F]/50">Lancer un espace</a>
            </div>
            @if(session('error')) <p class="mt-6 text-red-500 text-[10px] font-black uppercase italic tracking-widest animate-pulse">⚠️ {{ session('error') }}</p> @endif
        </div>
    @endif
</div>

<style>
    @keyframes slideUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    .animate-slide-up { animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>
@endsection