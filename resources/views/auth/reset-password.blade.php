@extends('frontend.layouts.master')

@section('title', 'Reset Password')

@section('content')
    <div class="parent-div">
        <div class="col-12 d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <div class="col-xl-3 col-lg-5 col-md-6 col-sm-8 col-10">
                <div class="login-card">
                    <div class="header mb-2">
                        <span class="me-2">Reset Your Password?</span><i class="fa-solid fa-key" style="font-size: 20px; color: white"></i>
                    </div>
                    <div class="body">
                        <form form method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <input
                                    id="email"
                                    class="custom-input"
                                    type="email"
                                    value="{{old('email', $request->email)}}"
                                    name="email"
                                    readonly
                                    placeholder="Email Address"
                                />
                            </div> 
                            <br />
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <input
                                    id="password"
                                    class="custom-input"
                                    type="password"
                                    value=""
                                    name="password"
                                    autofocus
                                    placeholder="New Password"
                                />
                            </div> 
                            <br />
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <input
                                    id="password_confirmation"
                                    class="custom-input"
                                    type="password"
                                    value=""
                                    name="password_confirmation"
                                    autofocus
                                    placeholder="Confirm Password"
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
                                    Reset Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection