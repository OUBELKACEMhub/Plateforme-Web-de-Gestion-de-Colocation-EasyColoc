<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EasyColoc - Gestion de Colocation Moderne</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .hero-bg {
                background: radial-gradient(circle at 100% 0%, rgba(255, 117, 15, 0.08) 0%, transparent 40%),
                            radial-gradient(circle at 0% 100%, rgba(255, 117, 15, 0.05) 0%, transparent 40%);
            }
        </style>
    </head>
    <body class="bg-[#FCFCFB] text-[#1b1b18] antialiased hero-bg">
        
        <div class="relative min-h-screen flex flex-col">
            
            <nav class="sticky top-0 z-50 w-full backdrop-blur-md border-b border-gray-100 px-6 lg:px-20 py-4">
                <div class="max-w-7xl mx-auto flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#FF750F] rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/20">
                            <span class="text-white font-bold text-xl">E</span>
                        </div>
                        <span class="text-2xl font-extrabold tracking-tight text-[#1b1b18]">Easy<span class="text-[#FF750F]">Coloc</span></span>
                    </div>

                    <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-500">
                        <a href="#" class="hover:text-[#FF750F] transition">Fonctionnalités</a>
                        <a href="#" class="hover:text-[#FF750F] transition">Tarifs</a>
                        <a href="#" class="hover:text-[#FF750F] transition">Aide</a>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="hidden sm:block text-sm font-bold text-gray-600 hover:text-[#1b1b18] transition">Connexion</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 text-sm font-bold bg-[#1b1b18] text-white rounded-xl hover:bg-black transition-all">S'inscrire</a>
                    </div>
                </div>
            </nav>

            <main class="flex-grow flex flex-col items-center justify-center px-6 pt-16 pb-24">
                <div class="max-w-7xl w-full grid lg:grid-cols-12 gap-16 items-center">
                    
                    <div class="lg:col-span-6 space-y-8">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-50 border border-orange-100 text-xs font-bold text-[#FF750F]">
                            NOUVEAU : SYSTÈME DE RÉPUTATION V2
                        </div>
                        
                        <h1 class="text-6xl lg:text-7xl font-extrabold leading-[1.1] tracking-tight text-[#1b1b18]">
                            L'harmonie <br/> <span class="text-[#FF750F]">chez vous.</span>
                        </h1>
                        
                        <p class="text-xl text-gray-600 leading-relaxed max-w-xl">
                            La plateforme tout-en-un pour gérer vos dépenses, vos tâches et vos colocataires sans aucun conflit.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <a href="{{ route('register') }}" class="px-10 py-5 bg-[#FF750F] text-white rounded-2xl font-bold text-lg shadow-xl shadow-orange-500/30 hover:translate-y-[-2px] transition-all flex items-center justify-center gap-2">
                                Commencer maintenant
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-6 grid grid-cols-2 gap-4">
                        
                        <div class="group relative overflow-hidden rounded-[2.5rem] bg-white border border-gray-100 p-6 aspect-[4/5] flex flex-col justify-end shadow-sm hover:shadow-xl transition-all">
                            <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=600" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-80">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="relative z-10 text-white">
                                <h3 class="text-xl font-bold mb-1">Calcul intelligent</h3>
                                <p class="text-xs text-gray-200">Répartition automatique au centime près.</p>
                            </div>
                        </div>

                        <div class="group relative overflow-hidden rounded-[2.5rem] bg-white border border-gray-100 p-6 aspect-[4/5] flex flex-col justify-end mt-12 shadow-sm hover:shadow-xl transition-all">
                            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=600" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-80">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="relative z-10 text-white">
                                <h3 class="text-xl font-bold mb-1">Réputation</h3>
                                <p class="text-xs text-gray-200">Valorisez la fiabilité de vos colocs.</p>
                            </div>
                        </div>

                        <div class="group relative overflow-hidden rounded-[2.5rem] bg-white border border-gray-100 p-6 aspect-[4/5] flex flex-col justify-end -mt-12 shadow-sm hover:shadow-xl transition-all">
                            <img src="https://images.unsplash.com/photo-1516321497487-e288fb19713f?q=80&w=600" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-80">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="relative z-10 text-white">
                                <h3 class="text-xl font-bold mb-1">Invitations</h3>
                                <p class="text-xs text-gray-200">Liez votre équipe en un clic.</p>
                            </div>
                        </div>

                        <div class="group relative overflow-hidden rounded-[2.5rem] bg-white border border-gray-100 p-6 aspect-[4/5] flex flex-col justify-end shadow-sm hover:shadow-xl transition-all">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=600" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-80">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="relative z-10 text-white">
                                <h3 class="text-xl font-bold mb-1">Statistiques</h3>
                                <p class="text-xs text-gray-200">Visualisez vos flux financiers.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </main>

            <footer class="py-8 text-center border-t border-gray-100">
                <p class="text-gray-400 text-sm font-medium">
                    &copy; {{ date('Y') }} EasyColoc — Ahmed Oubelkacem
                </p>
            </footer>
        </div>
    </body>
</html>