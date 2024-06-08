<?php use App\Models\Category; ?>


<?php $__env->startSection('title', 'Alina Luxury Outlet'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('masthead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Welcome to Alina's Luxury. </h2>
                <h3 class="section-subheading text-muted">Your definitive destination to purchase the world's most prestigious brands at unbeatable prices. At our exclusive outlet, we combine luxury and affordability, allowing you to enjoy the sophistication and style you deserve.</h3>
            </div>
            <div class="position-relative marquee-container d-none d-sm-block" style="height: 8cm" >
                <div class="marquee d-flex justify-content-around">
                    <div class="row">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($category->id != 1): ?>
                                <div class="col-lg-3 col-sm-3 mb-4 category"  >
                                    <div class="portfolio-item" >
                                        <a class="portfolio-link" href="<?php echo e(route('products.index', ['category' => $category->id])); ?>" >
                                            <div class="portfolio-hover">
                                                <div class="portfolio-hover-content"></div>
                                            </div>
                                            <?php if($category->image != Category::$IMAGE_DEFAULT): ?>
                                                <img class="img-fluid"  src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="<?php echo e($category->name); ?>" style="height: 6cm; width: 6cm; object-fit: cover;" onerror="this.onerror=null; this.src='<?php echo e($category->image); ?>';"/>
                                            <?php else: ?>
                                                <img class="img-fluid"  src="<?php echo e(Category::$IMAGE_DEFAULT); ?>" alt="<?php echo e($category->name); ?>" />
                                            <?php endif; ?>

                                        </a>
                                        <div class="portfolio-caption">
                                            <div class="portfolio-caption-heading"><?php echo e($category->name); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="container-fluid mb-4" >
    <div class="card mb-1 m-4" >
        <div class="row col-lg-12" >
            <div class="col-md-3">
                <img src="https://media-private.canva.com/MADAncbi7HE/1/screen.jpg?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJWF6QO3UH4PAAJ6Q%2F20240519%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20240519T111156Z&X-Amz-Expires=29547&X-Amz-Signature=d0eee49ee04aa0c989223c49942f1dcec213143383963368d450c46298cac52d&X-Amz-SignedHeaders=host%3Bx-amz-expected-bucket-owner&response-expires=Sun%2C%2019%20May%202024%2019%3A24%3A23%20GMT" class="img-fluid rounded-start" style="height: 200px; width: 300px" onerror="this.onerror=null; this.src='<?php echo e(Category::$IMAGE_DEFAULT); ?>';">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Luxury Watches</h5>
                    <p class="card-text">Discover our selection of luxury watches that make a difference. From classic designs to the latest innovations in watchmaking, we offer pieces from iconic brands such as Versace, Gucci, and Omega. Each watch in our catalog is a symbol of precision and elegance.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-1 m-4">
        <div class="row col-lg-12">
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Luxury Jewellery</h5>
                    <p class="card-text">Our jewelry collection is carefully curated to satisfy the most demanding tastes. You will find everything from rings and necklaces to bracelets and earrings, all created by the most renowned master jewelers. Brands such as Gucci, Versace and Coach adorn our display cases, giving you the opportunity to own true works of art.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <img src="https://media-private.canva.com/MACzFiHQ_w8/1/screen.jpg?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJWF6QO3UH4PAAJ6Q%2F20240518%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20240518T160533Z&X-Amz-Expires=97864&X-Amz-Signature=8ac13b813bdd89739b417a1c59fa72805567ec9c4bcdf455364da5dd8f6c0fcb&X-Amz-SignedHeaders=host%3Bx-amz-expected-bucket-owner&response-expires=Sun%2C%2019%20May%202024%2019%3A16%3A37%20GMT" class="img-fluid rounded-start" style="height: 200px; width: 300px"  onerror="this.onerror=null; this.src='<?php echo e(Category::$IMAGE_DEFAULT); ?>';">
            </div>
        </div>
    </div>

    <div class="card mb-1 m-4">
        <div class="row col-lg-12">
            <div class="col-md-3">
                <img src="https://media-public.canva.com/olf4c/MAEmEwolf4c/1/s.jpg" class="img-fluid rounded-start" style="height: 200px; width: 300px"  onerror="this.onerror=null; this.src='<?php echo e(Category::$IMAGE_DEFAULT); ?>';">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Luxury Bags</h5>
                    <p class="card-text">Explore a wide range of bags from the most recognized brands worldwide. From the iconic designs of Coach and Michael Kors to the modernity of Gucci and the craftsmanship of Prada, each piece reflects the excellence and legacy of these fashion houses.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-1 m-4">
        <div class="row col-lg-12">
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Sunglasses Premium</h5>
                    <p class="card-text">Protect your eyesight in style thanks to our variety of sunglasses and optical glasses from brands such as Ray-Ban, Gucci and Prada. Each piece not only guarantees maximum eye protection but also a design that highlights your personality and good taste.
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <img src="https://media-private.canva.com/MADGYbYiBaU/1/screen.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJWF6QO3UH4PAAJ6Q%2F20240519%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20240519T043031Z&X-Amz-Expires=53867&X-Amz-Signature=bf3a1d3f2fb0e307de1530e66134e843f542501d931cdd3bd241dbb46f80caf0&X-Amz-SignedHeaders=host%3Bx-amz-expected-bucket-owner&response-expires=Sun%2C%2019%20May%202024%2019%3A28%3A18%20GMT" class="img-fluid rounded-start" style="height: 200px; width: 300px"  onerror="this.onerror=null; this.src='<?php echo e(Category::$IMAGE_DEFAULT); ?>';">
            </div>
        </div>
    </div>
    </div>

    <section class="page-section" id="contact" style="position: relative; background-image: url('images/general/424606710_957179279311637_1439247418302646477_n.jpg')">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase text-warning" >Contact Us</h2>
            </div>
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->
            <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Name input-->
                            <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>
                        <div class="form-group">
                            <!-- Email address input-->
                            <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <div class="form-group mb-md-0">
                            <!-- Phone number input-->
                            <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-textarea mb-md-0">
                            <!-- Message input-->
                            <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>
                    </div>
                </div>
                <!-- Submit success message-->
                <!---->
                <!-- This is what your users will see when the form-->
                <!-- has successfully submitted-->
                <div class="d-none" id="submitSuccessMessage">
                    <div class="text-center text-white mb-3">
                        <div class="fw-bolder">Form submission successful!</div>
                        <br />
                    </div>
                </div>
                <!-- Submit error message-->
                <!---->
                <!-- This is what your users will see when there is-->
                <!-- an error submitting the form-->
                <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                <!-- Submit Button-->
                <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled" id="submitButton" type="submit">Send Message</button></div>
            </form>
        </div>
    </section>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/index.blade.php ENDPATH**/ ?>