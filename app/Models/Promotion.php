<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable=[
        'description_promotion_fr',
        'description_promotion_en',
        'description_promotion_ar',
        'valeur_promotion',
        'type_promotion',
        'active',
        'date_creation',
        'date_experation',

    ];


public function repas()
{
    return $this->hasMany('App\Models\Repas');
}
}
