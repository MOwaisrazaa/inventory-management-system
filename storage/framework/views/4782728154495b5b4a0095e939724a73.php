

<?php $__env->startSection('title', 'Cash Book'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Cash Book</h1>
    <a href="<?php echo e(route('cashbook.create')); ?>" class="btn btn-info">
        <i class="fas fa-plus"></i> Add Transaction
    </a>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <h5>Total Receipts</h5>
            <div class="value">₹<?php echo e(number_format($totalReceipts, 2)); ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
            <h5>Total Payments</h5>
            <div class="value">₹<?php echo e(number_format($totalPayments, 2)); ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);">
            <h5>Balance</h5>
            <div class="value">₹<?php echo e(number_format($balance, 2)); ?></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <i class="fas fa-arrow-down"></i> Receipts
            </div>
            <div class="card-body">
                <table class="table table-sm table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>From</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $receipts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receipt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($receipt->transaction_date->format('d-m-Y')); ?></td>
                                <td><?php echo e($receipt->from_to); ?></td>
                                <td><?php echo e($receipt->description); ?></td>
                                <td><strong>₹<?php echo e(number_format($receipt->amount, 2)); ?></strong></td>
                                <td>
                                    <a href="<?php echo e(route('cashbook.edit', $receipt)); ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('cashbook.destroy', $receipt)); ?>" method="POST" style="display:inline;">
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
                                <td colspan="5" class="text-center text-muted">No receipts found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <i class="fas fa-arrow-up"></i> Payments
            </div>
            <div class="card-body">
                <table class="table table-sm table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>To</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($payment->transaction_date->format('d-m-Y')); ?></td>
                                <td><?php echo e($payment->from_to); ?></td>
                                <td><?php echo e($payment->description); ?></td>
                                <td><strong>₹<?php echo e(number_format($payment->amount, 2)); ?></strong></td>
                                <td>
                                    <a href="<?php echo e(route('cashbook.edit', $payment)); ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('cashbook.destroy', $payment)); ?>" method="POST" style="display:inline;">
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
                                <td colspan="5" class="text-center text-muted">No payments found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\xampp\htdocs\inventory-app\resources\views/cashbook/index.blade.php ENDPATH**/ ?>