@props(['invitations'])

<div {{ $attributes->merge(['class' => '']) }}>
    <div class="mb-8">
        <h2 class="text-2xl font-black text-slate-800 dark:text-white uppercase italic tracking-tighter">
            Invitations <span class="text-[#FF750F]">reçues</span>
        </h2>
        <p class="text-slate-500 dark:text-slate-400 italic text-sm font-medium">Gérez les demandes de colocation envoyées par d'autres utilisateurs.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($invitations as $invitation)
            <div class="bg-white dark:bg-[#151515] rounded-[2rem] border border-slate-200/60 dark:border-white/5 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-500/20 dark:to-orange-500/5 rounded-2xl flex items-center justify-center text-[#FF750F] font-black text-xl shadow-inner">
                                {{ substr($invitation->sender->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 dark:text-white leading-none mb-1">{{ $invitation->sender->name }}</h3>
                                <span class="text-[10px] font-black uppercase tracking-widest text-[#FF750F] bg-orange-50 dark:bg-orange-500/10 px-2 py-0.5 rounded-md italic">
                                    ⭐ {{ $invitation->sender->reputation_score ?? 0 }} pts
                                </span>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-blue-50 dark:bg-blue-500/10 text-blue-500 text-[9px] font-black uppercase rounded-lg tracking-widest border border-blue-100 dark:border-blue-500/20">
                            {{ $invitation->status }}
                        </span>
                    </div>

                    <div class="mb-8 p-4 bg-slate-50 dark:bg-white/[0.02] rounded-2xl border border-slate-100 dark:border-white/5">
                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed italic">
                            Souhaite rejoindre : <br>
                            <span class="font-black text-slate-900 dark:text-white text-sm not-italic mt-1 block">
                                "{{ $invitation->colocation->name ?? 'Colocation sans titre' }}"
                            </span>
                        </p>
                        <div class="mt-3 flex items-center gap-2 text-[10px] text-slate-400 font-bold uppercase tracking-tighter">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Reçue {{ $invitation->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <form action="{{ route('invitations.accept', $invitation) }}" method="POST" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button class="w-full py-3 bg-[#FF750F] hover:bg-[#e6690d] text-white text-xs font-black uppercase italic rounded-xl transition-all shadow-lg shadow-orange-500/20 active:scale-95">
                                Accepter
                            </button>
                        </form>
                        
                        <form action="{{ route('invitations.reject', $invitation) }}" method="POST" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button class="w-full py-3 bg-slate-100 dark:bg-white/5 hover:bg-red-50 dark:hover:bg-red-500/10 text-slate-500 dark:text-slate-400 hover:text-red-500 transition-all text-xs font-black uppercase italic rounded-xl active:scale-95">
                                Refuser
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full flex flex-col items-center justify-center py-24 bg-white dark:bg-[#151515] rounded-[3rem] border-2 border-dashed border-slate-200 dark:border-white/10 shadow-inner">
                <div class="w-20 h-20 bg-slate-50 dark:bg-white/5 rounded-full flex items-center justify-center text-4xl mb-6 animate-bounce">
                    📩
                </div>
                <h3 class="text-slate-900 dark:text-white font-black italic uppercase tracking-tight">C'est un peu calme ici...</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm italic font-medium mt-1">Aucune invitation pour le moment.</p>
            </div>
        @endforelse
    </div>
</div>