<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();;
            $table->string('user_psp');
            $table->string('name',50)->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('status')->default(User::USUARIO_INACTIVO);
            $table->string('credito')->nullable();
            $table->string('verified')->dafault(User::USUARIO_NO_VERIFICADO);
            $table->string('verification_token')->nullable($value = true);
            $table->string('user_img_pr')->default('user_df.png');;
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
