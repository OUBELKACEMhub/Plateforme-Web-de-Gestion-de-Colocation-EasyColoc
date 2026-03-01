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

    $alreadyMember = DB::table('memberships')
        ->where('colocation_id', $invitation->colocation_id)
        ->where('user_id', auth()->id())
        ->whereNull('left_at') 
        ->exists();

    if ($alreadyMember) {
        $invitation->update(['status' => 'accepted']); 
        return redirect()->route('dashboard')->with('info', "Vous êtes déjà membre de cette colocation.");
    }

    try {
        DB::transaction(function () use ($invitation) {
            $invitation->update(['status' => 'accepted']);

            DB::table('memberships')->insert([
                'colocation_id' => $invitation->colocation_id,
                'user_id'       => auth()->id(),
                'role'          => 'Membre',
                'status'        => 'active', // تأكد من إضافة الـ status اللي صلحنا قبيلة
                'joined_at'     => now(),
                'created_at'    => now(), 
                'updated_at'    => now(), 
            ]);

            
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