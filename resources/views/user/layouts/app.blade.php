<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>User - Property Management Service</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ url('/img/favicon.png') }}" rel="icon">
    <link href="{{ url('/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ url('/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ url('/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ url('/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ url('/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ url('/css/style.css') }}" rel="stylesheet">

</head>

<body>



@include('user.layouts._header')

@include('user.layouts._sidebar')

<main id="main" class="main">
    @yield('content')
</main><!-- End #main -->

@include('user.layouts._footer')




<!-- Vendor JS Files -->
<script src="{{ url('/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ url('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ url('/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ url('/vendor/quill/quill.js') }}"></script>
<script src="{{ url('/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ url('/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ url('/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ url('/js/main.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@yield('script')
</body>

</html>
