<div class="swiper" style="width: 100%;">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    @foreach ($sliders as $slider)
      <div class="swiper-slide home-slide" style="background: url({{ $slider->banner }}); background-size: cover; background-position: center center">
        <div class="container">
            <div class="row info-holder">
              <div class="col-md-8 col-12 info">
                <span class="title">{!! $slider->title !!}</span>
                <span class="sub-title">{!! $slider->sub_title !!}</h6>
              </div>
              <div class="col-md-4 col-12 cta">
                <a type=button class="btn btn-primary px-5" href="{{$slider->btn_url}}">{{$slider->btn_text}}</a>
              </div>
            </div>
        </div>
      </div>
    @endforeach
  </div>
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>

  <!-- If we need navigation buttons -->
  <!-- <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div> -->

  <!-- If we need scrollbar -->
  <!-- <div class="swiper-scrollbar"></div> -->
</div>
