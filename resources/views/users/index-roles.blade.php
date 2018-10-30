@extends('layouts.app')
@section('content')
<body>
  <div style="margin: 25px">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
     <tr>
       <th style="visibility: hidden">No</th>
       <th>Name</th>
       <th>Email</th>
       <th>telefono</th>
       <th>creado el</th>
       <th>cambiar rol</th>
       <th>editar</th>
       <th>borrar</th>
     </tr>
     @foreach ($data as $key => $user)
      <tr>
        <td style="visibility: hidden">{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
        <td>{{$user['created_at']}}</td>
        <td>
           <a class="btn btn-info" href="{{url('/users/roles', $user['id'])}}">Change Role</a>
        </td>
        <td>
           <a href="{{url('users/edit', $user['id'])}}" class="btn btn-warning">Editar</a>
        </td>
        <td>
          <a href="{{url('user/delete', $user['id'])}}" class="btn btn-danger">Borrar</a>
        </td>
        </td>
      </tr>
     @endforeach
    </table>
  </div>
</body>
@endsection