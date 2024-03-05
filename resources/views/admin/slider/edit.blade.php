@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Slider</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.slider.index')}}"> All Sliders</a></div>
            <div class="breadcrumb-item">{{$slider->title}}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit "{{$slider->title}}"</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="banner">Preview</label>
                                <br>
                                <img width="100%" src="{{asset($slider->banner)}}" alt="">
                            </div>
                            <div class="form-group">
                                <label for="banner">Banner</label>
                                <input type="file" class="form-control" name="banner">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" value="{{$slider->title}}" name="title">
                            </div>
                            <div class="form-group">
                                <label for="sub_title">Sub Title</label>
                                <input type="text" class="form-control" value="{{$slider->sub_title}}"  name="sub_title">
                            </div>
                            <div class="form-group">
                                <label for="btn_text">Button Text</label>
                                <input type="text" class="form-control" value="{{$slider->btn_text}}" name="btn_text">
                            </div>
                            <div class="form-group">
                                <label for="btn_url">Button URL</label>
                                <input type="text" class="form-control" value="{{$slider->btn_url}}" name="btn_url">
                            </div>
                            <div class="form-group">
                                <label for="serial">Serial</label>
                                <input type="text" class="form-control" value="{{$slider->serial}}" name="serial">
                            </div>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option {{$slider->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                    <option {{$slider->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection