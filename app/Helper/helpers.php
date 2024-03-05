<?php

use Illuminate\Support\Facades\Session;

/** Set Sidebar item Active **/

function setActive(array $routes){
    if(is_array($routes)){
        foreach($routes as $route){
            if(request()->routeIs($route)){
                return 'active';
            }
        }
    }
}

function setActiveDynamic($routeName, $parameter = null)
{
    if (request()->routeIs($routeName) && request()->route('category') == $parameter) {
        return 'active';
    }

    return '';
}

function setActiveDropdown($routeName, $parameter = null)
{
    // Get the current route name
    $currentRoute = request()->route()->getName();

    // Check if the current route matches the given route name and parameter
    if ($currentRoute === $routeName && request()->route('slug') === $parameter) {
        return 'active';
    }

    return '';
}

function checkDiscount($product){
    if($product->discount_price > 0){
        return true;
    }
    return false;  
}

function getCartTotal(){
    $total = 0;
    foreach(\Cart::content() as $product){
        $total += ($product->price * $product->qty);
    }
    return $total;
}

function getCartCount(){
    return Cart::content()->count();
}

function currency(){
    if(Session::has('region.currency')){
        $currency = Session::get('region.currency');

        return $currency;
    }
    else{
        return '৳';
    }
}

function getMainTotal(){
    if(Session::has('coupon')){
        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();
        if($coupon['discount_type'] == 'amount'){
            $total = ceil($subTotal - $coupon['discount']);

            return $total;
        }elseif($coupon['discount_type'] == 'percent'){
            
            $total = ceil($subTotal - (($subTotal * $coupon['discount'])/100));

            return $total;
        }
    }
    else{
        return getCartTotal();
    }
}

function getDiscount(){
    if(Session::has('coupon')){
        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();
        if($coupon['discount_type'] == 'amount'){
            $discount = $coupon['discount'];

            return $discount;
        }elseif($coupon['discount_type'] == 'percent'){
            
            $discount = ($subTotal * $coupon['discount'])/100;

            return $discount;
        }
    }
    else{
        return '0';
    }
    
}

function getCoupon(){
    if(Session::has('coupon.coupon_code')){
        $coupon_code = Session::get('coupon.coupon_code');
        return $coupon_code;
    }
    else{
        return 'No Promo';
    }
}

function getRegion(){
    if(Session::has('region.name')){
        $regionName = Session::get('region.name');
        return $regionName;
    }
    else{
        return 'Global';
    }
}

function isSuper(){
    if(Auth::user()->role == 'admin'){
        if(Auth::user()->is_super){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function slugToNormalString($slug) {
    // Replace dashes with spaces
    $string = str_replace('-', ' ', $slug);

    // Capitalize the first letter of each word
    $string = ucwords($string);

    return $string;
}