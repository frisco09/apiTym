@extends('layouts.app')
@section('content')
<!-- edit.blade.php -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body style=" background: #34495e">
    <div style="margin: 40px; background: #fef9e7">
    <div class="container" >
      <h2>Edit form</h2><br  />
        <form method="POST" action="{{action('HomeController@update', $id)}}">
        @csrf
        <input name="method" type="hidden" value="PATCH">
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
                        <input type="text" id="name" class="form-control" name="name" value="{{$user->name}}">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('user_psp') ? 'has-error' : '' }}">
                        <label for="user_psp">user psp id:</label>
                        <input type="text" id="user_psp" class="form-control" name="user_psp" value="{{$user->user_psp}}">
                        <span class="text-danger">{{ $errors->first('user_psp') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">Email:</label>
                        <input type="text" id="email" class="form-control" name="email" value="{{$user->email}}">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('mobileno') ? 'has-error' : '' }}">
                        <label for="mobileno">Mobile Number:</label>
                        <input type="text" id="mobileno" class="form-control" name="mobileno" value="0203456">
                        <span class="text-danger">{{ $errors->first('mobileno') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">Password:</label>
                        <input type="text" id="password" class="form-control" name="password" value="">
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="text" id="confirm_password" class="form-control" name="confirm_password" value="">
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                
            </div>
            <div class="modal-footer">
                <input class="btn btn-success" type = 'submit' value = "GUARDAR"/>
            </div>
      </form>
    </div>
    </div>
  </body>
</html>
@endsection
