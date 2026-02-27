@props(['colocation'])

<div {{ $attributes->merge(['class' => '']) }}>
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="group inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="text-xs font-black uppercase italic tracking-widest">Retour au Dashboard</span>
        </a>
    </div>

    <div class="bg-white dark:bg-[#151515] rounded-[2.5rem] p-10 border border-slate-200/60 dark:border-white/5 shadow-2xl shadow-slate-200/50 dark:shadow-none overflow-hidden relative">
        
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-[#FF750F]/10 rounded-full blur-3xl"></div>

        <div class="relative">
            <div class="mb-10">
                <h1 class="text-3xl font-black text-slate-900 dark:text-white italic uppercase tracking-tighter">
                    Inviter un membre
                </h1>
                <p class="text-slate-500 dark:text-slate-400 italic mt-2 font-medium">
                    Ajoutez un nouveau colocataire à la team <span class="text-[#FF750F] font-black underline decoration-2 underline-offset-4">{{ $colocation->name }}</span>
                </p>
            </div>

            <form action="{{ route('colocations.invite.send', $colocation) }}" method="POST" class="space-y-8">
                @csrf
                
                <div>
                    <label for="email" class="block text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3 italic px-1">
                        Adresse Email du futur coloc
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400 group-focus-within:text-[#FF750F] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path>
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                               placeholder="exemple@mail.com"
                               class="w-full pl-14 pr-6 py-5 bg-slate-50 dark:bg-white/[0.03] border-2 border-transparent rounded-[1.5rem] focus:ring-0 focus:border-[#FF750F] text-slate-900 dark:text-white font-bold transition-all placeholder:text-slate-400 placeholder:font-medium italic">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-3 font-bold italic px-2">× {{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 flex flex-col sm:flex-row items-center gap-4">
                    <button type="submit" 
                            class="w-full sm:flex-1 flex items-center justify-center gap-3 px-8 py-5 bg-[#FF750F] hover:bg-[#FF852D] text-white font-black rounded-2xl shadow-xl shadow-orange-500/30 transition-all active:scale-[0.98] uppercase italic tracking-tighter group">
                        <span>Envoyer l'invitation</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    
                    <a href="{{ route('dashboard') }}" 
                       class="w-full sm:w-auto px-8 py-5 bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-slate-400 font-black rounded-2xl hover:bg-slate-200 dark:hover:bg-white/10 transition-all uppercase italic text-xs tracking-widest text-center">
                        Annuler
                    </a>
                </div>
            </form>

            <div class="mt-10 p-5 bg-blue-50/50 dark:bg-blue-500/5 rounded-2xl border border-blue-100/50 dark:border-blue-500/10">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-[11px] text-blue-700 dark:text-blue-400 font-bold italic leading-relaxed">
                        L'invitation restera valable pendant 7 jours. Le futur membre recevra un lien sécurisé pour rejoindre directement votre colocation.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>