<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'product_id',
        'order_id',
        'quantity'
    ];

    public function product()
    {
        
      return $this->belongsTo(Product::class,'product_id');
        
    }
    public function order()
    {
        
      return $this->belongsTo(Order::class,'order_id');
        
    }
}
