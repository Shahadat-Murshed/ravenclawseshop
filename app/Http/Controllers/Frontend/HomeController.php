<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){

        $sliders = Slider::where('status', 1)->orderBy('serial')->latest()->take(4)->get();        
        $categories = Category::where('status', 1)->get();        
        $productsByCategory = [];

        if(!Session::has('region.name')){
            Session::put('region', [
                'name' => 'Global',
                'currency' => '৳',
                'currency_name' => 'BDT'
            ]);
        }
        foreach ($categories as $category) {
            $products = Product::with('variant')->where('category_id', $category->id)->where('status', 1)->inRandomOrder()->limit(10)->get();
            $productsByCategory[] = [
                'category' => $category,
                'products' => $products,
            ];
        }
        return view('frontend.pages.home',
        compact(
            'sliders',
            'productsByCategory',
        ));
    }

    public function search(Request $request){
        $query = $request->input('query');
        $data = Product::where('name', 'like', '%' . $query . '%')->where('status', 1)->get();

        return response()->json(['products' => $data]);
    }

    public function changeRegionToMalay(){
        Session::put('region', [
            'name' => 'Malaysia',
            'currency' => 'RM',
            'currency_name' => 'RM'
        ]);
        Session::forget('coupon');
        Cart::destroy();
        return redirect()->back();
    }
    public function changeRegionToBangladesh(){
        Session::put('region', [
            'name' => 'Global',
            'currency' => '৳',
            'currency_name' => 'BDT'
        ]);
        Session::forget('coupon');
        Cart::destroy();
        return redirect()->back();
    }

    public function faq(){

        $faqs = Faq::all();
        return view('frontend.pages.faq', compact('faqs'));
    }

    public function postPurchase(){
        return view('frontend.pages.post-purchase');
    }

    public function forceReg(){
        if(Session::has('user')){
            $userEmail = Session::get('user.email');
            $userExist = User::where('email', $userEmail)->exists();
            if(!$userExist){
                $user = new User();
    
                $user->first_name = 'Guest';
                $user->last_name = Session::get('user.name');
                $user->email = Session::get('user.email');
                $user->phone = Session::get('user.phone');
                $user->password = bcrypt('password');
                $user->role = 'guest';
                $user->save();

                $order = Order::findorFail(Session::get('user.order_id'));
                $order->user_id = $user->id;
                $order->save();
            }else{
                $user = User::where('email',$userEmail)->first();
                $order = Order::findorFail(Session::get('user.order_id'));
                $order->user_id = $user->id;
                $order->save();
                return redirect()->route('home');
            }
        }
        Session::forget('user');
        return redirect()->route('home');
    }
}
