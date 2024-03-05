@extends('frontend.layouts.master')

@section('title')
    {{$product->name}}
@endsection

@push('styles')
  <link rel="stylesheet" href="{{asset('frontend/assets')}}/css/pdp.css" />
@endpush

@section('content')
<div class="banner col-12">
  <img
    src="{{asset($product->cover_image)}}"
    alt="{{$product->name}} Cover Image"
  />
</div>
<div class="parent-div" style="padding-top: 10vh" id="parent-div">
  <div class="container elevated">
    <div class="header">
      <div class="breadcrumb">
        <a href="{{ url()->previous() }}">
          <span><i class="fa fas fa-circle-arrow-left"></i> back </span>
        </a>
      </div>
      <div class="row">
        <div class="logo col-xl-5 col-md-5 col-12">
          <img src="{{asset($product->icon)}}" alt="{{$product->name}} Logo" />
        </div>
      </div>
    </div>
    <div class="row">
      <!-- left section -->
      <div
        class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12"
        style="min-height: 5vh"
      >
        <div class="game-info mb-4" style="text-align: center">
          <span class="title">{{$product->name}}</span>
          <div class="mt-2" style="text-align: justify; color: rgba(255, 255, 255, 0.5);" class="description">{!! $product->description !!}</div>
        </div>
        <hr />
        <div class="order-info mt-4">
          <span class="title">How to order</span>
          <p class="description" style="text-align: justify">
            {!! $product->how_to_order !!}
          </p>
        </div>
      </div>
      <!-- right section -->
      <div
        class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 purchase-corner"
        id="purchase-corner"
        style="min-height: 5vh"
      >
        {{-- product variant --}}
        <div class="corner product-variant col-12" style="min-height: 15vh">
          <div class="header pt-2 pb-2">
            <h4 class="mb-0" style="font-weight: 400!important">Pick Your Poison</h4>
          </div>
          <div class="body" id="variant-row">
            <div class="row">
              @foreach ($product_variants as $product_variant )
                {{-- if variant is in stock --}}
                @if ($product_variant->in_stock)
                    <div class="col-6 mb-3">
                        <button
                            class="variant-card variant-card-active"
                            id="product_{{ $product_variant['id']}}"
                            data-variant="{{ $product_variant['id']}}"
                            data-quantity="{{$product_variant->unit}}"
                            data-price="{{$product_variant->discount_price ? $product_variant->discount_price : $product_variant->price}}"
                            onclick="{{$product_variant->in_stock ? 'scrollToInfoCorner()' : ''}}">
                            <span class="amount" style="display: inline-block">
                                {{$product_variant->unit}}
                            </span>
                            <br>
                            @if(getRegion() == 'Malaysia')
                                @if (checkDiscount($product_variant))
                                    <span class="variant-current-price">{{currency()}}{{$product_variant->discount_price_rm}}</span>
                                    <strike class="variant-original-price" style="color: var(--neutral)">
                                        {{currency()}}{{$product_variant->price_rm}}
                                    </strike>
                                @else
                                    <span class="variant-current-price">{{currency()}}{{$product_variant->price_rm}}</span>
                                @endif
                            @elseif (getRegion() == 'Global')
                                @if (checkDiscount($product_variant))
                                    <span class="variant-current-price">{{currency()}}{{$product_variant->discount_price}}</span>
                                    <strike class="variant-original-price" style="color: var(--neutral)">
                                        {{currency()}}{{$product_variant->price}}
                                    </strike>
                                @else
                                    <span class="variant-current-price">{{currency()}}{{$product_variant->price}}</span>
                                @endif
                            @endif
                        </button>
                    </div>
                {{-- if variant is out of stock --}}
                @elseif (!$product_variant->in_stock)
                    <div class="col-6 mb-3">
                        <button
                            class="variant-card variant-card-inactive"
                            id="product_{{ $product_variant['id']}}">
                            <span class="amount" style="display: inline-block">
                                {{$product_variant->unit}}
                            </span>
                            <br>
                            <span style="color: grey">Out of Stock</span>
                        </button>
                    </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
        {{-- atc-info --}}
        <div
          class="corner payment-method col-12 d-none"
          id="info-corner"
          style="min-height: 10vh"
        >
          <div class="header pt-2 pb-2">
            <h4 class="mb-0" style="font-weight: 400!important">Add Details</h4>
          </div>
          <div class="body">
            <div id="purchase-state">
              <p>Grab <span id="order-details"></span> for <span id="order-price"></span> for {{$product->name}}</p>
              <p>
                  Please Fillout Information Bellow
              </p>
              <form class="cart-form" id="cart-form" method="POST" action="{{route('add-to-cart')}}">
                  @csrf
                  <div class="in-game-info" id="in-game-info">
                      @if ($product->ign_required)
                          <label for="ign">Enter Your {{$product->ign_type}}</label>
                          <div class="row mt-2">
                              <div
                                  class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                              >
                                  <input name="ign" placeholder="{{$product->ign_example}}" id="ign" class="custom-input" required type="text" />
                              </div>
                          </div>
                          <br>
                      @endif
                      @if ($product->tag_required)
                          <label for="tag">Enter Your {{$product->tag_type}}</label>
                          <div class="row mt-2">
                              <div
                                  class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                              >
                                  <input name="tag" placeholder="{{$product->tag_type}}" id="tag" class="custom-input" required type="text" />
                              </div>
                          </div>
                          <br>
                      @endif
                      @if ($product->region_required)
                          <label for="region">Select Your {{$product->region_type}}</label>
                          <div class="row mt-2">
                              <div
                                  class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                              >
                                  <select class="form-select text-center" name="region" id="region">
                                    @if ($product->region_type == 'Region')
                                        <option disabled selected>---- Select Region ----</option>

                                        @foreach ($regions as $region)
                                          <option value="{{$region->title}}">{{$region->title}}</option>
                                        @endforeach

                                    @elseif ($product->region_type == 'Platform')
                                        <option disabled selected>---- Select Platform ----</option>

                                        @foreach ($platforms as $platform)
                                          <option value="{{$platform->title}}">{{$platform->title}}</option>
                                        @endforeach
                                    @endif
                                  </select>
                              </div>
                          </div>
                          <br>
                      @endif
                      @if ($product->pass_required)
                          <label for="pass">Enter Your {{$product->password_type}}</label>
                          <div class="row mt-2">
                              <div
                                  class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                              >
                                  <input name="pass" id="pass" required class="custom-input" type="text" />
                              </div>
                          </div>
                          <br>
                      @endif
                      <input type="hidden" value="" name="variant_id" id="input-variant">
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100" id="submit-info">Add To Cart</button>
                      </div>
                  </div>
              </form>
            </div>
            <div id="after-purchase-state">
              <h5>Way to go 🔥</h5>
              <p>You just added <span id="order-details-ap" style="color:var(--yellow-color)"></span> for <span id="order-price-ap" style="color:var(--yellow-color)"></span> for {{$product->name}} in the cart</p>
              <div class="col-12">
                  <a href="{{route('cart-details')}}" class="btn btn-primary w-100 d-none mt-3" id="go-to-checkout"> <i class="fa fa-solid fa-cart-shopping"></i> &nbsp;Go To Cart</a>
              </div>

              <div class="col-12">
                  <button class="btn btn-secondary w-100 d-none mt-3" id="scroll-to-variants" onclick="scrollToVariantRow()">Check Other Variants</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container recommended">
    <div class="header">
      <div class="col-12">
        <div class="title-holder">
          <i class="fas fa-yin-yang"></i>
          <span> Featured Finds</span>
        </div>
      </div>
    </div>
    <div class="swiper-container-fade col-12">
      @include('frontend.pages.recommended-product-slider')
    </div>
  </div>
