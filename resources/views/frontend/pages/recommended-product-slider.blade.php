<div
    class=" swiper recommendedSwiper"
    style="width: 100%;"
>
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach ($all_products as $product)
            <div class="swiper-slide">
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
        <!-- If we need pagination -->

        <!-- If we need scrollbar -->
    </div>
    <!-- <div class="swiper-scrollbar"></div> -->
    <div class="swiper-pagination"></div>
</div>
