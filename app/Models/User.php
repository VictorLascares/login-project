<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo',
        'imagen',
        'rol',
        'activo',
        'password',
    ];
    public $timestamps = false;
    public function nombreCompleto(){
        return $this->nombre." ".$this->apellido_paterno." ".$this->apellido_materno;
    }

    public function nombre($user_id){
        $user = DB::table('users')->where('id', $user_id)->first();
        return $user->nombre;
    }


}
