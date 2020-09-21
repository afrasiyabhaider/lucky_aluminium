<?php $__env->startSection('title', 'Payment Voucher'); ?>

<?php $__env->startSection('content'); ?>
     <!-- Content Header (Page header) -->
     <section class="content-header">
          <h1>
               Payment Vouchers
          </h1>
     </section>
     
     <!-- Main content -->
     <section class="content no-print">
          <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
               <div class="table-responsive">
                    <table  class="table table-bordered table-striped ajax_view" id="payment_voucher_table">
                         <thead>
                              <tr>
                                   <tr>
                                        <th>Action</th>
                                        <th>No of Items</th>
                                        <th>Payee Name</th>
                                        <th>Checked By</th>
                                        <th>Account Number</th>
                                        <th>Voucher Number</th>
                                        <th>Prepared by</th>
                                        <th>Amount</th>
                                        <th>Date Prepared</th>
                                   </tr>
                              </tr>
                         </thead>
                    </table>
               </div>
          <?php echo $__env->renderComponent(); ?>
          <!-- This will be printed -->
     </section>
     <div class="modal fade payment_modal" tabindex="-1" role="dialog" 
     aria-labelledby="gridSystemModalLabel">
 </div>
 
 <div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
     aria-labelledby="gridSystemModalLabel">
 </div>
 
 <!-- This will be printed -->
 <section class="invoice print_section" id="receipt_section">
 </section>
          
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
     <script src="<?php echo e(asset('js/app.js'), false); ?>"></script>
     <script src="<?php echo e(asset('js/pos.js?v=' . $asset_v), false); ?>"></script>
     <script>
          payment_voucher_table = $('#payment_voucher_table').DataTable({
               processing: true,
               serverSide: true,
               "ajax": {
                    "url": "<?php echo e(url('/payment_voucher'), false); ?>",
               },
               columns: [
                    { data: 'action', name: 'action', orderable: false, "searchable": false},
                    { data: 'no_of_items', name: 'no_of_items'},
                    { data: 'payee_name', name: 'payee_name'},
                    { data: 'checked_by', name: 'checked_by'},
                    { data: 'ac_no', name: 'ac_no'},
                    { data: 'voucher_number', name: 'voucher_number'},
                    { data: 'user_id', name: 'user_id'},
                    { data: 'total_amount', name: 'total_amount'},
                    { data: 'created_at', name: 'created_at'},
               ]
          });
          initialize_printer();
          function printThis(id) {
               id = $(id).prop('id');
               url = '<?php echo e(url("/"), false); ?>';
               $.ajax({
                    method: 'GET',
                    url: url+'/payment_voucher/'+id+'/slip',
                    dataType: 'json',
                    success: function(result) {
                         if (result.success == 1) {
                              pos_print(result);
                         } else {
                              toastr.error(result.msg);
                         }
                    },
               });
          }
          function pos_print(receipt) {
               $('#receipt_section').html(receipt.html_content);
               __currency_convert_recursively($('#receipt_section'));
               __print_receipt('receipt_section');
          }
     </script>
     <script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>