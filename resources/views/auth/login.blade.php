<x-guest-layout>
    <div class="mb-10 text-center">
        <div class="flex justify-center mb-6">
            <div class="group flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-10 h-10 bg-[#FF750F] rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/20 transition-transform group-hover:rotate-12">
                    <span class="text-white font-bold text-xl">E</span>
                </div>
                <span class="text-2xl font-extrabold tracking-tight text-[#1b1b18]">Easy<span class="text-[#FF750F]">Coloc</span></span>
            </div>
        </div>
        
        <h2 class="text-3xl font-extrabold text-[#1b1b18] tracking-tight">Bon retour !</h2>
        <p class="mt-2 text-sm font-medium text-gray-500">Connectez-vous pour gérer vos colocations sans stress.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#1b1b18] font-bold text-xs uppercase tracking-wider ml-1 mb-2" />
            <div class="relative group">
                <x-text-input id="email" 
                    class="block w-full px-4 py-3.5 border-gray-200 bg-gray-50/50 text-[#1b1b18] focus:bg-white focus:border-[#FF750F] focus:ring-[#FF750F]/10 rounded-2xl transition-all placeholder:text-gray-400 shadow-sm" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username" 
                    placeholder="votre@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-semibold" />
        </div>

        <div>
            <div class="flex items-center justify-between ml-1 mb-2">
                <x-input-label for="password" :value="__('Mot de passe')" class="text-[#1b1b18] font-bold text-xs uppercase tracking-wider" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-[#FF750F] hover:text-[#e66a0e] transition" href="{{ route('password.request') }}">
                        {{ __('Oublié ?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" 
                class="block w-full px-4 py-3.5 border-gray-200 bg-gray-50/50 text-[#1b1b18] focus:bg-white focus:border-[#FF750F] focus:ring-[#FF750F]/10 rounded-2xl transition-all placeholder:text-gray-400 shadow-sm"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-semibold" />
        </div>

        <div class="flex items-center justify-between px-1">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-[#FF750F] shadow-sm focus:ring-[#FF750F] transition cursor-pointer" name="remember">
                <span class="ms-2 text-sm font-medium text-gray-500 group-hover:text-[#1b1b18] transition">{{ __('Rester connecté') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center items-center py-4 px-4 rounded-2xl shadow-xl shadow-orange-500/20 text-sm font-extrabold text-white bg-[#FF750F] hover:bg-[#e66a0e] hover:translate-y-[-1px] active:translate-y-[0px] focus:outline-none focus:ring-4 focus:ring-[#FF750F]/20 transition-all">
                {{ __('Se connecter') }}
                <svg class="w-4 h-4 ms-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>

        <div class="text-center pt-2">
            <p class="text-sm font-medium text-gray-500">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="font-extrabold text-[#1b1b18] hover:text-[#FF750F] transition underline-offset-4 hover:underline">
                    Créer un compte
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>