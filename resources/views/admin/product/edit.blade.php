@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Product</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.products.index')}}">All Products</a></div>
            <div class="breadcrumb-item">{{$product->name}}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update {{$product->name}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cover_image">Cover Preview</label><br>
                                        <img src="{{asset($product->cover_image)}}" style="width: 500px; height: 200px;" alt="">
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cover_image">Cover Image</label>
                                        <input type="file" class="form-control" name="cover_image">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="thumb_image">Thumbnail Preview</label><br>
                                        <img src="{{asset($product->thumb_image)}}" style="height: 200px;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="thumb_image">Thumbnail Image</label>
                                        <input type="file" class="form-control" name="thumb_image">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon">Icon Preview</label><br>
                                        <img src="{{asset($product->icon)}}" style="width: 200px; height: 200px;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon">Icon</label>
                                        <input type="file" class="form-control" name="icon">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" value="{{$product->name}}" class="form-control"  name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select id="category" class="form-control" name="category">
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                                <option {{$category->id == $product->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control summernote" id="description">{!! $product->description !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="how_to_order">How to Order</label>
                                <textarea name="how_to_order" class="form-control summernote" id="how_to_order">{!! $product->how_to_order !!}</textarea>
                            </div>

                            <div class="col-md-6 p-0">
                                <div class="form-group">
                                    <label for="seo_title">SEO Title</label>
                                    <input type="text" class="form-control" value="{{$product->seo_title}}"  name="seo_title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="seo_description">SEO Description</label>
                                <textarea name="seo_description" class="form-control"  id="seo_description" cols="30" rows="10">{!! $product->seo_description !!}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ign">Ign Required?</label>
                                        <select id="ign" class="form-control" name="ign_required">
                                            <option {{$product->ign_required   == 1 ? 'selected' : ''}} value="1">Yes</option>
                                            <option {{$product->ign_required   == 0 ? 'selected' : ''}} value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="region">Region Required?</label>
                                        <select id="region" class="form-control" name="region_required">
                                            <option {{$product->region_required   == 1 ? 'selected' : ''}} value="1">Yes</option>
                                            <option {{$product->region_required   == 0 ? 'selected' : ''}} value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Password Required?</label>
                                        <select id="password" class="form-control" name="pass_required">
                                            <option {{$product->pass_required   == 1 ? 'selected' : ''}} value="1">Yes</option>
                                            <option {{$product->pass_required   == 0 ? 'selected' : ''}} value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ign_type">IGN/UID/Email-id</label>
                                        <input type="text" class="form-control" value="{{$product->ign_type}}"  name="ign_type">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="region_type">Region/Server/Platform?</label>
                                        <input type="text" class="form-control" value="{{$product->region_type}}"  name="region_type">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password_type">Password Type?</label>
                                        <input type="text" class="form-control" value="{{$product->password_type}}"  name="password_type">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ign_example">IGN Placeholder</label>
                                        <input type="text" class="form-control" value="{{$product->ign_example}}"  name="ign_example">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option {{$product->status == '1' ? 'selected' : ''}} value="1">Active</option>
                                    <option {{$product->status == '0' ? 'selected' : ''}} value="0">Inactive</option>
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