@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('admin.category.index')}}"> All Categories</a></div>
                <div class="breadcrumb-item">{{$category->name}}</div>
            </div>
        </div>

        <div class="section-body">
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Edit "{{$category->name}}"</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.category.update', $category->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Div tag -->
                            <div class="form-group">
                                <label for="name">Name </label>
                                <input type="text" class="form-control" value="{{$category->name}}"  name="name"> 
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" value="{{$category->description}}"  name="description"> 
                            </div>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option {{$category->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                    <option {{$category->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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
 