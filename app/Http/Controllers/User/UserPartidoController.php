<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Partido;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserPartidoController extends ApiController
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
    public function index($id)
    {
        $user = User::findOrFail($id);
        $partidos = $user->partidos;
        return response()->json(['data' => $partidos],200);
        //return $this->showAll($partidos);
    }

    public function show(Partido $partido)
    {
        //
    }
}
