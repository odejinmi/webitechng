<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <form action="<?php echo e(route('admin.plans.loan.save', $plan->id ?? 0)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card b-radius--10 mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Plan Name'); ?></label>
                                    <input class="form-control" name="name" type="text" value="<?php echo e(@$plan->name); ?>" required />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Minimum Amount'); ?></label>
                                    <div class="input-group">
                                        <?php $minAmount = isset($plan) ? getAmount($plan->minimum_amount) : null; ?>
                                        <input class="form-control" name="minimum_amount" type="number" value="<?php echo e(old('number', $minAmount)); ?>" step="any" required />
                                        <span class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Maximum Amount'); ?></label>
                                    <div class="input-group">
                                        <?php $maxAmount = isset($plan) ? getAmount($plan->maximum_amount) : null; ?>
                                        <input class="form-control" name="maximum_amount" type="number" value="<?php echo e(old('number', $maxAmount)); ?>" step="any" required />
                                        <span class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Per Installment'); ?></label>
                                    <div class="input-group">
                                        <?php $perInstallment = isset($plan) ? getAmount($plan->per_installment) : null; ?>
                                        <input class="form-control" name="per_installment" type="number" value="<?php echo e(old('per_installment', $perInstallment)); ?>" step="any" required />
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Installment Interval'); ?></label>
                                    <div class="input-group">
                                        <?php $installmentInterval = isset($plan) ? getAmount($plan->installment_interval) : null; ?>
                                        <input class="form-control" name="installment_interval" type="number" value="<?php echo e(old('installment_interval', $installmentInterval)); ?>" required />
                                        <span class="input-group-text"><?php echo app('translator')->get('Days'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Total Installments'); ?></label>
                                    <div class="input-group">
                                        <?php $totalInstallment = isset($plan) ? getAmount($plan->total_installment) : null; ?>
                                        <input class="form-control" name="total_installment" type="number" value="<?php echo e(old('total_installment', $totalInstallment)); ?>" required />
                                        <span class="input-group-text"><?php echo app('translator')->get('Times'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Admin\'s Profit'); ?></label>
                                    <div class="input-group">
                                        <?php $installmentInterval = isset($plan) ? getAmount($plan->installment_interval) : null; ?>
                                        <input class="form-control admins_profit" type="number" disabled />
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label><?php echo app('translator')->get('Instruction'); ?></label>
                                <div class="form-group">
                                    <textarea class="form-control border-radius-5 nicEdit" name="instruction" rows="8"><?php echo @$plan->instruction ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card b-radius--10 mb-3">
                    <div class="card-header">
                        <h5 class="card-title text-center">
                            <?php echo app('translator')->get('Installment Delay Charge'); ?> <i class="fa fa-info-circle text--primary" title="<?php echo app('translator')->get('This charge will be apply for each delayed installment. The user needs to pay the charge with the installment amount.'); ?>"></i>
                        </h5>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label><?php echo app('translator')->get('Charge Will Apply If Delay'); ?></label>
                                <div class="input-group">
                                    <input class="form-control" name="delay_value" type="number" value="<?php echo e(old('delay_value', @$plan->delay_value)); ?>" required>
                                    <span class="input-group-text"><?php echo app('translator')->get('Day'); ?></span>
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label><?php echo app('translator')->get('Fixed Charge'); ?></label>
                                <div class="input-group">
                                    <input class="form-control" name="fixed_charge" type="number" value="<?php echo e(old('fixed_charge', @$plan->fixed_charge)); ?>" step="any" required>
                                    <span class="input-group-text"><?php echo app('translator')->get($general->cur_text); ?></span>
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label><?php echo app('translator')->get('Percent Charge'); ?></label>
                                <div class="input-group">
                                    <input class="form-control" name="percent_charge" type="number" value="<?php echo e(old('percent_charge', @$plan->percent_charge)); ?>" step="any" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.viser-form-data','data' => ['title' => 'Loan Application Form Fields','form' => @$form]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('viser-form-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Loan Application Form Fields','form' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(@$form)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                </div>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.plans.loan.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <button class="btn btn-primary w-100 h-45 mt-3" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                <?php endif ?>
            </form>
        </div><!-- card end -->
    </div>
    <?php if (isset($component)) { $__componentOriginalc2e85c5a6f46a6358a3b68e5bf9789587ca94cfe = $component; } ?>
<?php $component = App\View\Components\FormGenerator::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form-generator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\FormGenerator::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2e85c5a6f46a6358a3b68e5bf9789587ca94cfe)): ?>
<?php $component = $__componentOriginalc2e85c5a6f46a6358a3b68e5bf9789587ca94cfe; ?>
<?php unset($__componentOriginalc2e85c5a6f46a6358a3b68e5bf9789587ca94cfe); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $hasPermission = App\Models\Role::hasPermission('admin.plans.loan.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.plans.loan.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.plans.loan.index')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php $__env->stopPush(); ?>
<?php endif ?>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function($) {
            $('[name=per_installment], [name=total_installment]').on('input ', (e) => displayProfit());

            function displayProfit() {
                let totalInstallment = parseFloat($('[name=total_installment]').val());
                let perInstallment = parseFloat($('[name=per_installment]').val());
                let profit = (totalInstallment * perInstallment).toFixed(2);
                profit -= 100;
                $('.admins_profit').val(profit);
                if (profit <= 0) {
                    $('.admins_profit').css('border-color', 'red');
                    $('.admins_profit').siblings('.input-group-text').css('border-color', 'red');
                } else {
                    $('.admins_profit').removeAttr('style');
                    $('.admins_profit').siblings('.input-group-text').removeAttr('style');
                }
            }
            displayProfit();
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/plans/loan/form.blade.php ENDPATH**/ ?>