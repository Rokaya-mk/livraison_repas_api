<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable=[
        'unique_id_commande',
        'id_user',
        'total',
        'est_payée',
        'status',
        'nom_livreur'
    ];

    public function utilisateur(){
        return $this->belongsTo('App\Models\User');
    }

    public function repas(){
        return $this->belongsToMany('App\Models\Repas');
    }

}
