<!-- HEADER
   ============================================= -->
<header id="header" class="header tra-menu navbar-dark">
    <div class="header-wrapper">


        <!-- MOBILE HEADER -->
        <div class="wsmobileheader clearfix">
            <span class="smllogo"><img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>"
                    alt="mobile-logo" /></span>
            <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
        </div>


        <!-- NAVIGATION MENU -->
        <div class="wsmainfull menu clearfix">
            <div class="wsmainwp clearfix">


                <!-- HEADER LOGO -->
                <div class="desktoplogo"><a href="<?php echo e(url('/')); ?>" class="logo-black"><img
                            src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="header-logo"></a></div>
                <div class="desktoplogo"><a href="<?php echo e(url('/')); ?>" class="logo-white"><img
                            src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="header-logo"></a></div>


                <!-- MAIN MENU -->
                <nav class="wsmenu clearfix">
                    <ul class="wsmenu-list nav-theme-hover">


                        <!-- DROPDOWN MENU -->
                        <li aria-haspopup="true" class="text-primary"><a style="color:black;"
                                href="<?php echo e(route('home')); ?>">Home </a>

                        </li>



                        <!-- DROPDOWN MENU -->
                        <li aria-haspopup="true"><a style="color:black;" href="#">Company <span
                                    class="wsarrow"></span></a>
                            <ul class="sub-menu">
                                <li>
                                    <a style="color:black;" href="<?php echo e(route('page', 'assets')); ?>">Coin Trading</a>
                                </li>
                                <li>
                                    <a style="color:black;" href="<?php echo e(route('page', 'bills')); ?>">Bills Payment</a>
                                </li>
                                <?php
                                    $pages = App\Models\Page::where('tempname', $activeTemplate)
                                        ->where('is_default', 0)
                                        ->get();
                                    //$pages = getContent('pages.element', null, false, true);
                                ?>
                                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a style="color:black;"
                                            href="<?php echo e(route('pages', [$data->slug])); ?>"><?php echo e(__($data->name)); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                        

                            </ul>
                        </li>


                        <li aria-haspopup="true" class="text-primary"><a style="color:black;"
                            href="<?php echo e(route('blog')); ?>">Blog </a>

                        </li>
                        <li aria-haspopup="true">
                            <a style="color:black;" href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a>
                        </li>

                        <!-- SIMPLE NAVIGATION LINK -->
                        <li class="nl-simple" aria-haspopup="true"><a style="color:black;"
                                href="<?php echo e(route('rates')); ?>">Rates</a></li>




                        <!-- HEADER CALL BUTTON
       <li class="nl-simple header-phone ico-25" aria-haspopup="true">
       <a href="tel:123456789">
       <span class="flaticon-phone-call bg-white theme-color"></span>+12 9 8765 4321
       </a>
       </li> -->

                        <?php if(auth()->guard()->check()): ?>
                            <li aria-haspopup="true"><a style="color:black;" href="#">Account <span
                                        class="wsarrow"></span></a>
                                <ul class="sub-menu">
                                    <li>
                                        <a style="color:black;" href="<?php echo e(route('user.home')); ?>">Dashboard</a>
                                    </li>
                                    <li>
                                        <a style="color:black;" href="<?php echo e(route('user.logout')); ?>">Logout</a>
                                    </li>

                                </ul>
                            </li>
                        <?php else: ?>
                            <li aria-haspopup="true"><a style="color:black;" href="#">Login/Register<span
                                        class="wsarrow"></span></a>
                                <ul class="sub-menu">
                                    <li>
                                        <a style="color:black;" href="<?php echo e(route('user.home')); ?>">Login</a>
                                    </li>
                                    <li>
                                        <a style="color:black;" href="<?php echo e(route('user.register')); ?>">Register</a>
                                    </li>

                                </ul>
                            </li>
                            <?php endif; ?>



                            <li class="nl-simple white-color header-socials ico-20 clearfix" aria-haspopup="true">
                                <span><a href="https://www.facebook.com/LTechNG" class="ico-facebook"><span
                                            class="flaticon-facebook"></span></a></span>
                                <span><a href="https://x.com/LTechNG_?t=2Bed2mxW3uU0AClJM6-RKw&s=09" class="ico-twitter"><span
                                            class="flaticon-twitter"></span></a></span>
                                <span><a href="https://www.instagram.com/ltechng.co?igsh=MXVhZjVnbGdqbDY0cQ==" class="ico-instagram"><span
                                            class="flaticon-instagram"></span></a></span>
                                <span><a href="#" class="ico-dribbble"><span
                                            class="flaticon-dribbble"></span></a></span>
                            </li>


                        </ul>
                    </nav> <!-- END MAIN MENU -->


                </div>
            </div> <!-- END NAVIGATION MENU -->


        </div> <!-- End header-wrapper -->
    </header> <!-- END HEADER -->
<?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/basic/partials/header.blade.php ENDPATH**/ ?>