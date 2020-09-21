<?php $__env->startSection('title', __( 'lang_v1.subscriptions')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo app('translator')->getFromJson( 'lang_v1.subscriptions'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.recurring_invoice_help') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
	<div class="box">
        <div class="box-header">
        	<!-- <h3 class="box-title"></h3> -->
        </div>
        <div class="box-body">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sell.view')): ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="input-group">
                              <button type="button" class="btn btn-primary" id="sell_date_filter">
                                <span>
                                  <i class="fa fa-calendar"></i> <?php echo e(__('messages.filter_by_date'), false); ?>

                                </span>
                                <i class="fa fa-caret-down"></i>
                              </button>
                            </div>
                          </div>
                    </div>
                </div>
                <div class="table-responsive">
            	<table class="table table-bordered table-striped" id="sell_table">
            		<thead>
            			<tr>
            				<th><?php echo app('translator')->getFromJson('messages.date'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang_v1.subscription_no'); ?></th>
    						<th><?php echo app('translator')->getFromJson('sale.customer_name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('sale.location'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang_v1.subscription_interval'); ?></th>
    						<th><?php echo app('translator')->getFromJson('lang_v1.no_of_repetitions'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang_v1.generated_invoices'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang_v1.last_generated'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang_v1.upcoming_invoice'); ?></th>
    						<th><?php echo app('translator')->getFromJson('messages.action'); ?></th>
            			</tr>
            		</thead>
            	</table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready( function(){
    //Date range as a button
    $('#sell_date_filter').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#sell_date_filter span').html(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            sell_table.ajax.reload();
        }
    );
    $('#sell_date_filter').on('cancel.daterangepicker', function(ev, picker) {
        $('#sell_date_filter').html('<i class="fa fa-calendar"></i> <?php echo e(__("messages.filter_by_date"), false); ?>');
        sell_table.ajax.reload();
    });
    
    sell_table = $('#sell_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[0, 'desc']], 
        "ajax": {
            "url": "/sells/subscriptions",
            "data": function ( d ) {
                var start = $('#sell_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                var end = $('#sell_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                d.start_date = start;
                d.end_date = end;
            }
        },
        columnDefs: [ {
            "targets": 9,
            "orderable": false,
            "searchable": false
        } ],
        columns: [
            { data: 'transaction_date', name: 'transaction_date'  },
            { data: 'subscription_no', name: 'subscription_no'},
            { data: 'name', name: 'contacts.name'},
            { data: 'business_location', name: 'bl.name'},
            { data: 'recur_interval', name: 'recur_interval'},
            { data: 'recur_repetitions', name: 'recur_repetitions'},
            { data: 'subscription_invoices', searchable: false, orderable: false},
            { data: 'last_generated', searchable: false, orderable: false},
            { data: 'upcoming_invoice', searchable: false, orderable: false},
            { data: 'action', name: 'action'}
        ],
        "fnDrawCallback": function (oSettings) {
            __currency_convert_recursively($('#sell_table'));
        }
    });
});

$(document).on( 'click', 'a.toggle_recurring_invoice', function(e){
    e.preventDefault();
    $.ajax({
        method: "GET",
        url: $(this).attr('href'),
        dataType: "json",
        success: function(data){
            if(data.success == true){   
                toastr.success(data.msg);
                sell_table.ajax.reload();
            } else {
                toastr.error(data.msg);
            }
        }
    });
});

</script>
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>