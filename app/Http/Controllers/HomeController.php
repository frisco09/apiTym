<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
Use Alert;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Validation\ValidatesRequests;


use DB;

class HomeController extends Controller
{
    use ValidatesRequests;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        return view('home');
    }
    public function someAdminStuff(Request $request)
    {
        $request->user()->authorizeRoles('admin');

        return view('users.index');
    }

    public function getTokens()
    {
        return view('home.personal-tokens');
    }
    public function inBuild(){
        return view('inbuild');
    }
    public function getClients()
    {
        return view('home.personal-clients');
    }
    public function getAuthorizedClients()
    {
        return view('home.authorized-clients');
    }
    public function getUsersList(){
        $data = User::whereHas('roles', function($q){$q->where('name', 'user');})->get();
        return view('users.index',compact('data'));
    }
    public function getUsersCreate(){
        return view('users.create-user');
    }
    public function getUsersRoles(){
        //$data =User::where('admin', 'true')->get();
        $data = User::whereHas('roles', function($q){$q->where('name', 'admin');})->get();
        return view('users.index-roles',compact('data'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        if($user->hasRole('user'))
        {         
            return view('users.edit',compact('user','id'));
        }
        else
        {
            toast()->warning('solo pueden editarse usuarios regulares', 'title');
        }
   
    }
    public function getTokensUsers(){
        $data = User::whereHas('roles', function($q){$q->where('name', 'user');})->get();
        return view('users.userToken', compact('data'));
    }
    //validaciones

    public function formValidationPost(Request $request)
    {
        if((!empty($request))){
                $this->validate($request,[
                        'name' => 'required|min:5|max:35',
                        'user_psp' => 'required|min:5|max:35|unique:users',
                        'email' => 'required|email|unique:users',
                        'phone' => 'required|numeric|digits_between:6,20',
                        'password' => 'required|min:3|max:20',
                        'confirm_password' => 'required|min:3|max:20|same:password',
                    ],[
                        'name.required' => ' The name field is required.',
                        'user_psp.required' => ' The psp user id is required.',
                        'phone.required' => 'The phone user is required',
                        'name.max' => ' The first name may not be greater than 35 characters.',
                        'email.required' => ' The email field is required.',
                        'password.required' => ' The email field is required.',
                    ]);
                if($request->role == 'admin')
                {
                    $role = Role::where('name', 'admin')->first();
                    $campos = $request->all();
                    $campos ['password'] = bcrypt($request->password);
                    $campos ['verified'] = User::USUARIO_VERIFICADO;
                    $campos ['verification_token'] = "";
                    $campos ['admin'] = true;
                    $user = User::create($campos);
                    $user->roles()->attach($role);
                    toast()->success('admin added:', ' administrador creado exitosamente!');
                } 
                elseif ($request->role == 'user')   
                {
                    $role = Role::where('name', 'user')->first();
                    $campos = $request->all();
                    $campos ['password'] = bcrypt($request->password);
                    $campos ['phone'] = $request->phone;
                    $campos ['status'] = User::USUARIO_INACTIVO;
                    $campos ['verified'] = User::USUARIO_NO_VERIFICADO;
                    $campos ['verification_token'] = User::generarVerificationToken();
                    //$campos ['user_img_pr'] = $request->fotoPerfil->store('');
                    $user = User::create($campos);
                    $user->roles()->attach($role);
                    toast()->success('se agrego el usuario con exito', 'User Added');
                    
                }
                return redirect()->route('create-users');
        }
        else
        {

            toast()->warning('debes escribir los datos!');  
            return redirect()->route('create-users');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);  
                $reglas = [
                    'email' => 'email|unique:users,email,' . $user->id,
                    'user_psp' => 'required',
                    'password' => 'required|min:6|max:20',
                    'confirm_password' => 'required|min:6|max:20|same:password',
                ];
                $this->validate($request, $reglas);
                if ($request->has('name')) {
                    $user->name = $request->name;
                }
                if ($request->has('email') && $user->email != $request->email) {
                    if($user->hasRole('user')){
                        $user->verified = User::USUARIO_NO_VERIFICADO;
                        $user->verification_token = User::generarVerificationToken();
                        $user->email = $request->email;
                    }
                    elseif($user->hasRole('admin')){
                           $user->email = $request->email;
                    }
                }
                if ($request->has('password')) {
                    $user->password = $request->user_psp;
                }
                if ($request->has('user_psp')) {
                    $user->user_psp = $request->user_psp;
                }
                //----------------------------------------------------------------
                if($request->has('status')){
                    $state = $request->status;
                    
                    if($state==$user->no_disponible()){
                        $user->status = User::USUARIO_ACTIVO;
                    }
                    else
                        if($state==$user->esta_disponible()){
                            $user->status = User::USUARIO_INACTIVO;
                    }
                }
                //----------------------------------------------------------------
                if ($request->has('admin')) {
                    if (!$user->esVerificado()) {
                        return $this->errorResponse('Unicamente los usuarios verificados pueden cambiar su valor de administrador', 409);
                    }
                    $user->admin = $request->admin;
                }
                if (!$user->isDirty()) {
                    return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
                }
            $user->save();

        return redirect()->route('lista-usuarios');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('lista-usuarios');
    }

    public function changeRole($id){
        $user = User::findOrFail($id);
        if (! $user->hasRole('admin')) {
            
            $role_admin = Role::where('name', 'admin')->first();
            $user->roles()->detach();
            $user->save();
            $user->roles()->attach($role_admin);
            return redirect()->route('home-roles');
        }
        else{
            $role_user = Role::where('name', 'user')->first();
            $user->roles()->detach();
            $user->save();
            $user->roles()->attach($role_user);
            return redirect()->route('home-roles');
        }
        
    }
}
