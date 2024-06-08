<?php $__env->startSection('title', 'Alina Luxury - Payment Method'); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
<?php echo $__env->make('normalhead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container d-flex justify-content-center mt-5 mb-5">


    <div class="row g-3">

        <div class="col-md-6">
            <form action="<?php echo e(route('order_process')); ?>" method="POST">
                <?php echo csrf_field(); ?>
            <span>Payment Method</span>
            <div class="card">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header p-0" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span>Shipping Information</span>
                                        <i class="fas fa-person"></i>
                                    </div>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                           <div class="row mx-2">
                               <div class="card-body col-6">
                                   <span class="font-weight-normal card-text">Name</span>
                                   <div class="input">
                                       <input type="text" name="name" required class="form-control"  value="<?php echo e($address->name ?? ""); ?>">

                                   </div>
                               </div>
                               <div class="card-body col-6">
                                   <span class="font-weight-normal card-text">Last Name</span>
                                   <div class="input">
                                       <input type="text" name="lastName" required class="form-control"  value="<?php echo e($address->lastName ?? ""); ?>">

                                   </div>
                               </div>
                               <div class="card-body col-6">
                                   <span class="font-weight-normal card-text">DNI/NIE</span>
                                   <div class="input">
                                       <input type="text" class="form-control" required name="dni" value="<?php echo e($address->dni ?? ""); ?>">

                                   </div>
                               </div>
                               <div class="col-6"></div>
                               <div class="card-body col-6">
                                   <span class="font-weight-normal card-text">Street</span>
                                   <div class="input">
                                       <input type="text" class="form-control" required name="street" value="<?php echo e($address->street ?? ""); ?>">

                                   </div>
                               </div>
                               <div class="card-body col-3">
                                   <span class="font-weight-normal card-text">Number</span>
                                   <div class="input">
                                       <input type="text" class="form-control" name="number" value="<?php echo e($address->number ?? ""); ?>">
                                   </div>
                               </div>
                               <div class="card-body col-3">
                                   <span class="font-weight-normal card-text">City</span>
                                   <div class="input">
                                       <input type="text" class="form-control" required name="city" value="<?php echo e($address->city ?? ""); ?>" >
                                   </div>
                               </div>
                               <div class="card-body col-4">
                                   <span class="font-weight-normal card-text">Province</span>
                                   <div class="input">
                                       <input type="text" class="form-control" required name="province" value="<?php echo e($address->province ?? ""); ?>">
                                   </div>
                               </div>
                               <div class="col-4"></div>
                               <div class="card-body col-4">
                                   <span class="font-weight-normal card-text">Postal Code</span>
                                   <div class="input">
                                       <input type="text" class="form-control" required name="postCode" value="<?php echo e($address->postCode ?? ""); ?>">
                                   </div>
                               </div>
                               <div class="card-body col-6">
                                   <span class="font-weight-normal card-text">Aditional Information</span>
                                   <div class="input">
                                       <input type="text" class="form-control" name="additionalInfo" value="<?php echo e($address->additionalInfo ?? ""); ?>">
                                   </div>
                               </div>
                           </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header p-0">
                            <h2 class="mb-0">
                                <button class="btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="d-flex align-items-center justify-content-between">

                                        <span>Credit card</span>
                                        <div class="icons">
                                            <img src="<?php echo e(asset('images/general/visa.png')); ?>" width="30">
                                            <img src="<?php echo e(asset('images/general/mastercard.png')); ?>" width="30">
                                            <img src="<?php echo e(asset('images/general/stripe.png')); ?>" width="30">
                                        </div>

                                    </div>
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body payment-card-body">

                                <span class="font-weight-normal card-text">Card Number</span>
                                <div class="input">

                                    <i class="fa fa-credit-card"></i>
                                    <input type="text" class="form-control" name="card" required placeholder="0000 0000 0000 0000">

                                </div>

                                <div class="row mt-3 mb-3">

                                    <div class="col-md-6">

                                        <span class="font-weight-normal card-text">Expiry Date</span>
                                        <div class="input">

                                            <i class="fa fa-calendar"></i>
                                            <input type="text" required name="expiry" class="form-control" placeholder="MM/YY">

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <span class="font-weight-normal card-text">CVC/CVV</span>
                                        <div class="input">

                                            <i class="fa fa-lock"></i>
                                            <input type="text" required name="cvv" class="form-control" placeholder="000">

                                        </div>

                                    </div>


                                </div>

                                <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is secured with ssl certificate</span>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">
            <span>Summary</span>

            <div class="card">

                <div class="d-flex justify-content-between p-3">

                    <div class="d-flex flex-column">
                        <span>Total Cart<i class="fa fa-caret-down"></i></span>
                    </div>

                    <div class="mt-1">
                        <span class="super-month">€ <?php echo e(number_format($totalPrice,2)); ?></span>
                    </div>

                </div>

                <hr class="mt-0 line">


                <div class="p-3 d-flex justify-content-between">

                    <div class="d-flex flex-column">

                        <span>Aditional Tax (21%)</span>

                    </div>
                    <span>+ € <?php echo e(number_format($tax,2)); ?></span>

                </div>

                <hr class="mt-0 line">

                <?php if($save > 0): ?>
                <div class="p-3 d-flex justify-content-between">

                    <div class="d-flex flex-column">

                        <span>Save</span>

                    </div>
                    <span style="color: red">€ <?php echo e(number_format($save,2)); ?></span>

                </div>
                <?php endif; ?>
                <div class="p-3 d-flex justify-content-between">

                    <div class="d-flex flex-column">

                        <span>Total To Pay</span>

                    </div>
                    <span class="text-success">€ <?php echo e(number_format($total,2)); ?></span>

                </div>


                <div class="p-3">

                    <button class="btn btn-primary btn-block free-button">Realizar Pago</button>

                </div>




            </div>
            </form>
        </div>
    </div>
</div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/layouts/payment.blade.php ENDPATH**/ ?>