<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="spacer"></div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary no-print pull-right"
                 aria-label="Print" onclick="$('#invoice_content').printThis();"><i class="fa fa-print"></i> <?php echo app('translator')->getFromJson( 'messages.print' ); ?>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-12" style="border: 1px solid #ccc;">
            <div class="spacer"></div>
            <div id="invoice_content">
                <?php echo $receipt['html_content']; ?>

            </div>
            <div class="spacer"></div>
        </div>
    </div>
    <div class="spacer"></div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>