<?php use App\Models\Product; ?>



<?php $__env->startSection('title', 'Alina Luxury - Create Product'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('normalhead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <h1 class="text-center mt-5" style="color: black; font-weight: bolder">Create a Product</h1>
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

                <div class="container-fluid py-5 md-5" >
                    <div class="row">
                        <div class="col-md-6 offset-md-3 ">
                            <form action="<?php echo e(route('products.store')); ?>"  method="POST"  id="create" style="margin-bottom: 2cm">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input class="form-control" id="name" name="name" type="text"  pattern="^(?!\s*$).+" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" id="description" name="description" type="text" rows="10" cols="50" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input class="form-control" id="price" name="price" type="number" required
                                           min="1.0" step="0.01"  value="0">
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock:</label>
                                    <input class="form-control" id="stock" name="stock" type="number" required
                                           min="1" value="0">
                                </div>

                                <div class="form-group">
                                    <label for="sex">Sex:</label>
                                    <select class="form-control" id="sex" name="sex" required>
                                        <option value="">Select a sex</option>
                                        <option value="unisex">unisex</option>
                                        <option value="woman">woman</option>
                                        <option value="man">man</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="category">Category:</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="">Select a category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="buttons-container d-flex justify-content-between mt-5">
                                    <button class="btn btn-primary " type="submit">Create</button>
                                    <a class="btn btn-secondary mx-2" href="<?php echo e(route('products.index')); ?>">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/products/create.blade.php ENDPATH**/ ?>