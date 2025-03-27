<div class="body-wrapper">
    <!--  Header Start -->

    <header class="app-header">
      <nav class="navbar navbar-expand-lg navbar-light mb-2">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
              <i class="ti ti-menu-2"></i>
            </a>
          </li>
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="ti ti-search"></i>
            </a>
          </li>
        </ul>

        <div class="d-block d-lg-none">
          <img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" class="dark-logo" width="50" alt="" />
          <img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" class="light-logo"  width="50" alt="" />
        </div>
        <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="p-2">
            <i class="ti ti-dots fs-7"></i>
          </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <div class="d-flex align-items-center justify-content-between">
            <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
              <i class="ti ti-align-justified fs-7"></i>
            </a>
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">

              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ti ti-bell-ringing"></i>
                  <div class="notification bg-primary rounded-circle"></div>
                </a>
                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="d-flex align-items-center justify-content-between py-3 px-7">
                    <h5 class="mb-0 fs-5 fw-semibold"><?php echo app('translator')->get('Notification'); ?></h5>
                    <?php if($adminNotificationCount > 0): ?>
                      <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm"><?php echo e($adminNotificationCount); ?> <?php echo app('translator')->get('New'); ?></span>
                    <?php else: ?>
                      <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm"><?php echo e($adminNotificationCount); ?> <?php echo app('translator')->get('New'); ?></span>
                    <?php endif; ?>

                  </div>
                  <div class="message-body" data-simplebar>
                    <?php $__currentLoopData = $adminNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('admin.notification.read', $notification->id)); ?>" class="py-6 px-7 d-flex align-items-center dropdown-item">
                      <span class="me-3">
                        <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . @$notification->user->image, getFileSize('userProfile'))); ?>" alt="user" class="rounded-circle" width="48" height="48" />
                      </span>
                      <div class="w-75 d-inline-block v-middle">
                        <h6 class="mb-1 fw-semibold"><?php echo e(__($notification->title)); ?></h6>
                        <span class="d-block"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                      </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <div class="py-6 px-7 mb-1">
                    <a href="<?php echo e(route('admin.notifications')); ?>" class="btn btn-outline-primary w-100"> <?php echo app('translator')->get('View all notification'); ?> </a>
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="d-flex align-items-center">
                    <div class="user-profile-img">
                      <img src="<?php echo e(getImage('assets/images/admin/profile/' .auth()->guard('admin')->user()->image)); ?>" class="rounded-circle" width="35" height="35" alt="" />
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                  <div class="profile-dropdown position-relative" data-simplebar>
                    <div class="py-3 px-7 pb-0">
                      <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                    </div>
                    <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                      <img src="<?php echo e(getImage('assets/images/admin/profile/' .auth()->guard('admin')->user()->image)); ?>" class="rounded-circle" width="80" height="80" alt="" />
                      <div class="ms-3">
                        <h5 class="mb-1 fs-3"><?php echo e(auth()->guard('admin')->user()->name); ?></h5>
                        <span class="mb-1 d-block text-dark"><?php echo e(auth()->guard('admin')->user()->username); ?></span>
                        <p class="mb-0 d-flex text-dark align-items-center gap-2">
                          <i class="ti ti-mail fs-4"></i> <?php echo e(auth()->guard('admin')->user()->email); ?>

                        </p>
                      </div>
                    </div>
                    <div class="message-body">
                      <a href="<?php echo e(route('admin.profile')); ?>" class="py-8 px-7 mt-8 d-flex align-items-center">
                        <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                          <img src="<?php echo e(asset('assets/assets/dist/images/backgrounds/icon-account.svg')); ?>" alt="" width="24" height="24">
                        </span>
                        <div class="w-75 d-inline-block v-middle ps-3">
                          <h6 class="mb-1 bg-hover-primary fw-semibold"> <?php echo app('translator')->get('My Profile'); ?> </h6>
                          <span class="d-block text-dark"><?php echo app('translator')->get('Account Settings'); ?></span>
                        </div>
                      </a>
                      <a href="<?php echo e(route('admin.password')); ?>" class="py-8 px-7 d-flex align-items-center">
                        <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                          <img src="<?php echo e(asset('assets/assets/dist/images/backgrounds/icon-tasks.svg')); ?>" alt="" width="24" height="24">
                        </span>
                        <div class="w-75 d-inline-block v-middle ps-3">
                          <h6 class="mb-1 bg-hover-primary fw-semibold"><?php echo app('translator')->get('My Password'); ?></h6>
                          <span class="d-block text-dark"><?php echo app('translator')->get('Password Settings'); ?></span>
                        </div>
                      </a>

                    <div class="d-grid py-4 px-7 pt-8">
                      <a href="<?php echo e(route('admin.logout')); ?>" class="btn btn-outline-primary"><?php echo app('translator')->get('Log Out'); ?></a>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>


    <?php echo $__env->make('admin.partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--  Search Bar -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content rounded-1">

    <form class="navbar-search">
      <div class="modal-header border-bottom">
        <input type="search" name="#0" class="form-control gs-3 navbar-search-field" id="searchInput" autocomplete="off">
        <span data-bs-dismiss="modal" class="lh-1 cursor-pointer">
          <i class="ti ti-x fs-5 ms-3"></i>
        </span>
      </div>
      <div class="modal-body message-body" data-simplebar="">
        <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
        <ul class="search-list"></ul>
      </div>
    </form>
    </div>
  </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/partials/topnav.blade.php ENDPATH**/ ?>