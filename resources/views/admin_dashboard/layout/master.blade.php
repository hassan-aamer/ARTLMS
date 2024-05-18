<!doctype html>
<html lang="ar" class="semi-dark" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('admin_dashboard/assets/images/favicon-32x32.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('admin_dashboard/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
    <link href="{{ asset('admin_dashboard/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin_dashboard/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin_dashboard/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin_dashboard/assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin_dashboard/assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin_dashboard/assets/css/icons.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" integrity="sha512-xnP2tOaCJnzp2d2IqKFcxuOiVCbuessxM6wuiolT9eeEJCyy0Vhcwa4zQvdrZNVqlqaxXhHqsSV1Ww7T2jSCUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- loader-->
    <link href="{{ asset('admin_dashboard/assets/css/pace.min.css')}}" rel="stylesheet" />
    <!--Theme Styles-->
    <link href="{{ asset('admin_dashboard/assets/css/semi-dark.css')}}" rel="stylesheet" />
    <title> @yield('Page_Title')   |  منصة فن </title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .tox-notifications-container,.tox-statusbar__branding
        {
            display:none !important;
        }
    </style>
    @stack('styles')



</head>

<body>

<!--start wrapper-->
<div class="wrapper">

    @include('admin_dashboard.layout.header')

    @include('admin_dashboard.layout.aside')



    <!--start content-->
    <main class="page-content">


        @include('errors.validation_error')

        @yield('content')



    </main>
    <!--end page main-->


    <!--start overlay-->
    <div class="overlay nav-toggle-icon"></div>
    <!--end overlay-->

    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->



</div>
<!--end wrapper-->


<!-- Bootstrap bundle JS -->
<script src="{{ asset('admin_dashboard/assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{ asset('admin_dashboard/assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/js/pace.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/plugins/chartjs/js/Chart.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
<!--app-->
<script src="{{ asset('admin_dashboard/assets/js/app.js')}}"></script>

@stack('scripts')

<script>
    //Add New Row
    $(document).on('click','#addNewRow', function(){
        var row = $(this).parent().parent().find('#tr').clone();
        $(row).find("input").val("");
        $(row).appendTo( $(this).parent().parent().find('tbody'));
    });

    //Remove Row
    $(document).on('click','.removeRow', function(){
        if($("#lines").children().length >1){
            $(this).parent().parent().remove();
        }
    });
</script>
<script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
<script>

    $(".ckeditor").each(function () {
        let id = $(this).attr('id');
        CKEDITOR.replace(id);
    });


</script>

</body>

</html>
