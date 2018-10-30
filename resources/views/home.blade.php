@extends('layouts.app')
@section('content')
@if(Auth::user()->hasRole('admin'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">USUARIOS</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Administacion de usuarios</p>
                    <a href="{{route('create-users')}}" class="btn btn-info pull-right" >cargar usuarios</a>
                    <a href="{{route('lista-usuarios')}}" class="btn btn-info pull-right">listado de usuarios</a>
                    <a href="{{route('home-roles')}}" class="btn btn-danger pull-right">manager de perfiles</a>
                    <a href="{{route('build')}}" class="btn btn-danger pull-right">tokens de acceso</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">PARTIDOS</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Administacion de partidos</p>
                    <button class="btn" href="">detalles de partidos</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">RESULTADOS</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Administacion de resultados</p>
                    <button class="btn" href="">ver resultados</button>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <div>Acceso usuario</div>
@endif
@include('create')
@endsection
