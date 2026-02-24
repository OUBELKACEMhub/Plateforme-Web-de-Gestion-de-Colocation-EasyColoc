<nav x-data="{ open: false }" class="bg-white dark:bg-[#0a0a0a] border-b border-[#e3e3e0] dark:border-[#3E3E3A] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-9 h-9 bg-[#FF750F] rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/20">
                            <span class="text-white font-bold text-lg">E</span>
                        </div>
                        <span class="hidden sm:block text-xl font-bold dark:text-white tracking-tight italic">Easy<span class="text-[#FF750F]">Coloc</span></span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex font-medium">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="text-sm uppercase tracking-wider {{ request()->routeIs('dashboard') ? 'text-[#FF750F]' : 'dark:text-[#A1A09A]' }}">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <x-nav-link href="#" :active="false" class="text-sm uppercase tracking-wider dark:text-[#A1A09A] hover:text-[#FF750F]">
                        {{ __('Colocations') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="me-4 px-3 py-1 bg-orange-50 dark:bg-orange-500/10 rounded-full border border-orange-100 dark:border-orange-500/20">
                    <span class="text-[10px] font-bold text-[#FF750F] uppercase tracking-tighter">⭐ {{ Auth::user()->reputation_score }} pts</span>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#161615] hover:bg-gray-50 dark:hover:bg-white/5 transition ease-in-out duration-150 shadow-sm border-[#e3e3e0] dark:border-[#3E3E3A]">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-[#1b1b18] dark:bg-[#eeeeec] rounded-full flex items-center justify-center text-white dark:text-[#1b1b18] text-[10px]">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div>{{ Auth::user()->name }}</div>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-[#FF750F]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-2 space-y-1">
                            <x-dropdown-link :href="route('profile.edit')" class="rounded-lg hover:bg-orange-50 dark:hover:bg-orange-500/10 hover:text-[#FF750F]">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="rounded-lg hover:bg-red-50 dark:hover:bg-red-500/10 text-red-500 font-bold">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-[#706f6c] hover:bg-gray-100 dark:hover:bg-[#161615] focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-[#0a0a0a] border-t border-gray-100 dark:border-[#3E3E3A]">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-bold">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-100 dark:border-[#3E3E3A]">
            <div class="px-4 flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-[#FF750F] rounded-full flex items-center justify-center text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div>
                    <div class="font-bold text-base text-[#1b1b18] dark:text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-[#706f6c] dark:text-[#A1A09A]">⭐ {{ Auth::user()->reputation_score }} Points</div>
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