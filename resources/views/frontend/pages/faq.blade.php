@extends('frontend.layouts.master')

@section('title', 'FAQ')


@push('styles')
<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/faq.css" />
@endpush

@section('content')
<div class="parent-div" style="padding-top: 15vh" id="parent-div">
    <section>
        <div class="container">
            <h5 class="text-center">General Questions</h5>

              <div class="accordion faq-accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      1. How does Ravenclaws eShop ensure swift delivery of products?
                    </button>
                  </h2>
                  {{-- 1s item is expanded/ shown here, later divs wont have the show class  --}}
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-light">
                      At Ravenclaws eShop, we prioritize efficiency. Upon placing an order for gaming currency, gift cards, or entertainment subscriptions, customers can expect to receive their products within 3 to 10 minutes.
                    </div>
                  </div>
                </div>
                @foreach ($faqs as $faq)
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{$faq->id}}">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$faq->id}}" aria-expanded="false" aria-controls="collapse{{$faq->id}}">
                        {!!$faq->title!!}
                      </button>
                    </h2>
                    <div id="collapse{{$faq->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$faq->id}}" data-bs-parent="#accordionExample">
                      <div class="accordion-body text-light">
                        {!!$faq->description!!}
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
        </div>
    </section>
</div>
@endsection
