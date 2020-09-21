<?php $__env->startSection('title', __('lang_v1.purchase_return')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->getFromJson('lang_v1.purchase_return'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
	<?php echo Form::open(['url' => action('PurchaseReturnController@store'), 'method' => 'post', 'id' => 'purchase_return_form' ]); ?>

	<?php echo Form::hidden('transaction_id', $purchase->id);; ?>


	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.parent_purchase')]); ?>
		<div class="row">
			<div class="col-sm-4">
				<strong><?php echo app('translator')->getFromJson('purchase.ref_no'); ?>:</strong> <?php echo e($purchase->ref_no, false); ?> <br>
				<strong><?php echo app('translator')->getFromJson('messages.date'); ?>:</strong> <?php echo e(\Carbon::createFromTimestamp(strtotime($purchase->transaction_date))->format(session('business.date_format')), false); ?>

			</div>
			<div class="col-sm-4">
				<strong><?php echo app('translator')->getFromJson('purchase.supplier'); ?>:</strong> <?php echo e($purchase->contact->name, false); ?> <br>
				<strong><?php echo app('translator')->getFromJson('purchase.business_location'); ?>:</strong> <?php echo e($purchase->location->name, false); ?>

			</div>
		</div>
	<?php echo $__env->renderComponent(); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<?php echo Form::label('ref_no', __('purchase.ref_no').':'); ?>

					<?php echo Form::text('ref_no', !empty($purchase->return_parent->ref_no) ? $purchase->return_parent->ref_no : null, ['class' => 'form-control']);; ?>

				</div>
			</div>
			<div class="clearfix"></div>
			<hr>
			<div class="col-sm-12">
				<table class="table bg-gray" id="purchase_return_table">
		          	<thead>
			            <tr class="bg-green">
			              	<th>#</th>
			              	<th><?php echo app('translator')->getFromJson('product.product_name'); ?></th>
			              	<th><?php echo app('translator')->getFromJson('sale.unit_price'); ?></th>
			              	<th><?php echo app('translator')->getFromJson('purchase.purchase_quantity'); ?></th>
			              	<th><?php echo app('translator')->getFromJson('lang_v1.quantity_left'); ?></th>
			              	<th><?php echo app('translator')->getFromJson('lang_v1.return_quantity'); ?></th>
			              	<th><?php echo app('translator')->getFromJson('lang_v1.return_subtotal'); ?></th>
			            </tr>
			        </thead>
			        <tbody>
			          	<?php $__currentLoopData = $purchase->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			          	<?php
			          		$unit_name = $purchase_line->product->unit->short_name;

			          		$check_decimal = 'false';
			                if($purchase_line->product->unit->allow_decimal == 0){
			                    $check_decimal = 'true';
			                }

			          		if(!empty($purchase_line->sub_unit->base_unit_multiplier)) {
			          			$unit_name = $purchase_line->sub_unit->short_name;

			          			if($purchase_line->sub_unit->allow_decimal == 0){
			                    	$check_decimal = 'true';
			                	} else {
			                		$check_decimal = 'false';
			                	}
			          		}

			          		$qty_available = $purchase_line->quantity - $purchase_line->quantity_sold - $purchase_line->quantity_adjusted;
			          	?>
			            <tr>
			              	<td><?php echo e($loop->iteration, false); ?></td>
			              	<td>
			                	<?php echo e($purchase_line->product->name, false); ?>

			                 	<?php if( $purchase_line->product->type == 'variable'): ?>
			                  	- <?php echo e($purchase_line->variations->product_variation->name, false); ?>

			                  	- <?php echo e($purchase_line->variations->name, false); ?>

			                 	<?php endif; ?>
			              	</td>
			              	<td><span class="display_currency" data-currency_symbol="true"><?php echo e($purchase_line->purchase_price_inc_tax, false); ?></span></td>
			              	<td><span class="display_currency" data-is_quantity="true" data-currency_symbol="false"><?php echo e($purchase_line->quantity, false); ?></span> <?php echo e($unit_name, false); ?></td>
			              	<td><span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($qty_available, false); ?></span> <?php echo e($unit_name, false); ?></td>
			              	<td>
			              		<?php
					                $check_decimal = 'false';
					                if($purchase_line->product->unit->allow_decimal == 0){
					                    $check_decimal = 'true';
					                }
					            ?>
					            <input type="text" name="returns[<?php echo e($purchase_line->id, false); ?>]" value="<?php echo e(number_format($purchase_line->quantity_returned, config('constants.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>"
					            class="form-control input-sm input_number return_qty input_quantity"
					            data-rule-abs_digit="<?php echo e($check_decimal, false); ?>" 
					            data-msg-abs_digit="<?php echo app('translator')->getFromJson('lang_v1.decimal_value_not_allowed'); ?>"
					            <?php if($purchase_line->product->enable_stock): ?> 
			              			data-rule-max-value="<?php echo e($qty_available, false); ?>"
			              			data-msg-max-value="<?php echo app('translator')->getFromJson('validation.custom-messages.quantity_not_available', ['qty' => $purchase_line->formatted_qty_available, 'unit' => $unit_name ]); ?>" 
			              		<?php endif; ?>
					            >
					            <input type="hidden" class="unit_price" value="<?php echo e(number_format($purchase_line->purchase_price_inc_tax, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
			              	</td>
			              	<td>
			              		<div class="return_subtotal"></div>
			              		
			              	</td>
			            </tr>
			          	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		          	</tbody>
		        </table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<strong><?php echo app('translator')->getFromJson('lang_v1.total_return_tax'); ?>: </strong>
				<span id="total_return_tax"></span> <?php if(!empty($purchase->tax)): ?>(<?php echo e($purchase->tax->name, false); ?> - <?php echo e($purchase->tax->amount, false); ?>%)<?php endif; ?>
				<?php
					$tax_percent = 0;
					if(!empty($purchase->tax)){
						$tax_percent = $purchase->tax->amount;
					}
				?>
				<?php echo Form::hidden('tax_id', $purchase->tax_id);; ?>

				<?php echo Form::hidden('tax_amount', 0, ['id' => 'tax_amount']);; ?>

				<?php echo Form::hidden('tax_percent', $tax_percent, ['id' => 'tax_percent']);; ?>

			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-right">
				<strong><?php echo app('translator')->getFromJson('lang_v1.return_total'); ?>: </strong>&nbsp;
				<span id="net_return">0</span> 
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-12">
				<button type="submit" class="btn btn-primary pull-right"><?php echo app('translator')->getFromJson('messages.save'); ?></button>
			</div>
		</div>
	<?php echo $__env->renderComponent(); ?>

	<?php echo Form::close(); ?>


</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function(){
		$('form#purchase_return_form').validate();
		update_purchase_return_total();
	});
	$(document).on('change', 'input.return_qty', function(){
		update_purchase_return_total()
	});

	function update_purchase_return_total(){
		var net_return = 0;
		$('table#purchase_return_table tbody tr').each( function(){
			var quantity = __read_number($(this).find('input.return_qty'));
			var unit_price = __read_number($(this).find('input.unit_price'));
			var subtotal = quantity * unit_price;
			$(this).find('.return_subtotal').text(__currency_trans_from_en(subtotal, true));
			net_return += subtotal;
		});
		var tax_percent = $('input#tax_percent').val();
		var total_tax = __calculate_amount('percentage', tax_percent, net_return);
		var net_return_inc_tax = total_tax + net_return;

		$('input#tax_amount').val(total_tax);
		$('span#total_return_tax').text(__currency_trans_from_en(total_tax, true));
		$('span#net_return').text(__currency_trans_from_en(net_return_inc_tax, true));
	}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>