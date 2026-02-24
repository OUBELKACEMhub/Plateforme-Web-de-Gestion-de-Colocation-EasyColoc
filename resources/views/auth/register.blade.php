<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="flex justify-center mb-4">
            <div class="w-30 h-12 bg-[#FF750F] rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/20">
                <span class="text-white font-bold text-2xl">EasyColoc</span>
            </div>
        </div>
        <h2 class="text-2xl font-bold text-[#1b1b18] dark:text-white">Créer un compte</h2>
        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Rejoignez votre colocation en quelques secondes.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nom complet')" class="dark:text-[#EDEDEC]" />
            <x-text-input id="name" class="block mt-1 w-full border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-gray-900 dark:text-white focus:border-[#FF750F] focus:ring-[#FF750F] rounded-xl shadow-sm" type="text" name="name" :value="old('name')" required autofocus placeholder="Votre nom" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="dark:text-[#EDEDEC]" />
            <x-text-input id="email" class="block mt-1 w-full border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-gray-900 dark:text-white focus:border-[#FF750F] focus:ring-[#FF750F] rounded-xl shadow-sm" type="email" name="email" :value="old('email')" required placeholder="email@exemple.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Mot de passe')" class="dark:text-[#EDEDEC]" />
                <x-text-input id="password" class="block mt-1 w-full border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-gray-900 dark:text-white focus:border-[#FF750F] focus:ring-[#FF750F] rounded-xl shadow-sm" type="password" name="password" required placeholder="••••••••" />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmation')" class="dark:text-[#EDEDEC]" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-gray-900 dark:text-white focus:border-[#FF750F] focus:ring-[#FF750F] rounded-xl shadow-sm" type="password" name="password_confirmation" required placeholder="••••••••" />
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center py-3 bg-[#FF750F] hover:bg-[#e66a0e] text-white font-bold rounded-xl transition-all transform hover:scale-[1.02]">
                S'inscrire
            </button>
        </div>

        <p class="text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
            Déjà inscrit ? <a href="{{ route('login') }}" class="font-bold text-[#FF750F] hover:underline">Se connecter</a>
        </p>
    </form>
</x-guest-layout>