<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string("nome"); //50
            $table->string("abreviacao"); //3
            $table->integer("posicao"); //inteiro
            $table->unsignedBigInteger("serie_id");//define chave estrangeira
            //serie_id: int
            $table->timestamps();
            //define daonde é a chave estrangeira / fazendo delete cascade
            $table->foreign("serie_id")->references("id")->on("series"); //->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livros');
    }
};
