<?php if(!empty($notifications_data)): ?>
  <?php $__currentLoopData = $notifications_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="<?php if(empty($notification_data['read_at'])): ?> bg-aqua-lite <?php endif; ?>">
      <a href="<?php echo e($notification_data['link'] ?? '#', false); ?>">
        <i class="<?php echo e($notification_data['icon_class'] ?? '', false); ?>"></i> <?php echo $notification_data['msg'] ?? ''; ?> <br>
        <small><?php echo e($notification_data['created_at'], false); ?></small>
      </a>
    </li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
  <li class="text-center no-notification">
    <?php echo app('translator')->getFromJson('lang_v1.no_notifications_found'); ?>
  </li>
<?php endif; ?>