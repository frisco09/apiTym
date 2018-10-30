@extends('layouts.app')
@section('content')
  <head>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <style type="text/css">
       html, body {
                background-color:  #34495e;
                color: #922b21;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
        }
       #myInput {
          width: 500px; /* Full-width */
          font-size: 16px; /* Increase font-size */
          padding: 12px 20px 12px 40px; /* Add some padding */
          border: 1px solid #ddd; /* Add a grey border */
          margin-bottom: 12px; /* Add some space below the input */
          margin-top: 12px; 
      }

      #myTable {
          border-collapse: collapse; /* Collapse borders */
          width: 100%; /* Full-width */
          border: 1px solid #ddd; /* Add a grey border */
          font-size: 18px; /* Increase font-size */
      }

      #myTable th, #myTable td {
          text-align: left; /* Left-align text */
          padding: 12px; /* Add padding */
      }

      #myTable tr {
          /* Add a bottom border to all table rows */
          border-bottom: 1px solid #ddd;
      }

      #myTable tr.header, #myTable tr:hover {
          /* Add a grey background color to the table header and on hover */
          background-color: #f1f1f1;
      }
    </style>
    <script>
        function myFunction() {
          // Declare variables
          var input, filter, table, tr, td, i;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");

          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }
  </script>
  </head>
  <div class="container" style="background-color: #fef9e7">
    <div class="row" >
      <div class="col-lg-12 margin-tb">
        <div class="pull-right" style="display: inline-block; float: right; margin-bottom:5px;margin-top: 12px;">
            <a class="btn btn-success" href="{{route('create-users')}}"> Create New User</a>
        </div>
        <input align="left" type="text" id="myInput" onkeyup="myFunction()" style="width: 350px;margin-top: 12px;" placeholder="Search for Email..">
      </div>
    </div>
    
    <tbody>
    <table id="myTable"class="table table-bordered">
      <tr>
        <th style="visibility: hidden"></th>
        <th>Name</th>
        <th>Email</th>
        <th>Telefono</th>
        <th>id psp</th>
        <th>creditos</th>
        <th>Created At</th>
        <th>editar</th>
        <th>borrar</th>
      </tr>
      @foreach($data as $user)
        <tr>
          <td style="visibility: hidden" abbr="">{{$user['id']}}</td>
          <td>{{$user['name']}}</td>
          <td>{{$user['email']}}</td>
          <td>{{$user['phone']}}</td>
          <td>{{$user['user_psp']}}</td>
          <td>{{$user['credito']}}</td>
          <td>{{$user['created_at']}}</td>
          <td>
              <a href="{{url('users/edit', $user['id'])}}" class="btn btn-warning">Editar</a>
          </td>
          <td>
              <a href="{{url('user/delete', $user['id'])}}" class="btn btn-danger">Borrar</a>
          </td>

        </tr>
      @endforeach
      </table>

        </tbody>
        <div class="row justify-content-center">
        </div>
    <vue-pagination  :pagination="users"
                     @paginate="getUsers()"
                     :offset="4">
    </vue-pagination>

</div>

@endsection