<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    
    protected $fillable = [
        'name',        
        'description', 
        'status',      
    ];

   
   public function users()
{
    return $this->belongsToMany(User::class, 'memberships')
                ->using(Membership::class)
                ->withPivot('role', 'joined_at', 'left_at') 
                ->withTimestamps();
}


public function expenses()
{
    return $this->hasMany(Expense::class);
}
}