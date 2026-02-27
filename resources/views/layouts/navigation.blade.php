<nav x-data="{ open: false }" class="bg-white/80 dark:bg-[#151515]/80 backdrop-blur-md border-b border-slate-200/60 dark:border-white/5 sticky top-0 z-20 sm:ml-72 transition-all duration-300">
    <div class="px-4 sm:px-8 lg:px-10">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center sm:hidden">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-[#FF750F] rounded-lg flex items-center justify-center shadow-lg shadow-orange-500/20">
                            <span class="text-white font-bold text-sm">E</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:flex font-medium items-center">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Tableau de Bord</span>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <div class="px-3 py-1 bg-orange-50 dark:bg-orange-500/10 rounded-full border border-orange-100 dark:border-orange-500/20">
                    <span class="text-[10px] font-bold text-[#FF750F] uppercase tracking-tighter">⭐ {{ Auth::user()->reputation_score }} pts</span>
                </div>

                <!-- Notification Bell -->
                @php
                    $pendingCount = \App\Models\Invitation::where('email', Auth::user()->email)->where('status', 'pending')->count();
                @endphp
                <a href="{{ route('colocations.received') }}" class="relative p-2 text-slate-500 hover:text-[#FF750F] bg-slate-50 dark:bg-white/5 hover:bg-orange-50 dark:hover:bg-orange-500/10 rounded-xl border border-slate-200/60 dark:border-white/5 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    @if($pendingCount > 0)
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-[#FF750F] text-white text-[9px] font-black rounded-full flex items-center justify-center shadow-md shadow-orange-500/30 animate-pulse">
                            {{ $pendingCount > 9 ? '9+' : $pendingCount }}
                        </span>
                    @endif
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm leading-4 font-bold rounded-xl text-slate-700 dark:text-slate-200 bg-slate-50 dark:bg-white/5 hover:bg-slate-100 dark:hover:bg-white/10 transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-slate-900 dark:bg-white rounded-lg flex items-center justify-center text-white dark:text-slate-900 text-[10px]">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="text-xs">{{ Auth::user()->name }}</div>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-2 space-y-1">
                            <x-dropdown-link :href="route('profile.edit')" class="rounded-lg">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="rounded-lg text-red-500 font-bold hover:bg-red-50">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:bg-slate-100 dark:hover:bg-[#161615] transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-[#0a0a0a] border-t border-slate-100 dark:border-white/5">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-bold">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Mobile Notification Link -->
            <x-responsive-nav-link :href="route('colocations.received')" class="font-bold flex items-center gap-2">
                🔔 Invitations
                @if($pendingCount > 0)
                    <span class="ml-1 px-1.5 py-0.5 bg-[#FF750F] text-white text-[9px] font-black rounded-full">{{ $pendingCount }}</span>
                @endif
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-slate-100 dark:border-white/5">
            <div class="px-4 flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-[#FF750F] rounded-full flex items-center justify-center text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div>
                    <div class="font-bold text-base text-slate-900 dark:text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-500">⭐ {{ Auth::user()->reputation_score }} Points</div>
                </div>
            </div>

            <div class="space-y-1 p-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl">{{ __('Profile') }}</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-xl text-red-500 font-bold">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>