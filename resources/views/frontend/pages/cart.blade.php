@extends('frontend.layouts.master')
@section('title')
  Shopping Cart
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/css/cart.css" />
@endpush
@section('content')
<div class="parent-div" style="padding-top: 10vh">

    <div class="container mb-5">
        <table id="cartTable" class="table table-dark table-striped nowrap" style="width:100%">
            <thead>
                <tr>
                    <th style="border-bottom: 1px dashed white" class="text-center">Product</th>
                    <th style="border-bottom: 1px dashed white" class="text-center">Product Title</th>
                    <th style="border-bottom: 1px dashed white" class="text-center">Item</th>
                    <th style="border-bottom: 1px dashed white" class="text-center">Unit Price</th>
                    <th style="border-bottom: 1px dashed white" class="text-center">Quantity</th>
                    <th style="border-bottom: 1px dashed white" class="text-center">Subtotal</th>
                    <th style="border-bottom: 1px dashed white" class="text-center">
                        Remove item
                    </th>
                    <!-- Add more columns if needed -->
                </tr>
            </thead>
            <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            {{-- <td height="80px" class="img align-items-middle"><a href="{{route('product.details', $item->options->slug)}}"><img src="{{asset($item->options->image)}}" alt="product"
                                    class="img-fluid h-100 ms-3" style="aspect-ratio:1; object-fit:cover;border-radius: 5px"></a>
                            </td> --}}
                            <td height="80px" class="img align-items-middle">
                                <a href="{{route('product.details', $item->options->slug)}}">
                                    <img src="{{asset($item->options->image)}}" alt="product" class="img-fluid h-100 ms-3" style="aspect-ratio:1; object-fit:cover;border-radius: 5px">
                                </a>

                            </td>
                            <td>
                                <span class="variant-name">{!!$item->name!!}</span>
                            </td>
                            <td >
                                <div>
                                    <span class="variant-quantity">
                                        {{$item->options->quantity}}
                                    </span>
                                </div>

                                <div class="mt-2">
                                    <span class="user-info" style="color:var(--yellow-color)">

                                        @if ($item->options->ign)
                                            <span class="ign">{!!$item->options->ign!!}</span><br>
                                        @endif
                                        @if ($item->options->tag)
                                            <span class="tag">{!!$item->options->tag!!}</span><br>
                                        @endif
                                        @if ($item->options->pass)
                                            <span class="pass">Password: {!!$item->options->pass!!}</span>
                                        @endif
                                        @if ($item->options->region)
                                            <span class="region">{!!$item->options->region!!}</span>
                                        @endif
                                    </span>
                                </div>

                            </td>
                            <td>
                                <span id="unit-price">
                                    ৳{{$item->price}}
                                </span>
                            </td>
                            <td>
                                <div>

                                    <i class="fa fa-minus fa-sm decrease" id="decrease" style="cursor: pointer"></i>
                                    <span class="variantQty" id="variantQty" data-rowid="{{$item->rowId}}">{{$item->qty}}</span>
                                    <i class="fa fa-plus fa-sm increase" id="increase" style="cursor: pointer"></i>
                                </div>

                            </td>
                            <td>
                                <span id="{{$item->rowId}}">
                                    ৳{{($item->price) *  ($item->qty)}}
                                </span>
                            </td>
                            <td class="">
                                <a href="{{route('cart.remove-product', $item->rowId)}}"><i class="fa-solid fa-xmark" style="color: red"></i></a>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
        <div class="row pt-3">
            <div class="col-md-7 col-12">
            </div>
            <div class="col-md-5 col-12">
                <div class="wrapper d-flex justify-content-between p-3" style="width:100%;background: rgba(17, 14, 43, 0.66);padding:5px">
                    <div >
                        <span id="#cart-count">
                          Total {{Cart::content()->count()}} items
                        </span>
                    </div>
                    <div >
                        <span id="cart-total" class="text-right">{{$total}} BDT</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('checkout') }}" class="btn btn-primary to-checkout" id="checkoutBtn" style="width:100%">
                    Continue to Checkout Page
                </a>
                <a href="#" class="btn btn-outline-danger py-1 px-2 clear_cart mt-2 " style="width:100%">Clear Cart <i class="fa-regular fa-trash-can"></i></a>
            </div>
        </div>
    </div>

    <div class="container">
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
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('.increase').on('click', function(){

        //     console.log('+1')

        //     let input = $(this).siblings('.variantQty');
        //     let quantity = parseInt(input.text()) + 1;
        //     let rowId = input.data('rowid');

        //     input.text(quantity);

        //     $.ajax({
        //         method: 'POST',
        //         url: "{{route('cart.update-quantity')}}",
        //         data: {
        //             rowId: rowId,
        //             quantity: quantity,
        //         },
        //         success: function(data){
        //             if(data.status == 'success'){
        //                 let productId = '#'+rowId;
        //                 $(productId).text(data.product_total)
        //                 getCartTotal();
        //                 toastr.success(data.message);
        //             }
        //         },
        //         error: function(data){

        //         }
        //     })
        // })

        // $('.decrease').on('click', function(){
        //     let input = $(this).siblings('.variantQty');
        //     let quantity = parseInt(input.text());
        //     let rowId = input.data('rowid');

        //     if(quantity > 1){
        //         quantity--;

        //         input.text(quantity);

        //         $.ajax({
        //             method: 'POST',
        //             url: "{{route('cart.update-quantity')}}",
        //             data: {
        //                 rowId: rowId,
        //                 quantity: quantity,
        //             },
        //             success: function(data){
        //                 if(data.status == 'success'){
        //                     let productId = '#'+rowId;
        //                     $(productId).text(data.product_total)
        //                     getCartTotal();
        //                     toastr.success(data.message);
        //                 }
        //             },
        //             error: function(data){

        //             }
        //         })
        //     }


        // })

        // increase - event delegated
        $(document).on('click', '.increase', function () {

            let input = $(this).siblings('.variantQty');
                let quantity = parseInt(input.text()) + 1;
                let rowId = input.data('rowid');

                input.text(quantity);

                $.ajax({
                    method: 'POST',
                    url: "{{route('cart.update-quantity')}}",
                    data: {
                        rowId: rowId,
                        quantity: quantity,
                    },
                    success: function(data){
                        if(data.status == 'success'){
                            let productId = '#'+rowId;
                            $(productId).text(data.product_total)
                            getCartTotal();
                            toastr.success(data.message);
                        }
                    },
                    error: function(data){

                    }
                })
        });

        // decrease - delegated
        $(document).on('click', '.decrease', function () {
        let input = $(this).siblings('.variantQty');
            let quantity = parseInt(input.text());
            let rowId = input.data('rowid');

            if(quantity > 1){
                quantity--;

                input.text(quantity);

                $.ajax({
                    method: 'POST',
                    url: "{{route('cart.update-quantity')}}",
                    data: {
                        rowId: rowId,
                        quantity: quantity,
                    },
                    success: function(data){
                        if(data.status == 'success'){
                            let productId = '#'+rowId;
                            $(productId).text(data.product_total)
                            getCartTotal();
                            toastr.success(data.message);
                        }
                    },
                    error: function(data){

                    }
                })
            }

        });

        $('.clear_cart').on('click', function(e){
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "This action will clear your cart!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#640263',
                confirmButtonText: 'Clear it!'
                }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'get',
                        url: "{{route('clear.cart')}}",

                        success: function(data){
                            if(data.status == 'success'){
                                window.location.reload();
                            }
                        },
                        error: function(xhr, status, error){
                            console.log(error);
                        }
                    })
                }
            })
        })

        function getCartTotal(){
            $.ajax({
                method: 'GET',
                url: "{{route('cart.total')}}",
                success: function(data){
                    $('#cart-total').text(data+" BDT");
                },
                error: function(data){

                }
            })
        }
    })



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

