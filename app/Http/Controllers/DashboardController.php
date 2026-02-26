<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $activeColocation = auth()->user()->colocations()
        ->wherePivotNull('left_at')
        ->with(['users' => function($query) {
            $query->withPivot('role', 'joined_at');
        }])
        ->first();

    return view('dashboard', compact('activeColocation'));
}
}
