<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(15)->create();
        $this->call(CategorieTableSeeder::class);
        $this->call(PromotionSeeder::class);
        $this->call(RepasSeeder::class);
    }
}