<script>
    $(document).ready(function() {
        $('#cartTable').DataTable({
            info: false,
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 5 },
                { responsivePriority: 3, targets: 5 },
                { responsivePriority: 4, targets: -1 },


            ],
            paging: false,
            lengthChange: false,
            searching: false,
        });
    });

</script>

<script>
$(document).ready(function () {
    $(document).on('show.bs.modal', '.modal.dtr-bs-modal', function () {
        $(this).find('.modal-dialog').addClass('modal-dialog-centered');
    });

    $(document).on('shown.bs.modal', '.modal.dtr-bs-modal', function () {
        // Add a short delay before removing the modal-dialog-centered class to allow for the animation to complete
        var modal = $(this);
        setTimeout(function () {
            modal.find('.modal-dialog').addClass('modal-dialog-centered');
        }, 300); // Adjust the delay according to your transition duration
    });

    $(document).on('hidden.bs.modal', '.modal.dtr-bs-modal', function () {
        $(this).find('.modal-dialog').removeClass('modal-dialog-centered');
    });
});


</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('checkoutBtn').addEventListener('click', function () {
            this.classList.add('disabled');
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Wrapping Up';
            setTimeout(function () {
                window.location.href = "{{ route('checkout') }}";
            }, 10000);
        });
    });
</script>
@endpush
