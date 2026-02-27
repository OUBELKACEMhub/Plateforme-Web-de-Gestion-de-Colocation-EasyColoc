<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        <div class="mb-8">
            @if($activeColocation)
                @if(session('invite_token'))
                    <div x-data="{ show: true, copied: false }" x-show="show" 
                         class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 rounded-2xl flex items-center justify-between shadow-sm animate-bounce-in">
                        <div class="flex items-center gap-3 text-emerald-700 dark:text-emerald-400 text-sm font-bold italic">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Lien d'invitation prêt : <span class="bg-white dark:bg-white/5 px-2 py-0.5 rounded border border-emerald-200 uppercase tracking-widest">{{ session('invite_token') }}</span></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="navigator.clipboard.writeText('{{ session('invite_token') }}'); copied = true; setTimeout(() => copied = false, 2000)" 
                                    class="px-4 py-1.5 bg-emerald-600 text-white text-[10px] font-black uppercase rounded-xl hover:bg-emerald-700 transition-all flex items-center gap-2">
                                <span x-text="copied ? 'Copié !' : 'Copier'"></span>
                            </button>
                            <button @click="show = false" class="text-emerald-400 hover:text-emerald-600 transition-colors p-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </div>
                @endif

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white tracking-tighter italic uppercase">
                            {{ $activeColocation->name }}
                        </h1>
                        <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium italic max-w-2xl">
                            {{ $activeColocation->description }}
                        </p>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <span class="px-4 py-2 text-[10px] font-bold rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20 uppercase tracking-widest italic">
                            ● {{ $activeColocation->status ?? 'Active' }}
                        </span>

                        <a href="{{ route('colocations.invite', $activeColocation) }}" 
                                class="flex items-center gap-2 px-6 py-3 bg-[#FF750F] hover:bg-[#FF852D] text-white text-xs font-black rounded-2xl shadow-lg shadow-orange-500/30 transition-all active:scale-95 group uppercase italic tracking-tighter">
                                    
                                    <svg class="w-4 h-4 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    
                                    <span>Inviter un membre</span>
                         </a>
                    </div>
                </div>

            @else
                <div class="text-center py-16 bg-white dark:bg-[#151515] rounded-[2rem] border border-dashed border-slate-300 dark:border-white/10">
                    <div class="w-20 h-20 bg-slate-100 dark:bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white italic uppercase tracking-tighter">Aucune colocation active</h2>
                    <p class="text-slate-500 mt-2 mb-8 italic">Créez votre propre espace ou rejoignez-en un avec un code.</p>
                    <div class="flex justify-center gap-4">
                        <a href="{{ route('colocations.create') }}" class="px-8 py-3 bg-[#FF750F] text-white rounded-2xl font-black italic uppercase text-xs shadow-lg shadow-orange-500/20">Créer une coloc</a>
                        <button onclick="/* Ouvrir un modal de join */" class="px-8 py-3 bg-slate-900 dark:bg-white dark:text-slate-900 text-white rounded-2xl font-black italic uppercase text-xs">Rejoindre</button>
                    </div>
                </div>
            @endif
        </div>

        @if($activeColocation)
            <div class="bg-white dark:bg-[#151515] rounded-[2.5rem] border border-slate-200/60 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden animate-slide-up">
                <div class="p-8 border-b border-slate-100 dark:border-white/5 bg-slate-50/50 dark:bg-white/[0.02] flex items-center justify-between">
                    <h3 class="font-black text-slate-900 dark:text-white italic uppercase tracking-tighter flex items-center gap-3">
                        <span class="w-2 h-8 bg-[#FF750F] rounded-full"></span>
                        Membres de l'équipe
                    </h3>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest italic">{{ $activeColocation->users->count() }} Personnes</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-100 dark:border-white/5 bg-slate-50/30 dark:bg-transparent">
                                <th class="px-8 py-5">Membre</th>
                                <th class="px-6 py-5">Rôle</th>
                                <th class="px-6 py-5">Arrivée</th>
                                <th class="px-6 py-5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                            @foreach($activeColocation->users as $user)
                                <tr class="group hover:bg-slate-50 dark:hover:bg-white/[0.01] transition-all duration-300">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="relative">
                                                <div class="w-12 h-12 rounded-2xl bg-slate-900 dark:bg-white flex items-center justify-center text-white dark:text-slate-900 font-black text-sm shadow-lg transform group-hover:rotate-6 transition-transform">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-white dark:border-[#151515] rounded-full"></div>
                                            </div>
                                            <div>
                                                <p class="font-black text-slate-900 dark:text-white text-sm uppercase tracking-tight">{{ $user->name }}</p>
                                                <p class="text-[11px] text-slate-400 font-bold italic">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <span class="px-3 py-1 text-[10px] font-black rounded-xl bg-orange-50 dark:bg-orange-500/10 text-[#FF750F] border border-orange-100 dark:border-orange-500/20 uppercase italic tracking-tighter">
                                            {{ $user->pivot->role ?? 'Membre' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 text-xs text-slate-500 font-bold italic">
                                        {{ \Carbon\Carbon::parse($user->pivot->joined_at)->translatedFormat('d M Y') }}
                                    </td>
                                    <{{-- ... dakhél l-foreach($activeColocation->users as $user) ... --}}

<td class="px-6 py-6 text-right">
    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
        
        {{-- Bouton Message (ba9i dima kiban) --}}
        <button title="Message" class="p-2 text-slate-400 hover:text-indigo-500 bg-white dark:bg-white/5 rounded-xl border border-slate-200 dark:border-white/10 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        </button>

        @php
            $currentUserPivot = $activeColocation->users->where('id', auth()->id())->first();
            $isOwner = $currentUserPivot && $currentUserPivot->pivot->role === 'owner';
        @endphp

        {{-- Ila knti owner o machi k-t-supprimer rasek --}}
        @if($isOwner && auth()->id() !== $user->id)
            <form action="{{ route('colocations.members.remove', [$activeColocation, $user]) }}" 
                  method="POST" 
                  onsubmit="return confirm('Êtes-vous sûr de vouloir retirer ce membre ?')">
                @csrf
                @method('DELETE')
                <button type="submit" title="Retirer" class="p-2 text-slate-400 hover:text-red-500 bg-white dark:bg-white/5 rounded-xl border border-slate-200 dark:border-white/10 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </form>
        @endif
    </div>
</td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <style>
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up { animation: slideUp 0.6s ease-out forwards; }
        
        @keyframes bounceIn {
            0% { transform: scale(0.9); opacity: 0; }
            70% { transform: scale(1.02); }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-bounce-in { animation: bounceIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
    </style>
</x-app-layout>