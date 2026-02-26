<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Membership extends Pivot
{

    protected $table = 'memberships';
    
 
    protected $fillable = [
        'user_id',
        'colocation_id',
        'joined_at', 
        'left_at',   
        'role',      
    ];

 
    protected $casts = [
        'joined_at' => 'datetime', 
        'left_at' => 'datetime',   
    ];

   
    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}