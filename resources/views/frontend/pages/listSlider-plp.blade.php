<div
    class="swiper listSwiper"
    style="width: 100%; min-height: 100%"
>
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach ($products as $product)
            <div class="swiper-slide">
                <a class="product-card" href="{{route('product.details', $product->slug)}}">
                    <img
                        src="{{asset($product->thumb_image)}}"
                        alt="{{$product->name}}"
                    />
                </a>
                <span class="product-title"
                    >{{$product->name}}</span
                >
            </div>
        @endforeach
    </div>
    <div class="swiper-scrollbar"></div>
    <div class="swiper-pagination"></div>
</div>
