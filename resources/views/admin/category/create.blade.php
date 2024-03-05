@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('admin.category.index')}}"> All Categories</a></div>
                <div class="breadcrumb-item">Create New</div>
            </div>
        </div>

        <div class="section-body">
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Create Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.category.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name </label>
                                <input type="text" class="form-control" value="{{old('name')}}"  name="name"> 
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" value="{{old('description')}}"  name="description" placeholder="(optional)"> 
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
 