@extends('frontend.layouts.master')

@section('title', '404 Not Found')


@push('styles')
<link rel="stylesheet" href="{{asset('frontend/assets')}}/css/home.css" />
<style>
    .icon {
            font-size: 100px; /* Adjust the size of the icon */
            color: #fff; /* Adjust the color of the icon */
        }
    .div{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }    
</style>
@endpush

@section('content')
<div class="parent-div">
    <div
        class="col-12 d-flex justify-content-center align-items-center"
        style="min-height: 100vh"
    >   <div class="div">
            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h1>404 - Not Found</h1>
            <p>Sorry, the page you are looking for could not be found.</p>
            <a type=button class="btn btn-primary px-5" href="{{route('home')}}">Return to Home</a>
        </div>
    </div>
</div>
@endsection

