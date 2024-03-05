@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Coupon</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{route('admin.coupons.index')}}"> All Coupons</a></div>
              <div class="breadcrumb-item">Create New</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create New Coupon</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.coupons.store')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="">
                        </div>

                        <div class="form-group">
                            <label for="code">Code</label>
                            <input id="code" type="text" class="form-control" name="code" value="">
                        </div>


                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input id="quantity" type="text" class="form-control" name="quantity" value="">
                        </div>

                        <div class="form-group">
                            <label for="max_use">Max Use Per Person</label>
                            <input id="max_use" type="text" class="form-control" name="max_use" value="">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                        <input id="start_date" type="text" class="form-control datepicker" name="start_date" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input id="end_date" type="text" class="form-control datepicker" name="end_date" value="">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="discount_type">Discount Type</label>
                                    <select id="discount_type" class="form-control sub-category" name="discount_type">
                                      <option value="percent">Percentage (%)</option>
                                      <option value="amount">Amount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="discount">Discount Value</label>
                                    <input id="discount" type="text" class="form-control" name="discount" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="currency">Currency</label>
                                    <select class="form-control" name="currency" id="currency">
                                      <option value="BDT">Bangladeshi Taka</option>
                                      <option value="RM">Malaysian Ringgit </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" class="form-control" name="status">
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submmit" class="btn btn-primary">Create</button>
                        <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection
