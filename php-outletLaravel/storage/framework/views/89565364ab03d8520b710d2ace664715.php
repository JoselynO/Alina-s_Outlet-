<?php use App\Models\Product; ?>


<?php $__env->startSection('title', 'Alina Luxury - Product Details'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('normalhead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section id="product_<?php echo e($product->id); ?>" class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <?php if($product->image != Product::$IMAGE_DEFAULT): ?>
                        <img class="card-img-top mb-5 mb-md-0" src="<?php echo e(asset('storage/' . $product->image)); ?>"
                             alt="<?php echo e($product->name); ?>" style="height: 400px; object-fit: cover;" onerror="this.onerror=null; this.src='<?php echo e($product->image); ?>'"/>
                    <?php else: ?>
                        <img class="card-img-top mb-5 mb-md-0" src="<?php echo e(Product::$IMAGE_DEFAULT); ?>"
                             alt="<?php echo e($product->name); ?>" style="height: 400px; object-fit: cover;" />
                    <?php endif; ?>

                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder"><?php echo e($product->name); ?></h1>
                    <div class="fs-5 mb-4">
                        <span style="background-color: rgba(234,202,121,0.9); color: #fff; padding: 5px 10px; border-radius: 5px;"><?php echo e(ucfirst($product->sex)); ?></span>
                    </div>
                    <div class="fs-5 mb-3">
                        <?php if($product->price_before && $product->price_before > 0): ?><span style="color: red">€<?php echo e($product->price); ?></span> <del>€<?php echo e($product->price_before); ?></del><?php else: ?> <span>€<?php echo e($product->price); ?></span> <?php endif; ?>
                    </div>

                    <p class="lead"><?php echo e($product->description); ?></p>
                    <form method="post" action="<?php echo e(route('addToCart', $product->id)); ?>" id="formCart">
                        <?php echo csrf_field(); ?>
                        <div class="d-flex">
                            <?php if($product->stock > 0): ?>
                            <button class="btn btn-outline-dark" type="button" onclick="decrementQuantity()">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="hidden" id="stock" name="stock" value="0">
                            <input class="form-control text-center mx-2" id="temporalStock" name="temporalStock" type="text" value="0" style="max-width: 3rem" disabled>
                            <button class="btn btn-outline-dark me-3" type="button" onclick="incrementQuantity()">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                            <?php else: ?>
                               <i style="color: red">Out of Stock</i>
                            <?php endif; ?>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2>Related Products</h2>
            <div class="row my-3">
                <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card">
                            <?php if($relatedProduct->image != Product::$IMAGE_DEFAULT): ?>
                                <img class="card-img-top" src="<?php echo e(asset('storage/' . $relatedProduct->image)); ?>"
                                     alt="<?php echo e($product->name); ?>" style="height: 250px; object-fit: cover;"  onerror="this.onerror=null; this.src='<?php echo e($relatedProduct->image); ?>';"/>
                            <?php else: ?>
                                <img class="card-img-top" src="<?php echo e(Product::$IMAGE_DEFAULT); ?>"
                                     alt="<?php echo e($relatedProduct->name); ?>" style="height: 250px; object-fit: cover;"/>
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($relatedProduct->name); ?></h5>
                                <p class="card-text"><?php if($relatedProduct->price_before && $relatedProduct->price_before > 0): ?><span style="color: red;">€<?php echo e($relatedProduct->price); ?></span>&nbsp;<del>€<?php echo e($relatedProduct->price_before); ?></del><?php else: ?> €<?php echo e($relatedProduct->price); ?><?php endif; ?></p>
                                <a href="<?php echo e(route('products.show', $relatedProduct->id)); ?>"
                                   class="btn btn-outline-dark mt-auto">View Product</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('formCart').addEventListener('submit', function(event) {
            var inputQuantity = document.getElementById('temporalStock');
            var hiddenInputQuantity = document.getElementById('stock');
            hiddenInputQuantity.value = inputQuantity.value;
        });
        function incrementQuantity() {
            var inputQuantity = document.getElementById('temporalStock');
            var currentValue = parseInt(inputQuantity.value);
            if (currentValue < <?php echo e($product->stock); ?>) {
                inputQuantity.value = currentValue + 1;
            }
        }

        function decrementQuantity() {
            var inputQuantity = document.getElementById('temporalStock');
            var newValue = parseInt(inputQuantity.value) - 1;
            if (newValue >= 0) {
                inputQuantity.value = newValue;
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/products/show.blade.php ENDPATH**/ ?>