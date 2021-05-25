<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_food', function (Blueprint $table) {
            $table->increments('id');
            $table->integer( 'food_id' )->unsigned();
            $table->integer( 'order_id' )->unsigned();
            $table->decimal('prix', 10, 2);
            $table->integer('quantite')->default(1);
            $table->string('size');
            $table->timestamps();
            $table->foreign('food_id')->references('id')->on('foods') ->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_food');
    }
}
