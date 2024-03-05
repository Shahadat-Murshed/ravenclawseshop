@extends('frontend.layouts.master')

@section('title', 'Congrats')


@push('styles')
<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/postPurchase.css" />
@endpush

@section('content')
<div class="parent-div" style="padding-top: 15vh" id="parent-div">
    <section>
        <div class="container">
            <div class="col-12 d-flex justify-content-center align-items-center" style="min-height: 50vh">
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                    <div class="post-purchase-card login-card">
                        <h4 class="text-center">Congrats on checking out 🎉</h4>
                        <p class="text-center" style="color: var(--neutral)">What to do next?</p>
                        {{-- show this if user is not signed in --}}
                        <div class="mb-3 text-center">
                            <span>Track your orders effortlessly</span>
                            @if (Auth::user())
                                <a href="{{route('user.dashboard')}}" class="btn btn-primary mt-2 col-12">Go to Dashboard</a>
                            @else
                                <a href="{{route('register')}}" class="btn btn-primary mt-2 col-12">Sign-up/Log-in now</a>
                            @endif
                        </div>

                        <div class="text-center">
                            <span>Explore more goodies</span>
                            <a href="{{route('forceReg')}}" class="btn btn-secondary mt-2 col-12">Continue browsing</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
