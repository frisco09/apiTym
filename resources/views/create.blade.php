<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
                <h4>Crear</h4>
            </div>
        <h2>CARGA DE USUARIOS</h2>
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
                        <label for="user_psp">Last Name:</label>
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
                    <div class="form-group {{ $errors->has('mobileno') ? 'has-error' : '' }}">
                        <label for="mobileno">Mobile Number:</label>
                        <input type="text" id="mobileno" name="mobileno" class="form-control" placeholder="Enter Mobile Number" value="{{ old('mobileno') }}">
                        <span class="text-danger">{{ $errors->first('mobileno') }}</span>
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

            <div class="form-group">
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">GUARDAR</button>
            </div>
        </form>
        </div>
    </div>
</div>