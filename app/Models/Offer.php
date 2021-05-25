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
        'active'
    ];


public function foods()
{
    return $this->hasMany('App\Models\Food');
}
}
