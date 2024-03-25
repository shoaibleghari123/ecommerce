

<?php $__env->startSection('page_title', 'Manage Tax'); ?>
<?php $__env->startSection('tax_select', 'active'); ?>
<style>

    .error_message{
        color: #df0f24;

    }

    .success_message{
        color: #044919;

    }
</style>

<?php $__env->startSection('container'); ?>


<h1 class="mb10">Tax</h1>
    <a href="<?php echo e(url('admin/tax')); ?>">
        <button type="button" class="btn btn-success">Back</button>
    </a>

<div class="row m-t-30">
    <div class="col-md-12">

                <div class="card">
                
                    <div class="card-body">
                       
                    
                        <form action="<?php echo e(route('tax.manage_tax_process')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="tax_id" value="<?php echo e($tax_id); ?>">
                            <div class="form-group">
                                <label for="tax_desc" class="control-label mb-1"> Tax Description</label>
                                <input id="tax_desc" name="tax_desc" type="text" class="form-control" value="<?php echo e($tax_desc); ?>" placeholder="tax desc" required>
                                <?php $__errorArgs = ['tax_desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <li class='error_message'><?php echo e($message); ?>

                                </li>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>    
                            
                            
                            <div class="form-group">
                                <label for="tax_value" class="control-label mb-1"> Tax Value</label>
                                <input id="tax_value" name="tax_value" type="text" class="form-control" value="<?php echo e($tax_value); ?>" placeholder="tax value" required>
                                <?php $__errorArgs = ['tax_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <li class='error_message'><?php echo e($message); ?>

                                </li>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>  

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                   Submit
                                </button>
                            </div>
                        </form>
                    </div>
              
    </div>

        
    </div>
</div>

<?php $__env->stopSection(); ?> 
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\development\ecom\resources\views/admin/manage_tax.blade.php ENDPATH**/ ?>