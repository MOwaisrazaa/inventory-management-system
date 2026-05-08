

<?php $__env->startSection('title', 'Vendor Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-truck"></i> Vendor Details</h2>
    <div>
        <a href="<?php echo e(route('vendors.edit', $vendor)); ?>" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="<?php echo e(route('vendors.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <!-- Vendor Information -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Vendor Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Name:</th>
                        <td><strong><?php echo e($vendor->name); ?></strong></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo e($vendor->email ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><?php echo e($vendor->phone); ?></td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td><?php echo e($vendor->address ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th>Total Purchases:</th>
                        <td><span class="badge bg-info"><?php echo e($vendor->purchases->count()); ?></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Purchase Statistics -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Purchase Statistics</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6>Total Purchases</h6>
                    <h3 class="text-primary"><?php echo e($vendor->purchases->count()); ?></h3>
                </div>
                <div class="mb-3">
                    <h6>Total Amount</h6>
                    <h3 class="text-success">₹<?php echo e(number_format($vendor->purchases->sum('amount'), 2)); ?></h3>
                </div>
                <div>
                    <h6>Average Purchase</h6>
                    <h3 class="text-info">
                        ₹<?php echo e($vendor->purchases->count() > 0 ? number_format($vendor->purchases->avg('amount'), 2) : '0.00'); ?>

                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Purchases -->
<div class="card mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Recent Purchases</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Item</th>
                        <th>SKU</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $vendor->purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e(\Carbon\Carbon::parse($purchase->purchase_date)->format('d/m/Y')); ?></td>
                        <td><?php echo e($purchase->item->name); ?></td>
                        <td>
                            <?php if($purchase->item->sku): ?>
                                <span class="badge bg-secondary"><?php echo e($purchase->item->sku); ?></span>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($purchase->quantity); ?> <?php echo e($purchase->item->unit); ?></td>
                        <td>₹<?php echo e(number_format($purchase->rate, 2)); ?></td>
                        <td>₹<?php echo e(number_format($purchase->amount, 2)); ?></td>
                        <td>
                            <?php if($purchase->status == 'completed'): ?>
                                <span class="badge bg-success">Completed</span>
                            <?php elseif($purchase->status == 'pending'): ?>
                                <span class="badge bg-warning">Pending</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Cancelled</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p>No purchases yet from this vendor</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\xampp\htdocs\inventory-app\resources\views/vendors/show.blade.php ENDPATH**/ ?>