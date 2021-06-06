<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    protected $fillable=[
    'user_id',
    'note',
    'commentaire',
    'repas_id',
    'date_de_commentaire'
];

    public function utilisateur(){
        return $this->belongsTo('App\Models\User');
    }

    public function repas(){
        return $this->belongsTo('App\Models\Repas');
    }
}
