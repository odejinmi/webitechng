<?php $__env->startSection('panel'); ?>
    <div class="container-sfluid">
        <!-- --------------------------------------------------- -->
        <!--  Form Basic Start -->
        <!-- --------------------------------------------------- -->

        <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
                <h5 class="card-title fw-semibold mb-0 lh-sm"><?php echo app('translator')->get('Current Settings'); ?></h5>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive rounded-2 mb-4">
                    <table class="table border text-nowrap customize-table mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Name</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Amount</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Date Created</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $trans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <h6 class="fs-4 fw-semibold mb-0">LEVEL# <?php echo e($p->level); ?> </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal fs-4"><?php echo e($p->percent); ?> <?php if($general->commission_type): ?> <?php echo e($general->cur_text); ?> <?php else: ?> % <?php endif; ?></p>
                                    </td>

                                    <td>
                                        <span class="badge bg-light-success text-success fw-semibold fs-2">Active</span>
                                    </td>
                                    <td>
                                        <h6 class="fs-4 fw-semibold mb-0"><?php echo e($p->created_at); ?></h6>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php echo emptyData(); ?>

                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="casrd">
        <div class="card-header">
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                        class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                        class="fe fe-maximize"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-xl-12 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0">
                        <div class="card-header">
                            <h4 class="card-title">Active Referral Features</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.store.feature')); ?>" class="form-horizontal" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-row">

                                    
                                    <div class="form-group col-12">
                                        <div  class="alert customize-alert alert-dismissible text-primary border border-danger fade show remove-close-icon"  role="alert" >
                                         <div class="d-flsex align-items-center font-medium me-3 me-md-0" >
                                            <i class="ti ti-info-circle fs-5 me-2 flex-shrink-0 text-primary"></i>
                                            <?php echo app('translator')->get('Toggle <b class="text-danger">&nbsp; OFF &nbsp;</b> switch to enable percentage commmision earning and toggle <b class="text-success">&nbsp; ON &nbsp;</b> to enable flat commision earning. <br><b &nbsp;> Please note this feature is applicable to deposit only</b>'); ?>
                                        </div>
                                        <hr>
                                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Deposit Commission'); ?></label>
                                        <div class="form-check form-switch form-check-success">
                                            <input type="checkbox" class="form-check-input" name="deposit_commission"
                                                <?php if($general->deposit_commission): ?> checked <?php endif; ?> id="customSwitch5" />
                                            <label class="form-check-label" for="customSwitch5">
                                                <span class="switch-icon-left"><i data-feather="plus"></i></span>
                                                <span class="switch-icon-right"><i data-feather="x"></i></span>
                                            </label>
                                        </div>
                                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Deposit Commission Type'); ?> <b class="text-primary">( <?php if($general->commission_type): ?> Flat Rate <?php else: ?> Pecentage <?php endif; ?> )</b></label>
                                        <div class="form-check form-switch form-check-success">
                                            <input type="checkbox" class="form-check-input" name="commission_type"
                                                <?php if($general->commission_type): ?> checked <?php endif; ?> id="commission_type" />
                                            <label class="form-check-label" for="commission_type">
                                                <span class="switch-icon-left"><i data-feather="plus"></i></span>
                                                <span class="switch-icon-right"><i data-feather="x"></i></span>
                                            </label>
                                        </div>
                                        
                                        </div>

                                        
                                    </div>
                                    <hr> 
                                    <div class="form-group col-12">
                                        <div  class="alert customize-alert alert-dismissible text-primary border border-primary fade show remove-close-icon"  role="alert" >
                                        
                                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Registration Commission'); ?></label>
                                        <div class="form-check form-switch form-check-primary">
                                            <input type="checkbox" class="form-check-input" name="reg_commission"
                                                <?php if($general->reg_commission): ?> checked <?php endif; ?> id="customSwitch6" />
                                            <label class="form-check-label" for="customSwitch6">
                                                <span class="switch-icon-left"><i data-feather="plus"></i></span>
                                                <span class="switch-icon-right"><i data-feather="x"></i></span>
                                            </label>
                                        </div>
                                        <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('New Order Commission'); ?></label>
                                        <div class="form-check form-switch form-check-primary">
                                            <input type="checkbox" class="form-check-input" name="task_commission"
                                                <?php if($general->task_commission): ?> checked <?php endif; ?> id="task_commission" />
                                            <label class="form-check-label" for="task_commission">
                                                <span class="switch-icon-left"><i data-feather="plus"></i></span>
                                                <span class="switch-icon-right"><i data-feather="x"></i></span>
                                            </label>
                                        </div>
                                        
                                        </div>

                                        
                                    </div>
 
                                    
                                    
                                    </div>
                                <br>
                                <div class="form-group row">
                                    <div class="form-group col">
                                        <button type="submit" class="btn btn-block btn-primary mr-2"><?php echo app('translator')->get('Submit'); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0 mb-0">
                        <?php if($general->ref == 1): ?>
                            <div class="card-header">
                                <h4 class="card-title">Referral Level</h4>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">

                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label for="inputName1" class="col-md-3 col-form-label">Enter Referral Level</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="number" name="level" id="levelGenerate"
                                            placeholder="Levels">
                                    </div>
                                </div>

                                <div class="form-group mb-0 mt-3 row justify-content-end">
                                    <div class="col-md-9">
                                        <button type="button" style="background-color: <?php echo e($general->bclr); ?>"
                                            id="generate" class="btn btn-primary">Generate</button>
                                    </div>
                                </div>
                            </form>



                            <form action="<?php echo e(route('admin.store.refer')); ?>" id="prantoForm"
                                <?php if($general->ref == 1): ?> style="display: none" <?php endif; ?> method="post">
                                <?php echo e(csrf_field()); ?>


                                <div class="form-group">
                                    <label class="text-success"> Referral Earning : <small></small> </label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="description"
                                                style="width: 100%;border: 1px solid #ddd;padding: 10px;border-radius: 5px">
                                                <div class="row">
                                                    <div class="col-md-12" id="planDescriptionContainer">
                                                        <?php if($general->ref != 1): ?>
                                                            <div class="input-group" style="margin-top: 5px">
                                                                <input name="level[]" hidden
                                                                    class="form-control margin-top-10" type="number"
                                                                    readonly value="1" required placeholder="Level">
                                                                <input name="percent[]" class="form-control margin-top-10"
                                                                    type="text" required
                                                                    placeholder="Enter Referral Earning">
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- row closed -->


    </div>
    </div>
    <!-- App-content closed -->
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        var max = 1;
        $(document).ready(function() {
            $("#generate").on('click', function() {

                var da = $('#levelGenerate').val();
                var a = 0;
                var val = 1;
                var lev = 1;
                var guu = '';
                if (da !== '' && da > 0) {
                    $('#prantoForm').css('display', 'block');

                    for (a; a < parseInt(da); a++) {

                        console.log()

                        guu += '<div class="input-group" style="margin-top: 5px">\n' +
                            '<input name="level[]" hidden class="form-control margin-top-10" type="number" readonly value="' +
                            val++ + '" required placeholder="Level">\n' +
                            '<input name="percent[]" class="form-control margin-top-10" type="text" required placeholder="Enter Referral Earning For Level ' +
                            lev++ + '">\n' +
                            '<span class="input-group-btn">\n' +
                            '<button class="btn btn-outline-danger margin-top-10 delete_desc" type="button"><i class="ti ti-x"></i></button></span>\n' +
                            '</div><br>'
                    }
                    $('#planDescriptionContainer').html(guu);

                } else {
                    alert('Level Field Is Required')
                }

            });

            $(document).on('click', '.delete_desc', function() {
                $(this).closest('.input-group').remove();
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/refer.blade.php ENDPATH**/ ?>