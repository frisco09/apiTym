<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identificador'=>(int)$user->id,
            'nombre'=>(string)$user->name,
            'usuario_psp'=>(string)$user->user_psp,
            'correo'=>(string)$user->email,
            'telefono'=>(string)$user->phone,
            'estado'=>(string)$user->status,
            'cantidad'=>(string)$user->credito,
            'esVerificado'=>(int)$user->verified,
            'clave_verificacion'=>(string)$user->verification_token,
            'esAdministrador'=>($user->admin===true),
            'fechaCreacion'=>(string)$user->created_at,
            'fechaActulizacion'=>(string)$user->updated_at,
            'fechaEliminacion'=>isset($user->deleted_at) ? (string) $user->deleted_at : null,
            'fotoPerfil'=>(string)$user->user_img_pr,
            'claveAcceso'=>(string)$user->password,
            
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('Users.show', $user->id),
                ],
            ],
        ];
    }
    
    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador'=>'id',
            'nombre'=>'name',
            'usuario_psp'=>'user_psp',
            'correo' =>'email',
            'telefono'=>'phone',
            'estado'=>'status',
            'cantidad'=>'credito',
            'esVerificado'=>'verified',
            'clave_verificacion'=>'verification_token',
            'esAdministrador'=>'admin',
            'fechaCreacion'=>'created_at',
            'fechaActualizacion'=>'updated_at',
            'fechaEliminacion'=>'deleted_at',
            'fotoPerfil'=>'user_img_pr',
            'claveAcceso'=>'password',
        ];
        
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identificador',
            'name' => 'nombre',
            'user_psp'=>'usuario_psp',
            'email' => 'correo',
            'phone'=>'telefono',
            'status'=>'estado',
            'credito'=>'cantidad',
            'verified' => 'esVerificado',
            'verification_token'=>'clave_verificacion',
            'admin' => 'esAdministrador',
            'created_at' => 'fechaCreacion',
            'updated_at' => 'fechaActualizacion',
            'deleted_at' => 'fechaEliminacion',
            'user_img_pr'=>'fotoPerfil',
            'password'=>'claveAcceso',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}