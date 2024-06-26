<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable=[
    'user_id',
    'methode_paiement',
    'montant',
    'date_paiement',
    'commande_id'
];


    public function utilisateur()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function commande()
    {
        return $this->belongsTo('App\Models\Commande');
    }
}
