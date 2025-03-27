<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> <?php echo e($general->siteName(__($pageTitle))); ?></title>
    <?php echo $__env->make('partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800;900&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="<?php echo e(asset($activeTemplateTrue . 'front/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- FONT ICONS -->
    <link href="<?php echo e(asset($activeTemplateTrue . 'front/css/flaticon.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset($activeTemplateTrue . 'front/css/purple-theme.css')); ?>" rel="stylesheet">

    <!-- PLUGINS STYLESHEET -->
    <link href="<?php echo e(asset($activeTemplateTrue . 'front/css/menu.css')); ?>" rel="stylesheet">
    <link id="effect" href="<?php echo e(asset($activeTemplateTrue . 'front/css/dropdown-effects/fade-down.css')); ?>"
        media="all" rel="stylesheet">
    <link href="<?php echo e(asset($activeTemplateTrue . 'front/css/magnific-popup.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset($activeTemplateTrue . 'front/css/owl.carousel.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset($activeTemplateTrue . 'front/css/flexslider.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset($activeTemplateTrue . 'front/css/slick.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset($activeTemplateTrue . 'front/css/slick-themes.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset($activeTemplateTrue . 'front/css/owl.theme.default.min.css')); ?>" rel="stylesheet">

    <!-- ON SCROLL ANIMATION -->
    <link href="<?php echo e(asset($activeTemplateTrue . 'front/css/animate.css')); ?>" rel="stylesheet">

    <!-- RESPONSIVE CSS -->
    <link href="<?php echo e(asset($activeTemplateTrue . 'front/css/responsive.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('style-lib'); ?>
    <?php echo $__env->yieldPushContent('style'); ?>

</head>

<body>
    <?php echo $__env->yieldPushContent('fbComment'); ?>
    <!-- PRELOADER SPINNER
  ============================================= -->
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>

    <!-- End. Loader -->

    <!-- PAGE CONTENT
                 ============================================= -->
    <div id="page" class="page">



        <?php echo $__env->make($activeTemplate . 'partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- header-section end -->
        <?php echo $__env->yieldContent('content'); ?>

        

        <!-- footer-section start -->
        <?php echo $__env->make($activeTemplate . 'partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 


<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/65d98be69131ed19d97105a7/1hncskvjf';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
        <!-- EXTERNAL SCRIPTS
  ============================================= -->
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/jquery-3.5.1.min.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/modernizr.custom.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/jquery.easing.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/jquery.appear.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/jquery.scrollto.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/menu.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/materialize.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/slick.min.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/imagesloaded.pkgd.min.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/isotope.pkgd.min.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/jquery.flexslider.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/owl.carousel.min.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/jquery.magnific-popup.min.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/jquery.validate.min.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/jquery.ajaxchimp.min.js')); ?>"></script>
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/wow.js')); ?>"></script>

        <!-- Custom Script -->
        <script src="<?php echo e(asset($activeTemplateTrue . 'front/js/custom.js')); ?>"></script>

        <!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information. -->
        <!--
  <script>
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'G-X4TBXSY82C']);
      _gaq.push(['_trackPageview']);

      (function() {
          var ga = document.createElement('script');
          ga.type = 'text/javascript';
          ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
              '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0];
          s.parentNode.insertBefore(ga, s);
      })();
  </script>
  -->

        <?php echo $__env->yieldPushContent('script-lib'); ?>
        <?php echo $__env->yieldPushContent('script'); ?>
        <?php echo $__env->make('partials.plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/basic/layouts/frontend.blade.php ENDPATH**/ ?>