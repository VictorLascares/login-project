<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad','pago','ticket','calificacion','estado','user_id','product_id'];

    public function scopeSearch($query,$id){
        return $query->where('product_id',$id);
    }
}
