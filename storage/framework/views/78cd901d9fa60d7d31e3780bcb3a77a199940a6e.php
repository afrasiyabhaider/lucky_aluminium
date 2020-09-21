<?php $__env->startSection('title', 'Add Payment Voucher'); ?>

<?php $__env->startSection('content'); ?>
     <!-- Content Header (Page header) -->
     <section class="content-header">
          <h1>
               Add Payment Voucher
          </h1>
          <?php if($errors->any()): ?>
               <div class="alert alert-danger">
                    <ul>
                         <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <li><?php echo e($error, false); ?></li>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
               </div>
          <?php endif; ?>
     </section>
     
     <!-- Main content -->
     <section class="content no-print">
          <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
               <form action="<?php echo e(action('PaymentVoucherController@store'), false); ?>" method="post" id="payment_voucher">
                    <?php echo csrf_field(); ?>
                    <div class="form-row">
                         <div class="col-sm-6">
                              <label>Payee Name</label>
                              <input type="text" name="payee_name" placeholder="Enter Payee Name" class="form-control" required>
                         </div>
                         <div class="col-sm-6">
                              <label>Account Number</label>
                              <input type="text" name="ac_number" placeholder="Enter Account Number" class="form-control" required>
                         </div>
                    </div>
                    <div class="form-row">
                         <div class="col-sm-6">
                              <label>Checked By</label>
                              <input type="text" name="checked_by" placeholder="Enter Name of Checked By Person" class="form-control" required>
                         </div>
                    </div>
                    <div class="col-sm-12" style="margin-top: 40px">
                         <button class="btn btn-success" style="float: right;" id="plus" type="button">Add</button>
                    </div>
                    <div id="dynamic_form">
                         <div class="form-row container-item">
                              <div class="col-sm-6">
                                   <label class="col-form-label">
                                        Title
                                   </label>
                                   <input type="text" name="title[]" class="form-control" placeholder="Enter Title of Product" required>
                              </div>
                              <div class="col-sm-6">
                                   <label class="col-form-label">
                                        Amount
                                   </label>
                                   <input type="text" name="amount[]" class="form-control" placeholder="Enter Amount of Product" required>
                              </div>
                         </div>
                    </div>
                    <div id="duplicate"></div>

                    <div class="form-row">
                         <div class="col-sm-12"  style="margin-top: 20px">
                              <button type="button" class="btn btn-lg btn-primary col-sm-2" id="form-submit">
                                   <i class="fa fa-save"></i>
                                   Save
                              </button>
                         </div>
                    </div>
               </form>
          <?php echo $__env->renderComponent(); ?>
          <!-- This will be printed -->
     </section>
     <section class="invoice print_section" id="receipt_section"></section>
     <div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
     </div>

     <div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
     aria-labelledby="gridSystemModalLabel">
     </div>
          
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
     <script src="<?php echo e(asset('js/app.js'), false); ?>"></script>
     <script src="<?php echo e(asset('js/pos.js?v=' . $asset_v), false); ?>"></script>
     <script>
          function removeRow(id) {
               $(id).remove();
               console.log($(id).html());
          }
          $(function () {
               var i=0;
               $("#plus").click(function () {
                    $("#dynamic_form").clone(true);
                    i++;
                    var data = '<div class="form-row"  id="row_'+i+'"><div class="col-sm-12">'+$("#dynamic_form").html()+'<button class="btn btn-danger" style="float:right ;margin:10px 20px" type="button" onclick="removeRow(row_'+i+')">Remove</button></div></div>';
                    $("#duplicate").append(data);
               });

          });
          initialize_printer();
          /**
           * Ajax POST request 
           * 
           * */
           $('#form-submit').click(function (e) {
               $('form#payment_voucher').preventDefault;
               $.ajax({
                    method: 'POST',
                    url: "<?php echo e(url('/payment_voucher'), false); ?>",
                    data: $('form#payment_voucher').serialize(),
                    dataType: 'json',
                    success: function(result) {
                         if (result.status.success == 1) {
                              $('form#payment_voucher')[0].reset();
                              toastr.success(result.status.msg);
                              pos_print(result.status.receipt);
                         } else {
                              toastr.error(result.status.msg);
                         }
                    },
                    error: function () {
                         toastr.error("Please fill all fields with valid value");
                    }
               });
          });

          function pos_print(receipt) {
               $('#receipt_section').html(receipt.html_content);
               __currency_convert_recursively($('#receipt_section'));
               __print_receipt('receipt_section');
          }
     </script>
     <script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>