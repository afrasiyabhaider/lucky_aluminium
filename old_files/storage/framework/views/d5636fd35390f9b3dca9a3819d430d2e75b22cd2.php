<?php if(empty($edit_modifiers)): ?>
<small>
	<?php $__currentLoopData = $modifiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if(!$loop->first): ?>
			<?php echo e(', ', false); ?>

		<?php endif; ?>
		<?php echo e($modifier->name, false); ?>(<?php echo e(number_format($modifier->sell_price_inc_tax, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>)
		<input type="hidden" name="products[<?php echo e($index, false); ?>][modifier][]" 
			value="<?php echo e($modifier->id, false); ?>">
		<input type="hidden" class="modifiers_price" 
			name="products[<?php echo e($index, false); ?>][modifier_price][]" 
			value="<?php echo e(number_format($modifier->sell_price_inc_tax, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
		<input type="hidden" 
			name="products[<?php echo e($index, false); ?>][modifier_set_id][]" 
			value="<?php echo e($modifier->product_id, false); ?>">
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</small>
<?php else: ?>
	<?php $__currentLoopData = $modifiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if(!$loop->first): ?>
			<?php echo e(', ', false); ?>

		<?php endif; ?>
		<?php echo e($modifier->variations->name ?? '', false); ?>(<?php echo e(number_format($modifier->unit_price_inc_tax, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>)
		<input type="hidden" name="products[<?php echo e($index, false); ?>][modifier][]" 
			value="<?php echo e($modifier->variation_id, false); ?>">
		<input type="hidden" class="modifiers_price" 
			name="products[<?php echo e($index, false); ?>][modifier_price][]" 
			value="<?php echo e(number_format($modifier->unit_price_inc_tax, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
		<input type="hidden" 
			name="products[<?php echo e($index, false); ?>][modifier_set_id][]" 
			value="<?php echo e($modifier->product_id, false); ?>">
		<input type="hidden" 
			name="products[<?php echo e($index, false); ?>][modifier_sell_line_id][]" 
			value="<?php echo e($modifier->id, false); ?>">
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>