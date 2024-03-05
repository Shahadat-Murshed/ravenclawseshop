<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $variant = ProductVariant::findorFail($request->variant_id);
        $product = Product::findorFail($variant->product_id);
        if(!$variant->in_stock){
            return response(['status' => 'error', 'message' => 'Sorry! This product is currently out of stock.']);
        }
        if($product->region_required){
            if(!$request->region){
                if($product->region_type == 'Region'){
                    return response(['status' => 'error', 'message' => 'Please Select A Region']);
                }
                elseif($product->region_type == 'Platform'){
                    return response(['status' => 'error', 'message' => 'Please Select A Platform']);
                }
            }
        }

        if(getRegion() == 'Malaysia'){
            if(checkDiscount($variant)){
                $price = $variant->discount_price_rm;
            }
            else{
                $price = $variant->price_rm;
            }
        }elseif(getRegion() == 'Global'){
            if(checkDiscount($variant)){
                $price = $variant->discount_price;
            }
            else{
                $price = $variant->price;
            }
        }else{
            if(checkDiscount($variant)){
                $price = $variant->discount_price;
            }
            else{
                $price = $variant->price;
            }
        }   
        $cartData= [];
        $cartData['id'] = $variant->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = 1;
        $cartData['price'] = $price; 
        $cartData['weight'] = 1;
        $cartData['options']['quantity'] = $variant->unit;
        $cartData['options']['ign'] = $request->ign;
        $cartData['options']['region'] = $request->region;
        $cartData['options']['pass'] = $request->pass;
        $cartData['options']['tag'] = $request->tag;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;

        Cart::add($cartData);

        return response(['status' => 'success', 'message' => 'Added to cart successfully!']);
    }

    /** Show Cart Page **/
    public function cartDetails(){

        $all_products = Product::inRandomOrder()->limit(20)->get();
        $cartItems = Cart::content();
        $count = count($cartItems);
        // dd($count);

        if($count== 0){
            Session::forget('coupon');
            toastr('', 'warning', 'Cart is empty!');
            return redirect()->route('home');
        }

        $total = $this->cartTotal();


        return view('frontend.pages.cart', compact('cartItems','total', 'all_products'));
    }

    /** Update Product Quantity with plus and minus **/
    public function updateProductQty(Request $request){

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);

        return response(['status' => 'success', 'message'=> 'Product Quantity Updated', 'product_total' => $productTotal]);
    }

    /** get Product Total **/
    public function getProductTotal($rowId){

        $product = Cart::get($rowId);
        $total = ($product->price * $product->qty);

        return $total;
    }

    /** Get Cart Total **/
    public function cartTotal(){
        
        $total = 0;
        foreach(Cart::content() as $product){
            $total += $this->getProductTotal($product->rowId);
        }

        return $total;
    }

    /** Clear all Product from the Cart **/
    public function clearCart(){
        Cart::destroy();
        Session::forget('coupon');
        return response(['status' => 'success', 'message' => 'Cart Cleared successfully!']);
    }

    /** Remove Single Product **/
    public function removeProduct($rowId){
        Cart::remove($rowId);

        toastr('', 'success', 'Removed successfully!');
        return redirect()->back();
    }    

    /** To Get Cart Content Count for the Counter  **/
    public function getCartCount(){
        
        return Cart::content()->count();
    }

    public function applyCoupon(Request $request){
        if($request->coupon_code == null){
            return response(['status' => 'error', 'message' => 'Coupon field empty']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();

        if($coupon == null){
            return response(['status' => 'error', 'message' => 'Invalid Code']);
        }
        elseif($coupon->start_date > date('Y-m-d')){
            return response(['status' => 'error', 'message' => 'Coupon not available yet']);
        }
        elseif($coupon->end_date < date('Y-m-d')){
            return response(['status' => 'error', 'message' => 'Coupon Expired']);
        }
        elseif($coupon->total_used >= $coupon->quantity){
            return response(['status' => 'error', 'message' => 'Coupon no more applicable']);
        }

        if($coupon->currency == 'RM'){
            if(Session::has('region.name')){
                $regionName = Session::get('region.name');
                if ($regionName == 'Malaysia'){
                    if($coupon->discount_type == 'amount'){
                        Session::put('coupon', [
                            'coupon_name' =>$coupon->name,
                            'coupon_code' => $coupon->code,
                            'discount_type' => 'amount',
                            'discount' => $coupon->discount,
                        ]);
                    }
                    elseif($coupon->discount_type == 'percent'){
                        Session::put('coupon', [
                            'coupon_name' =>$coupon->name,
                            'coupon_code' => $coupon->code,
                            'discount_type' => 'percent',
                            'discount' => $coupon->discount,
                        ]);
                    }
                }
                else{
                    return response(['status' => 'error', 'message' => 'Coupon not applicable in this region']); 
                }
            }      
        }

        if($coupon->currency == 'BDT'){

            if(Session::has('region.name')){
                $regionName = Session::get('region.name');
                if ($regionName == 'Malaysia'){
                    return response(['status' => 'error', 'message' => 'Coupon not applicable in this region']);  
                }
            }
            if($coupon->discount_type == 'amount'){
                Session::put('coupon', [
                    'coupon_name' =>$coupon->name,
                    'coupon_code' => $coupon->code,
                    'discount_type' => 'amount',
                    'discount' => $coupon->discount,
                ]);
            }
            elseif($coupon->discount_type == 'percent'){
                Session::put('coupon', [
                    'coupon_name' =>$coupon->name,
                    'coupon_code' => $coupon->code,
                    'discount_type' => 'percent',
                    'discount' => $coupon->discount,
                ]);
            }
        }

        return response(['status' => 'success', 'message' => 'Coupon Applied Successfully']);
    }

    public function couponCalc(){
        if(Session::has('coupon')){
            $coupon = Session::get('coupon');
            $subTotal = getCartTotal();
            if($coupon['discount_type'] == 'amount'){
                $total = ceil($subTotal - $coupon['discount']);

                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
            }elseif($coupon['discount_type'] == 'percent'){
                
                $total = ceil($subTotal - (($subTotal * $coupon['discount'])/100));
                $discount = ($subTotal * $coupon['discount'])/100;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $discount]);
            }
        } 
    }
}
