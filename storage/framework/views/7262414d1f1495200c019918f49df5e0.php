

<?php $__env->startSection('title', 'Customer Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user"></i> Customer Details</h2>
    <div>
        <a href="<?php echo e(route('customers.edit', $customer)); ?>" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <!-- Customer Information -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Customer Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Name:</th>
                        <td><strong><?php echo e($customer->name); ?></strong></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo e($customer->email ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><?php echo e($customer->phone); ?></td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td><?php echo e($customer->address ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th>Total Sales:</th>
                        <td><span class="badge bg-success"><?php echo e($customer->sales->count()); ?></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Sales Statistics -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Sales Statistics</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6>Total Sales</h6>
                    <h3 class="text-primary"><?php echo e($customer->sales->count()); ?></h3>
                </div>
                <div class="mb-3">
                    <h6>Total Amount</h6>
                    <h3 class="text-success">₹<?php echo e(number_format($customer->sales->sum('amount'), 2)); ?></h3>
                </div>
                <div>
                    <h6>Average Sale</h6>
                    <h3 class="text-info">
                        ₹<?php echo e($customer->sales->count() > 0 ? number_format($customer->sales->avg('amount'), 2) : '0.00'); ?>

                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Sales -->
<div class="card mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-shopping-bag"></i> Recent Sales</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $customer->sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e(\Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y')); ?></td>
                        <td><?php echo e($sale->item->name); ?></td>
                        <td><?php echo e($sale->quantity); ?> <?php echo e($sale->item->unit); ?></td>
                        <td>₹<?php echo e(number_format($sale->rate, 2)); ?></td>
                        <td>₹<?php echo e(number_format($sale->amount, 2)); ?></td>
                        <td>
                            <?php if($sale->status == 'completed'): ?>
                                <span class="badge bg-success">Completed</span>
                            <?php elseif($sale->status == 'pending'): ?>
                                <span class="badge bg-warning">Pending</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Cancelled</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p>No sales yet from this customer</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\xampp\htdocs\inventory-app\resources\views/customers/show.blade.php ENDPATH**/ ?>