<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') - Ravenclaws</title>
    <link rel="icon" href="{{asset('frontend/assets/favicon/favicon.png')}}" type="image/x-icon">

    <!-- Css Libraries Start -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />



    <!-- Css Libraries End -->
    {{-- datatable css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <!-- Main/Custom css -->
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/css/navbar.css" />
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/css/footer.css" />
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/css/stylev1.0.0.css" />
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/css/responsive.css" />
    @stack('styles')

  </head>
  <body>
      @include('frontend.layouts.navbar')
      @yield('content')
      @include('frontend.pages.sticky-cart')
      @include('frontend.pages.footer')

      <!-- Main/Custom Js -->
      <script src="{{asset('frontend/assets')}}/js/script.js"></script>
      <script src="{{asset('frontend/assets')}}/js/mobileNav.js"></script>
      <!-- Swiper Js -->
      <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
      <!-- Toasts Js -->
      <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <!-- Sweet Alert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        @if ($errors->any())
          @foreach ($errors->all() as $error)
            toastr.error("{{$error}}");
          @endforeach
        @endif
      </script>

      <script>
          document.addEventListener("DOMContentLoaded", function() {
              var dropdownItems = document.querySelectorAll(".dropdown-item-region");
              var dropdownButton = document.getElementById("dropdown-toggle-region");

              dropdownItems.forEach(function(item) {
                  item.addEventListener("click", function() {
                      var newText = item.textContent;
                      dropdownButton.textContent = newText;
                  });
              });
          });
      </script>
      <script>
        $(document).ready(function(){
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        })
      </script>

      {{-- datatable script --}}
       <!-- DataTables and Responsive DataTables Libraries -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

        <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
      @stack('scripts')
  </body>
</html>
