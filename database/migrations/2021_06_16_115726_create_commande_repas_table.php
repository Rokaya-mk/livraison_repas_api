<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeRepasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_repas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('repas_id');
            $table->unsignedBigInteger('commande_id');
            $table->decimal('prix', 10, 2);
            $table->integer('quantite')->default(1);
            $table->timestamps();
            $table->foreign('repas_id')->references('id')->on('repas')->onDelete('cascade');
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande_repas');
    }
}
