<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryWiseProductController extends Controller
{
    public function index(string $slug){
        
        $category = Category::where('slug', $slug)->first();
        $all_products = Product::with('variant')->where('status', 1)->where('category_id', '!=', $category->id)->inRandomOrder()->get();
        $products = Product::with('variant')->where('status', 1)->where('category_id', $category->id)->orderBy('id', 'desc')->get();
        // dd($category);

        return view('frontend.pages.product-listing',
        compact(
            'products',
            'category',
            'all_products'
        ));
    }
}
