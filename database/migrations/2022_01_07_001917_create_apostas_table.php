<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apostas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('price_id');
            $table->unsignedBigInteger('concurso_id');
            $table->json('numeros');
            $table->integer('codigo');
            $table->boolean('premiado')->nullable();
            $table->integer('pontos')->nullable();

            $table->foreign('price_id')
                    ->references('id')
                    ->on('prices')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->foreign('concurso_id')
                    ->references('id')
                    ->on('concursos')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apostas');
    }
}
