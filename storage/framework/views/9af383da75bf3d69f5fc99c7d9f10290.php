

<?php $__env->startSection('title', 'Add Sale'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="mb-4">Add New Sale</h1>

<div class="card">
    <div class="card-body">
        <form action="<?php echo e(route('sales.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sale_date" class="form-label">Sale Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control <?php $__errorArgs = ['sale_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="sale_date" name="sale_date" value="<?php echo e(old('sale_date', date('Y-m-d'))); ?>" required>
                    <?php $__errorArgs = ['sale_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="customer_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="customer_name" name="customer_name" value="<?php echo e(old('customer_name')); ?>" 
                           placeholder="Enter customer name" required>
                    <small class="text-muted">Customer will be automatically saved</small>
                    <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="customer_phone" class="form-label">Customer Phone (Optional)</label>
                    <input type="text" class="form-control <?php $__errorArgs = ['customer_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="customer_phone" name="customer_phone" value="<?php echo e(old('customer_phone')); ?>" 
                           placeholder="Enter phone number">
                    <?php $__errorArgs = ['customer_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="item_id" class="form-label">Item <span class="text-danger">*</span></label>
                    <select class="form-control <?php $__errorArgs = ['item_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                            id="item_id" name="item_id" required>
                        <option value="">Select Item</option>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>" 
                                    data-price="<?php echo e($item->selling_price); ?>"
                                    data-sku="<?php echo e($item->sku); ?>"
                                    <?php if(old('item_id') == $item->id): echo 'selected'; endif; ?>>
                                <?php echo e($item->name); ?><?php if($item->sku): ?> [<?php echo e($item->sku); ?>]<?php endif; ?>
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['item_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3" id="selected_item_info" style="display: none;">
                    <div class="alert alert-info">
                        <strong>Selected Item:</strong> <span id="item_name_display"></span>
                        <span id="item_sku_display" style="display: none;"> | <strong>SKU:</strong> <span id="sku_value"></span></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number" class="form-control <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="quantity" name="quantity" value="<?php echo e(old('quantity', 1)); ?>" min="1" required>
                    <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="rate" class="form-label">Rate (₹) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control <?php $__errorArgs = ['rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="rate" name="rate" value="<?php echo e(old('rate')); ?>" min="0" required>
                    <?php $__errorArgs = ['rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="total_amount" class="form-label">Total Amount (₹)</label>
                    <input type="text" class="form-control bg-light" id="total_amount" readonly value="0.00">
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notes (Optional)</label>
                <textarea class="form-control" id="notes" name="notes" rows="2"><?php echo e(old('notes')); ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Save Sale
                </button>
                <a href="<?php echo e(route('sales.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-fill rate when item is selected
    document.getElementById('item_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        const sku = selectedOption.getAttribute('data-sku');
        const itemName = selectedOption.text;
        
        if (price) {
            document.getElementById('rate').value = price;
            calculateTotal();
        }
        
        // Show selected item info
        if (this.value) {
            document.getElementById('selected_item_info').style.display = 'block';
            document.getElementById('item_name_display').textContent = itemName;
            
            if (sku) {
                document.getElementById('item_sku_display').style.display = 'inline';
                document.getElementById('sku_value').textContent = sku;
            } else {
                document.getElementById('item_sku_display').style.display = 'none';
            }
        } else {
            document.getElementById('selected_item_info').style.display = 'none';
        }
    });

    // Calculate total amount
    function calculateTotal() {
        const quantity = parseFloat(document.getElementById('quantity').value) || 0;
        const rate = parseFloat(document.getElementById('rate').value) || 0;
        const total = quantity * rate;
        document.getElementById('total_amount').value = total.toFixed(2);
    }

    document.getElementById('quantity').addEventListener('input', calculateTotal);
    document.getElementById('rate').addEventListener('input', calculateTotal);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\xampp\htdocs\inventory-app\resources\views/sales/create.blade.php ENDPATH**/ ?>