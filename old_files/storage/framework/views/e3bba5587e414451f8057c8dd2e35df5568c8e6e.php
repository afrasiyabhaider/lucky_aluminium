<?php $__env->startSection('title', __( 'report.deposits' )); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->getFromJson( 'report.deposits' ); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="print_section"><h2><?php echo e(session()->get('business.name'), false); ?> - <?php echo app('translator')->getFromJson( 'report.deposits' ); ?></h2></div>
    
    <div class="row no-print">
         
        
    </div>
    

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="deposits_withdraws_report">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Amount</th>
                            <th>Ref No</th>
                            <th>Payment Method</th>
                            <th>Others</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(date('d-M-Y H:i', strtotime($transaction->transaction_date)), false); ?></td>
                                <td><?php echo e(ucwords($transaction->contact->name), false); ?></td>
                                <td><?php echo e(ucfirst($transaction->type), false); ?></td>
                                <td><?php echo e($transaction->location->name, false); ?></td>
                                <td><?php echo e(number_format($transaction->final_total, 2), false); ?></td>
                                <td><?php echo e($transaction->ref_no, false); ?></td>
                                <td><?php echo e('Cash', false); ?></td>
                                <td><?php echo e($transaction->additional_notes, false); ?></td>
                               
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    
                </table>
              <span class="no-print"><?php echo e($data->links(), false); ?></span> 

            </div>
            <button class="btn btn-primary pull-right no-print" onclick="window.print()"> <i class="fa fa-print"></i> Print</button>
             
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>