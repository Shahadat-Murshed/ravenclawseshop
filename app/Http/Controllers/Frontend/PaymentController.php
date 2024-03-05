<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderPlaced;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Transaction;
use App\Models\User;
use Cart;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function checkout()
    {

        $cartItems = Cart::content();
        $count = count($cartItems);
        $bkash = PaymentMethod::where('name', 'bkash')->where('is_default', 1)->first()->number;
        $nagad = PaymentMethod::where('name', 'nagad')->where('is_default', 1)->first()->number;
        $rocket = PaymentMethod::where('name', 'rocket')->where('is_default', 1)->first()->number;

        if ($count == 0) {
            toastr('', 'warning', 'Cart is empty!');
            return redirect()->route('home');
        }
        return view('frontend.pages.checkout', compact('cartItems', 'bkash', 'nagad', 'rocket'));
    }

    public function storeOrder($request)
    {
        $user_id = Auth::user()->id ?? null;
        try {
            DB::beginTransaction();

            // Order Details
            $order = new Order();
            $order->user_id = $user_id;
            $order->invoice_id = $this->generateInvoiceNumber();
            $order->sub_total = getCartTotal();
            $order->discount = getDiscount();
            $order->total = getMainTotal();
            $order->payment_status = 'pending';
            $order->user_name = $request->name;
            $order->user_email = $request->email;
            $order->user_phone = $request->phone;
            $order->coupon = getCoupon();
            $order->order_status = 'pending';
            $order->region =  getRegion();
            $order->product_quantity = getCartCount();

            $order->save();

            //Per Item in the Order Details
            event(new OrderPlaced($order));
            $cartItems = Cart::content();

            foreach ($cartItems as $cartItem) {
                $variant = ProductVariant::findorFail($cartItem->id);
                $product = Product::findorFail($variant->product_id);

                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->variant_id = $cartItem->id;
                $orderItem->product_id = $product->id;
                $orderItem->price = $cartItem->price;
                $orderItem->quantity = $cartItem->qty;
                $orderItem->unit = $cartItem->options->unit;
                $orderItem->ign = $cartItem->options->ign;
                $orderItem->tag = $cartItem->options->tag;
                $orderItem->region = $cartItem->options->region;
                $orderItem->pass = $cartItem->options->pass;

                $orderItem->save();
            }

            //Transaction Details
            $transaction = new Transaction();
            $transaction->order_id = $order->id;
            $transaction->payment_method = strtolower($request->pymnt_method);
            if ($transaction->payment_method == 'bkash') {
                $transaction->paid_to = PaymentMethod::where('name', 'bkash')->where('is_default', 1)->first()->number;
            } elseif ($transaction->payment_method == 'nagad') {
                $transaction->paid_to = PaymentMethod::where('name', 'nagad')->where('is_default', 1)->first()->number;
            } elseif ($transaction->payment_method == 'rocket') {
                $transaction->paid_to = PaymentMethod::where('name', 'rocket')->where('is_default', 1)->first()->number;
            } else {
                $transaction->paid_to = null;
            }
            $transaction->payment_id = $request->payment_id;
            $transaction->transaction_id = $request->trx_id;
            $transaction->currency = currency();
            $transaction->amount = getMainTotal();

            $transaction->save();

            DB::commit();
        } catch (\Throwable $error) {
            DB::rollBack();
            Log::error($error->getMessage());
            return response()->json(['errors' => 'Something went wrong.'], 500);
        }
        return $order->id;
    }

    public function clearSession()
    {
        Cart::destroy();
        Session::forget('coupon');
    }

    public function generateInvoiceNumber()
    {
        do {
            $invoiceNumber = $this->generateRandomInvoiceNumber();
        } while ($this->isInvoiceNumberUnique($invoiceNumber));

        return $invoiceNumber;
    }

    protected function generateRandomInvoiceNumber()
    {
        $currentDate = now()->format('Ymd');
        return 'inv_' . $currentDate . '_' . Str::random(4); // Example: INVabc1234
    }

    protected function isInvoiceNumberUnique($invoiceNumber)
    {
        return Order::where('invoice_id', $invoiceNumber)->exists();
    }

    public function bdPayment(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'max:200', 'email'],
            'phone' => ['required', 'regex:/^\d{11}$|^\+8801[0-9]{9}$/'],
            'pymnt_method' => ['required'],
            'payment_id' => ['required', 'max: 15'],
            'trx_id' => ['required', 'max: 200', 'unique:transactions,transaction_id'],
        ], [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name must not exceed 200 characters.',
            'email.required' => 'The email field is required.',
            'email.max' => 'The email must not exceed 200 characters.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter a valid Phone Number',
            'pymnt_method.required' => 'Please select a payment method.',
            'payment_id.required' => 'Please Enter Your ' . $request->pymnt_method . ' Number',
            'payment_id.max' => 'Please Provide a valid ' . $request->pymnt_method . ' Number',
            'trx_id.required' => 'Please Enter the Transcation ID',
            'trx_id.max' => 'The transaction ID must not exceed 200 characters.',
            'trx_id.unique' => 'Invalid transaction id',
        ]);


        $order_id  = $this->storeOrder($request);
        if (!Auth::user()) {
            Session::put('user', [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'order_id' => $order_id,
            ]);
            if (Session::has('user')) {
                $userEmail = Session::get('user.email');
                $userExist = User::where('email', $userEmail)->exists();
                if (!$userExist) {
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
                } else {
                    $user = User::where('email', $userEmail)->first();
                    $order = Order::findorFail(Session::get('user.order_id'));
                    $order->user_id = $user->id;
                    $order->save();
                    return redirect()->route('home');
                }
            }
            Session::forget('user');
        }
        $this->clearSession();
        toastr('', 'success', 'Order Placed Successfully.');
        return redirect()->route('post-purchase');
    }
}
