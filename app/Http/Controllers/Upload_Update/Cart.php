<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;


class Cart extends Model
{
    use HasFactory;
    
        protected $fillable = [
        'name',
        'purchased_price',
        'quantity'
    ];

    
    public function cartitems()
    {
        return $this->hasMany(CartItem::class);
    }
   
}
