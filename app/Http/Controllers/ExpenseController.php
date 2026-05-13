<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Settlement;
use App\Models\Categorie;
use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
   
    public function create()
    {
        $categories = Categorie::all();

        $activeColocation = Auth::user()->colocations()
            ->where('colocations.status', 'active')
            ->first();

        if (!$activeColocation) {
            return redirect()->route('dashboard')->with('error', 'Vous devez faire partie d\'une colocation.');
        }

        return view('expenses.create', compact('categories', 'activeColocation'));
    }

   
    public function store(Request $request) 
{
    $request->validate([
        'title' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'date' => 'required|date',
        'category_id' => 'required',
        'user_id' => 'required|exists:users,id', 
    ]);

    $activeColocation = Auth::user()->colocations()
        ->where('colocations.status', 'active')
        ->first();

    if (!$activeColocation) {
        return redirect()->route('dashboard')->with('error', 'Action non autorisée.');
    }

    $categoryId = $request->category_id;

    if ($categoryId === 'new' && $request->filled('new_category_name')) {
        $category = Categorie::create([
            'name' => $request->new_category_name
        ]);
        $categoryId = $category->id;
    }

    $expense = Expense::create([
        'title' => $request->title,
        'amount' => $request->amount,
        'date' => $request->date,
        'category_id' => $categoryId,
        'colocation_id' => $activeColocation->id, 
        'payer_id' => $request->user_id, 
    ]);

    $this->calculateSplits($expense);

    return redirect()->route('dashboard')->with('success', 'Dépense enregistrée et calcul des parts effectué !');
}



public function calculateSplits(Expense $expense)
{
    $colocation = $expense->colocation;
    $membersCount = $colocation->users()->count();

    if ($membersCount == 0) return;

    $sharePerPerson = $expense->amount / $membersCount;

    foreach ($colocation->users as $member) {
        if ($member->id !== $expense->payer_id) {
            Settlement::create([
                'amount' => $sharePerPerson,
                'debtor_id' => $member->id,    
                'creditor_id' => $expense->payer_id, 
                'colocation_id' => $colocation->id,
                'status' => 'pending',
            ]);
        }
    }
}


}