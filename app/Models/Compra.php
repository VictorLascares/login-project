<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad','pago','ticket','calificacion','estado','user_id','product_id'];

    public function scopeSearch($query,$product_id){
        return $query->where('product_id',$product_id);
    }
    public function scopeSearchu($query,$user_id){
        return $query->where('user_id',$user_id);
    }
}
