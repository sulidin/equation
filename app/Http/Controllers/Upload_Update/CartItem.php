<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Coffee;

class CartItem extends Model
{
    use HasFactory;
    
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    
    public function coffee()
    {
        return $this->belongsTo(Coffee::class);
    }
    
    
}
