<?php $__env->startSection('title'); ?>
Dashbard || User Permission
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-main'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('assign_permission_create')): ?>
<div class="col-12">
    <div class="card">
        <div class="card-header ">
            <h6 class="border-bottom py-1 mb-0 font-medium-2">
                <?php echo e(isset($editpermission) ? 'Edit Permission' : 'Assign Permission'); ?>

            </h6>
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
            <form class="needs-validation" action="<?php echo e(route('admin.assignPermission')); ?>" method='post' enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="desc">Role Name</label>
                    <select class="select2 form-select" id="roleid" name='roleid' required>

                        <option selected disabled value="">--Select Role--</option>

                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e(!isset($editrole) ? '' : ($editrole->id == $role->id ? 'selected' : '')); ?> value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="card-body px-75">
                    <div class="table-responsive users-view-permission">
                        <table class="table table-borderless">

                            <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Menu</th>
                                    <th>Read</th>
                                    <th>Create</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $per): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($per->name); ?></td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox2" class="custom-control-input" name="permissionckbx[]" value="<?php echo e($per->name); ?>" <?php echo e(!isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name) ? 'checked' : '')); ?>>
                                            <label class="custom-control-label" for="users-checkbox2"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox2" class="custom-control-input" name="permissionckbx[]" value="<?php echo e($per->name . '_read'); ?>" <?php echo e($per->name); ?>" <?php echo e($per->name); ?>" <?php echo e(!isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name . '_read') ? 'checked' : '')); ?>><label class="custom-control-label" for="users-checkbox2"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox3" name="permissionckbx[]" class="custom-control-input" value="<?php echo e($per->name . '_create'); ?>" <?php echo e($per->name . '_create'); ?>" <?php echo e($per->name); ?>" <?php echo e($per->name); ?>" <?php echo e(!isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name . '_create') ? 'checked' : '')); ?>><label class="custom-control-label" for="users-checkbox3"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox1" class="custom-control-input" name="permissionckbx[]" value="<?php echo e($per->name . '_edit'); ?>" <?php echo e(!isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name . '_edit') ? 'checked' : '')); ?>>
                                            <label class="custom-control-label" for="users-checkbox1"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox1" class="custom-control-input" name="permissionckbx[]" value="<?php echo e($per->name . '_delete'); ?>" <?php echo e(!isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name . '_delete') ? 'checked' : '')); ?>>
                                            <label class="custom-control-label" for="users-checkbox1"></label>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
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
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).on('change', '#roleid', function() {
        window.location.href = "<?php echo e(url('admin/user-permission')); ?>/" + $(this).val();
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Theallsif-astro\resources\views/admin/user_permission.blade.php ENDPATH**/ ?>