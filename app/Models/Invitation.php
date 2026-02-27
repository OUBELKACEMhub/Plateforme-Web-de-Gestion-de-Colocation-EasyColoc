<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Invitation extends Model
{
protected $fillable = [
        'colocation_id',
        'email',
        'token',        
        'expires_at',   
        'sender_id',
        'status',
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}