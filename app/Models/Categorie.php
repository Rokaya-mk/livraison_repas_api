<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom',
        'description_c',
        'image_c',

    ];

    public function repas(){
        return $this->hasMany('App\Models\Repas');
    }
}
