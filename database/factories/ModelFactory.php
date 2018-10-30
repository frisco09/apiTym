<?php

use App\Role;
use App\User;
use App\Partido;
use App\Resultado;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker $faker) {
    static $password;
    return [
        'user_psp' =>$faker->numberBetween(100,500),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->PhoneNumber,
        'password' => $password ?: $password = 'secret',
        'status' => $status = $faker->randomElement([User::USUARIO_ACTIVO,User::USUARIO_INACTIVO]),
        'credito' =>$credito = $faker->numberBetween(10,500),
		'user_img_pr'=>$faker->randomElement(['user_df.png','user_w_df.png']),
        'verified'=>$verificado = $faker-> randomElement([User::USUARIO_VERIFICADO,User::USUARIO_NO_VERIFICADO]),
        'verification_token' => $verificado == User::USUARIO_VERIFICADO ? null : User::generarVerificationToken(),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Partido::class,function(Faker $faker){
    return[
        'id_resultado'=>0,
        'id_player_1'=>User::all()->random()->id,
        'id_player_2'=>User::all()->random()->id,
        'modo_partido'=>$faker->randomElement([Partido::PARTIDO_GRATIS,Partido::PARTIDO_APUESTA]),
        'credito_apuesta'=>$faker->numberBetween(100,300),
        'status_game'=>$faker->randomElement([Partido::PARTIDO_VERIFICADO,Partido::PARTIDO_NO_VERIFICADO]),
        'fecha_inicio'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'fecha_fin'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'resultado_final'=>$faker->randomElement([Partido::RESULTADO_VICTORIA_USER_1,Partido::RESULTADO_VICTORIA_USER_1,Partido::RESULTADO_EMPATE]),
    ];
});

$factory->define(Resultado::class,function(Faker $faker){
    return[
        'goles_user_1' =>$faker->numberBetween(0,10), 
        'goles_user_2' =>$faker->numberBetween(0,10),
        'id_player_load'=>User::all()->random()->id,
        'player_win'=>$faker->randomElement([Resultado::JUGADOR_1,Resultado::JUGADOR_2,Resultado::EMPATE]),
        'certificacion'=>$faker->word,
        'estado_partido'=>$faker->randomElement([Resultado::PARTIDO_VERIFICADO,Resultado::PARTIDO_NO_VERIFICADO]),
    ];
});


