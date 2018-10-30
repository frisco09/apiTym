<?php

namespace App\Http\Controllers\Partido;

use App\Partido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class partidoController extends ApiController
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
        $partidos = Partido::all();
        //return $this->showAll($partidos);

        return response()->json(['data' => $partidos],200);
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
        'modo_partido'=>'required',
        'credito_apuesta'=>'required',
        ];
        $this->validate($request,$rules);
        $campos = $request->all();
        $campos ['status_game'] = Partido::PARTIDO_NO_VERIFICADO;
        $campos ['fecha_inicio'] = Carbon\Carbon::now();
        $campos ['fecha_fin'] = NULL;
        $campos ['resultado_final'] = -1;

        $partido = Partido::create($campos);
        return $this->showOne($partido);    }

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
        $partido = Partido::findOrFail($id);
        return $this->showOne($partido);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partido $partido)
    {

        $reglas = [
        'modo_partido'=>'required',
        'credito_apuesta'=>'required',
        ];
        $this->validate($request, $reglas);
        if ($request->has('status_game')) {
            $partido->status_game = $request->status_game;
        }
        if ($request->has('fecha_fin')) {
            $partido->fecha_fin = $request->fecha_fin;
        }
        if ($request->has('resultado_final')) {
            $partido->resultado_final = $request->resultado_final;
        }
        if (!$partido->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }
        $partido->save();
        return $this->showOne($partido);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partido = Partido::findOrFail($id);
        $partido->delete();
        return $this->showOne($partido);   
    }
}
