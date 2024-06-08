<?php $__env->startSection('title', 'Alina Luxury - Login'); ?>
<link rel="icon" href="<?php echo e(asset("images/logo1.png")); ?>" type="image/x-icon">
<?php $__env->startSection('content'); ?>
    <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden">
        <style>
            .background-radial-gradient {
                background-color: hsl(38, 100%, 55%);
                background-image: radial-gradient(650px circle at 0% 0%, hsl(36, 88%, 45%) 15%, hsl(35, 100%, 42%) 35%, hsl(36, 100%, 47%) 75%, hsl(46, 100%, 42%) 80%, transparent 100%), radial-gradient(1250px circle at 100% 100%, hsl(38, 100%, 65%) 15%, hsl(37, 100%, 42%) 35%, hsl(39, 100%, 50%) 75%, hsl(45, 100%, 40%) 80%, transparent 100%);
            }

            #radius-shape-1 {
                height: 220px;
                width: 220px;
                top: -60px;
                left: -130px;
                background: radial-gradient(hsl(35, 73%, 40%), hsl(38, 87%, 50%)); /* Gradiente de café oscuro a amarillo */
            }

            #radius-shape-2 {
                border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
                bottom: -60px;
                right: -110px;
                width: 300px;
                height: 300px;
                background: radial-gradient(hsl(35, 73%, 40%), hsl(38, 87%, 50%)); /* Gradiente de morado oscuro a rosa */
            }

            .bg-glass {
                background-color: hsla(0, 0%, 100%, 0.5) !important;
                backdrop-filter: saturate(200%) blur(25px);
            }

        </style>

        <div class="container px-4 py-4 px-md-4 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="card bg-glass my-5">
                        <div class="card-body px-4 py-5 px-md-5">
                            <form action="<?php echo e(route('login')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="py-2 text-center fs-2">Sign In</div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="email">Email address</label>
                                    <input type="email" id="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="example@example.com" value="<?php echo e(old('email')); ?>" name="email"/>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="row">
                                    <div class="form-outline mb-4 col-md-12">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" class="form-control  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="***********" name="password"/>
                                    </div>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-dark btn-block mb-4 w-100">
                                    Sign In
                                </button>

                                <div class="pb-4 text-center"> You dont have an account? <a href="<?php echo e(route('register')); ?>">Sign up now!</a></div>
                                <div class="text-center mb-2">
                                    <a href="<?php echo e(route('password.request')); ?>" class="btn btn-outline-dark btn-floating mx-1">
                                        <i class="fas fa-person-walking-with-cane"></i> Did you forget your password?
                                    </a>
                                </div>


                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p>or sign in with:</p>
                                    <button type="button" class="btn btn-outline-dark btn-floating mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>

                                    <button type="button" class="btn btn-outline-dark btn-floating mx-1">
                                        <i class="fab fa-google"></i>
                                    </button>

                                    <button type="button" class="btn btn-outline-dark btn-floating mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </button>

                                    <button type="button" class="btn btn-outline-dark btn-floating mx-1">
                                        <i class="fab fa-github"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0 text-center" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Sign In <br />
                        <span style="color: hsl(51,48%,32%)">and Enjoy!</span>
                    </h1>
                    <p class="mb-4 opacity-70 fs-5" style="color: hsl(0,0%,0%)">

                    </p>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/auth/login.blade.php ENDPATH**/ ?>