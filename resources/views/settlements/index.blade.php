@extends('layouts.app')

@section('content')
<div class="w-full min-h-screen bg-[#0F0F0F] text-white py-10 px-6 lg:px-12 space-y-12">
    
    {{-- Header --}}
    <div class="border-b border-white/5 pb-10 flex justify-between items-end">
        <div>
            <h1 class="text-4xl font-black tracking-tighter uppercase italic text-white">
                Qui doit à <span class="text-[#FF750F]">qui ?</span>
            </h1>
            <p class="text-slate-500 italic text-sm mt-2 uppercase font-bold tracking-widest">
                Colocation : {{ $activeColocation->name }}
            </p>
        </div>
        <div class="text-right">
            <p class="text-[10px] font-black text-slate-500 uppercase italic">Votre bilan personnel</p>
            @php
                $myCredits = $settlements->where('creditor_id', auth()->id())->where('status', 'pending')->sum('amount');
                $myDebts = $settlements->where('debtor_id', auth()->id())->where('status', 'pending')->sum('amount');
                $balance = $myCredits - $myDebts;
            @endphp
            <p class="text-3xl font-black italic {{ $balance >= 0 ? 'text-emerald-500' : 'text-red-500' }}">
                {{ $balance >= 0 ? '+' : '' }}{{ number_format($balance, 2) }} <span class="text-xs">MAD</span>
            </p>
        </div>
    </div>

    {{-- Settlements List --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($settlements as $settlement)
            @php
                $isMeDebtor = auth()->id() === $settlement->debtor_id;
                $isMeCreditor = auth()->id() === $settlement->creditor_id;
            @endphp

            <div class="bg-[#151515] p-8 rounded-[2.5rem] border {{ $isMeDebtor ? 'border-red-500/30' : ($isMeCreditor ? 'border-emerald-500/30' : 'border-white/5') }} relative overflow-hidden shadow-2xl animate-slide-up group">
                
                {{-- Background Glow for My Settlements --}}
                @if($isMeDebtor) <div class="absolute -right-10 -top-10 w-32 h-32 bg-red-500/5 blur-3xl rounded-full"></div> @endif
                @if($isMeCreditor) <div class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-500/5 blur-3xl rounded-full"></div> @endif

                <div class="flex justify-between items-start mb-8 relative z-10">
                    <span class="px-4 py-1.5 text-[8px] font-black rounded-full uppercase italic {{ $settlement->status === 'paid' ? 'bg-slate-800 text-slate-400' : ($isMeDebtor ? 'bg-red-500/10 text-red-500' : 'bg-emerald-500/10 text-emerald-500') }}">
                        ● {{ $settlement->status }}
                    </span>
                    
                    <div class="text-right">
                        <p class="text-[24px] font-black italic tracking-tighter {{ $isMeDebtor ? 'text-red-500' : ($isMeCreditor ? 'text-emerald-500' : 'text-white') }}">
                            {{ $isMeDebtor ? '-' : ($isMeCreditor ? '+' : '') }}{{ number_format($settlement->amount, 2) }}
                            <span class="text-[10px] ml-1">MAD</span>
                        </p>
                        <p class="text-[8px] font-black uppercase text-slate-600 italic tracking-widest">
                            {{ $isMeDebtor ? 'À VOUS DE PAYER' : ($isMeCreditor ? 'VOUS ALLEZ RECEVOIR' : 'TRANSFERT GROUPE') }}
                        </p>
                    </div>
                </div>

                {{-- People Involved --}}
                <div class="space-y-4 relative z-10 mb-8">
                    <div class="flex items-center justify-between p-3 rounded-2xl {{ $isMeDebtor ? 'bg-red-500/5' : 'bg-white/[0.02]' }}">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-red-500/10 flex items-center justify-center text-red-500 font-black text-[10px] italic border border-red-500/20">D</div>
                            <span class="text-sm font-bold {{ $isMeDebtor ? 'text-white' : 'text-slate-400' }}">{{ $isMeDebtor ? 'Moi' : $settlement->debtor->name }}</span>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-2xl {{ $isMeCreditor ? 'bg-emerald-500/5' : 'bg-white/[0.02]' }}">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-500 font-black text-[10px] italic border border-emerald-500/20">C</div>
                            <span class="text-sm font-bold {{ $isMeCreditor ? 'text-white' : 'text-slate-400' }}">{{ $isMeCreditor ? 'Moi' : $settlement->creditor->name }}</span>
                        </div>
                    </div>
                </div>

                {{-- Action: Ghir moul l-flouss li i-confirmi --}}
                @if($settlement->status === 'pending' && $isMeCreditor)
                    <form action="{{ route('settlements.pay', $settlement) }}" method="POST">
                        @csrf @method('PATCH')
                        <button class="w-full py-4 bg-emerald-500 hover:bg-emerald-400 text-[#0F0F0F] rounded-2xl font-black uppercase italic text-[10px] transition-all shadow-lg shadow-emerald-500/10 active:scale-95">
                            J'ai reçu l'argent
                        </button>
                    </form>
                @elseif($settlement->status === 'pending' && $isMeDebtor)
                    <div class="w-full py-4 bg-white/5 border border-white/10 rounded-2xl text-center">
                        <p class="text-[9px] font-black text-slate-500 uppercase italic">Contactez {{ $settlement->creditor->name }} pour payer</p>
                    </div>
                @endif
            </div>
        @empty
            <div class="col-span-full py-20 text-center bg-white/[0.01] rounded-[3rem] border border-dashed border-white/5">
                <p class="text-slate-600 font-black italic uppercase text-xs tracking-[0.3em]">Aucune transaction en cours.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection