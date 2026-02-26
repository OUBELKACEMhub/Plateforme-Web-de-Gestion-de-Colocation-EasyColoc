<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{

   public function create()
{
    return view('colocations.create'); 
}
    
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $isAlreadyInActiveColocation = Auth::user()->colocations()
        ->where('colocations.status', 'active') 
        ->exists();

    if ($isAlreadyInActiveColocation) {
        return back()->withErrors(['error' => 'Vous êtes déjà membre d\'une colocation active.']);
    }

        $colocation = Colocation::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'active',
        ]);

        $colocation->users()->attach(Auth::id(), [
            'role' => 'owner',      
            'joined_at' => now(),   
        ]);

        return redirect()->route('dashboard')->with('success', 'Colocation créée avec succès !');
    }
}