<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function variant(){
        return $this->hasMany(ProductVariant::class);
    }
    public function allVariantsHaveOutStock()
    {
        return $this->variant->every(function ($variant) {
            return $variant->in_stock == 0;
        });
    }
    public function hasLowStockPercentage($percentageThreshold = 50)
    {
        $totalVariants = $this->variant->count();

        if ($totalVariants === 0) {
            return false;
        }

        $variantsWithStock = $this->variant->where('in_stock', '>', 0)->count();
        $stockPercentage = ($variantsWithStock / $totalVariants) * 100;

        return $stockPercentage <= $percentageThreshold;
    }
    public function hasDiscount()
    {
        $totalVariants = $this->variant->count();

        if ($totalVariants === 0) {
            return false;
        }

        $variantsWithDiscount = $this->variant->where('discount_price', '>', 0)->count();
        if($variantsWithDiscount > 0){
            return true;
        }
        else{
            return false;
        }

    }
}
