<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->enum('methode_paiement',['paiement_a_livraison','paypal','stripe','carte_crédit'])->default('paiement_a_livraison');
            $table->decimal('montant', 10, 2);
            $table->dateTime('date_paiement');
            $table->unsignedBigInteger('commande_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('utilisateurs')->onDelete('cascade');
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
        Schema::dropIfExists('paiements');
    }
}
