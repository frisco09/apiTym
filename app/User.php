<?php

namespace App;

use App\Partido;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Transformers\UserTransformer;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $dates =['delete_at'];
    const USUARIO_ACTIVO = "disponible";
    const USUARIO_INACTIVO = "no disponible";
    
    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO = '0';
    const USUARIO_BAJA = '-1';
    
    public $transformer = UserTransformer::class;
    
    protected $table = 'users';
    //protected $dates = ['deleted_at'];
    
    protected $fillable = [
        //'id'
        'user_psp',
        'name',
        'email',
        'phone', 
        'password',
        'status',
        'credito',
        'verified',
        'verification_token',
        'user_img_pr',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];



    //mutador user_psp
    public function setUserPspAttribute($valor)
    {
        $this->attributes['user_psp'] = strtolower($valor);
    }
    public function getUserPspAttribute($valor)
    {
        return ucwords($valor);
    }
    //mutador name
    public function setNameAttribute($valor)
    {
        $this->attributes['name'] = strtolower($valor);
    }
    public function getNameAttribute($valor)
    {
        return ucwords($valor);
    }

    //mutador email
    public function setEmailAttribute($valor)
    {
        $this->attributes['email'] = strtolower($valor);
    }
    //mutador telefono
    public function getPhoneAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setPhoneAttribute($valor)
    {
        $this->attributes['phone'] = strtolower($valor);
    }
    //mutador pass
    /*public function setPasswordAttribute($valor)
    {
        $this->attributes['password'] = bcrypt($valor);
    }
    public function getEmailAttribute($valor)
    {
        return ucwords($valor);
    }*/
    //mutador credito
    public function getCreditoAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setCreditoAttribute($valor)
    {
        $this->attributes['credito'] = strtolower($valor);
    }
    //mutador foto
    public function getUserImgPrAttribute($valor)
    {
        return ucwords($valor);
    }
    public function setUserImgPrAttribute($valor)
    {
        $this->attributes['user_img_pr'] = strtolower($valor);
    }
    //user STATUS
    public function esta_disponible()
    {
        return $this->status == User::USUARIO_ACTIVO;
    }
    public function no_disponible()
    {
        return $this->status == User::USUARIO_INACTIVO;
    }
    //el perfil fue verificado con el token
    public function esVerificado()
    {
        return $this->verified == User::USUARIO_VERIFICADO;
    }
    //USUARIO_BAJA
    public function isBann (){
        return $this-> status == User::USUARIO_BAJA;
    }
    //clave random para verificar email
    public static function generarVerificationToken()
    {
        return str_random(40);
    }

    //relaciones 
    /*
    *un usuario muchos partidos*/
    //un usuario pertenece a un a un partido, 
    public function partidos()
    {
        return $this->belongsTo(Partido::class);
    }
    public function resultados()
    {
        return $this->hasMany(Resultado::class);
    }
    public function roles()
    {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
    //user passport
    /*
        //

    public function validateForPassportPasswordGrant($password)
    {
        return bcrypt($password, $this->password);
    }
    public function getPasswordAttribute($valor)
    {
        return ucwords($valor);
    }
    public function findForPassport($username) { 
     return self::where('email', $username)->first(); 
    } 
    public function findForPassport($username)
    {
        return $this->where('email', $username)->first();
    }
    public function validateForPassportPasswordGrant($password)
    {
        return \Hash::check($password, $this->password);
    }
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }*/
}