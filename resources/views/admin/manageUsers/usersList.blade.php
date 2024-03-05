@extends('admin.layouts.master')

@section('content')
    <section class="section">
      <div class="section-header">
        <h1>Users</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route($route)}}">All {{$user ?? 'Users'}}</a></div>
            <div class="breadcrumb-item">{{$user ?? 'Users'}} List</div>
        </div>
      </div>

      <div class="section-body">
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>All {{$user ?? 'Users'}}</h4>
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
                url: "{{route('admin.users.change-status')}}",
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
    $(document).ready(function(){
        $('body').on('click', '.change-role', function(){
            let id = $(this).data('id');

            $.ajax({
                url: "{{route('admin.users.changeRole')}}",
                method: 'PUT',
                data: {
                    id: id
                },
                success: function(data){
                    toastr.success(data.message)
                    location.reload();
                },
                error: function(xhr, status, error){
                    console.log(error);
                }
            })

        })
    })
</script>
@endpush