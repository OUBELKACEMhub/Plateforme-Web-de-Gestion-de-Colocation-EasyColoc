<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="flex justify-center mb-4">
            <div class="w-30 h-12 bg-[#FF750F] rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/20">
                <span class="text-white font-bold text-2xl">EasyColoc</span>
            </div>
        </div>
        <h2 class="text-2xl font-bold text-[#1b1b18] dark:text-white">Bon retour !</h2>
        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Connectez-vous pour gérer vos colocations.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#1b1b18] dark:text-[#EDEDEC] font-medium" />
            <x-text-input id="email" 
                class="block mt-1 w-full border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-gray-900 dark:text-white focus:border-[#FF750F] focus:ring-[#FF750F] rounded-xl shadow-sm placeholder-gray-400" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
                placeholder="votre@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Mot de passe')" class="text-[#1b1b18] dark:text-[#EDEDEC] font-medium" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-[#FF750F] hover:underline" href="{{ route('password.request') }}">
                        {{ __('Oublié ?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" 
                class="block mt-1 w-full border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-gray-900 dark:text-white focus:border-[#FF750F] focus:ring-[#FF750F] rounded-xl shadow-sm placeholder-gray-400"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-md border-[#e3e3e0] dark:border-[#3E3E3A] text-[#FF750F] shadow-sm focus:ring-[#FF750F] dark:bg-[#161615]" name="remember">
                <span class="ms-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">{{ __('Rester connecté') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-[#FF750F] hover:bg-[#e66a0e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF750F] transition-all transform hover:scale-[1.02]">
                {{ __('Se connecter') }}
            </button>
        </div>

        <p class="text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
            Pas encore de compte ? 
            <a href="{{ route('register') }}" class="font-bold text-[#0c0c0c] dark:text-[#0e0d0d] hover:underline">
                Créer un compte
            </a>
        </p>
    </form>
</x-guest-layout>