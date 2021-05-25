<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string("unique_order_id")->unique();
            $table->integer( 'user_id' )->unsigned();
            $table->decimal('total', 10, 2);
            $table->string('status')->default('en_attente');
            $table->string('nom_livreur')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
