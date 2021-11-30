<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question','answer','product_id'];

    public function scopeQproduct($query,$product_id){
        return $query->where('product_id',$product_id);
    }
}
