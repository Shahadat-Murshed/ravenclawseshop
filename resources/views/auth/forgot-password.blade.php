@extends('frontend.layouts.master')

@section('title', 'Forgot Password')

<!-- Log in And Sign Up-->
@section('content')
<div class="parent-div">
    <div
        class="col-12 d-flex justify-content-center align-items-center"
        style="min-height: 100vh"
    >
        <div class="col-xl-3 col-lg-5 col-md-6 col-sm-8 col-10">
            <div class="login-card">
                <div class="header mb-2">
                    <span class="me-2">Forgot Your Password?</span><i class="fa-solid fa-key" style="font-size: 20px; color: white"></i>
                </div>
                <div class="body">
                    <span
                        style="
                            color: white;
                        "
                        >No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</span
                    >
                    <br />
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div
                            class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                        >
                        <x-input-label for="email" class="mt-4 mb-2" :value="__('Email')" />
                            <input
                                id="email"
                                class="custom-input"
                                type="email"
                                value="{{old('email')}}"
                                name="email"
                                
                                autofocus
                                placeholder="Email Address"
                            />
                        </div> 
                        <br />
                        <div
                            class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                        >
                            <button
                                type="submit"
                                class="btn btn-primary"
                                style="width: 100%"
                            >
                                Email Password Reset Link
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
