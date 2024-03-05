@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Track New Orders</h1>
        </div>
        @forelse ($notifications as $notification)
            <div class="container">
                <div class="alert alert-info text-dark" role="alert">
                    {{ $notification->data['message'] }}
                    <br>
                    Invoice No: <a class="font-weight-bold text-dark" href="{{route('admin.orders.show', $notification->data['order_id'])}}">{{ $notification->data['invoice'] }}</a>
                    <a href="{{route('admin.markSingleAsRead', $notification->id)}}" class="float-right">
                        Mark as read
                    </a>
                    <br>
                    <span><i style="margin-right: 5px" class="icon far fa-clock"></i>{{\Carbon\Carbon::parse($notification->created_at)->format('jS F, h:i A') }}
                    </span>
                </div>
            </div>
            @if($loop->last)
                <div class="container justify-content-end">
                    <a href="{{route('admin.markAllAsRead')}}">
                        Mark all as read
                        <audio id="alert-audio"></audio>
                    </a>
                </div>
            @endif
        @empty
            There is no new notifications.<br>
            Last Checked <i class="icon far fa-clock mx-1"></i>{{\Carbon\Carbon::parse()->format('h:i A') }}
        @endforelse
        {{-- @php
            $products = \App\Models\Product::all();
            foreach($products as $product){
                echo "<br>Route::get('products-variants/$product->slug', [ProductVariantController::class, $product->slug])->name('products-variants.$product->slug');";
            }
        @endphp --}}
    </section>
@endsection
@push('scripts')
    <script>
        setInterval(function(){
            location.reload();
            }, 60000);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elementToCheck = document.getElementById('alert-audio');
            if (elementToCheck) {
                var audio = new Audio("{{asset('backend/assets/audio/notification.mp3')}}");
                audio.play();
            }
        });
    </script>
@endpush