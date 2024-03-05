@extends('admin.layouts.master')

@section('content')
    <section class="section">
      <div class="section-header">
        <h1>Orders</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.orders.pendingOrder')}}">On Hold Orders</a></div>
            <div class="breadcrumb-item">Orders List</div>
        </div>
      </div>

      <div class="section-body">
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>All Hold Orders</h4>
              </div>
              <div class="card-body">
                {{$dataTable->table()}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@push('scripts')
{{$dataTable->scripts(attributes: ['type'=> 'module'])}}
@endpush