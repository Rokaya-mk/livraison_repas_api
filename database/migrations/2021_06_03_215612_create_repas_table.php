<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_fr')->unique();
            $table->string('nom_en')->nullable();
            $table->string('nom_ar')->nullable();
            $table->longText('description_fr');
            $table->longText('description_en')->nullable();
            $table->longText('description_ar')->nullable();
            $table->decimal('prix', 10, 2);
            $table->string('image');
            $table->bigInteger('stock');
            $table->unsignedBigInteger('id_categorie');
            $table->unsignedBigInteger('id_offre')->nullable();
            $table->boolean('recommandee')->default(0);
            $table->boolean('populaire')->default(0);
            $table->boolean('nouveau')->default(1);
            $table->timestamps();
            $table->foreign('id_categorie')->references('id')->on('categories')->onUpdate('cascade');
            $table->foreign('id_offre')
                    ->references('id')
                    ->on('offres')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repas');
    }
}
