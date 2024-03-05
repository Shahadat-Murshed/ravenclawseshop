<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function item(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function variant(){
        return $this->hasOne(ProductVariant::class, 'id', 'variant_id');
    }
}
