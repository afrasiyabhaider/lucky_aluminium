<table class="table table-striped" id="ledger_table">
	<thead>
		<tr>
			<th><?php echo app('translator')->getFromJson('lang_v1.date'); ?></th>
			<th><?php echo app('translator')->getFromJson('purchase.ref_no'); ?></th>
			<th><?php echo app('translator')->getFromJson('lang_v1.type'); ?></th>
			<th><?php echo app('translator')->getFromJson('sale.location'); ?></th>
			<th><?php echo app('translator')->getFromJson('sale.payment_status'); ?></th>
			<th><?php echo app('translator')->getFromJson('sale.total'); ?></th>
			<th><?php echo app('translator')->getFromJson('account.debit'); ?></th>
			<th><?php echo app('translator')->getFromJson('account.credit'); ?></th>
			<th><?php echo app('translator')->getFromJson('lang_v1.payment_method'); ?></th>
			<th><?php echo app('translator')->getFromJson('report.others'); ?></th>
			<th style="width:110px">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $__currentLoopData = $ledger; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e(\Carbon::createFromTimestamp(strtotime($data['date']))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?></td>
				<td><?php echo e($data['ref_no'], false); ?></td>
				<td><?php echo e($data['type'], false); ?></td>
				<td><?php echo e($data['location'], false); ?></td>
				<td><?php echo e($data['payment_status'], false); ?></td>
				<td><?php if($data['total'] != ''): ?> <span class="display_currency" data-currency_symbol="true"><?php echo e($data['total'], false); ?></span> <?php endif; ?></td>
				<td><?php if($data['debit'] != ''): ?> <span class="display_currency" data-currency_symbol="true"><?php echo e($data['debit'], false); ?></span> <?php endif; ?></td>
				<td><?php if($data['credit'] != ''): ?> <span class="display_currency" data-currency_symbol="true"><?php echo e($data['credit'], false); ?></span> <?php endif; ?></td>
				<td><?php echo e($data['payment_method'], false); ?></td>
				<td><?php echo $data['others']; ?></td>
				<td>
					<?php if(in_array($data['type'], ['Withdraw', 'Deposit'])): ?>
					<?php $id = $data['id']; ?>
					<a href="<?php echo e(url('contacts/transaction',[$id]), false); ?>" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> <?php echo app('translator')->getFromJson("messages.edit"); ?></a>
					<a href="<?php echo e(url('contacts/transaction/print',[$id]), false); ?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-print"></i> <?php echo app('translator')->getFromJson("messages.print"); ?></a>
						
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>