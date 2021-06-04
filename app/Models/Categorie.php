<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom_fr',
        'nom_en',
        'nom_ar',
        'description_fr',
        'description_en',
        'description_ar',
        'image_c',

    ];

    public function repas(){
        return $this->hasMany('App\Models\Repas');
    }
}
