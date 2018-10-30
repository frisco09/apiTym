<?php

use App\Partido;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\softDeletes;
use Illuminate\Database\Migrations\Migration;

class CreatePartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_resultado')->unsigned()->nullable();
            $table->integer('id_player_1')->unsigned()->nullable();
            $table->integer('id_player_2')->unsigned()->nullable();
            $table->string('modo_partido');
            $table->string('credito_apuesta');
            $table->string('status_game')->default(Partido::PARTIDO_NO_VERIFICADO);
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('resultado_final');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('partidos', function($table) {
            $table->foreign('id_resultado')->references('id')->on('resultados');
            $table->foreign('id_player_1')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partidos');
    }
}