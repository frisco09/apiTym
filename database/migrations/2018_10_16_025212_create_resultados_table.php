<?php

use App\Resultado;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\softDeletes;
use Illuminate\Database\Migrations\Migration;

class CreateResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultados', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('goles_user_1')->nullable();
            $table->string('goles_user_2')->nullable();
            $table->integer('id_player_load')->unsigned();
            $table->string('player_win')->nullable();
            $table->string('certificacion')->nullable();
            $table->string('estado_partido')->default(Resultado::PARTIDO_NO_VERIFICADO);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('resultados', function($table) {
            $table->foreign('id_player_load')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultados');
    }
}
