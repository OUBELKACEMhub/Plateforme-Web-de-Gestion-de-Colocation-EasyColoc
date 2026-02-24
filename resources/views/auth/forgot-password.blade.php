<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="flex justify-center mb-4 text-4xl">🔑</div>
        <h2 class="text-xl font-bold dark:text-white">Mot de passe oublié ?</h2>
        <p class="mt-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">
            {{ __('Indiquez-nous votre email و غانصيفطو ليك رابط لإعادة التعيين.') }}
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf
        <div>
            <x-text-input id="email" class="block w-full border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-gray-900 dark:text-white rounded-xl" type="email" name="email" :value="old('email')" required autofocus placeholder="email@exemple.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <button type="submit" class="w-full py-3 bg-[#FF750F] text-white font-bold rounded-xl hover:bg-[#e66a0e] transition-all">
            {{ __('Envoyer le lien') }}
        </button>
    </form>
</x-guest-layout>