
<?php $__env->startSection('title'); ?>
Dashbard || Edit Team
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-main'); ?>
<div class="card">
    <div class="card-header border-bottom">
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


        <div class="card-title">
            <form action="<?php echo e(route('admin.teamUpdate',$edit->id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo e($edit->name ?? ''); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="designation" name="designation" value="<?php echo e($edit->designation ?? ''); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="<?php echo e($edit->teamimages->first()->img); ?>" alt="" srcset="" height="50px" width="50px">
                                </div>
                                <div class="col-md-11">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="introduction" class="form-label">Introduction</label>
                                <textarea type="text" class="form-control" id="introduction" name="introduction"><?php echo $edit->introduction ??''; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>

        <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
        </div>
    </div>


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('team_read')): ?>
    <div class="card-datatable table-responsive">
        <table class="datatables table border-top">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Introduction</th>
                    <th>Is Active</th>
                    <th>Actions</th>
                </tr>
            </thead>

        </table>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?php echo route('admin.teams'); ?>",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'imagemedia',
                    name: 'imagemedia   '
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'designation',
                    name: 'designation',
                },
                {
                    data: 'introduction',
                    name: 'introduction',
                },
                {
                    data: 'is_active',
                    name: 'is_active',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },

            ]
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('change', '.is_active', function() {
            var statusId = $(this).data('id');
            var isActive = $(this).is(':checked');
            var newurl = "<?php echo e(url('/admin/team-status')); ?>/" + statusId;
            $.ajax({
                // url: '/admin/is_active/' + statusId,
                url: newurl,
                type: 'get',
                success: function(response) {
                    location.reload();
                },
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#exampleModal').on('shown.bs.modal', function() {
            $('#select2success').select2({
                dropdownParent: $('#exampleModal')
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#exampleModal').on('shown.bs.modal', function() {
            $('#select2pr').select2({
                dropdownParent: $('#exampleModal')
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Theallsif-astro\resources\views/admin/team/team_edit.blade.php ENDPATH**/ ?>