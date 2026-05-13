<x-guest-layout>
    <div class="mb-10 text-center">
        <div class="flex justify-center mb-6">
            <div class="group flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-100 transition-all hover:shadow-md">
                <div class="w-10 h-10 bg-[#FF750F] rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/20 transition-transform group-hover:rotate-12">
                    <span class="text-white font-bold text-xl">E</span>
                </div>
                <span class="text-2xl font-extrabold tracking-tight text-[#1b1b18]">Easy<span class="text-[#FF750F]">Coloc</span></span>
            </div>
        </div>
        
        <h2 class="text-3xl font-extrabold text-[#1b1b18] tracking-tight">Créer un compte</h2>
        <p class="mt-2 text-sm font-medium text-gray-500">Rejoignez votre colocation et commencez à gérer vos dépenses.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nom complet')" class="text-[#1b1b18] font-bold text-xs uppercase tracking-wider ml-1 mb-2" />
            <x-text-input id="name" 
                class="block w-full px-4 py-3.5 border-gray-200 bg-gray-50/50 text-[#1b1b18] focus:bg-white focus:border-[#FF750F] focus:ring-[#FF750F]/10 rounded-2xl transition-all placeholder:text-gray-400 shadow-sm" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                placeholder="Ahmed Oubelkacem" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-semibold" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#1b1b18] font-bold text-xs uppercase tracking-wider ml-1 mb-2" />
            <x-text-input id="email" 
                class="block w-full px-4 py-3.5 border-gray-200 bg-gray-50/50 text-[#1b1b18] focus:bg-white focus:border-[#FF750F] focus:ring-[#FF750F]/10 rounded-2xl transition-all placeholder:text-gray-400 shadow-sm" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                placeholder="ahmed@exemple.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-semibold" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <x-input-label for="password" :value="__('Mot de passe')" class="text-[#1b1b18] font-bold text-xs uppercase tracking-wider ml-1 mb-2" />
                <x-text-input id="password" 
                    class="block w-full px-4 py-3.5 border-gray-200 bg-gray-50/50 text-[#1b1b18] focus:bg-white focus:border-[#FF750F] focus:ring-[#FF750F]/10 rounded-2xl transition-all placeholder:text-gray-400 shadow-sm" 
                    type="password" 
                    name="password" 
                    required 
                    placeholder="••••••••" />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmation')" class="text-[#1b1b18] font-bold text-xs uppercase tracking-wider ml-1 mb-2" />
                <x-text-input id="password_confirmation" 
                    class="block w-full px-4 py-3.5 border-gray-200 bg-gray-50/50 text-[#1b1b18] focus:bg-white focus:border-[#FF750F] focus:ring-[#FF750F]/10 rounded-2xl transition-all placeholder:text-gray-400 shadow-sm" 
                    type="password" 
                    name="password_confirmation" 
                    required 
                    placeholder="••••••••" />
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center items-center py-4 px-4 rounded-2xl shadow-xl shadow-orange-500/20 text-sm font-extrabold text-white bg-[#FF750F] hover:bg-[#e66a0e] hover:translate-y-[-1px] active:translate-y-[0px] focus:outline-none focus:ring-4 focus:ring-[#FF750F]/20 transition-all">
                {{ __("S'inscrire") }}
                <svg class="w-4 h-4 ms-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9l3 3m0 0l-3 3m3-3H3"></path></svg>
            </button>
        </div>

        <div class="text-center pt-2">
            <p class="text-sm font-medium text-gray-500">
                Déjà inscrit ? 
                <a href="{{ route('login') }}" class="font-extrabold text-[#1b1b18] hover:text-[#FF750F] transition underline-offset-4 hover:underline">
                    Se connecter
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>