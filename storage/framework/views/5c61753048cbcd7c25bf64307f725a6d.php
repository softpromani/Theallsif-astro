<?php $__env->startSection('title'); ?>
Dashbard || Add Permisssion
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-main'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_create')): ?>
<div class="card">
    <div class="card-header">
        <h3>
            <?php if(!isset($editpermission)): ?>
            Add New Permission
            <?php else: ?>
            Update Permission
            <?php endif; ?>
        </h3>

    </div>
    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
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
    <div class="card-body">
        <form class="needs-validation" action="<?php echo e(route('admin.permission.store')); ?>" method='post' enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="basic-addon-name">Permission Name</label>

                    <input type="text" id="basic-addon-name" name='name' class="form-control" value="<?php echo e(isset($editpermission) ? $editpermission->name : ''); ?>" placeholder="Permission Name" aria-label="Name" aria-describedby="basic-addon-name" required />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"><?php echo e(isset($editpermission) ? 'Update' : 'Add'); ?></button>
                </div>
            </div>

        </form>
    </div>
</div>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_read')): ?>
<div class="card">
    <div class="card-header">
        <h3>Manage Permissions</h3>
    </div>
    <div class="card-body">
        <table class="datatables-basic table datatable table-responsive">

            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->index + 1); ?></td>
                    <td><?php echo e($permission->name); ?></td>
                    <td><?php echo e($permission->created_at); ?></td>
                    <td>
                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                            <div class="mb-1 breadcrumb-right">
                                <div class="dropdown">
                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <?php $cid=Crypt::encrypt($permission->id); ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_edit')): ?>
                                        <a class="dropdown-item" href="#"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Edit</span></a>
                                        <?php endif; ?>
                                        <!-- onclick="event.preventDefault();document.getElementById('delete-form-<?php echo e($cid); ?>').submit();" -->
                                        <!-- <?php echo e(route('admin.permission.edit', $cid)); ?> -->
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_delete')): ?>
                                        <a class="dropdown-item" href=""><i class="me-1" data-feather="message-square"></i><span class="align-middle">Delete</span></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <form id="delete-form-<?php echo e($cid); ?>" action="<?php echo e(route('admin.permission.destroy', $cid)); ?>" method="post" style="display: none;">
                    <?php echo method_field('DELETE'); ?>
                    <?php echo csrf_field(); ?>
                </form>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                

            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Theallsif-astro\resources\views/admin/permission.blade.php ENDPATH**/ ?>