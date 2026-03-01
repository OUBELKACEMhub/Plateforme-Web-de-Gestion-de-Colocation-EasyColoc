<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
    $activeColocation = Auth::user()->colocations()
        ->with(['users', 'expenses.payer', 'expenses.categorie']) 
        ->where('colocations.status', 'active')
        ->first();

    return view('dashboard', compact('activeColocation'));
}
}
