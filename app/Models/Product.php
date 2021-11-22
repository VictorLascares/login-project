<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'category_id'];

    public function scopePropuestos($query){
        return $query->whereNull('concesionado');
    }
    public function scopeAceptados($query){
        return $query->where('concesionado',1);
    }
    public function scopeRechazados($query){
        return $query->where('concesionado',0);
    }
}
