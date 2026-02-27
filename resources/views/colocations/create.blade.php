@php
    $layout = Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app';
@endphp

@extends($layout)

@section('content')

    <div class="{{ Auth::user()->role !== 'admin' ? 'py-12 px-4 max-w-7xl mx-auto' : 'py-6' }}">
        
        <div class="max-w-lg mx-auto">
            {{-- L-Component dial l-form li sawbna --}}
            <x-create-coloc-form />
        </div>

    </div>
@endsection