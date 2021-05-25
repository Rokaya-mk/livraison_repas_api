<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_fr')->unique();
            $table->string('nom_ar')->unique();
            $table->string('nom_en')->unique();
            $table->longText('description_fr');
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->decimal('prix', 10, 2);
            $table->string('image')->nullable();
            $table->integer( 'category_id' )->unsigned();
            $table->boolean('recommandee');
            $table->boolean('populaire');
            $table->boolean('nouveau');
            $table->timestamps();
            $table->foreign('category_id')->references('id') ->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
