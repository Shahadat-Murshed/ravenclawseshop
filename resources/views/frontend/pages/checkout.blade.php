@extends('frontend.layouts.master')

@section('title')
  Checkout
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/css/checkout.css" />
@endpush

@section('content')
<div class="parent-div" style="padding-top: 10vh">
    {{-- <div class="container py-5">
        <div class="title-holder">
            <i class="fas fa-yin-yang"></i>
            <span>Checkout</span>
        </div>
    </div> --}}
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-12 order-2 order-lg-1">
                <div class="title-holder">
                    <span>Billing Details</span>
                </div>

                <div class="col-12">
                    <form action="{{route('payment-bd')}}" method="POST">
                        @csrf
                        <div class="col-12 mb-2 mt-2">
                            <label for="name">
                                Name
                            </label>
                            <br>
                            <input name="name"
                                @if (Auth::user())
                                    value="{{Auth::user()->first_name}} {{Auth::user()->last_name}}"
                                @else
                                    value="{{old('name')}}"
                                @endif
                            id="name" class="custom-input" type="text">
                        </div>
                        <div class="col-12 mb-2">
                            <label for="email">
                                Email
                            </label>
                            <br>
                            <input name="email"
                                @if (Auth::user())
                                    value="{{Auth::user()->email}}"
                                @else
                                    value="{{old('email')}}"
                                @endif
                            id="email" class="custom-input" type="email">
                        </div>
                        <div class="col-12 mb-2">
                            <label for="phone">
                                Phone Number
                            </label>
                            <br>
                            <input name="phone"
                                @if (Auth::user())
                                    value="{{Auth::user()->phone}}"
                                @else
                                    value="{{old('phone')}}"
                                @endif
                            id="phone" class="custom-input" type="tel">
                        </div>
                        @if (getRegion() == 'Global')
                            <input type="hidden" value="bkash" name="pymnt_method" id="pymnt_method">
                            <div class="col-12 mt-5">
                                <div class="title-holder">
                                    <span>Payment Method</span>
                                </div>
                                <div class="mt-3">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" id="bKash" role="presentation">
                                        <button class="nav-link active" id="bkash-tab" data-bs-toggle="tab" data-bs-target="#bkash-instructions" type="button" role="tab" aria-controls="bkash" aria-selected="true">
                                            <img class="img-fluid" src="https://freelogopng.com/images/all_img/1656234745bkash-app-logo-png.png" alt="">
                                            <span>bKash</span>
                                        </button>
                                        </li>
                                        <li class="nav-item" id="Nagad" role="presentation">
                                        <button class="nav-link" id="nagad-tab" data-bs-toggle="tab" data-bs-target="#nagad-instructions" type="button" role="tab" aria-controls="nagad" aria-selected="false">
                                            <img src="https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png" alt="">
                                            <span>Nagad</span>
                                        </button>
                                        </li>
                                        <li class="nav-item" id="Rocket" role="presentation">
                                        <button class="nav-link" id="rocket-tab" data-bs-toggle="tab" data-bs-target="#rocket-instructions" type="button" role="tab" aria-controls="rocket" aria-selected="false">
                                            <img src="https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png" alt="">
                                            <span>Rocket</span>
                                        </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="bkash-instructions" role="tabpanel" aria-labelledby="bkash-tab">
                                            <h5 class="mt-3">Pay with bkash</h5>
                                            <p>
                                                1. Open the bkash app or dial *247#.
                                                <br>
                                                2. Choose send money.
                                                <br>
                                                3. Enter <b>{{$bkash}}</b>.
                                                <br>
                                                4. Enter <b class="bill-amount">{{getMainTotal()}}</b> tk as the amount.
                                                <br>
                                                5. Note the <b>Transaction ID</b>
                                                <br>
                                                6. Drop your transaction ID and bkash number here
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="nagad-instructions" role="tabpanel" aria-labelledby="nagad-tab">
                                            <h5 class="mt-3">Pay with Nagad</h5>
                                            <p>
                                                1. Open the Nagad app or dial *167#.
                                                <br>
                                                2. Choose send money.
                                                <br>
                                                3. Enter <b>{{$nagad}}</b>.
                                                <br>
                                                4. Enter <b class="bill-amount">{{getMainTotal()}}</b> tk as the amount.
                                                <br>
                                                5. Note the <b>Transaction ID</b>
                                                <br>
                                                6. Drop your transaction ID and Nagad number here
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="rocket-instructions" role="tabpanel" aria-labelledby="rocket-tab">
                                            <h5 class="mt-3">Pay with Rocket</h5>
                                            <p>
                                                1. Open the Rocket app or dial *322#.
                                                <br>
                                                2. Choose send money.
                                                <br>
                                                3. Enter <b>{{$rocket}}</b>.
                                                <br>
                                                4. Enter <b class="bill-amount">{{getMainTotal()}}</b> tk as the amount.
                                                <br>
                                                5. Note the <b>Transaction ID</b>
                                                <br>
                                                6. Drop your transaction ID and Rocket number here
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="payment_id">
                                    <h5> <span id="selected_method">bKash</span> No:</h5>
                                </label>
                                <br>
                                <input name="payment_id" value="{{old('payment_id')}}" id="payment_id" class="custom-input" type="text">
                            </div>
                            <div class="col-12 mb-2">
                                <label for="trx_id">
                                    <h5> <span id="selected_method_trx">bKash</span> Transaction ID</h5>
                                </label>
                                <br>
                                <input name="trx_id" id="trx_id" class="custom-input" type="text">
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" id="placeOrder" class="btn btn-primary w-100">Place Order</button>
                            </div>
                        @endif
                    </form>

                </div>
            </div>
            <div class="col-lg-5 col-12 order-1 mb-3">
                <div class="row">
                    <div class="col-8 title-holder">
                        <span>Order Summary</span>
                    </div>
                    <div class="col-4 title-holder" style="text-align: right">
                        <span class="w-100">{{getCartCount()}} item(s)</span>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    {{-- each row for each product in the cart --}}

                    @foreach ($cartItems as $item)
                        <div class="row mt-2">
                            <div class="col-8">
                                <h5 class="variant-name" style="color: var(--neutral)">{!!$item->name!!}</h5>
                                <p class="variant-quantity">
                                    @if ($item->qty>1)
                                        {{$item->options->quantity}}<span> x {{$item->qty}}</span>
                                    @else
                                        {{$item->options->quantity}}
                                    @endif
                                </p>
                            </div>
                            <div class="col-4">
                                <p class="w-100" style="text-align: right">
                                    <span>{{currency()}}{{$item->price * $item->qty}}</span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <form id="coupon_form" action="" method="">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-12 mt-md-2">
                                <input name="coupon_code" type="text" class="custom-input" placeholder="Have a coupon?" value="{{Session::has('coupon') ? Session::get('coupon.coupon_code') : ''}}">
                            </div>
                            <div class="col-lg-4 col-12 mt-md-2">
                                <button type="submit" class="btn btn-primary w-100">Apply</button>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-4">
                        <div class="col-8">
                            <p>
                                <span>Subtotal</span>
                            </p>

                        </div>
                        <div class="col-4">
                            <p class="w-100" style="text-align: right">
                                <span>{{currency()}}{{getCartTotal()}}</span>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <p>
                                <span>Discount</span>
                            </p>

                        </div>
                        <div class="col-4">
                            <p class="w-100" style="text-align: right">
                                {{currency()}}<span id="discount">{{getDiscount()}}</span>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <p>
                                <span>Total</span>
                            </p>

                        </div>
                        <div class="col-4">
                            <p class="w-100" style="text-align: right">
                                {{currency()}}<span id="checkout-total">{{getMainTotal()}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.nav-item').on('click', function(){
                var clickedLiId = $(this).attr('id');
                $("#pymnt_method").val(clickedLiId);
                $("#selected_method").text(clickedLiId);
                $("#selected_method_trx").text(clickedLiId);
            })
        })
    </script>
    <script>
        //Coupon Verification
        $('#coupon_form').on('submit', function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method: 'GET',
                url: "{{route('apply-coupon')}}",
                data: formData,
                success: function(data){
                   if(data.status == 'error'){
                    toastr.error(data.message)
                   }else if(data.status == 'success'){
                    calculateCouponDiscount();
                    toastr.success(data.message)
                   }
                },
                error: function(data){
                    console.log(data);
                }
            })
        })

        function calculateCouponDiscount(){
            $.ajax({
                method: 'GET',
                url: "{{route('coupon-calc')}}",
                success: function(data){
                    if(data.status == 'success'){
                        $('#checkout-total').text(data.cart_total);
                        $('#discount').text(data.discount);
                        $('.bill-amount').text(data.cart_total);
                    }
                },
                error: function(data){
                    console.log(data);
                }
            })
        }
    </script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('placeOrder').addEventListener('click', function () {
            this.classList.add('disabled');
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Wrapping Up';
            setTimeout(function () {
                window.location.href = "{{ route('checkout') }}";
            }, 10000);
        });
    });
</script> --}}
@endpush
