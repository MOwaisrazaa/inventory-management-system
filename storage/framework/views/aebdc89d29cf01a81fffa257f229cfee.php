

<?php $__env->startSection('title', 'Vendors'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-truck"></i> Vendors Management</h2>
    <a href="<?php echo e(route('vendors.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Vendor
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
                        <th>Total Purchases</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><strong><?php echo e($vendor->name); ?></strong></td>
                        <td><?php echo e($vendor->email ?? '-'); ?></td>
                        <td><?php echo e($vendor->phone); ?></td>
                        <td><?php echo e(Str::limit($vendor->address, 40) ?? '-'); ?></td>
                        <td>
                            <span class="badge bg-info"><?php echo e($vendor->purchases_count); ?> purchases</span>
                        </td>
                        <td>
                            <a href="<?php echo e(route('vendors.show', $vendor)); ?>" class="btn btn-sm btn-info" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?php echo e(route('vendors.edit', $vendor)); ?>" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('vendors.destroy', $vendor)); ?>" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this vendor?')">
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
                            <p>No vendors found. Add your first vendor!</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <?php echo e($vendors->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\xampp\htdocs\inventory-app\resources\views/vendors/index.blade.php ENDPATH**/ ?>