<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $table = "cart";
    
    protected $fillable = ['idshops', 'ammount'];
    
    
    function shops() {
        return $this->belongsTo('App\Models\Shop', 'idshops');
    }
}
