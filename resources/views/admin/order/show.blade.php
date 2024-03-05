@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Order Details</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.orders.index')}}">All Orders</a></div>
            <div class="breadcrumb-item">{{$order->invoice_id}}</div>
        </div>
    </div>
    <div class="mb-3">
      <a href="{{ url()->previous() }}" class="btn btn-outline-primary px-3"><i class="fas fa-chevron-left"></i><span class="ml-3">Back</span></a>
    </div>
    <div class="section-body">
        <div class="invoice">
          <div class="invoice-print">
            <div class="row">
              <div class="col-lg-12">
                <div class="invoice-title">
                  <div class="col-md-6"></div>
                    <h2>Order Details</h2>
                  <div class="invoice-number">
                    {{$order->invoice_id}} <br>
                    <strong>Order Date:</strong> {{date('d F, y', strtotime($order->created_at))}}<br>
                </div>
                  
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-6">
                    <address>
                      <strong>Billed To:</strong><br>
                      <strong>Name:</strong> {!! $order->user_name !!}<br>
                      <strong>Delivery Mail:</strong> {!! $order->user_email !!}<br>
                      <strong>Phone No:</strong> {!! $order->user_phone !!}<br>
                    </address>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <address>
                      <strong>Region:</strong> {!! $order->region !!}<br>
                      @if ($order->region == 'Global')
                        <strong>Payment Method:</strong> {!! $order->transaction->payment_method !!}<br>
                        <strong>{!! $order->transaction->payment_method !!} No:</strong> {!! $order->transaction->payment_id !!}<br>
                        <strong>Transaction ID:</strong> {!! $order->transaction->transaction_id !!}<br>
                        <strong>Payment Status:</strong> {!! $order->payment_status !!}<br>
                      @endif
                    </address>
                  </div>
                  <div class="col-md-6 text-md-right">
                    
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row mt-4">
              <div class="col-md-12">
                <div class="section-title">Order Items</div>
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-md">
                    <tr>
                      <th data-width="40">#</th>
                      <th>Item</th>
                      <th class="text-center">Price</th>
                      <th class="text-center">Quantity</th>
                      <th class="text-right">Totals</th>
                    </tr>
                    @foreach ($order->orderItems as $item)
                      <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>                          
                          <a href="{{route('product.details', $item->variant->product->slug)}}">{{$item->variant->product->name}}</a><br>
                          {{$item->variant->unit}}<br>
                          @if ($item->ign)
                            <strong>IGN:</strong> {{$item->ign}}<br>
                          @endif
                          @if ($item->tag)
                            <strong>Tag:</strong> {{$item->tag}}<br>
                          @endif
                          @if ($item->region)
                            <strong>Region/Platform:</strong> {{$item->region}}<br>
                          @endif
                          @if ($item->pass)
                            <strong>Password:</strong> {{$item->pass}}<br>
                          @endif
                        </td>
                        <td class="text-center">{{$item->price}} {{$order->region == 'Malaysia'? 'RM' : 'BDT'}}</td>
                        <td class="text-center">{{$item->quantity}}</td>
                        <td class="text-right">{{$item->price * $item->quantity}} {{$order->region == 'Malaysia'? 'RM' : 'BDT'}}</td>
                      </tr>
                    @endforeach
                  </table>
                </div>
                <div class="row mt-4">
                  <div class="col-lg-8 text-left">
                    <div class="invoice-detail-item">
                      <div class="invoice-detail-name">Coupon:</div>
                      <div class="invoice-detail-value">{{$order->coupon ? $order->coupon : ' '}} Applied</div>
                      @if ($coupon)
                        <div class="invoice-detail-name">Discount</div>
                        <div class="invoice-detail-value">{{$coupon->discount}}@if ($order->region == 'Malaysia')
                            @if($coupon->discount_type == 'percent')
                            %
                            @elseif ($coupon->discount_type == 'amount')
                            RM
                            @endif
                          @elseif($order->region == 'Global')
                            @if($coupon->discount_type == 'percent')
                              %
                            @elseif ($coupon->discount_type == 'amount')
                              TK
                            @endif
                          @endif
                        </div>
                      @endif
                    </div>
                    <div class="invoice-detail-item">
                      <div class="invoice-detail-name"></div>
                      <div class="invoice-detail-value"></div>
                    </div>
                    <hr class="mt-2 mb-2">
                    <div class="invoice-detail-item">
                      <div class="invoice-detail-name"></div>
                      <div class="invoice-detail-value invoice-detail-value-lg"></div>
                    </div>
                  </div>
                  <div class="col-lg-4 text-right">
                    <div class="invoice-detail-item">
                      <div class="invoice-detail-name">Subtotal</div>
                      <div class="invoice-detail-value">{{$order->sub_total}} {{$order->region == 'Malaysia'? 'RM' : 'BDT'}}</div>
                    </div>
                    <div class="invoice-detail-item">
                      <div class="invoice-detail-name">Discount</div>
                      <div class="invoice-detail-value">{{$order->discount}} {{$order->region == 'Malaysia'? 'RM' : 'BDT'}}</div>
                    </div>
                    <hr class="mt-2 mb-2">
                    <div class="invoice-detail-item">
                      <div class="invoice-detail-name">Total</div>
                      <div class="invoice-detail-value invoice-detail-value-lg">{{$order->total}} {{$order->region == 'Malaysia'? 'RM' : 'BDT'}}</div>
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-lg-12 text-left">
                    <div><h2>Update Order & Payment Statuses</h2></div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="section-title" for="payment_status">Update Payment Statuses</label>
                          <select id="payment_status" class="form-control" data-id={{$order->id}} name="payment_status">
                            @foreach (config('payment_status.payment_status') as $key => $paymentStatus)
                            <option {{$order->payment_status == $key ? 'selected': ''}} value="{{$key}}">{{$paymentStatus['status']}}</option>
                          @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="section-title" for="order_status">Update Order Statuses</label>
                          <select id="order_status" class="form-control" data-id={{$order->id}} name="order_status">
                              @foreach (config('order_status.order_status') as $key => $orderStatus)
                                <option {{$order->order_status == $key ? 'selected': ''}} value="{{$key}}">{{$orderStatus['status']}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="text-md-right">
            <div class="float-lg-left mb-lg-0 mb-3">
              <a href="{{ url()->previous() }}" class="btn btn-outline-primary px-5"><i class="fas fa-chevron-left"></i><span class="ml-3 font-weight-bold">All Orders</span></a>
              <a href="{{ url()->previous() }}" class="btn btn-outline-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</a>
            </div>
            <button class="btn btn-warning btn-icon icon-left print_invoice"><i class="fas fa-print"></i> Print</button>
          </div>
        </div>
      </div>    
</section>

@endsection

@push('scripts')
  <script>
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#order_status').on('change', function(){
      let status = $(this).val();
      let id = $(this).data('id');
      $.ajax({
        method: 'PUT',
        url: "{{route('admin.order.status')}}",
        data: {
          status : status,
          id: id,
        },
        success: function(data){
          if(data.status == 'success'){
            toastr.success(data.message)
            location.reload();
          };
        },
        error: function(data){
          console.log(data);
        }
      })
    })

    $('#payment_status').on('change', function(){
      let status = $(this).val();
      let id = $(this).data('id');
      $.ajax({
        method: 'PUT',
        url: "{{route('admin.order.payment.status')}}",
        data: {
          status : status,
          id: id,
        },
        success: function(data){
          if(data.status == 'success'){
            toastr.success(data.message)
            location.reload();
          };
        },
        error: function(data){
          console.log(data);
        }
      })
    })

    $('.print_invoice').on('click', function(){
      let printBody = $('.invoice-print');
      let originalContents = $('body').html();

      $('body').html(printBody.html());

      window.print();

      $('body').html(originalContents);
    })
  </script>
@endpush