</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".variant-card-active").click(function() {;

                var submitButton = $('#submit-info');
                var scrollToVariant = $('#scroll-to-variants');
                var goToCheckout = $('#go-to-checkout');
                var purchaseState = $('#purchase-state');
                var afterPurchaseState = $('#after-purchase-state');

                // Add the 'disabled' class and update the button text with an icon
                submitButton.removeClass('d-none');
                scrollToVariant.addClass('d-none');
                goToCheckout.addClass('d-none');
                purchaseState.removeClass('d-none');
                afterPurchaseState.addClass('d-none');

                /** Assigning Values **/
                var productId = $(this).attr('id');
                var variantId = $(this).data('variant');
                var productQty = $(this).data('quantity');
                var productPrice = $(this).data('price');
                // console.log(`#${productId}`);

                /** Removing class from all the other buttons **/
                $('.variant-card').removeClass('focus-variant-card');
                $('.variant-card').find('.price').removeClass('focus-price');

                /** Adding class to the selected button **/
                $(this).addClass("focus-variant-card");
                $(this).find('.price').addClass('focus-price');

                /* Revealing the info corner with order details and price */
                $("#info-corner").removeClass("d-none");
                $("#order-details").text(productQty);
                $("#order-price").text('৳'+productPrice);
                $("#order-details-ap").text(productQty);
                $("#order-price-ap").text(' ৳'+ productPrice);

                /* Assigning Values for Cart */
                $("#input-variant").val(variantId);
                $("#input-qty").val(productQty);
                $("#input-price").val(productPrice);
            });


            /** Add to Cart Functionlity **/
            $('.cart-form').on('submit', function(e){
                e.preventDefault();
                var submitButton = $('#submit-info');
                var scrollToVariant = $('#scroll-to-variants');
                var goToCheckout = $('#go-to-checkout');
                var purchaseState = $('#purchase-state');
                var afterPurchaseState = $('#after-purchase-state');


                // Add the 'disabled' class and update the button text with an icon
                submitButton.addClass('disabled').html('<i class="fa fa-spinner fa-spin"></i> Adding to Cart');
                $.ajax({
                    method: 'POST',
                    data: jQuery('#cart-form').serialize(),
                    url: "{{route('add-to-cart')}}",
                    success: function(data){
                        if(data.status == 'error'){
                          toastr.error(data.message)
                          submitButton.removeClass('disabled').html('Add To Cart');
                        }
                        if(data.status == 'success'){
                          toastr.success(data.message);
                          getCartCount();
                          // hiding the submit button after a variant is added to cart
                          purchaseState.addClass('d-none');
                          afterPurchaseState.removeClass('d-none');
                          submitButton.addClass('d-none');
                          submitButton.removeClass('disabled').html('Add To Cart');
                          // clearing the cart form
                          $('.cart-form').trigger('reset');
                          // hiding after purchase button
                          scrollToVariant.removeClass('d-none');
                          goToCheckout.removeClass('d-none');
                        }
                    },
                    error: function(data){

                    }
                })
            })

            function getCartCount(){
                $.ajax({
                    method: 'GET',
                    url: "{{route('cart.count')}}",
                    success: function(data){
                        $('#cart-count').text(data);
                        $('.mobile-cart').text(data);

                    },
                    error: function(data){

                    }
                })
            }
        });
    </script>

    <script>
    var swiper = new Swiper(".recommendedSwiper", {
        grid: {
        rows: 1,
        },
        spaceBetween: 20,
        mousewheel: true,
        pagination: {
        el: ".swiper-pagination",
        clickable: true,
        },
        pagination: false,
        breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
        1440: {
            slidesPerView: 5,
            spaceBetween: 20,
        },
        },
        navigation: false,
        autoplay: {
        delay: 2000, // Autoplay speed in milliseconds (2 seconds in this example)
        },
    });
    </script>
    {{-- scroll behaviour scripts --}}
    <script>
      function scrollToInfoCorner() {
          var infoCorner = document.getElementById('info-corner');

          setTimeout(function() {
          // Calculate the target offset, considering 5vh before the "info-corner"
          var targetOffset = infoCorner.getBoundingClientRect().top + window.scrollY - 0.1 * window.innerHeight;

          window.scrollTo({ top: targetOffset, behavior: 'smooth' });
          }, 100);
      }
      function scrollToVariantRow() {
          // Get the "variant-row" element
          var variantRow = document.getElementById('variant-row');

          // Calculate the target offset, considering 10vh before the "variant-row"
          var targetOffset = variantRow.getBoundingClientRect().top + window.scrollY - 0.15 * window.innerHeight;

          // Scroll to the "variant-row" element
          window.scrollTo({ top: targetOffset, behavior: 'smooth' });
      }
    </script>
@endpush
