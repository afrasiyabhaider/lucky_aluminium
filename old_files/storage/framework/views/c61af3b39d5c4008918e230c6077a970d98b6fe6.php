<tr>
	<td><?php echo e($product->name, false); ?> (<?php echo e($product->sku, false); ?>)</td>
	<input type="hidden" name="products[]" value="<?php echo e($product->id, false); ?>">
	<td><button type="button" class="btn btn-danger btn-xs remove_modifier_product"><i class="fa fa-close"></i></button></td>
</tr>