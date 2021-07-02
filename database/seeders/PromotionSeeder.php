<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Promotion::insert([
            ['description_promotion' => 'reduction 10 pourcent',
              'valeur_promotion' =>10
            ,'type_promotion' =>'Percent','active' =>1,
            'date_creation' =>Carbon::createFromFormat('Y-m-d H:i:s', '2021-06-16 23:59:00'),'date_experation'=>Carbon::createFromFormat('Y-m-d H:i:s', '2021-07-16 23:59:00'),
             'created_at' => $now, 'updated_at' => $now],

             ['description_promotion' => 'reduction 20 pourcent',
              'valeur_promotion' =>20
             ,'type_promotion' =>'Percent','active' =>0,
             'date_creation' =>Carbon::createFromFormat('Y-m-d H:i:s','2021-06-30 23:59:00'),'date_experation'=>Carbon::createFromFormat('Y-m-d H:i:s', '2021-07-30 23:59:00'),
              'created_at' => $now, 'updated_at' => $now],

           ['description_promotion' => 'reduction 50 dh',
             'valeur_promotion' =>50
            ,'type_promotion' =>'fix','active' =>1,
            'date_creation' =>Carbon::createFromFormat('Y-m-d H:i:s', '2021-06-16 23:59:00') ,'date_experation'=>Carbon::createFromFormat('Y-m-d H:i:s','2021-08-30 23:59:00'),
             'created_at' => $now, 'updated_at' => $now],




        ]);
    }
}
