<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Region;
use Illuminate\Http\Request;

class SingleProductDetails extends Controller
{
    public function index(string $slug){
        
        $product = Product::with('variant')->where('slug', $slug)->where('status', 1)->first();
        if($product){
            $all_products = Product::with('variant')->where('category_id', $product->category_id)->where('status', 1)->where('id', '!=', $product->id)->inRandomOrder()->limit(10)->get();
            $product_variants = ProductVariant::where('product_id', $product->id)->where('status', 1)->get();
            $regions = Region::where('type', 'region')->get();
            $platforms = Region::where('type', 'platform')->get();

            return view('frontend.pages.product-details',
            compact(
                'product',
                'all_products',
                'product_variants',
                'regions',
                'platforms',
            ));
        }else{
            return response()->view('frontend.404', [], 404);
        }
    }
}
