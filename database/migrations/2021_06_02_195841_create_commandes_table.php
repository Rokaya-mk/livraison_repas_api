<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("unique_id_commande")->unique();
            $table->unsignedBigInteger('id_user');
            $table->decimal('total', 10, 2);
            $table->boolean('est_payée')->default(false);
            $table->enum('status', ['en attente','en cours','livrée','terminée','annulée','expirée'])->default('en attente');
            $table->string('nom_livreur')->nullable();
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('commandes') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
