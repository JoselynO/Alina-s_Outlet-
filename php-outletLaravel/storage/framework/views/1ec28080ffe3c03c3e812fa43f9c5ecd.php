<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alina's Luxury <?php echo e($order['id']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-4 {
            flex: 0 0 33.33%;
            max-width: 33.33%;
            padding: 10px;
        }

        hr {
            margin: 40px 0;
            border: none;
            border-top: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>
<body>
<div class="container">
    <h3>Alina's Luxury</h3>
    <div class="row">
        <div class="col-4">
            <h4>Ship to:</h4>
            <p><?php echo e($address['name']); ?> , <?php echo e($address['lastName']); ?></p>
            <p><?php echo e($address['street']); ?> , <?php echo e($address['number']); ?></p>
            <p><?php echo e($address['city']); ?> , <?php echo e($address['province']); ?> , <?php echo e($address['country']); ?> , <?php echo e($address['postCode']); ?></p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-2">
            <p > <span style="color: darkred">Order Date:</span> <?php echo e(\Illuminate\Support\Carbon::now()); ?></p>
            <p><span style="color: darkred">Order Number:</span><?php echo e($order['id']); ?></p>
        </div>

    </div>
    <hr>
    <table>
        <thead>
        <tr>
            <th scope="col">Quantity</th>
            <th scope="col">Product</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Total Price</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $orderLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderLine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($orderLine->stock); ?></td>
                <td><?php echo e($orderLine->product->name); ?></td>
                <td><?php echo e($orderLine->unitPrice); ?></td>
                <td><?php echo e($orderLine->linePrice); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <p class="text-end">Total: <?php echo e($order['totalPrice']); ?></p>
    <p class="text-end">Tax: <?php echo e($order['tax']); ?></p>
    <p class="text-end">Total: <?php echo e($order['total']); ?></p>
</div>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/pdf/invoice.blade.php ENDPATH**/ ?>