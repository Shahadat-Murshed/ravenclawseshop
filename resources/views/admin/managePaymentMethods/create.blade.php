@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
            <div class="section-header">
                <h1>Payment Methods</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{route('admin.payments.'.$name.'.list')}}">All {{$user ?? 'Payment'}} methods</a></div>
                    <div class="breadcrumb-item">Create a New {{$user ?? 'Payment'}} method</div>
                </div>
            </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create New {{$user ?? 'Payment'}} Method</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route($route)}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="region">Region</label>
                                    <input id="region" type="text" class="form-control" name="region" value="{{$region}}" readonly required disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Method</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{$user}}" readonly required disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="number">Number</label>
                            <input id="number" type="text" class="form-control" name="number" value="">
                            <small id="placeholder" class="form-text"></small>
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
@push('scripts')
<script>
  const textarea = document.getElementById("number");

  function update() {
    placeholder.innerText  = 'Total ' + textarea.value.length + ' Digit(s)';
  }

  textarea.addEventListener("keyup", () => {
    update();
  });
</script>
@endpush