

<?php $__env->startSection('title', 'Items'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-box"></i> Items Management</h2>
    <a href="<?php echo e(route('items.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Item
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Purchase Price</th>
                        <th>Selling Price</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><span class="badge bg-secondary"><?php echo e($item->sku); ?></span></td>
                        <td><strong><?php echo e($item->name); ?></strong></td>
                        <td><?php echo e(Str::limit($item->description, 50)); ?></td>
                        <td>₹<?php echo e(number_format($item->purchase_price, 2)); ?></td>
                        <td>₹<?php echo e(number_format($item->selling_price, 2)); ?></td>
                        <td>
                            <?php if($item->quantity < 10): ?>
                                <span class="badge bg-danger"><?php echo e($item->quantity); ?></span>
                            <?php else: ?>
                                <span class="badge bg-success"><?php echo e($item->quantity); ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($item->unit); ?></td>
                        <td>
                            <a href="<?php echo e(route('items.edit', $item)); ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('items.destroy', $item)); ?>" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this item?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <p>No items found. Add your first item!</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <?php echo e($items->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\xampp\htdocs\inventory-app\resources\views/items/index.blade.php ENDPATH**/ ?>