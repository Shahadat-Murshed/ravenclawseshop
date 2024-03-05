
<a href="{{route('cart-details')}}">
    <div class="sticky-cart" id="sticky-cart">
        <i class="fa fa-solid fa-cart-shopping"></i>
        <div id="cart-count" class="ordernumber"><span>{{Cart::content()->count()}}</span></div>
    </div>
</a>
