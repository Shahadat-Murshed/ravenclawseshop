@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Coupon</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{route('admin.coupons.index')}}"> All Coupons</a></div>
              <div class="breadcrumb-item">{{$coupon->name}}</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update "{{$coupon->name}}"</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.coupons.update', $coupon->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{$coupon->name}}">
                        </div>

                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" class="form-control" name="code" value="{{$coupon->code}}">
                        </div>


                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" value="{{$coupon->quantity}}">
                        </div>

                        <div class="form-group">
                            <label>Max Use Per Person</label>
                            <input type="text" class="form-control" name="max_use" value="{{$coupon->max_use}}">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                        <input type="text" class="form-control datepicker" name="start_date" value="{{$coupon->start_date}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="text" class="form-control datepicker" name="end_date" value="{{$coupon->end_date}}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Discount Type</label>
                                    <select id="inputState" class="form-control sub-category" name="discount_type">
                                      <option {{$coupon->discount_type == 'percent' ? 'selected' : ''}} value="percent">Percentage (%)</option>
                                      <option {{$coupon->discount_type == 'amount' ? 'selected' : ''}} value="amount">Amount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Descount Value</label>
                                    <input type="text" class="form-control" name="discount" value="{{$coupon->discount}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="currency">Currency</label>
                                  <select class="form-control" name="currency" id="currency">
                                    <option {{$coupon->currency == 'BDT' ? 'selected' : ''}} value="BDT">Bangladeshi Taka</option>
                                    <option {{$coupon->currency == 'RM' ? 'selected' : ''}} value="RM">Malaysian Ringgit </option>
                                  </select>
                              </div>
                          </div>
                        </div>

                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$coupon->status == 1 ? 'selected' : ''}} value="1">Active</option>
                              <option {{$coupon->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submmit" class="btn btn-primary">Update</button>
                        <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection
