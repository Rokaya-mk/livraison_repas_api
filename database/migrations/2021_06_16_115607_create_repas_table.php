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
            $table->unsignedBigInteger('categorie_id');
            //$table->unsignedBigInteger('promotion_id')->nullable();
            $table->boolean('recommandee')->default(0);
            $table->boolean('populaire')->default(0);
            $table->boolean('nouveau')->default(1);
            $table->unsignedBigInteger('promotion_id')->nullable();
            $table->timestamps();
            $table->foreign('categorie_id')->references('id')->on('categories')->onUpdate('cascade');
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('set null');
            //$table->foreign('promotion_id') ->references('id')->on('promotions')->onDelete('set null');
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
