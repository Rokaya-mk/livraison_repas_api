<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomnsToOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('type_offre')->default('POURCENTAGE')->after('valeur_offre');
            $table->dateTime('date_creation')->after('active');
            $table->dateTime('date_experation')->after('date_creation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('type_offre');
            $table->dropColumn('date_creation');
            $table->dropColumn('date_experation');
        });
    }
}
