
<?php $__env->startSection('title', __('expense.edit_expense')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->getFromJson('expense.edit_expense'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
  <?php echo Form::open(['url' => action('ExpenseController@update', [$expense->id]), 'method' => 'PUT', 'id' => 'add_expense_form', 'files' => true ]); ?>

  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

            <?php echo Form::select('location_id', $business_locations, $expense->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']);; ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::label('expense_category_id', __('expense.expense_category').':'); ?>

            <?php echo Form::select('expense_category_id', $expense_categories, $expense->expense_category_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]);; ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::label('ref_no', __('purchase.ref_no').':*'); ?>

            <?php echo Form::text('ref_no', $expense->ref_no, ['class' => 'form-control', 'required']);; ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::label('transaction_date', __('messages.date') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </span>
              <?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime($expense->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required', 'id' => 'expense_transaction_date']);; ?>

            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::label('expense_for', __('expense.expense_for').':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('tooltip.expense_for') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
            <?php echo Form::select('expense_for', $users, $expense->expense_for, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]);; ?>

          </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <?php echo Form::label('document', __('purchase.attach_document') . ':'); ?>

                <?php echo Form::file('document', ['id' => 'upload_document']);; ?>

                <p class="help-block"><?php echo app('translator')->getFromJson('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]); ?></p>
            </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::label('additional_notes', __('expense.expense_note') . ':'); ?>

                <?php echo Form::textarea('additional_notes', $expense->additional_notes, ['class' => 'form-control', 'rows' => 3]);; ?>

          </div>
        </div>
        <div class="clearfix"></div>
          <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label('tax_id', __('product.applicable_tax') . ':' ); ?>

                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <?php echo Form::select('tax_id', $taxes['tax_rates'], $expense->tax_id, ['class' => 'form-control'], $taxes['attributes']);; ?>


            <input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" 
            value="0">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::label('final_total', __('sale.total_amount') . ':*'); ?>

            <?php echo Form::text('final_total', number_format($expense->final_total, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'placeholder' => __('sale.total_amount'), 'required']);; ?>

          </div>
        </div>

        <div class="col-sm-12">
          <button type="submit" class="btn btn-primary pull-right"><?php echo app('translator')->getFromJson('messages.update'); ?></button>
        </div>
      </div>
    </div>
  </div> <!--box end-->

<?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>