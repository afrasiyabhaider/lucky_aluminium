<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => url('/contacts/make/withdraw', [$contact->id]), 'method' => 'POST', 'id' => 'contact_edit_form']); ?>


    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Withdraw From Account</h4>
    </div>

    <div class="modal-body">
            <div class="form-group">
                <strong><?php echo app('translator')->getFromJson('account.selected_account'); ?></strong>: 
                <?php echo e($contact->name, false); ?>

                <?php echo Form::hidden('contact_id', $contact->id); ?>

            </div>

            <div class="form-group">
                <?php echo Form::label('amount', "Amount" .":*"); ?>

                <?php echo Form::text('amount', 0, ['class' => 'form-control input_number', 'required','placeholder' => 'Amount' ]);; ?>

            </div>
            <div class="form-group">
            <?php echo Form::label('location_id', __( 'lang_v1.location_id' ) . ':'); ?>

              <?php echo Form::select('location_id', $locations, null, ['class' => 'form-control']);; ?>

              
          </div>
            <div class="form-group">
                <?php echo Form::label('operation_date', __( 'messages.date' ) .":*"); ?>

                <div class="input-group date" id='od_datetimepicker'>
                  <?php echo Form::text('date', 0, ['class' => 'form-control', 'required','placeholder' => __( 'messages.date' ) ]);; ?>

                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
            </div>

            <div class="form-group">
                <?php echo Form::label('note', __( 'brand.note' )); ?>

                <?php echo Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => __( 'brand.note' ), 'rows' => 4]);; ?>

            </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Withdraw</button>
      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->getFromJson( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script type="text/javascript">
  $(document).ready( function(){
    $('#od_datetimepicker').datetimepicker({
      format: moment_date_format + ' ' + moment_time_format
    });
  });
</script>