<?php $__env->startSection('title'); ?>
Dashbard || Add Permisssion
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-main'); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employee_create')): ?>
<div class="card">
    <div class="card-header">
        <h3>
            <?php if(!isset($editemployee)): ?>
            Add New Employee
            <?php else: ?>
            Edit Employee Details
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
        <form class="needs-validation" action="<?php echo e(isset($editemployee) ? route('admin.authuser.update', $editemployee->id) : route('admin.authuser.store')); ?>" method='post' enctype="multipart/form-data">
            <?php if(isset($editemployee)): ?>
            <?php echo method_field('patch'); ?>
            <?php endif; ?>
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="basic-addon-name">Name</label>

                    <input type="text" id="basic-addon-name" name='name' class="form-control" value="<?php echo e(isset($editemployee) ? $editemployee->name : ''); ?>" placeholder="Enter name" aria-label="Name" aria-describedby="basic-addon-name" required />
                </div>
                <div class="col-md-6 mb-1">
                    <label for="phone" class="form-label">Phone</label>
                    <div class="mb-3 input-group">
                        <?php
                        if(isset($editemployee)){
                        $lastTenDigits = substr($editemployee->phone, -10);
                        $remainingDigits = substr($editemployee->phone, 0, -10);
                        }
                        ?>
                        <div class="input-group-text col-2">
                            <input class="form-input " type="text" value="<?php echo e(isset($editemployee) ?  $remainingDigits : '+91'); ?>" aria-label="Checkbox for following text input" name="country_code">
                        </div>
                        <input type="number" class="form-control" id="phone" name="phone" value="<?php echo e(isset($editemployee) ?  $lastTenDigits : ''); ?>">
                    </div>
                    <!-- <label class="form-label" for="basic-addon-name">Phone</label>
                    <input type="number" id="basic-addon-name" name='phone' class="form-control" value="<?php echo e(isset($editemployee) ? $editemployee->phone : ''); ?>" placeholder="Enter Phone number" aria-label="Name" aria-describedby="basic-addon-name" required /> -->
                </div>
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="basic-addon-name">Email</label>

                    <input type="text" id="basic-addon-name" name='email' class="form-control" value="<?php echo e(isset($editemployee) ? $editemployee->email : ''); ?>" placeholder="Enter email" aria-label="email" aria-describedby="basic-addon-name" required />
                </div>
                <?php if(!isset($editemployee)): ?>
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="basic-addon-name">Password</label>
                    <input type="text" id="basic-addon-name" name='password' class="form-control" value="<?php echo e(isset($editemployee) ? $editemployee->password : ''); ?>" placeholder="Enter password" aria-label="password" aria-describedby="basic-addon-name" required />
                </div>
                <?php endif; ?>
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="desc">Role Name</label>
                    <select class="select2 form-select" id="select2-basic" name='roleid' required>
                        <?php if(isset($editemployee)): ?>
                        <option selected hidden value='<?php echo e($editemployee->roles[0]->id ?? ''); ?>'>
                            <?php echo e($editemployee->roles[0]->name ?? ''); ?>

                        </option>
                        <?php else: ?>
                        <option selected disabled value="">--Select Role--</option>
                        <?php endif; ?>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="pic">Image Thumbnail</label>
                    <input type="file" name='pic' id="pic" class="form-control " aria-label="pic" aria-describedby="pic" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"><?php echo e(isset($editemployee) ? 'Update' : 'Add'); ?></button>
                </div>
                <?php if(isset($editemployee)): ?>
                <div class="col-sm-6">
                    <img src="<?php echo e(asset($editemployee->pic)); ?>" class="bg-light-info" alt="" style="height:100px;width:100px;">
                </div>
                <?php endif; ?>
            </div>

        </form>
    </div>
</div>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employee_read')): ?>
<div class="card">
    <div class="card-header">
        <h3>Manage Employees</h3>
    </div>
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
    <div class="card-body" style="overflow-y: auto;">
        <table class="display nowrap" id="employee" style="width:100% !important;">
            <thead>
                <tr>
                    <th>Sr.No</th>

                    <th>Image</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>

                </tr>

            </thead>
            <tbody>
                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->index + 1); ?></td>

                    <td>
                        <img src="<?php echo e(asset($employee->pic)); ?>" class="me-75 bg-light-danger" style="height:60px;width:60px;" />
                    </td>
                    <td><?php echo e($employee->name); ?></td>
                    <td><?php echo e($employee->phone); ?></td>
                    <td><?php echo e($employee->email); ?></td>
                    <td><?php echo e($employee->roles[0]->name ?? ''); ?></td>


                    <td>
                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                            <div class="mb-1 breadcrumb-right">
                                <div class="dropdown">
                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <?php $eid=Crypt::encrypt($employee->id); ?>
                                        <?php if(Auth::user()->roles[0]->name == 'superadmin'): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('admin.loginUsingId', $eid)); ?>"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Login As</span>
                                        </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employee_edit')): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('admin.authuser.edit', $eid)); ?>"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Edit</span>
                                        </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employee_delete')): ?>
                                        <a class="dropdown-item" href="" onclick="event.preventDefault();document.getElementById('delete-form-<?php echo e($eid); ?>').submit();"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Delete</span>
                                        </a>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <form id="delete-form-<?php echo e($eid); ?>" action="<?php echo e(route('admin.authuser.destroy', $eid)); ?>" method="post" style="display: none;">
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
<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Theallsif-astro\resources\views/admin/employee.blade.php ENDPATH**/ ?>