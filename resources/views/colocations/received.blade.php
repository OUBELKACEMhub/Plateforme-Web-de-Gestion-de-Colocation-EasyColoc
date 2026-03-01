@extends('layouts.app') 

@section('content') 
    <div class="py-12 px-4 max-w-7xl mx-auto">
        <x-invitations-list :invitations="$receivedInvitations" />
    </div>
@endsection 