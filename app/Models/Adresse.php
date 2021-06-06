<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Adresse extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'adresse1',
        'adresse2',
        'code_postal',

    ];

    public function utilisateur(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
