<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->integer('note');
            $table->longText('commentaire');
            $table->unsignedBigInteger('repas_id');
            $table->boolean('date_de_commentaire');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('utilisateurs')->onDelete('cascade');
            $table->foreign('repas_id')->references('id')->on('repas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
}
