<?php

namespace App;

use App\User;
use App\Partido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resultado extends Model
{

        use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $dates =['delete_at'];
    
    const PARTIDO_VERIFICADO = 'true';
    const PARTIDO_NO_VERIFICADO = 'false';

    const JUGADOR_1 = '1';
    const JUGADOR_2 = '2';
    const EMPATE = '0';
    
    //public $transformer = ResultadoTransformer::class;
    protected $table = 'resultados';

    protected $fillable = [
        //'id'
        'goles_user_1', 
        'goles_user_2',
        'id_player_load',
        'player_win',
        'certificacion',
        'estado_partido',
    ];

    //mutador goles user 1 & 2
    public function getGolesUser1Attribute($valor)
    {
        return ucwords($valor);
    }
    public function setGolesUser1Attribute($valor)
    {
        $this->attributes['goles_user_1'] = strtolower($valor);
    }
    //---- user 2 
    public function getGolesUser2Attribute($valor)
    {
        return ucwords($valor);
    }
    public function setGolesUser2Attribute($valor)
    {
        $this->attributes['goles_user_2'] = strtolower($valor);
    }

    //mutador id player load
    public function getIdPlayerLoadAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setIdPlayerLoadAttribute($valor)
    {
        $this->attributes['id_player_load'] = strtolower($valor);
    }

    //mutador id player win
    public function getPlayerWinAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setPlayerWinAttribute($valor)
    {
        $this->attributes['player_win'] = strtolower($valor);
    }
    public function player_win(){
        if(goles_user_1 > goles_user_2)
        {
            player_win == Resultado::JUGADOR_1;
        }
        elseif (goles_user_2 > goles_user_1) {
            player_win == Resultado::JUGADOR_2;
        }
        else{
            player_win == Resultado::EMPATE;
        }
    }
    //mutador certificacion
    public function getCertificacionttribute($valor)
    {
        return ucwords($valor);
    }
    public function setCertificacionAttribute($valor)
    {
        $this->attributes['certificacion'] = strtolower($valor);
    }

    //mutador estado partido
    public function getEstadoPartidoAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setEstadoPartidoAttribute($valor)
    {
        $this->attributes['estado_partido'] = strtolower($valor);
    }
    //mutador id_partido
    public function getIdPartidoAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setIdPartidoAttribute($valor)
    {
        $this->attributes['id_partido'] = strtolower($valor);
    }

    //relaciones 
    /*
    *un resultado pertenece a un partido*/
    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    /*
    *un resultado lo carga un usuario*/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
