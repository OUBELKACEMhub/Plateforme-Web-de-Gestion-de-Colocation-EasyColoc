<div {{ $attributes->merge(['class' => 'max-w-4xl mx-auto']) }}>
    {{-- Header --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white tracking-tighter italic uppercase">
            Rejoindre une <span class="text-[#FF750F]">Colocation</span>
        </h1>
        <p class="mt-4 text-slate-500 dark:text-slate-400 font-medium italic">
            Entrez le code d'invitation reçu pour rejoindre vos amis.
        </p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white dark:bg-[#151515] rounded-[2.5rem] border border-slate-200/60 dark:border-white/5 shadow-xl shadow-slate-200/40 dark:shadow-none p-10 sm:p-16 relative overflow-hidden">
        {{-- Decoration --}}
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-orange-500/5 rounded-full blur-3xl"></div>
        
        <form action="{{ route('colocations.join') }}" method="POST" class="space-y-8 relative z-10">
            @csrf
            
            <div class="space-y-4 text-center">
                <label for="invite_token" class="block text-sm font-black text-slate-400 uppercase tracking-[0.2em] italic">
                    Code d'invitation
                </label>
                <input type="text" 
                       name="invite_token" 
                       id="invite_token" 
                       placeholder="EX: A1B2C3D4" 
                       maxlength="10"
                       class="block w-full text-center text-2xl font-black tracking-[0.5em] bg-slate-50 dark:bg-white/5 border-2 border-slate-100 dark:border-white/10 rounded-3xl py-6 focus:ring-4 focus:ring-orange-500/10 focus:border-[#FF750F] transition-all uppercase placeholder:text-slate-300 dark:placeholder:text-slate-700"
                       required>
                
                @error('invite_token')
                    <p class="text-red-500 text-xs font-bold italic mt-2 animate-shake">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-4">
                <button type="submit" class="px-8 py-5 bg-slate-900 dark:bg-white dark:text-slate-900 text-white rounded-2xl font-black italic uppercase text-xs tracking-widest hover:scale-[1.02] active:scale-[0.98] transition-all shadow-lg">
                    Rejoindre l'aventure
                </button>
                
                <a href="{{ route('dashboard') }}" class="text-center text-xs font-bold text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors uppercase tracking-widest italic">
                    Annuler et retourner au dashboard
                </a>
            </div>
        </form>
    </div>

    {{-- Info Cards --}}
    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-6 bg-white dark:bg-[#151515] rounded-[2rem] border border-slate-200/60 dark:border-white/5 shadow-sm flex items-start gap-4">
            <div class="w-10 h-10 bg-orange-50 dark:bg-orange-500/10 rounded-xl flex items-center justify-center text-[#FF750F] shrink-0 font-bold italic">1</div>
            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium italic">Le code est généré par l'administrateur de la colocation.</p>
        </div>
        <div class="p-6 bg-white dark:bg-[#151515] rounded-[2rem] border border-slate-200/60 dark:border-white/5 shadow-sm flex items-start gap-4">
            <div class="w-10 h-10 bg-emerald-50 dark:bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-500 shrink-0 font-bold italic">2</div>
            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium italic">Une fois rejoint, vous aurez accès à toutes les fonctionnalités du groupe.</p>
        </div>
    </div>
</div>