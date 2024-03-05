@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.orders.index')}}">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Today's Orders</h4>
                        </div>
                        <div class="card-body">{{$todaysOrder}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.orders.completedOrder')}}">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Today's Completed Orders</h4>
                        </div>
                        <div class="card-body">{{$todaysCompletedOrder}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.orders.pendingOrder')}}">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Today's Pending Orders</h4>
                        </div>
                        <div class="card-body">{{$todaysPendingOrder}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.orders.cancelledOrder')}}">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Today's Cancelled Orders</h4>
                        </div>
                        <div class="card-body">{{$todaysCancelledOrder}}</div>
                    </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.orders.index')}}">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">{{$orders->count()}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.orders.completedOrder')}}">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Total Completed Orders</h4>
                        </div>
                        <div class="card-body">{{$orders->where('order_status', 'completed')->count()}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.orders.pendingOrder')}}">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Total Pending Orders</h4>
                        </div>
                        <div class="card-body">{{$orders->where('order_status', 'pending')->count()}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.orders.cancelledOrder')}}">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Total Cancelled Orders</h4>
                        </div>
                        <div class="card-body">{{$orders->where('order_status', 'cancelled')->count()}}</div>
                    </div>
                    </div>
                </a>
            </div>
            @if (isSuper())
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="#">
                        <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Todays Earning</h4>
                            </div>
                            <div class="card-body">{{$todaysEarningBD}} BDT</div>
                        </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="#">
                        <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>This Month's Earning</h4>
                            </div>
                            <div class="card-body">{{$monthlyEarningBD}} BDT</div>
                        </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="#">
                        <div class="card card-statistic-1">
                        <div class="card-icon" style="background: teal">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>This Years's Earning</h4>
                            </div>
                            <div class="card-body">{{$yearlyEarningBD}} BDT</div>
                        </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="#">
                        <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Total Earning</h4>
                            </div>
                            <div class="card-body">{{$totalEarningBD}} BDT</div>
                        </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="#">
                        <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Todays Earning</h4>
                            </div>
                            <div class="card-body">{{$todaysEarningMalay}} RM</div>
                        </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="#">
                        <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>This Month's Earning</h4>
                            </div>
                            <div class="card-body">{{$monthlyEarningMalay}} RM</div>
                        </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="#">
                        <div class="card card-statistic-1">
                        <div class="card-icon" style="background: teal">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>This Years's Earning</h4>
                            </div>
                            <div class="card-body">{{$yearlyEarningMalay}} RM</div>
                        </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="#">
                        <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Total Earning</h4>
                            </div>
                            <div class="card-body">{{$totalEarningMalay}} RM</div>
                        </div>
                        </div>
                    </a>
                </div>
            @endif
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.category.index')}}">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Total Admins</h4>
                        </div>
                        <div class="card-body">{{$users->where('role', 'admin')->count()}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.category.index')}}">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Total Registered Users</h4>
                        </div>
                        <div class="card-body">{{$users->where('role', 'user')->count()}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.category.index')}}">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Total Category</h4>
                        </div>
                        <div class="card-body">{{$category}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{route('admin.products.index')}}">
                    <div class="card card-statistic-1">
                    <div class="card-icon"  style="background: teal">
                        <i class="fas fa-dice"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Total Products</h4>
                        </div>
                        <div class="card-body">{{$products->count()}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>PC Games</h4>
                        </div>
                        <div class="card-body">{{$products->where('category_id', 1)->count()}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-mobile-screen-button"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Mobile Games</h4>
                        </div>
                        <div class="card-body">{{$products->where('category_id', 2)->count()}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Gift Cards</h4>
                        </div>
                        <div class="card-body">{{$products->where('category_id', 3)->count()}}</div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                    <div class="card-icon"  style="background: teal">
                        <i class="fas fa-brands fa-spotify"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                        <h4>Subscriptions</h4>
                        </div>
                        <div class="card-body">{{$products->where('category_id', 4)->count()}}</div>
                    </div>
                    </div>
                </a>
            </div>
        </div>          
  </section>
@endsection