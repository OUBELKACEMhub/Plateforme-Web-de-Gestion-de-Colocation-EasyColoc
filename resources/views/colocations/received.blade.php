@php
    $layout = Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app';
@endphp

@extends($layout)

@section('content')
    
    <div class="{{ Auth::user()->role !== 'admin' ? 'py-12 px-4 max-w-7xl mx-auto' : '' }}">
        
      
        <x-invitations-list :invitations="$receivedInvitations" />

    </div>
@endsection