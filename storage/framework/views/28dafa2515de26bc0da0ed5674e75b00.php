

<?php $__env->startSection('title', 'Purchases'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Purchases</h1>
    <a href="<?php echo e(route('purchases.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Purchase
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Vendor</th>
                    <th>Item</th>
                    <th>SKU</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($purchase->purchase_date->format('d-m-Y')); ?></td>
                        <td><?php echo e($purchase->vendor->name); ?></td>
                        <td><?php echo e($purchase->item->name); ?></td>
                        <td>
                            <?php if($purchase->item->sku): ?>
                                <span class="badge bg-secondary"><?php echo e($purchase->item->sku); ?></span>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($purchase->quantity); ?></td>
                        <td>₹<?php echo e(number_format($purchase->rate, 2)); ?></td>
                        <td><strong>₹<?php echo e(number_format($purchase->amount, 2)); ?></strong></td>
                        <td>
                            <a href="<?php echo e(route('purchases.edit', $purchase)); ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('purchases.destroy', $purchase)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">No purchases found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    <?php echo e($purchases->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\xampp\htdocs\inventory-app\resources\views/purchases/index.blade.php ENDPATH**/ ?>