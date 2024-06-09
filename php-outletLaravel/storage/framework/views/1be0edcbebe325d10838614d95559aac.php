<?php use App\Models\Product; ?>


<?php $__env->startSection('title', 'Alina Luxury -Gestion Products'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('normalhead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="container">
            <h2>Our Products</h2>
            <div class="row">
                <div class="col-md-3">
                    <a class="btn btn-primary" href="<?php echo e(route('products.create')); ?>">Create a Product</a>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Price before</th>
                        <th>Stock</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                                <td>
                                    <?php if($product->image != Product::$IMAGE_DEFAULT): ?>
                                        <img  src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>"  style="width: 90px"  onerror="this.onerror=null; this.src='<?php echo e($product->image); ?>'"/>
                                    <?php else: ?>
                                        <img  src="<?php echo e(Product::$IMAGE_DEFAULT); ?>" alt="<?php echo e($product->name); ?>"  style="width: 90px"/>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($product->name); ?></td>
                                <td>€<?php echo e($product->price); ?></td>
                                <td><?php if($product->price_before && $product->price_before > 0): ?> €<?php echo e($product->price_before); ?> <?php else: ?> <p style="text-align: center">-</p> <?php endif; ?></td>
                                <td><?php echo e($product->stock); ?></td>
                                <td><div class="btn-group" role="group" >
                                        <a class="btn btn-primary" href="<?php echo e(route('products.edit', $product->id)); ?>">Edit</a>
                                    <a class="btn btn-secondary" href="<?php echo e(route('products.editImage', $product->id)); ?>">EditImage</a>
                                    <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    </div>
                                </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="pagination-container">
                    <?php echo e($products->links('pagination::bootstrap-4')); ?>

                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/products/gestion.blade.php ENDPATH**/ ?>