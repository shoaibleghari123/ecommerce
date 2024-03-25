

<?php $__env->startSection('page_title', 'Home Banner'); ?>
<?php $__env->startSection('banner_select', 'active'); ?>
<?php $__env->startSection('container'); ?>


<?php if(session()->has('message')): ?>
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    <?php echo e(session('message')); ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<?php endif; ?>

    <h1>Banner</h1>
    <a href="banner/manage_banner">
        <button type="button" class="btn btn-success">Add Banner</button>
    </a>
   <div class="row m-t-30">
    
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Image</th>
                        <th>Text Button</th>
                        <th>Text Link</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $home_banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($list->id); ?></td>
                        <td><?php echo e($list->image); ?></td>
                        <td><?php echo e($list->btn_txt); ?></td>
                        <td><?php echo e($list->btn_link); ?></td>
                        <td>
                            <a href="<?php echo e(asset('storage/media/banner/'.$list->image)); ?>" target="_blank"><img style="width: 100px" src="<?php echo e(asset('storage/media/banner/'.$list->image)); ?>" /></a>
                        </td>
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
                        <a href="<?php echo e(url('admin/banner/status/')); ?>/<?php echo e($status_id); ?>/<?php echo e($list->id); ?>"><button type="button" class="btn btn-<?php echo e($class); ?>"><?php echo e($status_title); ?></button></a>
                        <a href="<?php echo e(url('admin/banner/manage_banner/')); ?>/<?php echo e($list->id); ?>"><button type="button" class="btn btn-success">Edit</button></a>
                        <a href="<?php echo e(url('admin/banner/delete/')); ?>/<?php echo e($list->id); ?>"><button type="button" class="btn btn-danger">Delete</button></a>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\development\ecom\resources\views/admin/home_banner.blade.php ENDPATH**/ ?>