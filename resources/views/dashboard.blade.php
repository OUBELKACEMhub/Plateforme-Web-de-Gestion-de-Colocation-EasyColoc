<x-app-layout>
    <div class="flex min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a]">
        <aside class="w-64 bg-white dark:bg-[#161615] border-r border-[#e3e3e0] dark:border-[#3E3E3A] flex flex-col fixed h-full shadow-sm z-10">
            <div class="p-6 flex items-center gap-3">
                <div class="w-10 h-10 bg-[#FF750F] rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/20">
                    <span class="text-white font-bold text-xl">E</span>
                </div>
                <span class="text-xl font-bold dark:text-white tracking-tight">Easy<span class="text-[#FF750F]">Coloc</span></span>
            </div>

            

           
        </aside>

        <main class="flex-1 ml-64 p-8">
            <div class="flex justify-between items-center mb-10">
                <div class="flex items-center gap-4">
                    <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-white tracking-tight italic uppercase">Mes Colocations</h1>
                    <button class="bg-[#FF750F] hover:bg-[#e66a0e] text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-orange-500/20 transition-all transform hover:scale-[1.03] flex items-center gap-2">
                        <span class="text-lg">+</span> Nouvelle Coloc
                    </button>
                </div>

                
            </div>

            <div class="bg-white dark:bg-[#161615] rounded-[2.5rem] border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm p-32 flex flex-col items-center justify-center text-center transition-all">
                <div class="w-24 h-24 bg-orange-50 dark:bg-orange-500/5 rounded-[2rem] flex items-center justify-center mb-8">
                    <svg class="w-12 h-12 text-[#FF750F]/30" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011-1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-[#1b1b18] dark:text-white opacity-40">Aucune colocation active</h2>
                <p class="text-[#706f6c] dark:text-[#A1A09A] font-medium mt-2">Commencez par créer un groupe pour gérer vos dépenses.</p>
                <button class="mt-8 text-[#FF750F] font-bold hover:underline underline-offset-8 transition-all">
                    En savoir plus sur le fonctionnement &rarr;
                </button>
            </div>
        </main>
    </div>
</x-app-layout>