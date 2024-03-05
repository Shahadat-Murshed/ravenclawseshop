@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Slider</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.slider.index')}}"> All Sliders</a></div>
            <div class="breadcrumb-item">Create New</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Slider</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route(('admin.slider.store'))}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="banner">Banner</label>
                                <input type="file" class="form-control" name="banner">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" value="{{old('title')}}"  name="title">
                            </div>
                            <div class="form-group">
                                <label for="sub_title">Sub Title</label>
                                <input type="text" class="form-control" value="{{old('sub_title')}}" name="sub_title">
                            </div>
                            <div class="form-group">
                                <label for="btn_text">Button Text</label>
                                <input type="text" class="form-control" value="{{old('btn_text')}}" name="btn_text">
                            </div>
                            <div class="form-group">
                                <label for="btn_url">Button URL</label>
                                <input type="text" class="form-control" value="{{old('btn_url')}}" name="btn_url">
                            </div>
                            <div class="form-group">
                                <label for="serial">Serial</label>
                                <input type="text" class="form-control" value="{{old('serial')}}" name="serial">
                            </div>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option selected value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection