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
        'nom',
        'description',
        'prix',
        'image',
        'stock',
        'categorie_id',
        'promotion_id',
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

    public function promotion(){
        return $this->belongsTo('App\Models\Promotion');
    }

    public function commandes(){
        return $this->belongsToMany('App\Models\Commande')->withTimestamps();
    }
}
