<?php use App\Models\Product; ?>


<?php $__env->startSection('title', 'Alina Luxury - Products'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('normalhead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="py-2">
        <div class=" px-4 px-lg-5 mt-5 row">
            <div class="col-8 my-3 ms-4"><h1 class="fw-bolder">Products</h1></div>
            <div class="col-3 my-3 ms-5"><h2>Filter by:</h2></div>
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center col-md-9">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <?php if($product->image != Product::$IMAGE_DEFAULT): ?>
                                <img class="card-img-top" src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" style="height: 200px; object-fit: cover;"  onerror="this.onerror=null; this.src='<?php echo e($product->image); ?>'"/>
                            <?php else: ?>
                                <img class="card-img-top" src="<?php echo e(Product::$IMAGE_DEFAULT); ?>" alt="<?php echo e($product->name); ?>" style="height: 200px; object-fit: cover;"/>
                            <?php endif; ?>

                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder"><?php echo e($product->name); ?></h5>
                                    <?php if($product->price_before && $product->price_before != 0): ?>
                                        <span style="color:red;">€<?php echo e($product->price); ?> </span> <del>€<?php echo e($product->price_before); ?></del>
                                    <?php else: ?>
                                        €<?php echo e($product->price); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="<?php echo e(route('products.show', $product->id)); ?>">See Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="col-3">
                <form
                    action="<?php echo e(route('products.index')); ?>"
                    class="d-none d-sm-inline-block form-inline ms-4 m-3 mw-100 navbar-search"
                    id="filter-form"
                    method="get">
                    <?php echo csrf_field(); ?>
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search your product..."
                               aria-label="search" id="search" name="search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                Search
                            </button>
                        </div>
                    </div>
                    <div class="col-12 mt-4 mb-2"><h5>Category:</h5></div>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($category->id != 1): ?>
                            <div class="form-check form-check-inline w-25 mx-4 my-2">
                                <input class="form-check-input" name="category" type="radio" id="<?php echo e($category->name); ?>" value="<?php echo e($category->id); ?>" <?php echo e(request()->has('category') && request()->get('category') == $category->id ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="<?php echo e($category->name); ?>"><?php echo e(ucwords(strtolower($category->name))); ?></label>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <button type="button" class="btn btn-primary col-12 mt-4" onclick="clearFilters()">Clear Filters</button>
                </form>
            </div>
                <div class="pagination-container d-flex justify-content-center mb-4" >
                    <?php echo e($products->links('pagination::bootstrap-4')); ?>

                </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/products/index.blade.php ENDPATH**/ ?>