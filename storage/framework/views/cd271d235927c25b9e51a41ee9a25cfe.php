

<?php $__env->startSection('title', 'Customers'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users"></i> Customers Management</h2>
    <a href="<?php echo e(route('customers.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Customer
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Total Sales</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><strong><?php echo e($customer->name); ?></strong></td>
                        <td><?php echo e($customer->email ?? '-'); ?></td>
                        <td><?php echo e($customer->phone); ?></td>
                        <td><?php echo e(Str::limit($customer->address, 40) ?? '-'); ?></td>
                        <td>
                            <span class="badge bg-success"><?php echo e($customer->sales_count); ?> sales</span>
                        </td>
                        <td>
                            <a href="<?php echo e(route('customers.show', $customer)); ?>" class="btn btn-sm btn-info" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?php echo e(route('customers.edit', $customer)); ?>" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('customers.destroy', $customer)); ?>" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this customer?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <p>No customers found. Customers will be automatically added when you make sales!</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <?php echo e($customers->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\xampp\htdocs\inventory-app\resources\views/customers/index.blade.php ENDPATH**/ ?>