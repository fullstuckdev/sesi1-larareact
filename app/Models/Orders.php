<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'order'; 
    protected $fillable = ['address','total_order', 'status', 'product_id', 'user_id'];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
