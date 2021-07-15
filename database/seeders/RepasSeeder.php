<?php

namespace Database\Seeders;

use App\Models\Repas;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RepasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Repas::insert([
            ['nom'=>'Pizza MARGHERITA',
            'description' => 'Mozzarella et sauce tomate aux herbes',
            'prix'=>70,'image' =>'pizza-3000274_640.jpg' ,'stock'=>30 ,'categorie_id'=>1 ,
            // 'recommandee'=>0 ,'populaire'=>0,'nouveau'=>0,
             'promotion_id'=>1,'created_at' => $now, 'updated_at' => $now
             ],
             ['nom'=>'Jus de Citron',
            'description' => 'Jus de Citron Gingembre et Menthe',
            'prix'=>30,'image' =>'juice-3175117_640.jpg' ,'stock'=>60 ,'categorie_id'=>2 ,
            // 'recommandee'=>0 ,'populaire'=>0,'nouveau'=>1,
             'promotion_id'=>null,'created_at' => $now, 'updated_at' => $now
             ],
             ['nom'=>'Jus B.K.A',
            'description' => 'Bananes, kiwi et ananas',
            'prix'=>70,'image' =>'yogurt-3580383_640.jpg' ,'stock'=>30 ,'categorie_id'=>2 ,
            // 'recommandee'=>0 ,'populaire'=>0,'nouveau'=>0,
             'promotion_id'=>1,'created_at' => $now, 'updated_at' => $now
             ],
             ['nom'=>'Salade Caprese',
            'description' => 'Mesclun de salade, tomate, mozzarella, basilic, crème pesto',
            'prix'=>100,'image' =>'salad-5904093_640.jpg' ,'stock'=>20 ,'categorie_id'=>3 ,
            // 'recommandee'=>0 ,'populaire'=>0,'nouveau'=>0,
             'promotion_id'=>3,'created_at' => $now, 'updated_at' => $now
             ],
             ['nom'=>'Cheeseburger',
            'description' => 'Du fromage fondu sur une viande de bœuf grillée à la flamme. Légendaire.',
            'prix'=>40,'image' =>'barbeque-1239407_640.jpg' ,'stock'=>30 ,'categorie_id'=>4 ,
            // 'recommandee'=>0 ,'populaire'=>0,'nouveau'=>0,
             'promotion_id'=>null,'created_at' => $now, 'updated_at' => $now
             ],
        ]);
    }
}
