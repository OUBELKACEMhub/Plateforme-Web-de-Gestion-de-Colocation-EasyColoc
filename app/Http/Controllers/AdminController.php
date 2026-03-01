<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\User;
use App\Models\Colocation;
use App\Models\Membership;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   
    public function index()
    {
        $stats = [
            'users_count' => User::count(),
            'colocations_count' => Colocation::count(),
            'active_memberships' => Membership::whereNull('left_at')->count(), 
        ];

        $top_users = User::orderByDesc('reputation_score')
                     ->where('reputation_score', '>', 0) // Ghir li 3ndhom scores
                     ->limit(5)
                     ->get();
        $recent_activities = Expense::with('payer')
        ->orderByDesc('created_at')
        ->limit(10)
        ->get();             

        return view('admin.dashboard', compact('stats', 'top_users', 'recent_activities'));
    }

    public function users()
    {
        $users = User::where('role', '!=', 'admin')
             ->orderBy('created_at', 'desc')
             ->get();
        return view('admin.users', compact('users'));
    }

    
    public function toggleBan(User $user)
    {
    
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas vous bannir !');
        }

        $user->update([
            'is_banned' => !$user->is_banned 
        ]);

        return back()->with('success', 'Statut de l\'utilisateur mis à jour.');
    }
}