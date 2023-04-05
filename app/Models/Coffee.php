<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coffee extends Model
{
    use HasFactory;

    protected $fillable=['name','description','stock','selling_price','purchased_price','pic'];

     public function purchasedItems()
    {
        return $this->hasMany(PurchasedItem::class);
    }
}
