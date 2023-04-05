<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coffee_id',
        'quantity',
        'price',
        'purchase_date',
    ];

    public function coffee()
    {
        return $this->belongsTo(Coffee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}