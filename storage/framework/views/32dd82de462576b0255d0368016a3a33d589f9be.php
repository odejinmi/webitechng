<!doctype html>
<html lang="<?php echo e(config('app.locale')); ?>" itemscope itemtype="http://schema.org/WebPage">
<!--begin::Head-->

<head>

    <title> <?php echo e($general->siteName(__($pageTitle))); ?></title>
    <?php echo $__env->make('partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />

    <!--  Stylesheet -->

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset( $activeTemplateTrue . 'agent/css/main.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset( $activeTemplateTrue . 'agent/css/utility.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://api.fontshare.com/v2/css?f=satoshi@900,700,500,300,401,400&display=swap">
    <link rel="stylesheet" href="<?php echo e(asset( $activeTemplateTrue . 'dashboard/css/toast.min.css')); ?>" />
</head>
<body>

        <?php echo $__env->yieldContent('content'); ?>

</body>
    <!--  Scripts -->
     <div class="d-flex align-items-center gap-2 position-fixed bottom-0 end-0 mb-6 me-6 px-2 py-2 rounded-pill shadow-4 bg-white z-2">
        <img src="<?php echo e(getImage(getFilePath('logoIcon') . '/favicon.png')); ?>" class="avatar avatar-xs">
          <a href="#" class="me-1 text-heading fw-bold text-xs ls-tight stretched-link" target="_blank">Powered By LtechNg</a>
      </div>
    <script src="<?php echo e(asset( $activeTemplateTrue . 'agent/js/main.js')); ?>"></script>
    <script src="<?php echo e(asset( $activeTemplateTrue . 'dashboard/js/toast.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/assets/dist/libs/jquery/dist/jquery.min.js')); ?>"></script>


        <?php echo $__env->yieldPushContent('script'); ?>
        <?php echo $__env->make('partials.plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.toast', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/layouts/auth.blade.php ENDPATH**/ ?>