<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EasyColoc - Gérer vos dépenses</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] font-sans antialiased">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF750F] selection:text-white">
            
            <nav class="absolute top-0 w-full flex justify-between items-center p-6 lg:px-20">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-[#FF750F] rounded-lg flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-xl">E</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight dark:text-white">Easy<span class="text-[#FF750F]">Coloc</span></span>
                </div>

                @if (Route::has('login'))
                    <div class="flex gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2 text-sm font-medium text-white bg-[#FF750F] rounded-full hover:bg-[#e66a0e] transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] hover:underline underline-offset-4">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-medium text-white bg-[#1b1b18] dark:bg-[#EDEDEC] dark:text-black rounded-full hover:opacity-90 transition">S'inscrire</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>

            <main class="w-full max-w-6xl px-6 lg:flex items-center gap-12 pt-20">
                <div class="lg:w-1/2">
                    <h1 class="text-5xl lg:text-7xl font-bold leading-tight dark:text-white mb-6">
                        Gérer vos dépenses <span class="text-[#FF750F]">sans stress.</span>
                    </h1>
                    <p class="text-lg text-[#706f6c] dark:text-[#A1A09A] mb-8 max-w-lg">
                        Suivez les dépenses communes, calculez automatiquement les dettes et maintenez une bonne ambiance dans votre colocation.
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-[#FF750F] text-white rounded-xl font-bold text-lg shadow-xl shadow-orange-500/20 hover:scale-105 transition-transform">
                            Commencer maintenant
                        </a>
                        <div class="flex items-center gap-2 px-6 py-4 text-[#706f6c] dark:text-[#A1A09A]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>100% Gratuit</span>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2 mt-12 lg:mt-0 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-6 bg-white dark:bg-[#161615] rounded-2xl border dark:border-[#3E3E3A] shadow-sm">
                        <div class="text-[#FF750F] mb-4">💰</div>
                        <h3 class="font-bold dark:text-white mb-2">Calcul Automatique</h3>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Plus besoin de calculette, nous gérons la répartition.</p>
                    </div>
                    <div class="p-6 bg-white dark:bg-[#161615] rounded-2xl border dark:border-[#3E3E3A] shadow-sm">
                        <div class="text-[#FF750F] mb-4">⭐</div>
                        <h3 class="font-bold dark:text-white mb-2">Système de Réputation</h3>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Valorisez les bons payeurs avec des points de réputation.</p>
                    </div>
                    <div class="p-6 bg-white dark:bg-[#161615] rounded-2xl border dark:border-[#3E3E3A] shadow-sm">
                        <div class="text-[#FF750F] mb-4">📧</div>
                        <h3 class="font-bold dark:text-white mb-2">Invitations Simples</h3>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Invitez vos colocataires par email en un clic.</p>
                    </div>
                    <div class="p-6 bg-white dark:bg-[#161615] rounded-2xl border dark:border-[#3E3E3A] shadow-sm">
                        <div class="text-[#FF750F] mb-4">📊</div>
                        <h3 class="font-bold dark:text-white mb-2">Stats Mensuelles</h3>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Filtrez et visualisez vos dépenses par mois.</p>
                    </div>
                </div>
            </main>

            <footer class="mt-20 py-8 text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
                &copy; {{ date('Y') }} EasyColoc - Fait avec ❤️ par Ahmed Oubelkacem
            </footer>
        </div>
    </body>
</html>