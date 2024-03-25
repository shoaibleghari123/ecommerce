

<?php $__env->startSection('page_title', 'Coupon'); ?>
<?php $__env->startSection('coupon_select', 'active'); ?>
<?php $__env->startSection('container'); ?>

<?php if(session()->has('message')): ?>
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    <?php echo e(session('message')); ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<?php endif; ?>

    <h1 class="mb10">Coupon</h1>
    <a href="coupon/manage_coupon">
        <button type="button" class="btn btn-success">Add Coupon</button>
    </a>
   <div class="row m-t-30">
    
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Title</th>
                        <th>Code</th>
                        <th>Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($list->id); ?></td>
                        <td><?php echo e($list->title); ?></td>
                        <td><?php echo e($list->code); ?></td>
                        <td><?php echo e($list->value); ?></td>

                        <?php if($list->status==0){
                            $status_id = 1;
                            $status_title = "Deactive";
                            $class = "warning";
                        }else{
                            $status_id = 0;
                            $status_title = "Active";
                            $class = "info";
                        }
                        ?>

                        <td>
                            <a href="<?php echo e(url('admin/coupon/status/')); ?>/<?php echo e($status_id); ?>/<?php echo e($list->id); ?>"><button type="button" class="btn btn-<?php echo e($class); ?>"><?php echo e($status_title); ?></button></a>
                        <a href="<?php echo e(url('admin/coupon/manage_coupon/')); ?>/<?php echo e($list->id); ?>"><button type="button" class="btn btn-success">Update</button></a>
                        <a href="<?php echo e(url('admin/coupon/delete/')); ?>/<?php echo e($list->id); ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                    </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>


   </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\development\ecom\resources\views/admin/coupon.blade.php ENDPATH**/ ?>