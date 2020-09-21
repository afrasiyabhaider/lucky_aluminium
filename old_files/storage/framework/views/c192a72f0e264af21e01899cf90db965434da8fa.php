<?php $__env->startSection('title', "Edit Transaction"); ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css?v='.$asset_v), false); ?>">

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Transaction
        <small>Edit transaction</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
      <?php echo Form::open(['url' => url('/contacts/transaction/save'), 'method' => 'POST']); ?>

      <div class="col-md-12">
        <div class="form-group">
          <strong><?php echo app('translator')->getFromJson('account.selected_account'); ?></strong>: 
            <?php echo e($transaction->contact->name, false); ?>

            <?php echo Form::hidden('transaction_id', $transaction->id); ?>

          </div>
          <div class="form-group">
            <?php echo Form::label('amount', "Amount" .":*"); ?>

            <?php echo Form::text('amount', $transaction->final_total, ['class' => 'form-control input_number', 'required','placeholder' => 'Amount' ]);; ?>

          </div>
          <button type="submit" class="btn btn-primary">Update</button>
      </div>
      <?php echo Form::close(); ?>

      
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>