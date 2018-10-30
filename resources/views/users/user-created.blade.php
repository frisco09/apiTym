@extends('layouts.app') 
@section('content')
 
    <h2>Add a user</h2>
<div style="margin: 40px">
    <form method="post" action="/user-store" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">User name</label>
            <div class="col-sm-9">
                <input name="name" type="text" class="form-control" id="name" placeholder="nombre" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="user_psp" class="col-sm-3 col-form-label">User ID PSP</label>
            <div class="col-sm-9">
                <input name="user_psp" type="text" class="form-control" id="user_psp"
                       placeholder="user id psp" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input name="email" type="text" class="form-control" id="email"
                       placeholder="Email" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password"  required>
            </div>
        </div>
        <div class="form-group row">
            <label for="password_confirm" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="password_confirm" id="password_confirm" name="password_confirm" class="form-control" placeholder="password confirm"  required>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Submit User</button>
            </div>
        </div>
        @if(count($errors))
            <div class="form-group">
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </form>
 </div> 
@endsection

