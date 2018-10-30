<?php

namespace App\Http\Controllers\Resultado;

use App\Resultado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class resultadoController extends ApiController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index','destroy','update', 'store','show']);
        //$this->middleware('auth:api')->except(['store', 'verify', 'resend']);
        //$this->middleware('transform.input:' . UserTransformer::class)->only(['get','store', 'update']);
        //$this->middleware('scope:manage-account')->only(['show', 'update']);
        //$this->middleware('can:view,user')->only('show');
        //$this->middleware('can:update,user')->only('update');
        //$this->middleware('can:delete,user')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$resultados = Resultado::all();
        return $this->showAll($resultados);*/
        $resultados = Resultado::all();
        //return $this->showAll($partidos);

        return response()->json(['data' => $resultados],200);    
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'goles_user_1'=>'required', 
            'goles_user_2'=>'required',
            'id_player_load' =>'required|id|unique:users',
            'id_partido'=>'required|id|unique:partidos'
        ];
        $this->validate($request,$rules);
        $campos = $request->all();
        $campos ['id_player_win'] = null;
        $campos ['certificacion'] = "foto_certificado.jpg";
        $campos ['estado_partido'] = Resultado::PARTIDO_NO_VERIFICADO;

        $resultado = Resultado::create($campos);
        return $this->showOne($resultado);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return $this->showOne($user);
        /*$usuario = User::findOrFail($id);
        return response()->json(['data' => $usuario],200);*/
        $resultado = Resultado::findOrFail($id);
        return $this->showOne($resultado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Resultado $resultado)
    {
        $reglas = [
            'goles_user_1'=>'required', 
            'goles_user_2'=>'required',
            'id_player_load' =>'required|id|unique:users',
            'id_partido'=>'required|id|unique:partidos'
        ];
        $this->validate($request, $reglas);
        if ($request->has('id_player_win')) {
            $resultado->id_player_win = $request->id_player_win;
        }
        if ($request->has('certificacion')) {
            $resultado->certificacion = $request->certificacion;
        }
        if ($request->has('estado_partido')) {
            $resultado->restado_partido = $request->estado_partido;
        }
        if (!$partido->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }
        $resultado->save();
        return $this->showOne($resultado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resultado = Resultado::findOrFail($id);
        $resultado->delete();
        return $this->showOne($resultado);   
    }
}
