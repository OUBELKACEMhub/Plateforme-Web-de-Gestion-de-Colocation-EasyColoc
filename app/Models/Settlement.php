<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected $fillable = ['amount', 'debtor_id', 'creditor_id', 'colocation_id', 'status'];

    public function creditor() {
        return $this->belongsTo(User::class, 'creditor_id');
    }

    public function debtor() {
        return $this->belongsTo(User::class, 'debtor_id');
    }

    public function colocation() {
        return $this->belongsTo(Colocation::class);
    }
}