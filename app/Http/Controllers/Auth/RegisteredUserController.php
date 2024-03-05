<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        if(User::where('email', $request->reg_email)->exists()){
            if(User::where('phone', $request->phone)->exists()){
                $request->validate([
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                $user = User::where('phone',$request->phone)->where('email',$request->reg_email)->first();
                if($user->role == 'guest'){
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->email = $request->reg_email;
                    $user->phone = $request->phone;
                    $user->password = bcrypt($request->password);
                    $user->role = 'user';
    
                    $user->save();
                    if(Session::has('user')){
                        $order = Order::findorFail(Session::get('user.order_id'));
                        $order->user_id = $user->id;
                        $order->save();
                    }
                    
                    event(new Registered($user));
        
                    Auth::login($user);
                    toastr('', 'success', 'Welcome to Ravenclaws');
                    return redirect()->intended('/user/dashboard');
                }
                else{
                    toastr('', 'error', 'User already Exists');
                    return redirect()->route('home');
                }
            }
            else{
                toastr('', 'error', 'User already Exists');
                return redirect()->route('home');
            }
            toastr('', 'error', 'User already Exists');
            return redirect()->route('home');
        }else{
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'reg_email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ], [
                'reg_email.required' => 'The Email Address is Required'
            ]);
            
            $user = new User();
    
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->reg_email;
            $user->phone = $request->phone;
            $user->password = bcrypt($request->password);
    
            $user->save();
            
    
            event(new Registered($user));
    
            Auth::login($user);
    
            return redirect()->intended('/user/dashboard');
        }
    }
}
