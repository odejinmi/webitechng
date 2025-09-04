<?php if($layout == 'frontend'): ?>
    <?php $__env->startSection('content'); ?>
    <?php elseif($layout == 'app'): ?>
    <?php $__env->startSection('panel'); ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body ">

                    <!--begin::Messenger-->
                    <div class="card w-100 border-0 rounded-0" id="kt_drawer_chat_messenger">
                        <!--begin::Card header-->
                        <div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
                            <!--begin::Title-->
                            <div class="card-title">
                                <!--begin::User-->
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <a href="#"
                                        class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">[<?php echo app('translator')->get('Ticket ID:'); ?>#<?php echo e($myTicket->ticket); ?>] </a>
                                        <?php echo e($myTicket->subject); ?>

                                    <!--begin::Info-->
                                    <div class="mb-0 lh-1">
                                        <?php echo $myTicket->statusBadge; ?>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Title-->

                                <!--begin::Menu-->
                                <?php if($myTicket->status != Status::TICKET_CLOSE && $myTicket->user): ?>
                                    <button data-question="<?php echo app('translator')->get('Are you sure to close this ticket?'); ?>" data-action="<?php echo e(route('ticket.close', $myTicket->id)); ?>" class="confirmationBtn btn btn-sm btn-icon btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ti ti-trash fs-2"></i>                </button>
                                <?php endif; ?>

                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body" id="kt_drawer_chat_messenger_body">
                            <!--begin::Messages-->
                            <div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true"
                                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                                data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer"
                                data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px">


                                <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if($message->admin_id == 1): ?>
                                <!--begin::Message(in)-->
                                <div class="d-flex justify-content-start mb-10 ">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column align-items-start">
                                        <!--begin::User-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Avatar-->
                                            <div class="symbol  symbol-35px symbol-circle "><img alt="Pic"
                                                    src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" /></div><!--end::Avatar-->
                                            <!--begin::Details-->
                                            <div class="ms-3">
                                                <a href="#"
                                                    class="fs-5 fw-bold text-gray-900 text-hover-primary me-1"><?php echo app('translator')->get('Admin'); ?></a>
                                                <span class="text-muted fs-7 mb-1"><?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?></span>
                                            </div>
                                            <!--end::Details-->

                                        </div>
                                        <!--end::User-->

                                        <!--begin::Text-->
                                        <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start"
                                            data-kt-element="message-text">
                                            <?php echo e($message->message); ?> </div>
                                        <!--end::Text-->
                                        <?php if($message->attachments->count() > 0): ?>
                                        <div class="my-3">
                                            <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('admin.ticket.download', encrypt($image->id))); ?>"
                                                    class="me-2"><i class="fa fa-file"></i> <?php echo app('translator')->get('Attachment'); ?>
                                                    <?php echo e(++$k); ?> </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Message(in)-->
                                <?php else: ?>
                                <!--begin::Message(out)-->
                                <div class="d-flex justify-content-end mb-10 ">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column align-items-end">
                                        <!--begin::User-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Details-->
                                            <div class="me-3">
                                                <span class="text-muted fs-7 mb-1"><?php echo e(diffForHumans($message->created_at)); ?></span>
                                            </div>
                                            <!--end::Details-->

                                            <!--begin::Avatar-->
                                            <div class="symbol  symbol-35px symbol-circle "><img alt="Pic"
                                                    src="<?php echo e(getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile'))); ?>" /></div><!--end::Avatar-->
                                        </div>
                                        <!--end::User-->

                                        <!--begin::Text-->
                                        <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end"
                                            data-kt-element="message-text">
                                            <?php echo e($message->message); ?> </div>
                                        <!--end::Text-->
                                        <?php if($message->attachments->count() > 0): ?>
                                        <div class="my-3">
                                            <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('ticket.download', encrypt($image->id))); ?>"
                                                    class="me-2"><i class="fa fa-file"></i> <?php echo app('translator')->get('Attachment'); ?>
                                                    <?php echo e(++$k); ?> </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Message(out)-->
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php echo emptyData(); ?>

                                <?php endif; ?>

                                <!--begin::Message(in)-->

                            </div>
                            <!--end::Messages-->
                            <?php if($myTicket->status != Status::TICKET_CLOSE && $myTicket->user): ?>
                            <form method="post" action="<?php echo e(route('ticket.reply', $myTicket->id)); ?>"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                            <!--begin::Card footer-->
                            <div class="card-footer pt-4" id="kt_drawer_chat_messenger_footer">
                                <!--begin::Input-->
                                <textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input"  name="message" placeholder="Type a message">

                                </textarea>
                                <!--end::Input-->

                                <div class="col-12 mb-2">
                                    <div id="fileUploadsContainer"></div>
                                </div>
                                <!--begin:Toolbar-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center me-2">
                                        <button class="addFile btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Upload File">
                                            <i class="ti ti-upload fs-3"></i>
                                        </button>

                                    </div>
                                    <!--end::Actions-->

                                    <!--begin::Send-->
                                    <button class="btn btn-primary"  type="submit" name="replayTicket" value="1" data-kt-element="send"><?php echo app('translator')->get('Send'); ?></button>
                                    <!--end::Send-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Card footer-->
                            </form>
                            <?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b = $component; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ConfirmationModal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b)): ?>
<?php $component = $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b; ?>
<?php unset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b); ?>
<?php endif; ?>
                        <?php $__env->stopSection(); ?>

                        <?php $__env->startPush('script'); ?>
                            <script>
                                (function($) {
                                    "use strict";
                                    var fileAdded = 0;
                                    $('.addFile').on('click', function() {
                                        if (fileAdded >= 4) {
                                            notify('error', 'You\'ve added maximum number of file');
                                            return false;
                                        }
                                        fileAdded++;
                                        $("#fileUploadsContainer").append(`
                    <div class="input-group flex-nowrap my-3">
                        <input type="file" name="attachments[]" class="<?php echo e(auth()->user() ? 'form-control form--control' : 'form--control'); ?>" required />
                        <button type="submit" class="input-group-text btn btn--danger remove-btn"><i class="ti ti-trash"></i></button>
                    </div>
                `)
                                    });
                                    $(document).on('click', '.remove-btn', function() {
                                        fileAdded--;
                                        $(this).closest('.input-group').remove();
                                    });
                                })(jQuery);
                            </script>
                        <?php $__env->stopPush(); ?>

                        <?php $__env->startPush('style'); ?>
                            <style>
                                .card-body-color {
                                    background-color: #f7f7f7 !important;

                                }
                            </style>
                        <?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/support/view.blade.php ENDPATH**/ ?>