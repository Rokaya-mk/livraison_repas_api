<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;
    protected $fillable=[
        'description_offre_fr',
        'description_offre_en',
        'description_offre_ar',
        'valeur_offre',
        'type_offre',
        'active',
        'date_creation',
        'date_experation',

    ];


public function repas()
{
    return $this->hasMany('App\Models\Repas');
}
}
