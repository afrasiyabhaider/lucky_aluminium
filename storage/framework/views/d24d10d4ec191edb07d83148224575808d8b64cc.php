
     <style>
          *{
               font-family: Arial,'Times New Roman',serif;
          }
     </style>
<table style="width:100%;">
     <thead>
          <tr>
               <td>
                    <h2 class="text-center">
                         <?php echo e($business_details['name'], false); ?>

                    </h2>
                    <h3 class="text-center">
                         Payment Voucher
                    </h3>

               </td>
          </tr>
     </thead>

     <tbody class="text-center">
          <tr>
               <td>

                    <!-- business information here -->
                    <div class="row invoice-info">

                         <div class="col-md-12 invoice-col width-100">

                              <h4 class="text-center">
                                   Ref No: <?php echo e($voucher->voucher_number, false); ?>

                              </h4>
                              <p class="text-center">
                                   TIN: <?php echo e($business_details['tax_number_1'], false); ?>

                              </p>
                              <!-- Date-->
                              <p class="text-center">
                                   <span>
                                        Date: 
                                        <?php echo e(Carbon\Carbon::now()->format('d-M-Y H:i A'), false); ?>

                                   </span>
                              </p>
                              <h5 class="text-left">
                                   Payee: <?php echo e($voucher->payee_name,'..............', false); ?>

                              </h5>
                              <h5 class="text-left">
                                   A/C: <?php echo e($voucher->ac_no,'..............', false); ?>

                              </h5>
                         </div>
                    </div>


                    <div class="row color-555">
                         <div class="col-xs-12">
                              <br/>
                              <table class="table table-bordered text-center">
                                   <thead>
                                        <tr>
                                             <th width="10%">
                                                  Sr#
                                             </th>
                                             <th>
                                                  Title
                                             </th>
                                             <th>
                                                  Amount
                                             </th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $__currentLoopData = $voucher->voucher_data()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <tr>
                                                  <td>
                                                       <?php echo e($loop->iteration, false); ?>

                                                  </td>
                                                  <td class="text-center">
                                                       <?php echo e($data->title, false); ?>

                                                  </td>
                                                  <td class="text-center">
                                                       <?php echo e($num = number_format($data->amount,2,$business_details['decimal_separator'],$business_details['thousand_separator']), false); ?>

                                                       <?php echo e($business_details['currency_symbol'], false); ?>

                                                  </td>
                                             </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <tfoot>
                                             <tr class="bg-light">
                                                  <th colspan="2">
                                                       Total
                                                  </th>
                                                  <th>
                                                       <?php
                                                           $num = number_format($voucher->total_amount,2,$business_details['decimal_separator'],$business_details['thousand_separator']);
                                                       ?>
                                                       <?php echo e($num, false); ?>

                                                       <?php echo e($business_details['currency_symbol'], false); ?>

                                                  </th>
                                             </tr>
                                        </tfoot>

                                   </tbody>
                              </table>
                         </div>
                    </div>

                    <div class="row invoice-info color-555" style="page-break-inside: avoid !important">
                         <div class="col-md-6 invoice-col width-50">
                              <b class="pull-left">Prepared By: <?php echo e(Auth::user()['first_name'], false); ?> <?php echo e(Auth::user()['last_name'], false); ?></b>
                              <br>
                              <br>
                              <b class="pull-left">___________________</b>
                              
                         </div>
                         <div class="col-md-6 invoice-col width-50">
                              <b class="pull-left" style="margin-left: 10px">Received By: <?php echo e($voucher->checked_by, false); ?></b>
                              <br>
                              <br>
                              <b class="pull-left">___________________</b>
                              <br>
                         </div>
                    </div>

                    <br>

               </td>
          </tr>
     </tbody>
</table>