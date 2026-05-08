

<?php $__env->startSection('title', 'Inventory Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <h2><i class="fas fa-warehouse"></i> Inventory Management</h2>
    <p class="text-muted">Track and manage your sales & purchases</p>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6 class="card-title"><i class="fas fa-boxes"></i> Total Items</h6>
                <h2 class="mb-0"><?php echo e($stats['total_items']); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h6 class="card-title"><i class="fas fa-exclamation-triangle"></i> Low Stock</h6>
                <h2 class="mb-0"><?php echo e($stats['low_stock_items']); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6 class="card-title"><i class="fas fa-dollar-sign"></i> Inventory Value</h6>
                <h2 class="mb-0">₹<?php echo e(number_format($stats['total_inventory_value'], 2)); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h6 class="card-title"><i class="fas fa-chart-line"></i> Total Sales</h6>
                <h2 class="mb-0">₹<?php echo e(number_format($stats['total_sales_value'], 2)); ?></h2>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="<?php echo e(route('inventory.index')); ?>" class="row g-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" 
                       placeholder="Search by item name or SKU..." 
                       value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-3">
                <select name="low_stock" class="form-control">
                    <option value="">All Items</option>
                    <option value="1" <?php echo e(request('low_stock') == '1' ? 'selected' : ''); ?>>Low Stock Only</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Current Inventory -->
<div class="card mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-list"></i> Current Inventory</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>SKU</th>
                        <th>Item Name</th>
                        <th>Purchase Price</th>
                        <th>Selling Price</th>
                        <th>Stock</th>
                        <th>Unit</th>
                        <th>Value</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><span class="badge bg-secondary"><?php echo e($item->sku); ?></span></td>
                        <td><strong><?php echo e($item->name); ?></strong></td>
                        <td>₹<?php echo e(number_format($item->purchase_price, 2)); ?></td>
                        <td>₹<?php echo e(number_format($item->selling_price, 2)); ?></td>
                        <td>
                            <?php if($item->quantity < 10): ?>
                                <span class="badge bg-danger"><?php echo e($item->quantity); ?></span>
                            <?php elseif($item->quantity < 50): ?>
                                <span class="badge bg-warning"><?php echo e($item->quantity); ?></span>
                            <?php else: ?>
                                <span class="badge bg-success"><?php echo e($item->quantity); ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($item->unit); ?></td>
                        <td>₹<?php echo e(number_format($item->quantity * $item->purchase_price, 2)); ?></td>
                        <td>
                            <?php if($item->quantity < 10): ?>
                                <span class="badge bg-danger">Low Stock</span>
                            <?php elseif($item->quantity < 50): ?>
                                <span class="badge bg-warning">Medium</span>
                            <?php else: ?>
                                <span class="badge bg-success">In Stock</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <p>No items found</p>
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

<!-- Recent Transactions -->
<div class="row">
    <!-- Recent Purchases -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-shopping-cart text-primary"></i> Recent Purchases</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Item</th>
                                <th>Vendor</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentPurchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(\Carbon\Carbon::parse($purchase->purchase_date)->format('d/m/Y')); ?></td>
                                <td><?php echo e($purchase->item->name); ?></td>
                                <td><?php echo e($purchase->vendor->name); ?></td>
                                <td><?php echo e($purchase->quantity); ?></td>
                                <td>₹<?php echo e(number_format($purchase->amount, 2)); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">No recent purchases</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="<?php echo e(route('purchases.index')); ?>" class="btn btn-sm btn-outline-primary">
                        View All Purchases <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Sales -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-cash-register text-success"></i> Recent Sales</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Item</th>
                                <th>Customer</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentSales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(\Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y')); ?></td>
                                <td><?php echo e($sale->item->name); ?></td>
                                <td><?php echo e($sale->customer->name); ?></td>
                                <td><?php echo e($sale->quantity); ?></td>
                                <td>₹<?php echo e(number_format($sale->amount, 2)); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">No recent sales</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="<?php echo e(route('sales.index')); ?>" class="btn btn-sm btn-outline-success">
                        View All Sales <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\xampp\htdocs\inventory-app\resources\views/inventory/index.blade.php ENDPATH**/ ?>