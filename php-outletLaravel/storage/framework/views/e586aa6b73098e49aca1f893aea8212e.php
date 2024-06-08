<?php use App\Models\Product; ?>


<?php $__env->startSection('title', 'Alina Luxury - Products'); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <?php echo $__env->make('normalhead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="py-2">

        <section class="pt-5 pb-5">
            <div class="container">
                <?php if(session()->has('cart') && session()->get('cart') != []): ?>
                    <div class="row w-100">
                        <div class="col-lg-12 col-md-12 col-12">
                            <h3 class="display-5 mb-2 text-center"><i class="fas fa-cart-shopping me-3"></i>Shopping Cart</h3>
                            <p class="mb-5 text-center">
                                <i class="font-weight-bold" style="color: #cca000;"><?php echo e(session()->get('totalItems')); ?></i> fabulous items in your cart
                            </p>
                            <table id="shoppingCart" class="table table-condensed table-responsive">
                                <thead>
                                <tr>
                                    <th style="width:60%">Product</th>
                                    <th style="width:12%">Price</th>
                                    <th style="width:10%">Quantity</th>
                                    <th style="width:16%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td data-th="Product">
                                            <div class="row">
                                                <div class="col-md-3 text-left">
                                                    <?php if($item['product']->image != Product::$IMAGE_DEFAULT): ?>
                                                        <img src="<?php echo e(asset('storage/' . $item['product']->image)); ?>" alt="<?php echo e($item['product']->name); ?>" class="img-fluid d-none d-md-block rounded mb-2 shadow " onerror="this.onerror=null; this.src='<?php echo e($item['product']->image); ?>';">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(Product::$IMAGE_DEFAULT); ?>" alt="<?php echo e($item['product']->name); ?>" class="img-fluid d-none d-md-block rounded mb-2 shadow ">
                                                    <?php endif; ?>

                                                </div>
                                                <div class="col-md-9 text-left mt-sm-2">
                                                    <h4><?php echo e($item['product']->name); ?></h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-th="Price">€ <?php echo e($item['product']->price); ?></td>
                                        <form method="post" action="<?php echo e(route('cart.update', $item['product']->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <td data-th="Quantity">
                                                <input type="number" class="form-control form-control-lg text-center" name="stock" value="<?php echo e($item['quantity']); ?>">
                                            </td>
                                            <td data-th="id">
                                                <input hidden="" class="form-control form-control-lg text-center" name="id" value="<?php echo e($item['product']->id); ?>">
                                            </td>
                                        <td class="actions" data-th="">
                                                <input type="hidden" name="key" value="<?php echo e($key); ?>">
                                                <div class="input-group">
                                                    <button type="submit" class="btn btn-outline-primary btn-md ml-2">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </div>
                                        </td>
                                        </form>
                                        <td class="actions" data-th="">
                                            <form method="post" action="<?php echo e(route('cart.destroy', $item['product']->id)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <input type="hidden" name="key" value="<?php echo e($key); ?>">
                                                <div class="text-right">
                                                    <button class="btn btn-outline-danger btn-md mb-2" type="submit">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <div class="float-right text-right">
                                <p class="fs-5">Subtotal:</p>
                                <p class="fs-4 text-success">€ <?php echo e($totalPrice); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 d-flex align-items-center">
                        <div class="col-sm-6 order-md-2 text-right">
                            <a href="<?php echo e(route('payment')); ?>" class="btn btn-outline-warning mb-4 btn-lg pl-5 pr-5">Checkout</a>
                        </div>
                        <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                            <a href="<?php echo e(route('products.index')); ?>" style="color: #cca000;">
                                <i class="fas fa-arrow-left mr-2"></i> Continue Shopping</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row w-100">
                        <div class="col-lg-12 col-md-12 col-12">
                            <h3 class="display-5 mb-2 text-center"><i class="fas fa-basket-shopping me-3"></i>Your Cart is Empty</h3>
                            <p class="mb-5 text-center">
                                <i class="font-weight-bold" style="color: #cca000;">Add products to your cart!</i>
                            </p>
                        </div>
                    </div>
                    <div class="row mt-4 d-flex align-items-center">
                        <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                            <a href="<?php echo e(route('products.index')); ?>" style="color: #cca000;">
                                <i class="fas fa-arrow-left mr-2"></i> Go To Shopping</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-3.3.1.slim.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/cart/cart.blade.php ENDPATH**/ ?>