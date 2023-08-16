<!DOCTYPE html>
<html lang="en">
<!--[endif]-->


<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <meta charset="utf-8" />
    <title>Astrology</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Jyotish" />
    <meta name="keywords" content="Jyotish" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />

    @include('frontend.include.head')
</head>

<body>
    <!-- preloader Start-->
    <div id="preloader">
        <div id="status"><img src="{{ asset('frontend/asset/images/header/horoscope.gif') }}" id="preloader_image" alt="loader">
        </div>
    </div>
    <!-- main_header_wrapper Start -->

    @include('frontend.include.nav')
    @yield('content-area')

    @include('frontend.include.footer')
    @include('frontend.include.foot')
</body>


<!-- Mirrored from webstrot.com/html/jyotish/light_version/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Sep 2020 06:35:24 GMT -->

</html>