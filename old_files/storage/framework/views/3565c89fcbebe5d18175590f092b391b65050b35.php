<?php
  $id = 'modifier_' . $row_count . '_' . time();
?>
<div>
  <span class="selected_modifiers">
    <?php if(!empty($edit_modifiers) && !empty($product->modifiers) ): ?>
      <?php echo $__env->make('restaurant.product_modifier_set.add_selected_modifiers', array('index' => $row_count, 'modifiers' => $product->modifiers ) , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
  </span>&nbsp;  
  <i class="fa fa-external-link-square cursor-pointer text-primary select-modifiers-btn" title="<?php echo app('translator')->getFromJson('restaurant.modifiers_for_product'); ?>" data-toggle="modal" data-target="#<?php echo e($id, false); ?>"></i>
</div>
<div class="modal fade modifier_modal" id="<?php echo e($id, false); ?>" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
  <div class="modal-content">

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->getFromJson( 'restaurant.modifiers_for_product' ); ?>: <span class="text-success"></span>
      </h4>
    </div>

    <div class="modal-body">
      <?php if(!empty($product_ms)): ?>
        <div class="panel-group" id="accordion<?php echo e($id, false); ?>" role="tablist" aria-multiselectable="true">

      <?php $__currentLoopData = $product_ms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier_set): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $collapse_id = 'collapse'. $modifier_set->id . $id;
        ?>

        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
              <a role="button" data-toggle="collapse" data-parent="#accordion<?php echo e($id, false); ?>" 
                href="#<?php echo e($collapse_id, false); ?>" 
                aria-expanded="true" aria-controls="collapseOne">
                <?php echo e($modifier_set->name, false); ?>

              </a>
            </h4>
          </div>
          <input type="hidden" class="modifiers_exist" value="true">
          <input type="hidden" class="index" value="<?php echo e($row_count, false); ?>">

          <div id="<?php echo e($collapse_id, false); ?>" class="panel-collapse collapse <?php if($loop->index==0): ?> in <?php endif; ?>" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
              <div class="btn-group" data-toggle="buttons">
                <?php $__currentLoopData = $modifier_set->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <label class="btn btn-primary <?php if(!empty($edit_modifiers) && in_array($modifier->id, $product->modifiers_ids) ): ?> active <?php endif; ?>">
                    <input type="checkbox" autocomplete="off" 
                      value="<?php echo e($modifier->id, false); ?>" <?php if(!empty($edit_modifiers) && in_array($modifier->id, $product->modifiers_ids) ): ?> checked <?php endif; ?>> 
                      <?php echo e($modifier->name, false); ?>

                  </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
        </div>
          
        
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
      <?php endif; ?>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-primary add_modifier" data-dismiss="modal">
        <?php echo app('translator')->getFromJson( 'messages.add' ); ?></button>
      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->getFromJson( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
if( typeof $ !== 'undefined'){
  $(document).ready(function(){
    $('div#<?php echo e($id, false); ?>').modal('show');
  });
}
</script>