<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    
    protected $table = "shops";
    
    protected $fillable = ['name', 'price', 'category', 'description', 'thumbnail'];
    
    function cart() {
        return $this->belongsTo('App\Models\Cart', 'idcart');
    }
}
