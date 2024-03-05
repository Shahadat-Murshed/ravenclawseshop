@extends('frontend.layouts.master')
@section('title')
  {{Auth::user()->first_name}}
@endsection
@section('content')
<div class="parent-div" style="padding-top: 10vh">
    <div class="container">
        <div class="mt-4">
            <div>
                <form action="{{route('user.profile.update')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <h4>Personal Information</h4>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                <label class="mb-1 mt-3" for="firstName">First Name</label>
                                <input name="first_name" id="firstName" type="text" class="custom-input" value="{{$user->first_name}}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                <label class="mb-1 mt-3"  for="lastName">Last Name</label>
                                <input name="last_name" id="lastName" type="text" class="custom-input" value="{{$user->last_name}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <label class="mb-1 mt-3"  for="email">Email</label>
                                <input name="email" id="email" type="email" class="custom-input" value="{{$user->email}}">
                            </div>
                            <div class="col-lg-6 col-12">
                                <label class="mb-1 mt-3"  for="phone">Phone Number</label>
                                <input name="phone" id="phone" type="text" class="custom-input" value="{{$user->phone}}">
                            </div>
                        </div>
                        <br>
                        <div class="col-12 d-flex justify-content-end mt-2">
                            <div class="col-lg-3 col-12">
                                <button type="submit" class="btn btn-success" style="width:100%">
                                    Update Profile
                                </button>
                            </div>

                        </div>
                    </div>
                </form>

                <form action="{{route('user.password.update')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <br>
                    <br>
                    <div class="mt-2">
                        <h4>Change Your Password</h4>
                        <div class="col-12">
                            <label class="mb-1 mt-3"  for="oldPassword">Current Password</label>
                            <input id="oldPassword" type="password" class="custom-input" name="current_password" placeholder="Current Password">
                        </div>
                        <div class="col-12">
                            <label class="mb-1 mt-3"  for="newPassword">New Password</label>
                            <input id="newPassword" type="password" class="custom-input" name="password" placeholder="New Password">
                        </div>
                        <div class="col-12">
                            <label class="mb-1 mt-3"  for="confirmPassword">Confirm Password</label>
                            <input id="confirmPassword" type="password" class="custom-input" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                    </div>
                    <br>
                    <div class="col-12 d-flex justify-content-end mt-2">
                        <div class="col-lg-3 col-12">
                            <button type="submit" class="btn btn-danger" style="width:100%">
                                Change Password
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
