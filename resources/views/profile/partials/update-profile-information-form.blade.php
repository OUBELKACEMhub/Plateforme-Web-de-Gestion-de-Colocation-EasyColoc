<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-[#1b1b18] dark:text-white uppercase tracking-tight italic">
            {{ __('Informations du profil') }}
        </h2>
        <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A]">
            {{ __("Gérez vos informations personnelles et vérifiez votre statut.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label :value="__('Votre Rôle')" class="dark:text-[#EDEDEC] opacity-70" />
                <div class="mt-1 px-4 py-3 bg-gray-50 dark:bg-white/5 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl text-sm font-bold text-[#FF750F] uppercase tracking-widest">
                    {{ Auth::user()->role }} </div>
            </div>
            <div>
                <x-input-label :value="__('Statut du Compte')" class="dark:text-[#EDEDEC] opacity-70" />
                <div class="mt-1 px-4 py-3 bg-gray-50 dark:bg-white/5 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl text-sm font-bold {{ Auth::user()->is_banned ? 'text-red-500' : 'text-green-500' }} uppercase tracking-widest">
                    {{ Auth::user()->is_banned ? 'Banni' : 'Actif' }} </div>
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Nom complet')" class="dark:text-[#EDEDEC] font-medium" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-gray-900 dark:text-white rounded-xl focus:ring-[#FF750F] focus:border-[#FF750F]" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="dark:text-[#EDEDEC] font-medium" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-gray-900 dark:text-white rounded-xl focus:ring-[#FF750F] focus:border-[#FF750F]" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-6 py-2.5 bg-[#FF750F] hover:bg-[#e66a0e] text-white font-bold rounded-xl shadow-lg shadow-orange-500/20 transition-all transform hover:scale-[1.02]">
                {{ __('Enregistrer') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-medium text-green-600 dark:text-green-400">✅ {{ __('Modifié avec succès.') }}</p>
            @endif
        </div>
    </form>
</section>