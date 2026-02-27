@php
    $layout = Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app';
@endphp

@extends($layout)

@section('content')
    <div class="{{ Auth::user()->role !== 'admin' ? 'py-12 px-4' : '' }}">
        
        <x-join-coloc-form />

    </div>
@endsection