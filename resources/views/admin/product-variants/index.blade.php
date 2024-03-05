@extends('admin.layouts.master')

@section('content')
    <section class="section">
      <div class="section-header">
        <h1>Products</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.products.index')}}">All Products</a></div>
            <div class="breadcrumb-item">Product Variants List</div>
        </div>
      </div>

      <div class="section-body">
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>{{$heading}}</h4>
                <div class="card-header-action"><a href="{{route('admin.products-variants.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>  Create New Item</a></div>
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

<script>
    $(document).ready(function(){
        $('body').on('click', '.change-status', function(){
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');

            $.ajax({
                url: "{{route('admin.products-variants.change-status')}}",
                method: 'PUT',
                data: {
                    status: isChecked,
                    id: id
                },
                success: function(data){
                    toastr.success(data.message)
                },
                error: function(xhr, status, error){
                    console.log(error);
                }
            })

        })
    })
</script>
<script>
    $(document).ready(function(){
        $('body').on('click', '.change-stock', function(){
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');

            $.ajax({
                url: "{{route('admin.products-variants.change-stock-status')}}",
                method: 'PUT',
                data: {
                    in_stock: isChecked,
                    id: id
                },
                success: function(data){
                    toastr.success(data.message)
                },
                error: function(xhr, status, error){
                    console.log(error);
                }
            })

        })
    })
</script>
@endpush