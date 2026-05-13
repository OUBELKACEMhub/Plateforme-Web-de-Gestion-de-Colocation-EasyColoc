<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Settlement;
use App\Models\Categorie;
use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettlementController extends Controller
{
   public function index()
{
    $activeColocation = Auth::user()->colocations()
    ->with(['users', 'expenses']) 
    ->first();

    if (!$activeColocation) {
        return redirect()->route('dashboard')->with('error', 'Aucune colocation active détectée.');
    }

    $settlements = Settlement::where('colocation_id', $activeColocation->id)
        ->whereColumn('debtor_id', '!=', 'creditor_id') 
        ->where('status', 'pending')
        ->with(['debtor', 'creditor'])
        ->get();

    return view('settlements.index', compact('settlements', 'activeColocation'));
}

public function pay(Settlement $settlement)
{
    if (auth()->id() !== $settlement->creditor_id) {
        return back()->with('error', 'Action non autorisée.');
    }

    $settlement->update(['status' => 'paid']);
    return back()->with('success', 'Règlement confirmé !');
}
}
