<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description_promotion_fr')->unique();
            $table->string('description_promotion_en')->nullable();
            $table->string('description_promotion_ar')->nullable();
            $table->decimal('valeur_promotion',8,2);
            $table->enum('type_promotion',['Percent','fix']);
            $table->boolean('active');
            $table->dateTime('date_creation');
            $table->dateTime('date_experation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
