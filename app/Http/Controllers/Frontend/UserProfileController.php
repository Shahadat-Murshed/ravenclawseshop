<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('frontend.pages.user_account.profile', compact('user'));
    }

    public function updateProfile(Request $request){
        // dd($request->all());
        
        $request->validate([
            'first_name' => ['required', 'max:100'],
            'last_name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id],
        ]);

        $user = Auth::user();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        toastr('', 'success', 'Profile Updated Successfully.');
        return redirect()->route('user.dashboard');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password'=> ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password),
        ]);
        

        toastr('', 'success', 'Password Changed Successfully.');
        return redirect()->back();
    }
}


