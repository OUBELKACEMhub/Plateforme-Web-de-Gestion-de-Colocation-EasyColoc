<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Invitation;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;
use Illuminate\Support\Facades\DB;

class ColocationController extends Controller
{

public function dashboard()
{
   $activeColocation = Auth::user()->colocations()
    ->where('memberships.status', 'active') 
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

    $invitation = Invitation::create([
        'colocation_id' => $colocation->id,
        'email'         => $request->email,
        'token'         => $token,
        'status'        => 'pending', 
        'expires_at'    => now()->addDays(7),
        'sender_id'     => auth()->id(),
    ]);

    Mail::to($request->email)->send(new InvitationMail($invitation));

    $redirectTo = auth()->user()->role === 'admin' ? route('admin.index') : route('dashboard');
    
    return redirect($redirectTo)->with('success', "L'invitation a été envoyée avec succès !");
}

public function joinparToken(Request $request)
{
    $request->validate([
        'token' => 'required|string',
    ]);

    $invitation = Invitation::where('token', $request->token)->first();

    if (!$invitation) {
        return back()->with('error', 'Token invalide.');
    }

    if ($invitation->expires_at && \Carbon\Carbon::parse($invitation->expires_at)->isPast()) {
        return back()->with('error', 'Ce lien Invitation est expiré.');
    }

    $colocation = Colocation::find($invitation->colocation_id);

    if ($colocation->users()->where('user_id', auth()->id())->exists()) {
        return redirect()->route('dashboard')->with('error', 'Vous êtes déjà membre.');
    }

    auth()->user()->colocations()->updateExistingPivot(
        auth()->user()->colocations()->wherePivot('status', 'active')->pluck('colocations.id'),
        ['status' => 'inactive']
    );

    $colocation->users()->attach(auth()->id(), [
        'role' => 'member',
        'status' => 'active',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect()->route('dashboard')->with('success', 'Bienvenue dans ' . $colocation->name);
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





public function destroy(Colocation $colocation)
{
    
    $role = DB::table('memberships')
        ->where('colocation_id', $colocation->id)
        ->where('user_id', auth()->id())
        ->value('role');

    if ($role !== 'owner') {
        return back()->with('error', 'Action non autorisée. Seul le propriétaire peut supprimer la colocation.');
    }

    try {
        DB::transaction(function () use ($colocation) {
            
            $colocation->users()->detach();
            
            DB::table('invitations')
                ->where('colocation_id', $colocation->id)
                ->delete();

            $colocation->delete();
        });

        return redirect()->route('dashboard')->with('success', 'La colocation a été supprimée avec succès.');

    } catch (\Exception $e) {
        return back()->with('error', 'Une erreur est survenue lors de la suppression de la colocation.');
    }
}



public function leave(Colocation $colocation)
{
    $user = auth()->user();
    
    $isOwner = $colocation->users()
        ->where('user_id', $user->id)
        ->wherePivot('role', 'owner')
        ->exists();

    $nextOwner = null;
    if ($isOwner) {
        $nextOwner = $colocation->users()
            ->where('user_id', '!=', $user->id)
            ->orderBy('memberships.created_at', 'asc') 
            ->first();

        if ($nextOwner) {
            $colocation->users()->updateExistingPivot($nextOwner->id, [
                'role' => 'owner'
            ]);
        }
    } else {
        $nextOwner = $colocation->users()
            ->wherePivot('role', 'owner')
            ->first();
    }

    Settlement::where('colocation_id', $colocation->id)
        ->where('creditor_id', $user->id)
        ->where('status', 'pending')
        ->update(['creditor_id' => $nextOwner ? $nextOwner->id : $user->id]);

    $myDebts = Settlement::where('colocation_id', $colocation->id)
        ->where('debtor_id', $user->id)
        ->where('status', 'pending')
        ->sum('amount');

    if ($myDebts > 0) {
        $user->decrement('reputation_score', 1);
    } else {
        $user->increment('reputation_score', 1);
    }

    $colocation->users()->detach($user->id);
    
    if ($colocation->users()->count() == 0) {
        $colocation->delete();
    }

    return redirect()->route('dashboard')->with('success', 'Vous avez quitté la colocation. Vos crédits ont été transférés au responsable.');
}

}