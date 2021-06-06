<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description_offre_fr')->unique();
            $table->string('description_offre_en')->nullable();
            $table->string('description_offre_ar')->nullable();
            $table->decimal('valeur_offre',8,2);
            $table->enum('type_offre',['Percent','fix']);
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
        Schema::dropIfExists('offres');
    }
}
