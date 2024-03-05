@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Product Details</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.products.index')}}">All Products</a></div>
            <div class="breadcrumb-item">{{$product->name}}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card col-xl-12">
                    <div class="card-header">
                        <h4>{{$product->name}}</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-8 px-5">
                            <div class="form-group">
                                <label for="cover_image">Cover Preview</label><br>
                                <img src="{{asset($product->cover_image)}}" style="width: 500px; height: 200px;" alt="">
                            </div>
                        </div>
                        <div class="col-md-4 px-5">
                            <div class="form-group">
                                <label for="cover_image">Thumbnail Preview</label><br>
                                <img src="{{asset($product->thumb_image)}}" style="height: 200px;" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3">
                        <div class="col-xl-8 card">        
                            <div class="mb-4">
                                <div class="card-header">
                                    Product Information
                                </div>
                                <div class="card-body">
                                    <div class="row gx-3 mb-3">
                                        <div class="mb-3 col-md-6">
                                            <label class="h5">Product name</label>
                                            <div class="form-control form-control-solid">{{ $product->name }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="h5">Product category</label>
                                            <div class="form-control form-control-solid">{{$product->category->name}}</div>
                                        </div>
                                        
                                    </div>

                                    <div class="row gx-3 mb-3">                                    
                                        <div class="col-md-6">
                                            <label class="h5">SEO Title</label>
                                            <div style="height: 4rem" class="form-control form-control-solid">{{ $product->seo_title}}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="h5">Status</label>
                                            @if ($product->status == 1)
                                                <div class="form-control form-control-solid">Active</div>
                                            @else
                                                <div class="form-control form-control-solid">Inactive</div>
                                            @endif     
                                        </div>
                                    </div>
                                    
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="h5">SEO Description</label>
                                            <div style="height: 4rem" class="form-control form-control-solid">{{ $product->seo_description  }}</div>
                                        </div>
                                        
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 card">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="h5" for="icon">Icon Preview</label><br>
                                    <img src="{{asset($product->icon)}}" style="width: 100%;" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 card">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="h5" style="font-size: 20px" for="description">Description</label>
                                        <textarea name="description" readonly class="form-control summernote" id="description">{!! $product->description !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="h5" style="font-size: 20px" for="how_to_order">How to Order</label>
                                        <textarea name="how_to_order" readonly class="form-control summernote" id="how_to_order">{!! $product->how_to_order !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 card">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ign">Ign Required?</label>
                                        <div class="form-control form-control-solid">{{$product->ign_required   == 1 ? 'Yes' : 'No'}}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="region">Region Required?</label>
                                        <div class="form-control form-control-solid">{{$product->region_required == 1 ? 'Yes' : 'No'}}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Password Required?</label>
                                        <div class="form-control form-control-solid">{{$product->pass_required == 1 ? 'Yes' : 'No'}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ign_type">IGN/UID/Email-id</label>
                                        <div class="form-control form-control-solid">{{ $product->ign_type }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="region_type">Region/Server?</label>
                                        <div class="form-control form-control-solid">{{ $product->region_type }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password_type">Password Type?</label>
                                        <div class="form-control form-control-solid">{{ $product->password_type }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ign_example">IGN Placeholder</label>
                                        <div class="form-control form-control-solid">{{$product->ign_example}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="col-xl-12 btn btn-danger" href="{{ url()->previous() }}">Go Back</a>
                    </div>        
                </div>
            </div>
        </div>
    </div>    
</section>

@endsection