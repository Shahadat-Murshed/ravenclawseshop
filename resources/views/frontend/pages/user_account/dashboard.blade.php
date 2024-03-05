@extends('frontend.layouts.master')
@section('title')
  {{Auth::user()->first_name}}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/css/dashboard.css" />
@endpush
@section('content')
<div class="parent-div" style="padding-top: 10vh">
    <div class="container">
        <div class="mt-4">
            <h2>Hi <span class="dynamic-username">{{Auth::user()->first_name}} {{Auth::user()->last_name}} </span> </h2>
            <a href="{{route('user.profile')}}">
                <span style="color: var(--neutal)">Edit Profile <i class="fa-solid fa-pen"></i> </span>
            </a>
            <div class="row mt-3">
                <div class="col-md-6 col-12">
                    <div class="w-100 bg-success  d-flex align-items-center justify-content-between mb-3" style="height: 10vh; border-radius: 1rem ; padding: 1rem">
                        <div>
                            <p class="mb-0">You have
                                @if ($orders->where('order_status', 'completed')->count() > 0)
                                    {{$orders->where('order_status', 'completed')->count()}}
                                @else
                                    0
                                @endif
                                completed orders
                            </p>
                            <span>Last updated -
                                @if ($orders->where('order_status', 'completed')->count() > 0)
                                    {{\Carbon\Carbon::parse($latestCompleted->updated_at ?? 'N/A')->format('jS F, h:i A') }}
                                @else
                                    N/A
                                @endif
                            </span>
                        </div>

                    </div>

                </div>
                <div class="col-md-6 col-12">

                    <div class="w-100 bg-warning  d-flex align-items-center justify-content-between mb-3" style="height: 10vh; border-radius: 1rem ; padding: 1rem">
                        <div>
                            <p class="mb-0" style="color:black">You have
                                @if ($orders->where('order_status', 'pending')->count() > 0)
                                    {{$orders->where('order_status', 'pending')->count()}}
                                @else
                                    0
                                @endif
                                pending order
                            </p>
                            <span style="color:black">Order received -
                                @if ($orders->where('order_status', 'pending')->count() > 0)
                                    {{\Carbon\Carbon::parse($latestPending->created_at)->format('jS F, h:i A') ?? 'N/A'}}
                                @else
                                    N/A
                                @endif
                            </span>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 col-12">
                    <div class="w-100 bg-secondary d-flex align-items-center justify-content-between mb-3" style="height: 10vh; border-radius: 1rem ; padding: 1rem">
                        <div>
                            <p class="mb-0">You have
                                @if ($orders->where('order_status', 'cancelled')->count() > 0)
                                    {{$orders->where('order_status', 'cancelled')->count()}}
                                @else
                                    0
                                @endif
                                cancelled order
                            </p>
                            <span>Order received -
                                @if ($orders->where('order_status', 'cancelled')->count() > 0)
                                    {{\Carbon\Carbon::parse($latestCancelled->created_at)->format('jS F, h:i A') }}
                                @else
                                    N/A
                                @endif
                            </span>
                        </div>
                        <div>
                            <a target="_blank" href="https://www.facebook.com/ravenclawseshopint?mibextid=ZbWKwL" type="button" class="btn btn-outline-dark">Contact</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="w-100  d-flex align-items-center justify-content-between mb-3" style="height: 10vh; border-radius: 1rem ; padding: 1rem; background-color: var(--primary-color)">
                        @if ($latestCompleted)
                            @foreach ($latestCompleted->orderItems as $item)
                                @if ($loop->last)
                                    <span> Your last purchase was <br>
                                        <p class="mb-0">
                                            {{$item->variant->product->name}}
                                        </p>
                                    </span>
                                    <div>
                                        <h4>{{$item->variant->unit}}</h4>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div>
                                <a href="{{route('home')}}" class="mb-0">
                                    Purchase Something
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if ($orders->count() > 0)
            <div class="mt-5">
                <h4>Your Past Orders</h4>
                <table id="cartTable" class="table table-dark table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th style="border-bottom: 1px dashed white" class="text-center">SL No.</th>
                            <th class="text-start" style="border-bottom: 1px dashed white">Invoice #</th>
                            <th class="text-start" style="border-bottom: 1px dashed white">Product Title</th>
                            <th class="text-start" style="border-bottom: 1px dashed white">Item</th>
                            <th class="text-start" style="border-bottom: 1px dashed white">Quantity</th>
                            <th class="text-start" style="border-bottom: 1px dashed white">Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="align-middle">
                                    <span>
                                        {{$loop->index+1}}
                                    </span>
                                </td>
                                <td class="align-middle text-start">
                                    <span class="orderId">
                                        {{$order->invoice_id}}
                                    </span>
                                </td>
                                <td class="text-start">
                                    @foreach ($order->orderItems as $item)
                                        <span class="productTitle">
                                            {{$item->variant->product->name}}
                                        </span>
                                        <br>  
                                    @endforeach
                                </td>
                                <td class="text-start">
                                    @foreach ($order->orderItems as $item)
                                        <span class="productUnit">
                                            {{$item->variant->unit}}
                                        </span>
                                        <br>  
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($order->orderItems as $item)
                                        <span class="productQty">
                                            {{$item->quantity}}
                                        </span>
                                        <br>  
                                    @endforeach 
                                </td>
                                <td class="align-middle">
                                    @if ($order->order_status == 'pending')
                                        <span class="badge rounded-pill bg-warning text-dark" style="width:90px;">Processing</span>
                                    @elseif ($order->order_status == 'processing')
                                        <span class="badge rounded-pill bg-warning text-dark" style="width:90px;">Pending</span>
                                    @elseif ($order->order_status == 'on hold')
                                        <span class="badge rounded-pill bg-secondary" style="width:90px;">On Hold</span>
                                    @elseif ($order->order_status == 'delivered')
                                        <span class="badge rounded-pill bg-success" style="width:90px;">Delivered</span>
                                    @elseif ($order->order_status == 'completed')
                                        <span class="badge rounded-pill bg-success" style="width:90px;">Completed</span>
                                    @elseif ($order->order_status == 'cancelled')
                                        <span class="badge rounded-pill bg-danger" style="width:90px;">Cancelled</span>
                                    @elseif ($order->order_status == 'refunded')
                                        <span class="badge rounded-pill bg-danger" style="width:90px;">Refunded</span>
                                    @elseif ($order->order_status == 'failed')
                                        <span class="badge rounded-pill bg-danger" style="width:90px;">Failed</span>
                                    @elseif ($order->order_status == 'returned')
                                        <span class="badge rounded-pill bg-danger" style="width:90px;">Returned</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">{{$order->order_status}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#cartTable').DataTable({
            info: false,
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 5 },
                { responsivePriority: 3, targets: 3 },
                { responsivePriority: 4, targets: 2 },
            ],
            paging: false,
            lengthChange: false,
            searching: false,
        });
    });

</script>
@endpush
