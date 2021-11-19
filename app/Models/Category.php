<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    static $rules = [
        'name' => 'requiered',
        'active' => 'required'
    ];

    protected $fillable = ['name', 'active'];
    
    protected $casts = [
        'active' => 'boolean',
    ];


    public function products(){
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }
}
