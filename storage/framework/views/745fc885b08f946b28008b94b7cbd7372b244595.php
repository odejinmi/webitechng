
<header class="border-bottom mb-10"> 
                        <ul class="nav nav-tabs nav-tabs-flush gap-6 overflow-x border-0 mt-4">
                            <li class="nav-item"><a href="<?php echo e(route('user.profile.setting')); ?>" class="nav-link <?php echo e(Request::routeIs('user.profile.setting') ? 'active' : ''); ?>">General</a></li>
                            <li class="nav-item"><a href="<?php echo e(route('user.change.password')); ?>" class="nav-link" <?php echo e(Request::routeIs('user.change.password') ? 'active' : ''); ?>>Security</a></li>
                            <li class="nav-item"><a href="<?php echo e(route('user.twofactor')); ?>" class="nav-link <?php echo e(Request::routeIs('user.twofactor') ? 'active' : ''); ?>">Google 2FA</a></li>
                            <li class="nav-item"><a href="#" data-bs-toggle="modal" data-bs-target="#closeaccount" class="nav-link">Deactivate Account</a></li>
                        </ul>
                    </header>


                    <div class="modal fade" id="closeaccount" tabindex="-1" aria-labelledby="topUpModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content overflow-hidden">
                                <div class="modal-header pb-0 border-0">
                                    <h1 class="modal-title h4" id="topUpModalLabel">Deactivate your account</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <!--begin::Notice-->
                                        

                                <div class="modal-body undefined">
                                    <div
                                            class="alert alert-warning rounded border-warning border border-dashed mb-9 p-6">
                                            <!--begin::Icon--> 
        
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-stack flex-grow-1 ">
                                                <!--begin::Content-->
                                                <div class=" fw-semibold">
                                                    <h4 class="text-gray-900 fw-bold"><?php echo app('translator')->get('You Are Deactivating Your Account'); ?></h4>
        
                                                    <div class="fs-6 text-gray-700 "><?php echo app('translator')->get('By clicking on the deactivate button below, you are concenting to deactivating your account. Please proceed with caution'); ?></div>
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Notice-->
                                        <form class="vstack gap-8" action="<?php echo e(route('user.account.deactivate')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                        <div><label class="form-label">Enter Account Password</label>
                                            <div
                                                class="d-flex justify-content-between p-4 bg-body-tertiary border rounded">
                                                <input type="password" name="password" class="form-control form-control-flush text-xl fw-bold w-rem-40" placeholder="******">
                                                 
                                            </div>

                                            <button id="deactivate" type="submit"
                                            class="btn btn-danger btn-xs fw-semibold"><?php echo app('translator')->get('Deactivate Account'); ?></button>
                                        </div>
                                         
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/satoshi/partials/settings.blade.php ENDPATH**/ ?>