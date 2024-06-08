<?php use App\Models\Category; ?>



<?php $__env->startSection('title', 'Alina Luxury - Categories'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('normalhead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <h1 class="text-center mt-5" style="color: black; font-weight: bolder">Edit Category</h1>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <br/>
    <?php endif; ?>

    <div class="container-fluid py-5 mb-lg-5" >
        <div class="row">
            <div class="col-md-6 offset-md-3 ">
                <form action="<?php echo e(route('categories.update', $category->id)); ?>"  method="POST"   style="margin-bottom: 2cm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input class="form-control" id="name" name="name" type="text"  pattern="^(?!\s*$).+"  value="<?php echo e($category->name); ?>">
                    </div>
                    <div class="buttons-container d-flex justify-content-between mt-5">
                        <button class="btn btn-primary " type="submit">Submit</button>
                        <a class="btn btn-secondary mx-2" href="<?php echo e(route('categories.index')); ?>">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/categories/edit.blade.php ENDPATH**/ ?>