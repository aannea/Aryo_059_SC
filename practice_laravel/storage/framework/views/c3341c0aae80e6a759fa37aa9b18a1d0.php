<?php $__env->startSection('title', 'Create Student'); ?>

<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('admin_layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('leftbar'); ?>
    <?php echo $__env->make('admin_layout.leftbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('rightbar'); ?>
    <?php echo $__env->make('admin_layout.rightbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('student.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\VSCodeProjects\Kampus\sem5\21102059-sc1-pw2324\practice_laravel\resources\views/adminlte/create.blade.php ENDPATH**/ ?>