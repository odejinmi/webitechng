<?php if($layout == 'frontend'): ?>
    <?php $__env->startSection('content'); ?>
    <?php elseif($layout == 'app'): ?>
    <?php $__env->startSection('panel'); ?>
    <?php endif; ?>
    <br>
    <section class="crancy-adashboard crancy-show">
        <div class="container container__bscreen">
            <div class="row row__bscreen">
                <div class="col-12">
                    <div class="crancy-body">
                        <!-- Dashboard Inner -->
                        <div class="crancy-dsinner">
                            <div class="crancy-chatbox">
                                <div class="row g-0">


                                    <div class="col-lg-12 col-md-12 col-12 crancy-chatsbox__two">
                                        <div class="crancy-chatbox__explore">
                                            <div class="crancy-chatbox__explore-head">
                                                <div class="crancy-chatbox__author">

                                                    <div class="crancy-chatbox__heading">
                                                        <h4 class="crancy-chatbox__heading--title">
                                                            [<?php echo app('translator')->get('Ticket ID:'); ?>#<?php echo e($myTicket->ticket); ?>]
                                                        </h4>
                                                        <p class="crancy-chatbox__heading--text">
                                                            <?php echo $myTicket->statusBadge; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="crancy-chatbox__toggle">
                                                    <?php if($myTicket->status != Status::TICKET_CLOSE && $myTicket->user): ?>
                                                        <a href="<?php echo e(route('ticket.close', $myTicket->id)); ?>"><img
                                                                src="<?php echo e(asset( $activeTemplateTrue . 'dashboard/img/close-icon.svg')); ?>" /></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="crancy-chatbox__explore-body">
                                                <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <!-- Incomming List -->
                                                    <?php if($message->admin_id == 1): ?>
                                                        <div class="crancy-chatbox__incoming">
                                                            <ul class="crancy-chatbox__incoming-list">

                                                                <!-- Single Incoming -->
                                                                <li>
                                                                    <div class="crancy-chatbox__chat">

                                                                        <div class="crancy-chatbox__main-content">
                                                                            <div class="crancy-chatbox__incoming-chat">
                                                                                <p class="crancy-chatbox__incoming-text">
                                                                                    <?php echo e($message->message); ?>

                                                                                </p>
                                                                            </div>
                                                                            <p
                                                                                class="crancy-chatbox__time crancy-chatbox__time-two">
                                                                                <?php echo e(diffForHumans($message->created_at)); ?>

                                                                            </p>
                                                                        </div>
                                                                        <?php if($message->attachments->count() > 0): ?>
                                                                            <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div
                                                                                    class="crancy-chatbox__incoming-chat crancy-chatbox__incoming-chat__file">
                                                                                    <p
                                                                                        class="crancy-chatbox__incoming-text">
                                                                                        <a href="<?php echo e(route('admin.ticket.download', encrypt($image->id))); ?>"
                                                                                            class="text-white crancy-flex-between">Download
                                                                                            <i
                                                                                                class="fas fa-download"></i></a>
                                                                                    </p>
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </li>
                                                                <!-- End Single Incoming -->
                                                            </ul>
                                                        </div>
                                                        <!-- End Incomming List -->
                                                    <?php else: ?>
                                                        <!-- Outgoing List -->
                                                        <div class="crancy-chatbox__incoming crancy-chatbox__outgoing">
                                                            <ul class="crancy-chatbox__incoming-list">
                                                                <!-- Single Incoming -->
                                                                <li>
                                                                    <div class="crancy-chatbox__chat">
                                                                        <div class="crancy-chatbox__main-content">
                                                                            <div class="crancy-chatbox__incoming-chat">
                                                                                <p class="crancy-chatbox__incoming-text">
                                                                                    <?php echo e($message->message); ?>

                                                                                </p>
                                                                            </div>
                                                                            <?php if($message->attachments->count() > 0): ?>
                                                                                <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <div
                                                                                        class="crancy-chatbox__incoming-chat crancy-chatbox__incoming-chat__file">
                                                                                        <p
                                                                                            class="crancy-chatbox__incoming-text">
                                                                                            <a href="<?php echo e(route('admin.ticket.download', encrypt($image->id))); ?>"
                                                                                                class="text-white crancy-flex-between">Download
                                                                                                <i
                                                                                                    class="fas fa-download"></i></a>
                                                                                        </p>
                                                                                    </div>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php endif; ?>
                                                                            <p
                                                                                class="crancy-chatbox__time crancy-chatbox__time-two">
                                                                                <?php echo e(diffForHumans($message->created_at)); ?>

                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <!-- End Single Incoming -->
                                                            </ul>
                                                        </div>
                                                        <!-- End Outgoing List -->
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <?php echo emptyData(); ?>

                                                <?php endif; ?>

                                                <?php if($myTicket->status != Status::TICKET_CLOSE && $myTicket->user): ?>
                                                    <!-- New Message -->
                                                    <div class="crancy-chatbox__new-message">
                                                        <div class="crancy-chatbox__form">
                                                            <form method="post" class="crancy-chatbox__form-inner"
                                                                action="<?php echo e(route('ticket.reply', $myTicket->id)); ?>"
                                                                enctype="multipart/form-data">
                                                                <?php echo csrf_field(); ?>
                                                                <textarea name="message" class="form-control" value="" type="text" placeholder="Type a message..."></textarea>
                                                                <div class="crancy-chatbox__button">
                                                                    <div class="crancy-chatbox__button-inline">

                                                                        <div
                                                                            class="crancy-chatbox__button-inline__single crancy-chatbox__button-inline__link">
                                                                            <a href="#"><img
                                                                                    src="<?php echo e(asset( $activeTemplateTrue . 'dashboard/img/photo-icon.svg')); ?>" /></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="crancy-chatbox__submit">
                                                                        <button class="btn btn-primary"
                                                                            type="submit">
                                                                            <img
                                                                                src="<?php echo e(asset( $activeTemplateTrue . 'dashboard/img/send-icon.svg')); ?>" />Send
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <!-- End New Message -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Dashboard Inner -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End crancy Dashboard -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/satoshi/user/support/view.blade.php ENDPATH**/ ?>