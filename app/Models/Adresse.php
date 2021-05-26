<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;
    protected $fillable=[
        'adresse1',
        'adresse2',
        'ville',
        'code_postal',
        'user_id'
    ];
}
