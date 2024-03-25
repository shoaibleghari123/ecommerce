
<?php $__env->startSection('page_title', 'Manage Category'); ?>
<?php $__env->startSection('category_select', 'active'); ?>
<style>
   .error_message{
   color: #df0f24;
   }
   .success_message{
   color: #044919;
   }
</style>
<?php $__env->startSection('container'); ?>
<h1 class="mb10">Category</h1>
<a href="<?php echo e(url('admin/category')); ?>">
<button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            
            <form action="<?php echo e(route('category.manage_category_process')); ?>" method="post" enctype="multipart/form-data">
               <?php echo csrf_field(); ?>
               <input type="hidden" name="category_id" value="<?php echo e($category_id); ?>">


               <div class="row">

               <div class="col-md-4">
                  <div class="form-group">
                     <label for="category_name" class="control-label mb-1">Category Name</label>
                     <input id="category_name" name="category_name" type="text" class="form-control" value="<?php echo e($category_name); ?>" placeholder="Category Name" required>
                     <?php $__errorArgs = ['category_name'];
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
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label for="parent_category_id" class="control-label mb-1">Parent Category Name</label>
                     <select name="parent_category_id" id="parent_category_id" class="form-control">
                        <option value="0">Select Category</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($cat->id==$parent_category_id): ?>
                        <option selected value="<?php echo e($cat->id); ?>">
                           <?php else: ?>
                        <option value="<?php echo e($cat->id); ?>">
                           <?php endif; ?>
                           <?php echo e($cat->category_name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
   
                     <?php $__errorArgs = ['parent_category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                       <li class='error_message'><?php echo e($message); ?></li>
                     <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
   
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="category_slug" class="control-label mb-1">Category Slug</label>
                     <input id="category_slug" name="category_slug" type="text" class="form-control" value="<?php echo e($category_slug); ?>" placeholder="Category Slug" required>
                     <?php $__errorArgs = ['category_slug'];
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
               </div>

            </div>




               <div class="form-group">
                  <label for="category_image" class="control-label mb-1">Category Image</label>
                  <input id="category_image" name="category_image" type="file" class="form-control" value="<?php echo e($category_image); ?>" placeholder="Category Image">
                  
                  <?php if($category_image !=''): ?>
                  <a href="<?php echo e(asset('storage/media/category/'.$category_image)); ?>" target="_blank"><img src="<?php echo e(asset('storage/media/category/'.$category_image)); ?>" alt=""></a>
                  
                  <?php endif; ?>
                  <?php $__errorArgs = ['category_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <li class='error_message'><?php echo e($message); ?></li>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

               </div>


               <div class="form-group">
                  <label for="show_in_home_page" class="control-label mb-1">Show in Home Page</label>
                  <input type="checkbox" id="is_home" name="is_home" <?php echo e($is_home_selected); ?>>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\development\ecom\resources\views/admin/manage_category.blade.php ENDPATH**/ ?>