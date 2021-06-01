<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable=[
        'description_offre',
        'valeur_offre',
        'type_offre',
        'active',
        'date_creation',
        'date_experation',

    ];


public function foods()
{
    return $this->hasMany('App\Models\Food');
}
}
