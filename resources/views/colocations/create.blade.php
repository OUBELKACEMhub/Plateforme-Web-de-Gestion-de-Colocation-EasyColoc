@extends('layouts.app')

@section('content')
    <div class="{{ Auth::user()->is_global_admin ? 'sm:ml-72 py-10 px-6' : 'py-12 px-4 max-w-7xl mx-auto' }}">
        
        <div class="max-w-xl mx-auto">
            {{-- Header sghir bach l-admin y-3ref fin rah --}}
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-black text-white italic uppercase tracking-tighter">
                    Lancer un <span class="text-[#FF750F]">Espace</span>
                </h1>
                <p class="text-slate-500 text-sm italic mt-2">Créez votre colocation et commencez à gérer vos dépenses.</p>
            </div>

            <div class="bg-[#151515] p-8 rounded-[2.5rem] border border-white/5 shadow-2xl">
                <x-create-coloc-form />
            </div>
        </div>

    </div>
@endsection