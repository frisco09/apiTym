<?php

namespace App\Http\Controllers\Partido;

use App\Partido;
use App\Resultado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartidoResultadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index', 'show']);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resultado  $resultado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $partido = Partido::findOrFail($id);
 
            $resultado = $partido->resultado;
            return response()->json(['data' => $resultado],200);
            //return $this->showOne($resultado);
    }

}
