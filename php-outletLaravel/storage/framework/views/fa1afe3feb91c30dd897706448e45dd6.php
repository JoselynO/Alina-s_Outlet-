<?php use App\Models\Product; ?>



<?php $__env->startSection('title', 'Alina Luxury - Gestion de Productos'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('normalhead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <h1 class="text-center mt-5 mb-3" style="color: black; font-weight: bolder">Create a Product</h1>
    <div class="container mt-3 mb-5" style=" text-align: center; ">
        <p><span style="color: black; font-weight: bolder">ID:</span> <?php echo e($product->id); ?></p>
        <p><span style="color: black; font-weight: bolder">Name:</span> <?php echo e($product->name); ?></p>
        <p>  <?php if($product->image != Product::$IMAGE_DEFAULT): ?>
                <img  src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>"  style="width: 250px"  onerror="this.onerror=null; this.src='<?php echo e($product->image); ?>'"/>
            <?php else: ?>
                <img  src="<?php echo e(Product::$IMAGE_DEFAULT); ?>" alt="<?php echo e($product->name); ?>"  style="width: 250px"/>
            <?php endif; ?></p>
        <form action="<?php echo e(route('products.updateImage', $product->id)); ?>" method="POST"  enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div  class="form-group" style=" text-align: center;">
                <label for="image">Select an Image for the Product</label>
                <input type="file" name="image" required class="form-control" style=" width: 15cm;margin: 0 auto; ">
                <div class="invalid-feedback"> Please select an Image valid</div>
            </div>
            <button type="submit" class="btn btn-primary">Update Image</button>
            <a class="btn btn-secondary mx-2" href="<?php echo e(route('products.index')); ?>">Back</a>

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
        </form>
    </div>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/products/image.blade.php ENDPATH**/ ?>