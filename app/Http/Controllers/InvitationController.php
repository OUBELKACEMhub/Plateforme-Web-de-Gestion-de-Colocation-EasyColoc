<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvitationController extends Controller
{
   
    public function receivedInvitations()
    {
        $receivedInvitations = Invitation::where('email', Auth::user()->email)
            ->where('status', 'pending') 
            ->with(['sender', 'colocation'])
            ->latest()
            ->get();

        return view('colocations.received', compact('receivedInvitations'));
    }

 
   public function accept(Invitation $invitation)
{
    if ($invitation->email !== auth()->user()->email) {
        return back()->with('error', "Cette invitation ne vous est pas destinée.");
    }

    if ($invitation->status !== 'pending') {
        return back()->with('error', "Cette invitation a déjà été traitée.");
    }

    try {
        DB::transaction(function () use ($invitation) {
            $invitation->update(['status' => 'accepted']);

            DB::table('memberships')->insert([
    'colocation_id' => $invitation->colocation_id,
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

        return redirect()->route('dashboard')->with('success', "Félicitations ! Vous avez rejoint la colocation.");

    } catch (\Exception $e) {
        return back()->with('error', "Une erreur est survenue lors de l'acceptation.");
    }
}
  
    public function reject(Invitation $invitation)
    {
        if ($invitation->email !== Auth::user()->email) {
            abort(403, 'Action non autorisée.');
        }

        $invitation->update([
            'status' => 'rejected'
        ]);

        return back()->with('info', 'Invitation refusée.');
    }
}