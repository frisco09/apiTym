@extends('layouts.app')
@section('content')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
</head>
<body  style=" background: #34495e">
<div style="margin: 40px; background: #fef9e7; padding: 10px">
        <div class="modal-header">
                <h2>CARGA DE USUARIOS</h2>
        </div>
        <form method="POST" action="/form-validation" autocomplete="off">
            @if(count($errors))
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <br/>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Nombre/Nick:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('user_psp') ? 'has-error' : '' }}">
                        <label for="user_psp">user psp id:</label>
                        <input type="text" id="user_psp" name="user_psp" class="form-control" placeholder="Enter psp id user" value="{{ old('user_psp') }}">
                        <span class="text-danger">{{ $errors->first('user_psp') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email" value="{{ old('email') }}">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                        <label for="phone">Mobile Number:</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Mobile Number" value="{{ old('phone') }}">
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" >
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Enter Confirm Passowrd">
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <h3>ROL PARA EL USUARIO</h3>
                <input type="radio" name="role" value="user" checked><h4 style="color: #C70039;display: inline;">Usuario regular</h4>
                <input type="radio" name="role" value="admin" style="margin-left: 25px"><h4 style="color: #C70039; display: inline;">Administrador</h4>
            </div>
            <div class="modal-footer">
                <input class="btn btn-success" type = 'submit' value = "GUARDAR"/>
            </div>
        </form>
    <div class="container">
        @include('toast::messages')
    </div>
</div>
</body>
@endsection