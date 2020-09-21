<?php $__env->startSection('title', 'Transaction'); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Transaction
    </h1>
</section>

<section class="content">

    <div class="box box-solid">
        <div class="box-header print_section">
            <h3 class="box-title"><?php echo e(session()->get('business.name'), false); ?></span></h3>
        </div>
        <div class="box-body">
            <table class="table table-border-center no-border table-pl-12">
                <thead>
                    <tr class="bg-gray">
                        <th colspan="2">Transaction</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Business</b></td>
                        <td><?php echo e($transaction->business->name, false); ?></td>
                    </tr>
                    <tr>
                        <td><b>Location</b></td>
                        <td><?php echo e($transaction->location->name, false); ?></td>
                    </tr>
                    <tr>
                        <td><b>Transaction Type</b></td>
                        <td><?php echo e(ucwords($transaction->type), false); ?></td>
                    </tr>
                    <tr>
                        <td><b>Contact</b></td>
                        <td><?php echo e($transaction->contact->name, false); ?></td>
                    </tr>
                    <tr>
                        <td><b>Invoice No.</b></td>
                        <td><?php echo e($transaction->ref_no, false); ?></td>
                    </tr>
                    <tr>
                        <td><b>Payment Type</b></td>
                        <td><?php echo e("Cash", false); ?></td>
                    </tr>
                    <tr>
                        <td><b>Amount</b></td>
                        <td><?php echo e(number_format($transaction->final_total, 2), false); ?></td>
                    </tr>
                    <tr>
                        <td><b>Transaction Date</b></td>
                        <td><?php echo e(date('d-M-Y H:i', strtotime($transaction->transaction_date)), false); ?></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-primary no-print pull-right"onclick="window.print()">
          <i class="fa fa-print"></i> <?php echo app('translator')->getFromJson('messages.print'); ?></button>
        </div>
    </div>
    

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>