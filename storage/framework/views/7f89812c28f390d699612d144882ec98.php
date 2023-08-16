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

    <?php echo $__env->make('frontend.include.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
    <!-- preloader Start-->
    <div id="preloader">
        <div id="status"><img src="<?php echo e(asset('frontend/asset/images/header/horoscope.gif')); ?>" id="preloader_image" alt="loader">
        </div>
    </div>
    <!-- main_header_wrapper Start -->

    <?php echo $__env->make('frontend.include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content-area'); ?>

    <?php echo $__env->make('frontend.include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.include.foot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>


<!-- Mirrored from webstrot.com/html/jyotish/light_version/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Sep 2020 06:35:24 GMT -->

</html><?php /**PATH E:\Theallsif-astro\resources\views/frontend/layout/frontend.blade.php ENDPATH**/ ?>