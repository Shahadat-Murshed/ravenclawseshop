<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('admin.dashboard')}}">Ravenclaws</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('admin.dashboard')}}">RC</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{setActive([
                'admin.dashboard',
            ])}}">
            <a href="{{route('admin.dashboard')}}" class="nav-link"
                ><i class="fas fa-fire"></i><span>Dashboard</span></a
            >
            </li>
            <li class="dropdown {{setActive([
                'admin.notifications',
            ])}}">
            <a href="{{route('admin.notifications')}}" class="nav-link"
                ><i class="fas fa-file-invoice-dollar"></i><span>Track New Order</span></a
            >
            </li>
            <li class="menu-header">Starter</li>
            
            @if (isSuper())
                <li class="dropdown {{setActive([
                    'admin.users.*',
                    'admin.admins.*',
                    'admin.guests.*',
                ])}}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"
                        ><i class="fa-solid fa-users"></i><span>Manage Users</span></a
                    >
                    <ul class="dropdown-menu">
                        <li class="{{setActive([
                            'admin.admins.*',
                        ])}}">
                            <a class="nav-link" href="{{route('admin.admins.list')}}"
                                ><i class="fa-solid fa-user-shield mr-0"></i>Admins</a
                            >
                        </li>
                        <li class="{{setActive([
                            'admin.users.*',
                        ])}}">
                            <a class="nav-link" href="{{route('admin.users.list')}}"
                                ><i class="fa-regular fa-user mr-0"></i>Clients</a
                            >
                        </li>
                        <li class="{{setActive([
                            'admin.guests.*',
                        ])}}">
                            <a class="nav-link" href="{{route('admin.guests.list')}}"
                                ><i class="fa-regular fa-circle-user mr-0"></i>Guests</a
                            >
                        </li>
                    </ul>
                </li>

                <li class="dropdown {{setActive([
                    'admin.payments.*',
                    'admin.paymentmethods.*',
                    ])}}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"
                        ><i class="fa-solid fa-sack-dollar"></i></i><span>Payment Methods</span></a
                    >
                    <ul class="dropdown-menu">
                        <li class="{{setActive([
                            'admin.payments.all.list',
                            'admin.paymentmethods.*',
                        ])}}">
                            <a class="nav-link" href="{{route('admin.payments.all.list')}}"
                                ><img class= 'logo' src="{{asset('backend/assets/img/world.png')}}" alt="logo" style="height:20px;width:20px;object-fit:cover" ><span class="ml-2">All Methods</span></a
                            >
                        </li>
                        <li class="dropdown {{setActive([
                            'admin.payments.bkash.*',
                            'admin.payments.nagad.*',
                            'admin.payments.rocket.*',
                        ])}}">
                            <a class="nav-link has-dropdown" style="cursor: pointer" data-toggle="dropdown"><img class= 'logo' src="{{asset('backend/assets/img/bd_icon.png')}}" alt="logo" style="height:20px;width:20px;object-fit:cover" ><span class="ml-2">Bangladeshi Methods</span></a
                            >
                            <ul class="dropdown-menu">
                                <li class="dropdown {{setActive([
                                    'admin.payments.bkash.*',
                                ])}}">
                                    <a class="nav-link" style="padding-left: 50px" href="{{route('admin.payments.bkash.list')}}">
                                        <img class= 'logo' src="https://freelogopng.com/images/all_img/1656234745bkash-app-logo-png.png" alt="logo" style="height:20px;width:20px;object-fit:cover" ><span class="ml-2">Bkash</span>
                                    </a>
                                </li>
                                <li class="dropdown {{setActive([
                                    'admin.payments.nagad.*',
                                ])}}">
                                    <a class="nav-link" style="padding-left: 50px" href="{{route('admin.payments.nagad.list')}}">
                                        <img class= 'logo' src="https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png" alt="logo" style="height:20px;width:20px;object-fit:cover" ><span class="ml-2">Nagad</span>
                                    </a>
                                </li>
                                <li class="dropdown {{setActive([
                                    'admin.payments.rocket.*',
                                ])}}">
                                    <a class="nav-link" style="padding-left: 50px" href="{{route('admin.payments.rocket.list')}}">
                                        <img class= 'logo' src="https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png" alt="logo" style="height:20px;width:20px;" ><span class="ml-2">Rocket</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li id="" class="dropdown {{setActive([
                            'admin.payments.crypto.*',
                            'admin.payments.cryptox.*',
                            'admin.payments.cryptoy.*',
                            ])}}">
                            <a class="nav-link has-dropdown" style="cursor: pointer" data-toggle="dropdown"><img class= 'logo' src="{{asset('backend/assets/img/malay_icon.png')}}" alt="logo" style="height:20px;width:20px;object-fit:cover" ><span class="ml-2">Malaysian Methods</span></a
                            >
                            <ul class="dropdown-menu">
                                <li class="dropdown {{setActive([
                                    'admin.payments.crypto.*',
                                    ])}}">
                                    <a class="nav-link" style="padding-left: 50px" href="{{route('admin.payments.crypto.list')}}">
                                        Crypto
                                    </a>
                                </li>
                                <li class="dropdown {{setActive([
                                    'admin.payments.cryptox.*',
                                    ])}}">
                                    <a class="nav-link" style="padding-left: 50px" href="{{route('admin.payments.cryptox.list')}}">
                                        CryptoX
                                    </a>
                                </li>
                                <li class="dropdown {{setActive([
                                    'admin.payments.cryptoy.*',
                                    ])}}">
                                    <a class="nav-link" style="padding-left: 50px" href="{{route('admin.payments.cryptoy.list')}}">
                                        CryptoY
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                    </ul>
                </li>
            @endif
            <li class="dropdown {{setActive([
                'admin.slider.*',
                'admin.coupons.*',
                'admin.faqs.*'
            ])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"
                    ><i class="fas fa-window-maximize"></i><span>Manage Website</span></a
                >
                <ul class="dropdown-menu">
                    <li class="{{setActive([
                        'admin.slider.*',
                    ])}}">
                        <a class="nav-link" href="{{route('admin.slider.index')}}"
                            ><i class="fas fa-image mr-0"></i>Slider</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.coupons.*'
                    ])}}">
                        <a class="nav-link" href="{{route('admin.coupons.index')}}"
                            ><i class="fa-solid fa-gifts mr-0"></i>Coupons</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.faqs.*'
                    ])}}">
                        <a class="nav-link" href="{{route('admin.faqs.index')}}"
                            ><i class="fas fa-question mr-0"></i></i>FAQs</a
                        >
                    </li>
                </ul>
            </li>

            <li class="dropdown {{setActive([
                'admin.category.*',
            ])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"
                    ><i class="fas fa-layer-group"></i><span>Manage Categories</span></a
                >
                <ul class="dropdown-menu">
                    <li class="{{setActive([
                        'admin.category.*',
                    ])}}">
                        <a class="nav-link" href="{{route('admin.category.index')}}"
                            ><i class="fas fa-bars mr-0"></i>Category</a
                        >
                    </li>
                </ul>
            </li> 

            <li class="dropdown 
                        {{setActive([
                            'admin.products.*',
                        ])}} 
                        {{ setActiveDynamic('admin.products.all.category', 'pc-games')}}
                        {{ setActiveDynamic('admin.products.all.category', 'mobile-games')}}
                        {{ setActiveDynamic('admin.products.all.category', 'vouchers-gift-cards')}}
                        {{ setActiveDynamic('admin.products.all.category', 'subscription-entertainment')}}
                        ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"
                    ><i class="fas fa-dice"></i><span>Manage Products</span></a
                >
                <ul class="dropdown-menu">
                    <li class="{{setActive([
                        'admin.products.index',
                        'admin.products.edit',
                    ])}}">
                        <a class="nav-link" href="{{route('admin.products.index')}}"
                            ><i class="fas fa-gamepad mr-0"></i>All Products</a
                        >
                    </li>
                    <li class="{{ setActiveDynamic('admin.products.all.category', 'pc-games')}}">
                        <a class="nav-link" href="{{route('admin.products.all.category', 'pc-games')}}"
                            ><i class="fas fa-desktop mr-0"></i>PC Games</a
                        >
                    </li>
                    <li class="{{ setActiveDynamic('admin.products.all.category', 'mobile-games')}}">
                        <a class="nav-link" href="{{route('admin.products.all.category', 'mobile-games')}}"
                            ><i class="fas fa-mobile-screen-button mr-0"></i>Mobile Games</a
                        >
                    </li>
                    <li class="{{ setActiveDynamic('admin.products.all.category', 'vouchers-gift-cards')}}">
                        <a class="nav-link" href="{{route('admin.products.all.category', 'vouchers-gift-cards')}}"
                            ><i class="fas fa-gift mr-0"></i>Gift Cards</a
                        >
                    </li>
                    <li class="{{ setActiveDynamic('admin.products.all.category', 'subscription-entertainment')}}">
                        <a class="nav-link" href="{{route('admin.products.all.category', 'subscription-entertainment')}}"
                            ><i class="fas fa-brands fa-spotify mr-0"></i>Subscriptions</a
                        >
                    </li>
                </ul>
            </li>
            <li class="dropdown {{setActive([
                'admin.products-variants.*',
                'admin.product-variants',
                ])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"
                    ><i class="fa-solid fa-dice-six"></i><span>Manage Items</span></a
                >
                <ul class="dropdown-menu">
                    <li class="{{setActive([
                        'admin.products-variants.index',
                        'admin.products-variants.edit',
                        'admin.product-variants.*',
                    ])}}">
                        <a class="nav-link" href="{{route('admin.products-variants.index')}}"
                            ><i class="fas fa-puzzle-piece mr-0"></i>All Items</a
                        >
                    </li>
                    <li id="parent-pc" class="dropdown {{setActive([
                        'admin.products-variants.pc-games',
                    ])}}">
                        <a class="nav-link has-dropdown" style="cursor: pointer" data-toggle="dropdown"><i class="fas fa-desktop mr-0"></i><span>PC Games Items</span></a
                        >
                        <ul class="dropdown-menu">
                            <li class="dropdown {{setActive([
                                'admin.products-variants.pc-games',
                            ])}}">
                                <a class="nav-link" style="padding-left: 50px" href="{{route('admin.products-variants.pc-games')}}">
                                    All PC Games Items
                                </a>
                            </li>
                            @php
                                $pcs =  \App\Models\Product::where('category_id', 1)->get();
                            @endphp
                            @foreach ($pcs as $pc)
                            <li class="dropdown {{setActiveDropdown('admin.product-variants',$pc->slug)}}">
                                <a class="nav-link" style="padding-left: 50px" href="{{route('admin.product-variants',$pc->slug)}}">
                                    {{slugToNormalString($pc->slug)}}
                                </a>
                            </li>   
                            @endforeach
                        </ul>
                    </li>
                    <li id="parent-mobile" class="dropdown {{setActive([
                        'admin.products-variants.mobile-games',
                    ])}}">
                        <a class="nav-link has-dropdown" style="cursor: pointer" data-toggle="dropdown"><i class="fas fa-mobile-screen-button mr-0"></i><span>Mobile Games Items</span></a
                        >
                        <ul class="dropdown-menu">
                            <li class="dropdown {{setActive([
                                'admin.products-variants.mobile-games',
                            ])}}">
                                <a class="nav-link" style="padding-left: 50px" href="{{route('admin.products-variants.mobile-games')}}">
                                    All Mobile Games Items
                                </a>
                            </li>
                            @php
                                $mobiles =  \App\Models\Product::where('category_id', 2)->get();
                            @endphp
                            @foreach ($mobiles as $mobile)
                            <li class="dropdown {{setActiveDropdown('admin.product-variants',$mobile->slug)}}">
                                <a class="nav-link" style="padding-left: 50px" href="{{route('admin.product-variants', $mobile->slug)}}">
                                    {{slugToNormalString($mobile->slug)}}
                                </a>
                            </li>   
                            @endforeach
                        </ul>
                    </li>
                    <li id="parent-gift" class="dropdown {{setActive([
                        'admin.products-variants.gift-cards',
                    ])}}">
                        <a class="nav-link has-dropdown" style="cursor: pointer" data-toggle="dropdown"><i class="fas fa-gift mr-0"></i><span>Gift Cards Items</span></a
                        >
                        <ul class="dropdown-menu">
                            <li class="dropdown {{setActive([
                                'admin.products-variants.gift-cards',
                            ])}}">
                                <a class="nav-link" style="padding-left: 50px" href="{{route('admin.products-variants.gift-cards')}}">
                                    All Gift Card Items
                                </a>
                            </li>
                            @php
                                $gifts =  \App\Models\Product::where('category_id', 3)->get();
                            @endphp
                            @foreach ($gifts as $gift)
                            <li class="dropdown {{setActiveDropdown('admin.product-variants',$gift->slug)}}">
                                <a class="nav-link" style="padding-left: 50px" href="{{route('admin.product-variants',$gift->slug)}}">
                                    {{slugToNormalString($gift->slug)}}
                                </a>
                            </li>   
                            @endforeach
                        </ul>
                    </li>
                    <li id="parent-sub" class="dropdown {{setActive([
                        'admin.products-variants.subscriptions',
                    ])}}">
                        <a class="nav-link has-dropdown" style="cursor: pointer" data-toggle="dropdown"><i class="fas fa-brands fa-spotify mr-0"></i><span>Subscriptions Items</span></a
                        >
                        <ul class="dropdown-menu">
                            <li class="dropdown {{setActive([
                                'admin.products-variants.subscriptions',
                            ])}}">
                                <a class="nav-link" style="padding-left: 50px" href="{{route('admin.products-variants.subscriptions')}}">
                                    All Subscriptions Items
                                </a>
                            </li>
                            @php
                                $subscriptions =  \App\Models\Product::where('category_id', 4)->get();
                            @endphp
                            @foreach ($subscriptions as $subscription)
                            <li class="dropdown {{setActiveDropdown('admin.product-variants',$subscription->slug)}}">
                                <a class="nav-link" style="padding-left: 50px" href="{{route('admin.product-variants',$subscription->slug)}}">
                                    {{slugToNormalString($subscription->slug)}}
                                </a>
                            </li>   
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{setActive([
                'admin.orders.*',
            ])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"
                    ><i class="fa-solid fa-coins"></i><span>Manage Orders</span></a
                >
                <ul class="dropdown-menu">
                    <li class="{{setActive([
                        'admin.orders.index',
                    ])}}">
                        <a class="nav-link" style="padding-left: 50px" href="{{route('admin.orders.index')}}"
                            ><i class="fa-solid fa-cart-arrow-down mr-0"></i>All Orders</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.orders.pendingOrder',
                    ])}}">
                        <a class="nav-link" style="padding-left: 50px" href="{{route('admin.orders.pendingOrder')}}"
                            ><i class="fas fa-hourglass-half mr-0"></i>Pending Orders</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.orders.completedOrder',
                    ])}}">
                        <a class="nav-link" style="padding-left: 50px" href="{{route('admin.orders.completedOrder')}}"
                            ><i class="fas fa-check-circle mr-0"></i>Completed Orders</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.orders.cancelledOrder',
                    ])}}">
                        <a class="nav-link" style="padding-left: 50px" href="{{route('admin.orders.cancelledOrder')}}"
                            ><i class="fas fa-times-circle mr-0"></i>Cancelled Orders</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.orders.refundedOrder',
                    ])}}">
                        <a class="nav-link" style="padding-left: 50px" href="{{route('admin.orders.refundedOrder')}}"
                            ><i class="fas fa-money-check mr-0"></i>Refunded Orders</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.orders.processingOrder',
                    ])}}">
                        <a class="nav-link" style="padding-left: 50px" href="{{route('admin.orders.processingOrder')}}"
                            ><i class="fas fa-cog mr-0"></i>Processing Orders</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.orders.holdOrder',
                    ])}}">
                        <a class="nav-link" style="padding-left: 50px" href="{{route('admin.orders.holdOrder')}}"
                            ><i class="fas fa-pause mr-0"></i>On Hold Orders</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.orders.deliveredOrder',
                    ])}}">
                        <a class="nav-link" style="padding-left: 50px" href="{{route('admin.orders.deliveredOrder')}}"
                            ><i class="fas fa-truck mr-0"></i>Delivered Orders</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.orders.failedOrder',
                    ])}}">
                        <a class="nav-link" style="padding-left: 50px" href="{{route('admin.orders.failedOrder')}}"
                            ><i class="fas fa-exclamation-circle mr-0"></i>Failed Orders</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.orders.returnedOrder',
                    ])}}">
                        <a class="nav-link" style="padding-left: 50px" href="{{route('admin.orders.returnedOrder')}}"
                            ><i class="fas fa-undo mr-0"></i>Returned Orders</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.orders.globalOrder',
                    ])}}">
                        <a class="nav-link" style="padding-left: 50px" href="{{route('admin.orders.globalOrder')}}"
                            ><i class="fa-solid fa-earth-americas  mr-0"></i>Global Orders</a
                        >
                    </li>
                    <li class="{{setActive([
                        'admin.orders.malayOrder',
                    ])}}">
                        <a class="nav-link" style="padding-left: 50px" href="{{route('admin.orders.malayOrder')}}"
                            ><img class="mr-2" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2b/Flag_of_Malaysia.png/1200px-Flag_of_Malaysia.png" alt="" height='12' width='20'>Malaysian Orders</a
                        >
                    </li>
                </ul>
            </li>
            <li class="{{ setActive(['admin.transactions.all']) }}"><a class="nav-link"
                href="{{ route('admin.transactions.all') }}"><i class="fas fa-money-bill-alt"></i> <span>Transactions</span></a>
            </li>
        </ul>
    </aside>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        // Function to check if any child route is active
        function isAnyChildActive(parentId) {
            return $(`#${parentId} .dropdown-menu li.active`).length > 0;
        }

        // Add "active" class to the parent dropdown if any child is active
        $('.dropdown').each(function () {
            const dropdownId = $(this).attr('id');
            if (isAnyChildActive(dropdownId)) {
                $(this).addClass('active');
            }
        });
    });
</script>
@endpush