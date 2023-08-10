<?php $__env->startSection('title'); ?>
Dashbard || Customer
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
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer_read')): ?>
    <div class="card-datatable table-responsive">
        <table class="datatables table border-top">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Image</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <?php if($role !== 'intern'): ?>
                    <th>Phone </th>
                    <?php endif; ?>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
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
            ajax: "<?php echo route('admin.customers'); ?>",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'image',
                    name: 'image',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        var imagePath = "<?php echo e('https://8bittask.com/astrologynew/public/images/'); ?>" + '/' + data;
                        return '<div class="avatar me-2"><img src="' + imagePath + '" alt="Avatar" class="rounded-circle" /></div>';
                    }
                },
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {

                    data: 'email',
                    name: 'email'
                },
                // {
                //     data: 'phone',
                //     name: 'phone'
                // },
                <?php if($role !== 'intern'): ?> {
                    data: 'phone',
                    name: 'phone'
                },
                <?php endif; ?> {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'state',
                    name: 'state'
                },
                {
                    data: 'country',
                    name: 'country'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },

                // Add more column definitions here
            ]
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Theallsif-astro\resources\views/admin/customer.blade.php ENDPATH**/ ?>