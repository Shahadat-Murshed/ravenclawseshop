@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Product</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.products.index')}}">All Products</a></div>
            <div class="breadcrumb-item">{{$product_variant->quantity}} {{$product_variant->unit}}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit {{$product_variant->quantity}} {{$product_variant->unit}} for {{$product_variant->product->name}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.products-variants.update', $product_variant->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select id="category" class="form-control main-category" name="category">
                                            <option value="{{$product_variant->category_id}}">Select</option>
                                            @foreach ($categories as $category)
                                                <option {{$category->id == $product_variant->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product">Product</label>
                                        <select id="product" class="form-control products" name="product">
                                            <option value="{{$product_variant->product_id}}">Select</option>
                                            @foreach ($products as $product)
                                                <option {{$product->id == $product_variant->product_id ? 'selected' : ''}} value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unit">Unit</label>
                                        <input type="text" class="form-control" value="{{$product_variant->unit}}"  name="unit">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" value="{{$product_variant->price}}"  name="price">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount_price">Discount Price (Optional)</label>
                                        <input type="number" class="form-control" value="{{$product_variant->discount_price}}"  name="discount_price">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price_rm">Price in RM (Optional)</label>
                                        <input type="number" class="form-control" value="{{$product_variant->price_rm}}"  name="price_rm">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount_price_rm">Discount Price in RM (Optional)</label>
                                        <input type="number" class="form-control" value="{{$product_variant->discount_price_rm}}"  name="discount_price_rm">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="in_stock">In Stock?</label>
                                        <select id="in_stock" class="form-control" name="in_stock">
                                            <option  {{$product_variant->in_stock == '1' ? 'selected' : ''}} value="1">Yes</option>
                                            <option {{$product_variant->in_stock == '0' ? 'selected' : ''}} value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputState">Status</label>
                                        <select id="inputState" class="form-control" name="status">
                                            <option {{$product_variant->status == '1' ? 'selected' : ''}} value="1">Active</option>
                                            <option {{$product_variant->status == '0' ? 'selected' : ''}} value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
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
@push('scripts')
  <script>
    $(document).ready(function(){
        $('body').on('change', '.main-category', function(e){
        // alert('hello');
        let categoryId = $(this).val();
        // console.log(categoryId);
        $.ajax({
            method: 'GET',
            url: "{{route('admin.products-variants.get-products')}}",
            data: {
            id: categoryId,

            },
            success: function(data){
            $('.products').html(`<option value="">Select</option>`)
            $.each(data, function(i, item){
                $('.products').append(`<option value="${item.id}">${item.name}</option>`)
            })
            },
            error: function(xhr, status, error){
            console.log(error);
            }
        })
      })
    })
  </script>
@endpush