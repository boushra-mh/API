<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'user_id',
        'location_id',
        'total_price',
        'date_of_delivery'
    ];
    public function user()
    {
        
      return $this->belongsTo('App\Models\User','user_id');
        
    }
    public function location()
    {
        
      return $this->belongsTo('App\Models\Location','location_id');
        
    }
}
