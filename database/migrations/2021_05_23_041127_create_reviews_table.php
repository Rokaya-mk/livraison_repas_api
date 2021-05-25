<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('note');
            $table->longText('commentaire');
            $table->integer('food_id')->unsigned();
            $table->boolean('date_enregistree');
            $table->timestamps();
            $table->foreign('user_id')->references('id') ->on('users')->onDelete('cascade');
            $table->foreign('food_id')->references('id') ->on('foods')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
