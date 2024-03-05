<!-- nav -->
@php
    $categories = \App\Models\Category::where('status', 1)->get();
@endphp
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        {{-- desktop-navigation --}}
        <div class="d-none d-lg-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand" href="{{route('home')}}">
                <img class= 'logo' src="{{asset('frontend/assets')}}/images/raven_2.png" alt="logo" style="height:40px;width:60px;object-fit:cover" >
            </a>

            <div class="collapse navbar-collapse mx-2" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-3">
                    @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('product.listing', $category->slug)}}">
                            <span>{{$category->name}}</span>
                        </a>
                    </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('faq')}}">
                            <span>FAQ</span>
                        </a>
                    </li>
                </ul>
                <div class="d-flex gap-3 justify-content-end  align-items-center">
                    <div class="dropdown mr-1">
                        <a class="nav-link dropdown-toggle" style="color: white; cursor: pointer" id="dropdown-toggle-region" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">{{Session::get('region.name')}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg-end custom-dropdown-menu-region" aria-labelledby="dropdown-toggle">
                            <a class="dropdown-item dropdown-item-region" href="#">Malaysia
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2b/Flag_of_Malaysia.png/1200px-Flag_of_Malaysia.png" alt="" height='16' width='25'>
                            </a>
                            <a class="dropdown-item dropdown-item-region" href="{{route('bd-region')}}">Global <i class="fa-solid fa-earth-americas"></i></a>
                        </div>
                    </div>

                    <a data-bs-toggle="modal" data-bs-target="#searchModal" style="cursor: pointer">
                        <i class='fa fa-search'></i>
                    </a>

                    @if(Auth::user())
                    <div class="dropdown dropdown-account mr-1">
                        <button class='profile' id="dropdown-toggle-account" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                        <i class="far fa-user mx-2"></i>
                        </button>
                        <div class="dropdown-menu  dropdown-menu-lg-end custom-dropdown-menu-account p-3" aria-labelledby="dropdown-toggle-account">
                            @if (Auth::user()->role == 'user')

                            <a href="{{route('user.profile')}}">
                                <div class="account mt-2 mb-2 p-2">
                                <span class="mb-1 h5">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                                <span style="color: var(--neutral);font-size:14px">View Your Profile</span>
                                </div>
                            </a>
                            <hr style="background-color: white">
                            <div class="items p-2">
                                <a href="{{route('user.dashboard')}}" style="width:fit-content">Check Dashboard 🔗</a>
                                {{-- <a href="{{route('user.order')}}" style="width:fit-content">View Order Summery</a> --}}
                            </div>
                            <div class="logout col-12 p-2">
                                <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();"  class="btn btn-outline-danger" style="width: 100%;">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                </form>
                            </div>

                            @else

                                <img class="rounded-circle m-2" width="40px" src="{{asset(Auth::user()->image)}}" alt="Admin Display Pic">
                                <div class="d-sm-none d-lg-inline-block mt-2 mb-2" style="color: white">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</div>

                                <div class="logout col-12 p-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();"  class="btn btn-outline-danger" style="width: 100%;">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </form>
                                </div>

                            @endif
                        </div>
                    </div>
                    @else
                    <a class='btn btn-primary' style="border-radius: 5px!important" href="{{route('login')}}">
                        Log in
                    </a>
                    @endif
                </div>
            </div>

        </div>

        {{-- mobile-navigation --}}
        <div class="d-flex d-lg-none justify-content-between align-items-center" style="width: 100%">
            <a class="navbar-brand" href="{{route('home')}}">
                <img class= 'logo' src="{{asset('frontend/assets')}}/images/raven_2.png" alt="logo" style="height:40px;width:60px;object-fit:cover" >
            </a>

            <div class="d-flex justify-content-end align-items-center gap-3">
                <a id="mobile-search-button" type="button" class="btn btn-link" style="padding: 0px">
                    <i class="fa-solid fa-magnifying-glass" style="font-size: 1.4rem"></i>
                </a>
                <a id="mobile-nav-button" type="button" class="btn btn-link" style="padding: 0px">
                    <i class="fa-solid fa-bars" style="font-size: 1.4rem"></i>
                </a>
            </div>
        </div>


        <!-- Mobile Nav drawer - Shown only on mobile screens -->
        <div id="mobile-nav">
            <button id="mobile-nav-close-button" class="btn btn-link"><i class="fa-solid fa-xmark fa-rotate-90" style="font-size: 1.4rem"></i></button>
            <div class="d-flex flex-column w-100 p-3 gap-2" style="height: 100%; justify-content:space-between">
                <div class="col-12 pt-5 d-flex flex-column w-100 gap-2">
                    <div class="mobile-nav-accordion accordion" id="accordionFlushExample">
                        @foreach ($categories as $category)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading-{{$category->id}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{$category->id}}" aria-expanded="false" aria-controls="flush-collapse-{{$category->id}}">
                                        {{$category->name}}
                                    </button>
                                </h2>
                                <div id="flush-collapse-{{$category->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{$category->id}}" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="col-12 mobile-nav-products d-flex flex-column align-items-right">
                                            @php
                                                $products = \App\Models\Product::where('status', 1)->where('category_id', $category->id)->limit(5)->get();
                                            @endphp
                                            @foreach ($products as $product)
                                            <a href="{{route('product.details', $product->slug)}}">
                                                <span>
                                                    {{$product->name}}
                                                </span>
                                            </a>
                                            @endforeach
                                            <a class="btn-link mt-2" href="{{route('product.listing', $category->slug)}}">See All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <a href="{{route('faq')}}">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" id="faq" type="button">
                                        FAQ
                                    </button>
                                </h2>
                            </div>
                        </a>
                    </div>
                    <div class="mt-3 col-12">
                        <div class="d-flex justify-content-center gap-4" style="width: 100%;">

                            <a target="_blank" href="https://whatsapp.com/channel/0029Va5PKFyDuMRbRXDdsa2E">
                                <i class=" fa-2x fa-brands fa-whatsapp"></i>
                            </a>
                            <a target="_blank" href="https://instagram.com/ravenclaws_eshop?igshid=MWY0ZHh1cTIwYzY2cw==">
                                <i class=" fa-2x fa-brands fa-instagram"></i>
                            </a>
                            <a target="_blank" href="https://www.facebook.com/ravenclawseshopint?mibextid=ZbWKwL">
                                <i class=" fa-2x fa-brands fa-facebook"></i>
                            </a>
                            <a target="_blank" href="https://discord.gg/3srQZZubr5">
                                <i class=" fa-2x fa-brands fa-discord"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div style="text-align:right">
                    @if(Auth::user())
                    @if (Auth::user()->role == 'user')
                    <div class="col-12">
                        <a href="{{route('user.profile')}}">
                            <div style="display: flex; justify-content:center; align-items:center; flex-direction:column;">
                                <span>Hello, {{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                                <span style="color: var(--neutral);font-size:14px">View Your Profile</span>
                            </div>
                        </a>
                        <div class="d-flex justify-content-center mb-2">
                            <a href="{{route('user.dashboard')}}" style="width:fit-content">
                                <span style="color: var(--neutral);font-size:14px">Check Your Dashboard</span>
                            </a>
                        </div>
                        <a href="{{route('cart-details')}}" class="btn btn-secondary" style="width: 100%;">
                            <i class="fa-solid fa-cart-shopping"></i> Cart  <span class="mobile-cart"> ({{Cart::content()->count()}}) </span>
                        </a>
                        <div class="logout col-12 mt-3">
                            <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                this.closest('form').submit();"  class="btn btn-outline-danger" style="width: 100%;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            </form>
                        </div>
                    </div>
                    @else
                    @endif
                @else
                <a href="{{route('cart-details')}}" class="btn btn-secondary" style="width: 100%;">
                    <i class="fa-solid fa-cart-shopping"></i> Cart  <span class="mobile-cart"> ({{Cart::content()->count()}}) </span>
                </a>
                <div class="col-12">
                    <a class='btn btn-primary w-100' href="{{route('login')}}">
                        Log in
                    </a>
                </div>

                @endif
                </div>

            </div>

        </div>

        <!-- Mobile Search drawer - Shown only on mobile screens -->
        <div id="mobile-search">
            <button id="mobile-search-close-button" class="btn btn-link"><i class="fa-solid fa-xmark fa-rotate-90" style="font-size: 1.4rem"></i></button>
            <div id="mobile-search-content" class="col-12 p-3">
                <div class="pt-5">
                    <input type="text" id="mobile-search-input" class="form-control custom-input search-input" placeholder="Search...">
                    <br>
                    <div class="row">
                      <p class="col-md-12"><span id="mobileSearchText">Search For Products</span></p>
                    </div>
                    <div class="row" id="mobileSearchResults">

                    </div>
                </div>
            </div>
        </div>


        <!-- Mobile Nav Backdrop - Shown only when mobile nav is open -->
        <div id="mobile-nav-backdrop"></div>
    </div>
</nav>

{{-- desktop search drawer --}}

<div class="modal fade searchModal"  id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body container pt-4 pb-4">
        <div class="row">
            <div class="input-group mt-3 ">
                <input id="search" type="text" class="form-control custom-input search-input">
                <a class="input-group-text cls-btn" data-bs-dismiss="modal">
                    <i class="fa-solid fa-x"></i>
                </a>
            </div>
        </div>
        <hr>
        <div class="row">
          <p class="col-md-12"><span id="searchText">Search For Products</span></p>
        </div>

        <div class="row" id="searchResults">

        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')

  <script src="{{asset('frontend/assets')}}/js/mobileNav.js"></script>
  <script>
    $(document).ready(function () {
        $('#search').on('input', function () {
            var query = $(this).val();
            $('#searchText').text('Search Results for '+query);
            if(query === ""){
                $('#searchResults').html('');
                $('#searchText').text('Search For Products');
            }
            else{
                $.ajax({
                    url: '/search',
                    method: 'GET',
                    data: { query: query },
                    success: function (data) {
                    $('#searchResults').html('');
                    data.products.forEach(function (product) {
                        var productHtml =`<div class="col-2" >
                                            <a class="product-card" href="{{url('product-details')}}/${product.slug}">
                                                <img src="{{asset('/')}}${product.thumb_image}" alt="${product.name}"/>
                                            </a>
                                            <a href="{{url('product-details')}}/${product.slug}">${product.name}</a>
                                            </div>`;
                        $('#searchResults').append(productHtml);
                        $('#searchText').text('Search Results for '+query);
                    });
                    },
                    error: function(data){
                    console.log(data)
                    }
                });
            }
        });
    });
  </script>
  <script>
    $(document).ready(function () {
        $('#mobile-search-input').on('input', function () {
            var query = $(this).val();
            $('#mobileSearchText').text('Search Results for '+query);
            if(query === ""){
                $('#mobileSearchResults').html('');
                $('#mobileSearchText').text('Search For Products');
            }
            else{
                $.ajax({
                    url: '/search',
                    method: 'GET',
                    data: { query: query },
                    success: function (data) {
                    $('#mobileSearchResults').html('');
                    data.products.forEach(function (product) {
                        var productHtml =`<div class="col-6" >
                                            <a class="product-card" href="{{url('product-details')}}/${product.slug}">
                                                <img src="{{asset('/')}}${product.thumb_image}" alt="${product.name}"/>
                                            </a>
                                            <a href="{{url('product-details')}}/${product.slug}">${product.name}</a>
                                            </div>`;
                        $('#mobileSearchResults').append(productHtml);
                        $('#mobileSearchText').text('Search Results for '+query);
                    });
                    },
                    error: function(data){
                    console.log(data)
                    }
                });
            }
        });
    });
  </script>
@endpush
