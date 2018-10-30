<?php

namespace App;

use App\Partido;
use App\Resultado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partido extends Model
{
        use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $dates =['delete_at'];
    const PARTIDO_APUESTA = "partido por apuesta";
    const PARTIDO_GRATIS = "partido gratuito";
	/*
		JUGADOR 1 inicia juego;
		JUGADOR 2 acepta el juego;
    */
    const RESULTADO_VICTORIA_USER_1 = '1';
    const RESULTADO_VICTORIA_USER_2 = '2';
    const RESULTADO_EMPATE = '0';
    const RESULTADO_INDEFINIDO = '-1';
    
    
    const PARTIDO_VERIFICADO = 'true';
    const PARTIDO_NO_VERIFICADO = 'false';
    
    //public $transformer = PartidoTransformer::class;
    protected $table = 'partidos';

    protected $fillable = [
        //'id'
        'id_resultado',
        'id_player_1',
        'id_player_2',
        'modo_partido',
        'credito_apuesta',
        'status_game',
        'fecha_inicio',
        'fecha_fin',
        'resultado_final',
    ];


    //id_resultado
    public function getIdResultadoAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setIdResultadoAttribute($valor)
    {
        $this->attributes['id_resultado'] = strtolower($valor);
    }
    //mutador partido mod
    public function getModoPartidoAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setModoPartidoAttribute($valor)
    {
        $this->attributes['modo_partido'] = strtolower($valor);
    }
    public function esApuesta()
    {
        return $this->modo_partido == Partido::PARTIDO_APUESTA;
    }
    public function esGratis()
    {
        return $this->modo_partido == Partido::PARTIDO_GRATIS;
    }

    //mutador credito apuesta
    public function getCreditoApuestaAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setCreditoApuestaAttribute($valor)
    {
        $this->attributes['credito_apuesta'] = strtolower($valor);
    }
    //mutador id user 1
    /*public function setId_user_1Attribute($valor)
    {
        $this->attributes['id_user_1'] = strtolower($valor);
    }
    public function getId_user_1Attribute($valor)
    {
        return ucwords($valor);
    }
    //mutador id user 2
    public function setId_user_2Attribute($valor)
    {
        $this->attributes['id_user_2'] = strtolower($valor);
    }
    public function getId_user_2Attribute($valor)
    {
        return ucwords($valor);
    }*/

    //mutador estado
    public function getStatusGameAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setStatusGameAttribute($valor)
    {
        $this->attributes['status_game'] = strtolower($valor);
    }
    public function esVerificado()
    {
        return $this->status_game == Partido::PARTIDO_VERIFICADO;
    }
    public function noVerificado()
    {
        return $this->status_game == Partido::PARTIDO_NO_VERIFICADO;
    }

    //mutador fecha inicio
    public function getFechaInicioAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setFechaInicioAttribute($valor)
    {
        $this->attributes['fecha_inicio'] = strtolower($valor);
    }

    //mutador fecha fin
    public function getFechaFinAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setFechaFinAttribute($valor)
    {
        $this->attributes['fecha_fin'] = strtolower($valor);
    }

    //mutador resultado final
    public function getResultadoFinalAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setResultadoFinalAttribute($valor)
    {
        $this->attributes['resultado_final'] = strtolower($valor);
    }
    public function esVictoria1()
    {
        return $this->resultado_final == Partido::RESULTADO_VICTORIA_USER_1;
    }
    public function esVictoria2()
    {
        return $this->resultado_final == Partido::RESULTADO_VICTORIA_USER_2;
    }
    public function esEmpate()
    {
        return $this->resultado_final == Partido::RESULTADO_EMPATE;
    }


    //relaciones 
    /*
    *un partido muchos(dos) usuarios*/
    public function users()
    {
        return $this->hasOne(User::class,'id_user_1');
    }

	//un partido tiene un resultado
    public function resultado()
    {
        return $this->hasOne(Resultado::class,'resultados','id_resultado');
    }
    
}
