@extends('frontend.layouts.master')

@section('title', 'Log In')
@push('styles')
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/css/auth.css" />
@endpush
@section('content')
<div class="parent-div">
    <div
        class="col-12 d-flex justify-content-center align-items-center"
        style="min-height: 100vh"
    >
        <div class="col-xl-3 col-lg-5 col-md-6 col-sm-8 col-10">
            <div class="login-card">
                <ul
                    class="nav nav-pills mb-3 row"
                    id="pills-tab"
                    role="tablist"
                >
                    <li class="nav-item col-6" role="presentation">
                        <button
                            class="nav-link active"
                            style="width: 100%"
                            id="pills-login-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#pills-login"
                            type="button"
                            role="tab"
                            aria-controls="pills-login"
                            aria-selected="true"
                        >
                            Login
                        </button>
                    </li>
                    <li class="nav-item col-6" role="presentation">
                        <button
                            class="nav-link"
                            style="width: 100%"
                            id="pills-signup-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#pills-signup"
                            type="button"
                            role="tab"
                            aria-controls="pills-signup"
                            aria-selected="false"
                        >
                            Signup
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div
                        class="tab-pane fade show active"
                        id="pills-login"
                        role="tabpanel"
                        aria-labelledby="pills-login-tab"
                    >
                        <div class="header">
                            <span>Ravenclaw Id Login</span>
                        </div>
                        <div class="body">
                            <br />
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div
                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                                >
                                    <input
                                        id="email"
                                        class="custom-input"
                                        type="email"
                                        value="{{old('email')}}"
                                        name="email"
                                        placeholder="Email Address"
                                    />
                                </div>
                                <br />
                                <div
                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                                >
                                    <input
                                        id="password"
                                        name="password"
                                        class="custom-input"
                                        type="password"
                                        placeholder="Password"
                                    />
                                </div>
                                <br />
                                <div class="block px-1">
                                    <label
                                        for="remember_me"
                                        class="inline-flex items-center"
                                        style="cursor: pointer"
                                    >
                                        <input
                                            id="remember_me"
                                            type="checkbox"
                                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                            name="remember"
                                        />
                                        <span
                                            class="ml-2 text-sm text-gray-600 dark:text-gray-400"
                                            >{{ __('Remember me') }}</span
                                        >
                                    </label>
                                </div>
                                <br />
                                <div
                                    class="col-lg-12 col-md-12 col-12 pb-1"
                                    style="text-align: right"
                                >
                                    <a
                                        href="{{ route('password.request') }}"
                                        style="font-size: 12px"
                                        >Forgot Your Password?</a
                                    >
                                </div>

                                <div
                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                                >
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        style="width: 100%"
                                    >
                                        Login
                                    </button>
                                </div>
                            </form>
                            <br />
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <span
                                        style="
                                            font-size: 12px;
                                            color: var(--neutral);
                                        "
                                        >Not registered yet?</span
                                    >
                                    <br />
                                    <a
                                        id="pills-signup-link"
                                        style="width: 100%" href="{{route('register')}}"   
                                    >
                                        Create a Ravenclaw Id
                                    </a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12"></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="pills-signup"
                        role="tabpanel"
                        aria-labelledby="pills-signup-tab"
                    >
                        <div class="header">
                            <span>Create Ravenclaw Id </span>
                        </div>
                        <div class="body">
                            <br />
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div
                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                                >
                                    <input
                                        id="first_name"
                                        class="custom-input"
                                        type="text"
                                        value="{{Session::has('user') ? Session::get('user.name') : old('first_name')}}"
                                        name="first_name"
                                        placeholder="First Name"
                                    />
                                    <x-input-error :messages="$errors->get('first_name')"/>
                                </div>
                              
                                <br />
                                <div
                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                                >
                                    <input
                                        id="last_name"
                                        class="custom-input"
                                        type="text"
                                        value="{{old('last_name')}}"
                                        name="last_name"
                                        placeholder="Last Name"
                                    />
                                    <x-input-error :messages="$errors->get('last_name')"/>
                                </div>
                            
                                <br />
                                <div
                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                                >
                                    <input
                                        id="reg_email"
                                        class="custom-input"
                                        type="email"
                                        value="{{Session::has('user') ? Session::get('user.email') : old('reg_email')}}"
                                        name="reg_email"
                                        placeholder="Email Address"
                                    />
                                </div>
                                <br />
                                <div
                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                                >
                                    <input
                                        id="phone"
                                        class="custom-input"
                                        type="text"
                                        value="{{Session::has('user') ? Session::get('user.phone') : old('phone')}}"
                                        name="phone"
                                        placeholder="Phone Number"
                                    />
                                </div>
                                <x-input-error
                                    :messages="$errors->get('phone')"
                                />
                                <br />
                                <div
                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                                >
                                    <input
                                        id="password"
                                        name="password"
                                        class="custom-input"
                                        type="password"
                                        placeholder="Password"
                                    />
                                </div>
                                <x-input-error
                                    :messages="$errors->get('password')"
                                />

                                <br />
                                <div
                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                                >
                                    <input
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="custom-input"
                                        type="password"
                                        placeholder="Confirm Password"
                                    />
                                </div>
                                <x-input-error
                                    :messages="$errors->get('password_confirmation')"
                                />
                                <br />
                                <div
                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                                >
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        style="width: 100%"
                                    >
                                        Signup
                                    </button>
                                </div>
                            </form>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
