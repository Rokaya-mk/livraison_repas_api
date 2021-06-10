<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Categorie::insert([
            ['nom_fr' => 'Pizza', 'nom_en' => 'Pizza','nom_ar' => 'البيتزا',
            'description_fr' =>'c\'est Pizza categorie','description_en' =>'This is Pizza category','description_ar' =>'هذه قائمة البيتزا',
            'image_c' => '56576085640.png', 'created_at' => $now, 'updated_at' => $now],

            ['nom_fr' => 'jus', 'nom_en' => 'Drinks','nom_ar' => 'العصائر',
            'description_fr' =>'c\'est jus categorie','description_en' =>'This is Drinks category','description_ar' =>'هذه قائمة العصائر',
            'image_c' => '3758181640.png', 'created_at' => $now, 'updated_at' => $now],

            ['nom_fr' => 'Salades', 'nom_en' => 'Salad','nom_ar' => 'السلطات',
            'description_fr' =>'c\'est Salades categorie','description_en' =>'This is Salad category','description_ar' =>'هذه قائمة السلطات',
            'image_c' => '162315562284.png', 'created_at' => $now, 'updated_at' => $now],

            ['nom_fr' => 'Burger', 'nom_en' => 'Burger','nom_ar' => 'البرغر',
            'description_fr' =>'c\'est Burger categorie','description_en' =>'This is Burger category','description_ar' =>'هذه قائمة البرغر',
            'image_c' => '34334314640.png', 'created_at' => $now, 'updated_at' => $now],


        ]);
    }
}
