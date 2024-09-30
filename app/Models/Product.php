<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'image',
        'price',
        'discount',
        'amount',
        'is_trendy',
        'is_available',
        'category_id',
        'brand_id',

    ];

    public function category()
    {
        return $this->belongsTo(Categories::class,'category_id');
    }
    public function brand()
    {
            return $this->belongsTo(Brands::class,'brand_id');
    }

    public function items()
    {

        return $this->hasMany(OrderItems::class);

    }
}
