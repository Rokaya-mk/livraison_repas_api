<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Adresse extends Model
{
    use HasFactory;
    protected $fillable=[
        'adresse1',
        'adresse2',
        'ville',
        'code_postal',
        'id_user'
    ];

    public function utilisateur(){
        return $this->belongsTo('App\Models\User');
    }
}
