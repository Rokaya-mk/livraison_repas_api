<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeRepas extends Model
{
    use HasFactory;

    protected $fillable=[
        'repas_id',
        'commande_id',
        'prix',
        'quantite'
    ];
}
