<?php

namespace App\Models;
use App\Models\User;
use App\Models\Coffee;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'date',
        'totalPrice'];
        
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function coffees()
    {
        return $this->hasMany(Coffee::class);
    }
}
