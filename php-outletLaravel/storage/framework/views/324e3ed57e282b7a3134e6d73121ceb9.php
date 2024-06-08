<?php use App\Models\Category; ?>



<?php $__env->startSection('title', 'Alina Luxury - Categories'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('normalhead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container mb-lg-5 mt-5">
        <h2>Our Categories</h2>
                <div class="row">
                        <div class="col-md-3">
                            <a class="btn btn-primary mb-lg-4 mt-4" href="<?php echo e(route('categories.create')); ?>">Create Category</a>
                        </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($category->id!=1): ?>
                                <td><img src="<?php echo e(asset('storage/' . $category->image)); ?>" style="width: 45px" onerror="this.onerror=null; this.src='<?php echo e($category->image); ?>'"></td>
                                    <td><?php echo e($category->name); ?></td>
                                <td><button><a class="btn btn-primary" href="<?php echo e(route('categories.edit', $category->id)); ?>">Edit</a></button>
                                    <button><a class="btn btn-secondary" href="<?php echo e(route('categories.editImage', $category->id)); ?>">EditImage</a></button>
                                    <form action="<?php echo e(route('categories.destroy', $category->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    <?php endif; ?>
                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="pagination-container">
                        <?php echo e($categories->links('pagination::bootstrap-4')); ?>

                    </div>
                </div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/categories/index.blade.php ENDPATH**/ ?>