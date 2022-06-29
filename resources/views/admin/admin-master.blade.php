<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('backend/assets/images/favicon.ico')}}">

    <title>Schoolmasoft | Admin Dashboard</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{asset('backend/assets/css/vendors_css.css')}}">

    <!-- Style-->
    <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/skin_color.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

<div class="wrapper">

    @include('admin.layouts.admin-header')

    <!-- Left side column. contains the logo and sidebar -->
  @include('admin.layouts.admin-main-sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">

           @yield('admin')
        </div>
    </div>
    <!-- /.content-wrapper -->
    @include('admin.layouts.admin-footer')

    <!-- Control Sidebar -->
   @include('admin.layouts.admin-control-slider')
    <!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->


<!-- Vendor JS -->
<script src="{{asset('backend/assets/js/vendors.min.js')}}"></script>
<script src="{{asset('backend/assets/icons/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor_components/easypiechart/dist/jquery.easypiechart.js')}}"></script>
<script src="{{asset('backend/assets/vendor_components/apexcharts-bundle/irregular-data-series.js')}}"></script>
<script src="{{asset('backend/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>

<!-- Sunny Admin App -->
<script src="{{asset('backend/assets/js/template.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/dashboard.js')}}"></script>

{{--sweetalert--}}


<script src="{{asset('backend/assets/vendor_components/datatable/datatables.min.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/data-table.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('backend/assets/js/validate.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(function (){
       $(document).on('click','#delete',function (e) {
          e.preventDefault();
          var link = $(this).attr("href");
           Swal.fire({
               title: 'Are you sure?',
               text: "You won't be able to revert this!",
               icon: 'danger',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Yes, delete it!'
           }).then((result) => {
               if (result.isConfirmed) {
                   window.location.href = link;
                   Swal.fire(
                       'Deleted!',
                       'Your file has been deleted.',
                       'success'
                   )
               }
           });
       });
    });
</script>

<script>
        @if(Session::has('message')){
        var type = "{{Session::get('alert-type','info')}}"
        switch (type) {
            case 'info':
                toastr.info("{{Session::get('message')}}");
                break;
            case 'success':
                toastr.success("{{Session::get('message')}}");
                break;
            case 'warning':
                toastr.warning("{{Session::get('message')}}");
                break;
            case 'error':
                toastr.error("{{Session::get('message')}}");
                break;
        }
    }
    @endif
</script>


</body>
</html>
