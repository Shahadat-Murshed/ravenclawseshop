<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        $latestCancelled = Order::where('user_id', $user->id)->where('order_status', 'cancelled')->latest()->first();
        $latestPending = Order::where('user_id', $user->id)->where('order_status', 'pending')->latest()->first();
        $latestCompleted = Order::where('user_id', $user->id)->where('order_status', 'completed')->latest('updated_at')->first();
        return view('frontend.pages.user_account.dashboard', 
        compact(
            'user', 
            'orders', 
            'latestCancelled',
            'latestPending', 
            'latestCompleted',
        ));
    }
}