<?php $__env->startSection('title'); ?>
Dashbard || Add Role
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-main'); ?>
<div class="row">
    <?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>
    <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!--begin::Col-->
    <div class="col-md-6" style="<?php if(count($role) < 4): ?> style='width:400px !important' <?php endif; ?>">
        <!--begin::Card-->
        <div class="card card-flush h-md-100" style="<?php if(count($role) < 4): ?> style='width:400px !important' <?php endif; ?>">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <?php
                    $id=Crypt::encrypt($rl->id);
                    ?>
                    <div class="row">
                        <div class="col-sm-10 float-left">
                            <h2><?php echo e($rl->name); ?></h2>
                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('assign_permission_edit')): ?>
                        <div class="col-sm-2 float-right">
                            <a class="btn btn-info" href="<?php echo e(route('admin.permission.edit', $id)); ?>">Edit</a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="pt-1 card-body">
                <!--begin::Users-->
                <div class="mb-1 text-gray-600 fw-bolder">Total users with this role:
                    <?php echo e($rl->users_count); ?>

                </div>
                <!--end::Users-->
                <!--begin::Permissions-->
                <ul class="list-group list-group-flush">
                    <?php
                    $i = 0;
                    $c = count($rl->permissions);
                    ?>
                    <?php $__currentLoopData = $rl->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $per): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($i > 4): ?>
                    <?php
                    $id = Crypt::encrypt($rl->id);
                    ?>
                    <li class="list-group-item">
                        <span class='me-1'></span>
                        <a class="btn btn-primary" style="float: right;" href="<?php echo e(route('admin.viewRole', $id)); ?>"><em><?php echo e($c); ?>

                                More...</em></a>
                    </li>
                    <?php break; ?>
                    <?php else: ?>
                    <li class="list-group-item">
                        <span class='bullet bg-primary me-1'></span>
                        <?php echo e($per->name); ?>

                    </li>
                    <?php endif; ?>
                    <?php $i++; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <!--end::Permissions-->
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->

            <!--end::Card footer-->
        </div>
        <!--end::Card-->
    </div>

    <!--end::Col-->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Theallsif-astro\resources\views/admin/role_has_permission.blade.php ENDPATH**/ ?>