<x-guest-layout>
    <div class="text-center mb-8">
        <div class="text-5xl mb-4">📧</div>
        <h2 class="text-xl font-bold dark:text-white">Vérifiez votre email</h2>
        <p class="mt-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">
            {{ __('Merci pour votre inscription ! كليكي على الرابط اللي صيفطنا ليك باش تفعل الحساب.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200 text-center">
            {{ __('Un nouveau lien de vérification a été envoyé.') }}
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full py-3 bg-[#FF750F] text-white font-bold rounded-xl hover:bg-[#e66a0e] transition-all">
                {{ __('Renvoyer l\'email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#FF750F] underline font-medium">
                {{ __('Se déconnecter') }}
            </button>
        </form>
    </div>
</x-guest-layout>