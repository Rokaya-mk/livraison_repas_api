<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    protected $fillable=[
    'id_user',
    'note',
    'commentaire',
    'id_repas',
    'date_de_commentaire'
];

    public function utilisateur(){
        return $this->belongsTo('App\Models\User');
    }

    public function repas(){
        return $this->belongsTo('App\Models\Repas');
    }
}
