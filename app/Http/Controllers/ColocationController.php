<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Invitation;
use Illuminate\Support\Facades\DB;

class ColocationController extends Controller
{

public function dashboard()
{
    $activeColocation = Auth::user()->colocations()
        ->where('status', 'active') 
        ->with('users')
        ->first();

    return view('dashboard', compact('activeColocation'));
}

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



public function showInviteForm(Colocation $colocation)
{
    return view('colocations.invite', compact('colocation'));
}

public function sendInvitation(Request $request, Colocation $colocation)
{
    $request->validate([
        'email' => 'required|email|max:255'
    ]);

    $exists = Invitation::where('colocation_id', $colocation->id)
                        ->where('email', $request->email)
                        ->where('status', 'pending')
                        ->exists();

    if ($exists) {
        return back()->withErrors(['email' => 'Une invitation est déjà en cours pour cet email.']);
    }

    $token = Str::random(32);

    Invitation::create([
        'colocation_id' => $colocation->id,
        'email'         => $request->email,
        'token'         => $token,
        'expires_at'    => now()->addDays(7),
        'sender_id'     => auth()->id(),
    ]);

    $redirectTo = auth()->user()->role === 'admin' ? route('admin.index') : route('dashboard');

    return redirect($redirectTo)->with('success', "L'invitation a été envoyée avec succès !");
}





public function join(Request $request)
{
    $request->validate([
        'invite_token' => 'required|string'
    ]);

    $invitation = DB::table('invitations')
        ->where('token', $request->invite_token)
        ->where('email', auth()->user()->email)
        ->where('status', 'pending')
        ->first();

    if (!$invitation) {
        return back()->with('error', "Invitation introuvable ou déjà utilisée.");
    }

    $colocation = \App\Models\Colocation::findOrFail($invitation->colocation_id);

    DB::transaction(function () use ($invitation, $colocation) {
        DB::table('invitations')
            ->where('id', $invitation->id)
            ->update(['status' => 'accepted']);

        DB::table('memberships')->insert([
            'colocation_id' => $colocation->id,
            'user_id'       => auth()->id(),
            'role'          => 'Membre',
            'joined_at'     => now(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        DB::table('users')
            ->where('id', $invitation->sender_id)
            ->increment('reputation_score', 50);
    });

    return redirect()->route('dashboard')->with('success', "Félicitations ! Vous avez rejoint {$colocation->name}.");
}

public function removeMember(Colocation $colocation, User $user)
{
    $currentUserRole = DB::table('memberships')
        ->where('colocation_id', $colocation->id)
        ->where('user_id', auth()->id())
        ->value('role');

    if ($currentUserRole !== 'owner') {
        return back()->with('error', 'Action non autorisée.');
    }

    $colocation->users()->detach($user->id);

    return back()->with('success', "Le membre {$user->name} a été retiré de la colocation.");
}

}