<div {{ $attributes->merge(['class' => 'bg-white dark:bg-[#151515] p-8 rounded-[2.5rem] border border-slate-200/60 dark:border-white/5 shadow-sm transition-all']) }}>
    
    <div class="mb-8">
        <h2 class="text-xl font-black text-slate-900 dark:text-white uppercase italic tracking-tight">
            🏠 Créer une nouvelle <span class="text-[#FF750F]">Coloc</span>
        </h2>
        <p class="text-slate-500 dark:text-slate-400 text-[11px] mt-1 uppercase font-bold tracking-tighter italic">Lancer un nouvel espace de vie</p>
    </div>
    
    <form action="{{ route('colocations.store') }}" method="POST" class="space-y-6">
        @csrf
        
        {{-- Nom de la Coloc --}}
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Nom de la Colocation')" class="dark:text-slate-300 font-bold ml-1 text-xs" />
            <x-text-input id="name" name="name" type="text" 
                class="block w-full px-4 py-3 bg-slate-50 dark:bg-white/5 border-slate-200/60 dark:border-white/5 rounded-2xl focus:ring-2 focus:ring-orange-500/20 focus:border-[#FF750F] transition-all" 
                placeholder="Ex: Appartement Rabat Centre" required />
        </div>

        {{-- Description --}}
        <div class="space-y-2">
            <x-input-label for="description" :value="__('Description')" class="dark:text-slate-300 font-bold ml-1 text-xs" />
            <textarea id="description" name="description" 
                class="block w-full px-4 py-3 bg-slate-50 dark:bg-white/5 border-slate-200/60 dark:border-white/5 text-slate-900 dark:text-white rounded-2xl focus:ring-2 focus:ring-orange-500/20 focus:border-[#FF750F] transition-all min-h-[100px] text-sm" 
                placeholder="Décrivez l'ambiance, les règles, etc..." required></textarea>
        </div>

        {{-- Error Handling --}}
        @if($errors->has('error'))
            <div class="p-4 bg-red-50 dark:bg-red-500/10 border border-red-100 dark:border-red-500/20 rounded-2xl flex items-center gap-3 text-red-600 dark:text-red-400 text-[11px] font-bold animate-shake">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ $errors->first('error') }}
            </div>
        @endif

        {{-- Submit Button --}}
        <button type="submit" class="w-full bg-[#FF750F] hover:bg-[#e66a0e] text-white font-black py-4 rounded-2xl shadow-lg shadow-orange-500/20 transition-all transform hover:scale-[1.01] active:scale-[0.98] flex items-center justify-center gap-2">
            <span>Confirmer la création</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
        </button>
    </form>
</div>