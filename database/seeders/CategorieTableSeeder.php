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
            ['nom' => 'Pizza',
            'description_c' =>'c\'est Pizza categorie',
            'image_c' => '56576085640.png', 'created_at' => $now, 'updated_at' => $now],

            ['nom_fr' => 'jus',
            'description_c' =>'c\'est jus categorie',
            'image_c' => '3758181640.png', 'created_at' => $now, 'updated_at' => $now],

            ['nom_fr' => 'Salades',
            'description_c' =>'c\'est Salades categorie',
            'image_c' => '162315562284.png', 'created_at' => $now, 'updated_at' => $now],

            ['nom_fr' => 'Burger',
            'description_c' =>'c\'est Burger categorie',
            'image_c' => '34334314640.png', 'created_at' => $now, 'updated_at' => $now],


        ]);
    }
}
