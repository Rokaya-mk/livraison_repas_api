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
            ['nom_fr'=>'Pizza MARGHERITA', 'nom_en' => 'Pizza MARGHERITA', 'nom_ar' => 'بيتزا ماكريتا',
            'description_fr' => 'Mozzarella et sauce tomate aux herbes', 'description_en' => 'Mozzarella and Tomato Sauce with Herbs', 'description_ar' => 'موزاريلا وصلصة الطماطم مع الأعشاب',
            'prix'=>70,'image' =>'' ,'stock'=>30 ,'categorie_id'=>1 ,'recommandee'=>0 ,'populaire'=>0,'nouveau'=>0,
             'promotion_id'=>1,'created_at' => $now, 'updated_at' => $now
             ],
             ['nom_fr'=>'Jus de Citron', 'nom_en' => 'Lemon Juice Ginger and Mint', 'nom_ar' => 'عصير الليمون',
            'description_fr' => 'Jus de Citron Gingembre et Menthe', 'description_en' => 'Mozzarella and Tomato Sauce with Herbs',
             'description_ar' => 'عصير الليمون الزنجبيل والنعناع',
            'prix'=>30,'image' =>'' ,'stock'=>60 ,'categorie_id'=>2 ,'recommandee'=>0 ,'populaire'=>0,'nouveau'=>1,
             'promotion_id'=>null,'created_at' => $now, 'updated_at' => $now
             ],
             ['nom_fr'=>'Jus B.K.A', 'nom_en' => 'Jus B.K.A', 'nom_ar' => '  B.K.A عصير',
            'description_fr' => 'Bananes, kiwi et ananas', 'description_en' => 'Bananas, kiwi and pineapple', 'description_ar' => 'الموز ,الكيوي والأناناس',
            'prix'=>70,'image' =>'' ,'stock'=>30 ,'categorie_id'=>2 ,'recommandee'=>0 ,'populaire'=>0,'nouveau'=>0,
             'promotion_id'=>1,'created_at' => $now, 'updated_at' => $now
             ],
             ['nom_fr'=>'Salade Caprese', 'nom_en' => 'caprese salad', 'nom_ar' => 'سلطة كابريس',
            'description_fr' => 'Mesclun de salade, tomate, mozzarella, basilic, crème pesto',
             'description_en' => 'Salad greens, tomato, mozzarella, basil, pesto cream', 'description_ar' => 'سلطة خضراء ، طماطم ، موزاريلا ، بيستو كريم',
            'prix'=>100,'image' =>'' ,'stock'=>20 ,'categorie_id'=>3 ,'recommandee'=>0 ,'populaire'=>0,'nouveau'=>0,
             'promotion_id'=>3,'created_at' => $now, 'updated_at' => $now
             ],
             ['nom_fr'=>'Cheeseburger', 'nom_en' => 'Cheeseburger', 'nom_ar' => '  برجر بالجبن',
            'description_fr' => 'Du fromage fondu sur une viande de bœuf grillée à la flamme. Légendaire.',
             'description_en' => 'melted cheese on flame-grilled beef. Legendary. ',
              'description_ar' => 'الجبن المطبوخ على اللحم المشوي باللهب. الأسطوري.              ',
            'prix'=>40,'image' =>'' ,'stock'=>30 ,'categorie_id'=>4 ,'recommandee'=>0 ,'populaire'=>0,'nouveau'=>0,
             'promotion_id'=>null,'created_at' => $now, 'updated_at' => $now
             ],
        ]);
    }
}
