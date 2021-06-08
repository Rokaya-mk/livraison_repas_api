<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Repas extends Model
{

    use HasFactory;
    public $table='repas';
    protected $fillable=[
        'nom_fr',
        'nom_en',
        'nom_ar',
        'description_fr',
        'description_en',
        'description_ar',
        'prix',
        'image',
        'stock',
        'categorie_id',
        'offre_id',
        // 'recommandee',
        // 'populaire',
        // 'nouveau'

    ];


    public function getNomAttribute()
    {
        $locale = App::getLocale();
        $column = "nom_" . $locale;
        return $this->{$column};
    }
    public function getDescriptionAttribute()
    {
        $locale = App::getLocale();
        $column = "description_" . $locale;
        return $this->{$column};
    }

    public function categorie(){
        return $this->belongsTo('App\Models\Categorie');
    }

    public function commentaire()
    {
        return $this->hasMany('App\Models\Commentaire');
    }

    public function offre(){
        return $this->belongsTo('App\Models\Offre');
    }

    public function commandes(){
        return $this->belongsToMany('App\Models\Commande');
    }
}
