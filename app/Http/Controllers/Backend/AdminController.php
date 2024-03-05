<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){

        $orders = Order::all();
        $users = User::all();
        
        $todaysOrder = Order::whereDate('created_at', Carbon::today())->count();
        $todaysCompletedOrder = Order::whereDate('created_at', Carbon::today())->where('order_status', 'completed')->count();
        $todaysPendingOrder = Order::whereDate('created_at', Carbon::today())->where('order_status', 'pending')->count();
        $todaysCancelledOrder = Order::whereDate('created_at', Carbon::today())->where('order_status', 'cancelled')->count();
        
        $todaysEarningBD = Order::whereDate('created_at', Carbon::today())->where('order_status', 'completed')->where('region', 'Global')->sum('total');
        $monthlyEarningBD = Order::whereMonth('created_at', Carbon::now()->month)->where('order_status', 'completed')->where('region', 'Global')->sum('total');
        $yearlyEarningBD = Order::whereYear('created_at', Carbon::now()->year)->where('order_status', 'completed')->where('region', 'Global')->sum('total');
        $totalEarningBD = Order::where('order_status', 'completed')->where('region', 'Global')->sum('total');

        $todaysEarningMalay = Order::whereDate('created_at', Carbon::today())->where('order_status', 'completed')->where('region', 'Malaysia')->sum('total');
        $monthlyEarningMalay = Order::whereMonth('created_at', Carbon::now()->month)->where('order_status', 'completed')->where('region', 'Malaysia')->sum('total');
        $yearlyEarningMalay = Order::whereYear('created_at', Carbon::now()->year)->where('order_status', 'completed')->where('region', 'Malaysia')->sum('total');
        $totalEarningMalay = Order::where('order_status', 'completed')->where('region', 'Malaysia')->sum('total');

        $category = Category::where('status', 1)->count();
        $products = Product::where('status', 1)->get();

        return view('admin.dashboard', 
            compact(
                'orders',
                'todaysOrder',
                'todaysCompletedOrder',
                'todaysPendingOrder',
                'todaysCancelledOrder',
                'todaysEarningBD',
                'monthlyEarningBD',
                'yearlyEarningBD',
                'totalEarningBD',
                'todaysEarningMalay',
                'monthlyEarningMalay',
                'yearlyEarningMalay',
                'totalEarningMalay',
                'users',
                'category',
                'products',
            ));
    }

    public function notifications(){
        $notifications = auth()->user()->unreadNotifications;
        return view('admin.notifications', compact('notifications'));
    }

    public function login(){
        return view('auth.login');
    }

    public function markSingleAsRead(Request $request, $id)
    {
        Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
        return redirect()->back();
    }

    public function markAsRead(Request $request)
    {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }
}
