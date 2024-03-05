@extends('frontend.layouts.master')
@section('title')
  {{$category->name}}
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/plp.css" />
@endpush

@section('content')
<div class="parent-div" style="padding-top: 10vh" id="parent-div">
      <div class="container">
        <div class="col-12">
          <div class="title-holder">
            <i class="fas fa-yin-yang"></i>
            <span>{{$category->name}}</span>
          </div>
          <div class="row">
            @foreach ($products as $product)
              @if ($product->category_id == $category->id)
              <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                <a class="product-card hidden" style="position: relative" href="{{route('product.details', $product->slug)}}">
                    <img
                      src="{{asset($product->thumb_image)}}"
                      alt=""
                    />
                    @if ($product->allVariantsHaveOutStock())
                        <div style="position: absolute; top: -10px; right: -10px; background-color: #B2A59B; padding: 5px 10px; border:1px solid black;border-bottom:3px solid black; border-left:3px solid black; border-radius: 15px; display: grid">
                            <span style="font-size: 12px;margin:0px;color:black!important; font-weight: 500">Out of Stock</span>
                        </div>
                    @elseif ($product->hasDiscount())
                        <div style="position: absolute; top: -10px; right: -10px; background-color: #008170; padding: 5px 10px; border:1px solid black;border-bottom:3px solid black; border-left:3px solid black; border-radius: 15px; display: grid">
                            <span style="font-size: 12px;margin:0px;color:black!important; font-weight: 500" >Offer Running 🔥</span>
                        </div>
                    @elseif ($product->hasLowStockPercentage())
                        <div style="position: absolute; top: -10px; right: -10px; background-color: #B15EFF; padding: 5px 10px; border:1px solid black;border-bottom:3px solid black; border-left:3px solid black; border-radius: 15px; display: grid">
                            <span style="font-size: 12px;margin:0px;color:black!important; font-weight: 500">Few Left!</span>
                        </div>
                    @endif
                </a>
                <span class="product-title"
                  >{{$product->name}}</span>
              </div>
              @endif
            @endforeach
          </div>
        </div>
      </div>

    {{-- <div class="col-12 mt-5 mb-5 px-3 pt-5">
        <h2 class="text-center">Why Trust RavenClaw?</h2>
        <p class="text-center" style="color: var(--neutral)">
            Ravenclaws deserves your trust because of their proven track record of
            providing quality products and services, our commitment to customer
            satisfaction, and our dedication to delivering an exceptional online
            shopping and gaming experience.
        </p>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12 col-12 text-center p-3">
                    <i class="fa-3x fa-solid fa-bolt-lightning mb-3"></i>

                    <h5>Ensures instant delivery</h5>
                    <p style="color: var(--neutral); text-align: justify">
                        Ravenclaws Eshop is dedicated to rapid and reliable service,
                        ensuring instant delivery to your virtual doorstep for an
                        unparalleled shopping experience. Say goodbye to waiting and
                        hello to instant gratification with our swift delivery
                        system.
                    </p>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-12 col-12 text-center p-3">
                    <i class="fa-3x fa-solid fa-clock mb-3"></i>
                    <h5>Round-the-clock support</h5>
                    <p style="color: var(--neutral); text-align: justify">
                        Ravenclaws Eshop provides 24/7 support, so you can shop with
                        confidence knowing that help is always just a click away,
                        ensuring a seamless and worry-free experience.
                    </p>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-12 col-12 text-center p-3">
                    <i class="fa-3x fa-solid fa-crown mb-3"></i>
                    <h5>Royalty customer benefits</h5>
                    <p style="color: var(--neutral); text-align: justify">
                        Ravenclaws Eshop recognizes and rewards loyalty with
                        exclusive royalty customer benefits, ensuring that your
                        continued support is truly appreciated and valued on our
                        platform. Enjoy special privileges and exclusive perks as a
                        token of our gratitude for your commitment
                    </p>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-12 col-12 text-center p-3">
                    <i class="fa-3x fa-solid fa-basket-shopping mb-3"></i>
                    <h5>Hassle-free shopping experience</h5>
                    <p style="color: var(--neutral); text-align: justify">
                        At Ravenclaws Eshop, we prioritize your convenience,
                        offering a user-friendly interface and streamlined processes
                        to ensure a hassle-free shopping experience. Shop with ease,
                        confidence, and simplicity as you explore our diverse range
                        of gaming points and subscription-based services.
                    </p>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="container mt-5" >
        <div class="generic-holder">
            <div class="header">
                <div class="col-12">
                    <div class="title-holder">
                    <i class="fas fa-yin-yang"></i>
                    <span>Featured Finds</span>
                    </div>
                </div>
            </div>
            <div class="swiper-container-fade col-12">
                @include('frontend.pages.recommended-product-slider')
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
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
          slidesPerView: 5,
          spaceBetween: 20,
        },
      },
      navigation: false,
      autoplay: {
            delay: 2000,    // Autoplay speed in milliseconds (2 seconds in this example)
          },

    });
</script>
@endpush
