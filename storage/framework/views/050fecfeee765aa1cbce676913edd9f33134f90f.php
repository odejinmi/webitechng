<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="card-body ">

                    <h6 class="card-title  mb-4">
                        <div class="row">
                            <div class="col-sm-8 col-md-6">
                                <?php echo $ticket->statusBadge; ?>
                                [<?php echo app('translator')->get('Ticket#'); ?><?php echo e($ticket->ticket); ?>] <?php echo e($ticket->subject); ?>

                            </div>
                            <div class="col-sm-4  col-md-6 text-sm-end mt-sm-0 mt-3">
                                <?php if($ticket->status != Status::TICKET_CLOSE): ?>
                                    <button class="btn btn-outline-danger btn-sm" type="button" data-bs-toggle="modal"
                                        data-bs-target="#DelModal">
                                        <i class="fa fa-lg fa-times-circle"></i> <?php echo app('translator')->get('Close Ticket'); ?>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </h6>
                    <form action="<?php echo e(route('admin.ticket.reply', $ticket->id)); ?>" enctype="multipart/form-data"
                        method="post" class="form-horizontal">
                        <?php echo csrf_field(); ?>


                        <div class="row ">

                            <div class="position-relative d-flex flex-grow-1 flex-column">
                                <div class="chat-box p-9" style="height: calc(100vh - 442px)" data-simplebar>
                                  <div class="chat-list chat active-chat" data-user-id="1">
                                    <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php if($message->admin_id == 0): ?>
                                    <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                                      <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $ticket->user->image, getFileSize('userProfile'))); ?>" alt="user8" width="40" height="40" class="rounded-circle" />
                                      <div>
                                        <h6 class="fs-2 text-muted"><?php echo e(diffForHumans($message->created_at)); ?></h6>
                                        <div class="p-2 bg-light rounded-1 d-inline-block text-dark fs-3"> <?php echo e($message->message); ?> </div>
                                        <?php if($message->attachments->count() > 0): ?>
                                        <div class="my-3">
                                            <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('admin.ticket.download', encrypt($image->id))); ?>"
                                                    class="me-2"><i class="fa fa-file"></i> <?php echo app('translator')->get('Attachment'); ?>
                                                    <?php echo e(++$k); ?> </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-outline-danger btn-sm my-3 confirmationBtn"
                                        data-question="<?php echo app('translator')->get('Are you sure to delete this message?'); ?>"
                                        data-action="<?php echo e(route('admin.ticket.delete', $message->id)); ?>"><i
                                            class="ti ti-trash"></i> <?php echo app('translator')->get('Delete'); ?></button>
                                      </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                                      <div class="text-end">
                                        <h6 class="fs-2 text-muted"><?php echo e(diffForHumans($message->created_at)); ?></h6>
                                        <div class="p-2 bg-light-info text-dark rounded-1 d-inline-block fs-3"> <?php echo e($message->message); ?></div>
                                        <?php if($message->attachments->count() > 0): ?>
                                        <div class="my-3">
                                            <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('admin.ticket.download', encrypt($image->id))); ?>"
                                                    class="me-2"><i class="fa fa-file"></i> <?php echo app('translator')->get('Attachment'); ?>
                                                    <?php echo e(++$k); ?> </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-outline-danger btn-sm my-3 confirmationBtn"
                                        data-question="<?php echo app('translator')->get('Are you sure to delete this message?'); ?>"
                                        data-action="<?php echo e(route('admin.ticket.delete', $message->id)); ?>"><i
                                            class="ti ti-trash"></i> <?php echo app('translator')->get('Delete'); ?></button>
                                      </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo emptyData(); ?>

                                    <?php endif; ?>
                                     
                                  </div> 
                                </div>
                                <div class="px-9 py-6 border-top chat-send-message-footer">
                                  <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-2 w-85">
                                      <a class="position-relative nav-icon-hover z-index-5" href="javascript:void(0)"> <i class="ti ti-mood-smile text-dark bg-hover-primary fs-7"></i></a>
                                      <input type="text" name="message" class="form-control message-type-box text-muted border-0 p-0 ms-2" placeholder="Type a Message" />
                                    </div>
                                    
                                    <ul class="list-unstyledn mb-0 d-flex align-items-center">
                                       <li><a class="extraTicketAttachment text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5 " href="javascript:void(0)"><i class="ti ti-paperclip"></i></a></li>
                                     </ul>
                                  </div>
                                  <br>
                                  <span class="text-danger"><?php echo app('translator')->get('Max 5 files can be uploaded. Maximum upload size is'); ?>
                                            <?php echo e(ini_get('upload_max_filesize')); ?></span>
                                  <div class="d-flex align-items-center gap-2 w-85 mb-2">
                                    <input type="file" name="attachments[]" id="inputAttachments" class="form-control file-upload-field" />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div id="fileUploadsContainer"></div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <button class="btn btn-outline-primary w-100 mt-4" type="submit" name="replayTicket"
                                            value="1"><i class="la la-fw la-lg la-reply"></i> <?php echo app('translator')->get('Reply'); ?>
                                        </button>
                                    </div>
                                </div>
                              </div> 

                              

                             
                        </div>

                    </form>


                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <?php echo app('translator')->get('Close Support Ticket!'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo app('translator')->get('Are you want to close this support ticket?'); ?></p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo e(route('admin.ticket.close', $ticket->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="replayTicket" value="2">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"> <?php echo app('translator')->get('No'); ?> </button>
                        <button type="submit" class="btn btn-outline-primary"> <?php echo app('translator')->get('Yes'); ?> </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.ticket.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.ticket.index')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function($) {
            $('.delete-message').on('click', function(e) {
                $('.message_id').val($(this).data('id'));
            })
            var fileAdded = 0;
            $('.extraTicketAttachment').on('click', function() {
                if (fileAdded >= 4) {
                    notify('error', 'You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;
                $("#fileUploadsContainer").append(`
                    <div class="row">
                        <div class="col-9 mb-3">
                            <div class="file-upload-wrapper" data-text="<?php echo app('translator')->get('Select your file!'); ?>"><input type="file" name="attachments[]" id="inputAttachments" class="form-control file-upload-field"/></div>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-ouline-danger extraTicketAttachmentDelete"><i class="ti ti-x ms-0"></i></button>
                        </div>
                    </div>
                `)
            });

            $(document).on('click', '.extraTicketAttachmentDelete', function() {
                fileAdded--;
                $(this).closest('.row').remove();
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/support/reply.blade.php ENDPATH**/ ?>