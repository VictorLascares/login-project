<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;
    const CREATE_AT = 'cuando';
    protected $fillable=['quien','accion','que','product_id'];

    public function scopeRproduct($query,$product_id){
        return $query->where('product_id',$product_id);
    }

}
