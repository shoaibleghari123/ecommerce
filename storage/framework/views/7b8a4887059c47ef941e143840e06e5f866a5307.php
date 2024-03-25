

<?php $__env->startSection('page_title', 'Size'); ?>
<?php $__env->startSection('size_select', 'active'); ?>
<?php $__env->startSection('container'); ?>

<?php if(session()->has('message')): ?>
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    <?php echo e(session('message')); ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<?php endif; ?>


    <h1 class="mb10">Size</h1>
    <a href="size/manage_size">
        <button type="button" class="btn btn-success">Add Size</button>
    </a>
   <div class="row m-t-30">
    
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Size</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($list->id); ?></td>
                        <td><?php echo e($list->size); ?></td>

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
                            <a href="<?php echo e(url('admin/size/status/')); ?>/<?php echo e($status_id); ?>/<?php echo e($list->id); ?>"><button type="button" class="btn btn-<?php echo e($class); ?>"><?php echo e($status_title); ?></button></a>
                        <a href="<?php echo e(url('admin/size/manage_size/')); ?>/<?php echo e($list->id); ?>"><button type="button" class="btn btn-success">Edit</button></a>
                        <a href="<?php echo e(url('admin/size/delete/')); ?>/<?php echo e($list->id); ?>"><button type="button" class="btn btn-danger">Delete</button></a>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\development\ecom\resources\views/admin/size.blade.php ENDPATH**/ ?>