@extends('admin.layouts.master')

@section('content')
    <section class="section">
      <div class="section-header">
        <h1>Payment Methods</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">All {{$user ?? 'Payment'}} Methods</a></div>
            <div class="breadcrumb-item">{{$user ?? 'Payment'}} methods List</div>
        </div>
      </div>

      <div class="section-body">
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>All {{$user ?? 'Payment'}} Methods</h4>
                @if ($route)
                    <div class="card-header-action">
                        <a href="{{route($route)}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New {{$user}} Number</a>
                    </div>    
                @endif
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
        $('body').on('click', '.change-default', function(){
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');

            $.ajax({
                url: "{{route('admin.paymentmethods.default')}}",
                method: 'PUT',
                data: {
                    status: isChecked,
                    id: id
                },
                success: function(data){
                    location.reload();
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