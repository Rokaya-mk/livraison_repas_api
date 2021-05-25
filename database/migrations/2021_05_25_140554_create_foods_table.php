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
            $table->string('nom')->unique();
            $table->longText('description');
            $table->decimal('prix', 10, 2);
            $table->string('image');
            $table->integer('category_id')->unsigned();
            $table->integer('offer_id')->unsigned()->nullable();
            $table->boolean('recommandee')->default(0);
            $table->boolean('populaire')->default(0);
            $table->boolean('nouveau')->default(1);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('offer_id')
                    ->references('id')
                    ->on('offers')
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
        Schema::dropIfExists('foods');
    }
}
