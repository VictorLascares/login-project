<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'descripcion', 'price', 'imagen', 'user_id', 'category_id','consesionado','motivo','existencia','pendientes','estado'];




    public function scopePropuestos($query){
        return $query->whereNull('concesionado');
    }
    public function scopeAceptados($query){
        return $query->where('concesionado',1);
    }
    public function scopePropios($query,$user){
        return $query->where('user_id',$user);
    }
    public function scopeAceptadosrechazados($query){
        return $query->whereNotNull('concesionado');
    }
    public function scopeCategory($query,$category_id){
        return $query->where('category_id',$category_id);
    }
    public function scopeName($query,$name){
        return $query->where('name',$name);
    }


}
