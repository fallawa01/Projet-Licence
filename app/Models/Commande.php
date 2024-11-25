<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id', 'burger_id', 'etat', 'date_commande', 'montant', 'quantite',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function burger()
    {
        return $this->belongsTo(Burger::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}
