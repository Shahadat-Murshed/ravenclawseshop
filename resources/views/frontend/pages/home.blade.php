@extends('frontend.layouts.master')

@section('title', 'Home')


@push('styles')
<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/home.css" />
@endpush

@section('content')
  <div class="swiper-container-fade slider col-12">
    @include('frontend.pages.slider')
  </div>

<!-- TODO: slider navigation goes here. after that product card, make those dynamic -->
<div class="parent-div"  id="parent-div">
      {{-- <div class="slider-container mt-0">
        <div class="slider-nav col-4 mt-0"></div>
      </div> --}}
      <!-- 1st section -->
      @foreach ($productsByCategory as $categoryData)
        <section class="mt-0 pt-5">
          <div class="container">
            <div class="col-12">
              <div class="title-holder d-flex align-items-center justify-content-between">
                <div>
                  <i class="fas fa-yin-yang"></i>
                  <span>{{$categoryData['category']->name}}</span>
                </div>
                <div>
                  <a href="{{route('product.listing', $categoryData['category']->slug)}}">See All <i style="font-size: 1rem" class="fa-solid fa-angle-right"></i></a>
                </div>
              </div>
              <div class="row">
                @foreach ($categoryData['products'] as $product)
                  <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6" >
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

                @endforeach
              </div>
            </div>
          </div>
        </section>
      @endforeach


  </div>
@endsection
@push('scripts')
<script>
        const swiper = new Swiper(".swiper", {
          // Optional parameters
          loop: true,
          autoplay: {
            delay: 2000,    // Autoplay speed in milliseconds (2 seconds in this example)
          },

          // If we need pagination
        //   pagination: {
        //     el: ".swiper-pagination",
        //     clickable: true,
        //   },

          // Navigation arrows
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },

          // And if we need scrollbar
          scrollbar: {
            el: ".swiper-scrollbar",
          },
          breakpoints:{
            500:{
                pagination: false,
            }
          }
        });
</script>

@endpush
