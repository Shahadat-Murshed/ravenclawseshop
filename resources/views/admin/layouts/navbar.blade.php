<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"
                ><i class="fas fa-bars"></i
            ></a>
            </li>
            <li>
            <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"
                ><i class="fas fa-search"></i
            ></a>
            </li>
        </ul>
      
    </form>
    @php
        $notifications = auth()->user()->unreadNotifications;
    @endphp
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle">
            <a
            href="#"
            data-toggle="dropdown"
            class="nav-link notification-toggle nav-link-lg @if(count($notifications) != 0) beep @endif"
            ><i class="far fa-bell"></i
            ></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
            <div class="dropdown-header">
                Notifications
                <div class="float-right">
                <a href="{{route('admin.markAllAsRead')}}">Mark All As Read</a>
                </div>
            </div>
            <div class="dropdown-list-content dropdown-list-icons">
                @forelse ($notifications as $notification)
                    <div class="dropdown-item">
                        <div class="dropdown-item-icon bg-primary text-white">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            <a href="{{route('admin.orders.show', $notification->data['order_id'])}}">{{ $notification->data['message'] }} ({{ $notification->data['invoice'] }})
                            </a>
                            <div class="time text-primary">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                            </div>
                            <div>
                                <a href="{{route('admin.markSingleAsRead', $notification->id)}}" class="float-right text-dark">
                                Mark as read</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="container">There is no new notifications.</div>       
                @endforelse
            </div>
            <div class="dropdown-footer text-center">
                <a href="{{route('admin.dashboard')}}">View All <i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
        </li>
        <li class="dropdown">
            <a
            href="#"
            data-toggle="dropdown"
            class="nav-link dropdown-toggle nav-link-lg nav-link-user"
            >
            <img
                alt="image"
                src="{{asset(Auth::user()->image)}}"
                class="rounded-circle mr-1"
            />
            <div class="d-sm-none d-lg-inline-block">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</div></a
            >
            <div class="dropdown-menu dropdown-menu-right">
            <a href="{{route('admin.profile')}}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit();"  class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>