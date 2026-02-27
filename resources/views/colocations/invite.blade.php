@php
    $layout = Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app';
@endphp

@extends($layout)

@section('content')
    <div class="{{ Auth::user()->role !== 'admin' ? 'py-12 px-4 max-w-2xl mx-auto' : 'max-w-2xl mx-auto py-6' }}">
        
        <x-invite-member-form :colocation="$colocation" />

    </div>
@endsection