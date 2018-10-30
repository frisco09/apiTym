<?php

namespace App\Http\Controllers\Resultado;

use App\Partido;
use App\Resultado;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ResultadoPartidoController extends ApiController
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
     * @param  \App\Partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function show(Resultado $resultado)
    {
            $partido = $resultado->resultadoPartido;
            return $this->showOne($partido);
    }
}
