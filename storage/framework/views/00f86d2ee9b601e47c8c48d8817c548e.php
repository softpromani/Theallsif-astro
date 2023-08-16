<?php $__env->startSection('title'); ?>
Dashbard || Add Astrologer
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

		<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('astrologer_create')): ?>
		<div class="card-title mb-3">
			<div class="row">
				<div class="col-md-4">
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
						Add
					</button>
				</div>
				<?php
				$role=Auth::user()->roles[0]->name;
				?>
				<?php if($role =='superadmin'): ?>
				<!-- <div class="col-md-4">
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
						Import
					</button>
				</div> -->
				<div class="col-md-4">
					<a href="<?php echo e(route('admin.exportAstrologer')); ?>" class="btn btn-primary">
						Export
					</a>
				</div>
				<?php endif; ?>

			</div>
		</div>
		<?php endif; ?>
		<div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
			<div class="col-md-4 user_role"></div>
			<div class="col-md-4 user_plan"></div>
			<div class="col-md-4 user_status"></div>
		</div>
	</div>

	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('astrologer_read')): ?>
	<div class="card-datatable table-responsive">
		<table class="datatables table border-top">
			<thead>
				<tr>
					<th>Sr. No.</th>
					<th>Image</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>City</th>
					<th>State</th>
					<th>Country</th>
					<th>Experties</th>
					<th>Language</th>
					<th>Description</th>
					<th>Experience</th>
					<th>Education</th>
					<th>Is Active</th>
					<th>Actions</th>
				</tr>
			</thead>

		</table>

	</div>
	<?php endif; ?>

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Astrologer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?php echo e(route('admin.astrologer.store')); ?>" method="post" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="first_name" class="form-label">First Name</label>
								<input type="test" class="form-control" id="first_name" name="first_name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="last_name" class="form-label">Last Name</label>
								<input type="test" class="form-control" id="last_name" name="last_name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="father_name" class="form-label">Father Name</label>
								<input type="text" class="form-control" id="father_name" name="father_name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control" id="email" name="email">
							</div>
						</div>
						<div class="col-md-6">
							<label for="phone" class="form-label">Phone</label>
							<div class="mb-3 input-group">

								<div class="input-group-text col-2">
									<input class="form-input " type="text" value="+91" aria-label="Checkbox for following text input" name="country_code">
								</div>
								<input type="number" class="form-control" id="phone" name="phone">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="Country" class="form-label">Country</label>
								<input type="text" class="form-control" id="Country" name="country">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="State" class="form-label">State</label>
								<input type="text" class="form-control" id="State" name="state">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="City" class="form-label">City</label>
								<input type="text" class="form-control" id="City" name="city">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="pin_code" class="form-label">Pin Code</label>
								<input type="text" class="form-control" id="pin_code" name="pin_code">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="dob" class="form-label">Dob Date</label>
								<input type="date" class="form-control" id="dob" name="dob">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="dob_place" class="form-label">Dob Place</label>
								<input type="text" class="form-control" id="dob_place" name="dob_place">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="dob_time" class="form-label">Dob Time</label>
								<input type="time" class="form-control" id="dob_time" name="dob_time">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="image" class="form-label">Image</label>
								<input type="file" class="form-control" id="image" name="image">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="male" value="male">
								<label class="form-check-label" for="male">Male</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="female" value="female">
								<label class="form-check-label" for="female">Female</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-4">
							<label for="select2success" class="form-label">Experties</label>
							<div class="select2-primary" style="z-index: 999999999 !important;">
								<?php
								$exp=\App\Models\Experties::get();
								?>
								<select id="select2success" class="select2 form-select" name="experties[]" multiple="multiple">
									<?php $__currentLoopData = $exp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($e->experties); ?>"><?php echo e($e->experties); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
						<div class="col-md-6 mb-4">
							<label for="select2successpr" class="form-label">Language</label>
							<div class="select2-primary" style="z-index: 999999999 !important;">
								<?php
								$lang=\App\Models\Language::get();
								?>
								<select id="select2pr" class="select2 form-select" name="language[]" multiple="multiple">
									<?php $__currentLoopData = $lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($l->language); ?>"><?php echo e($l->language); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="description" class="form-label">Description</label>
								<textarea type="text" class="form-control" id="Description" name="description"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="education" class="form-label">Education</label>
								<textarea type="text" class="form-control" id="education" name="education"></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label for="experience" class="form-label">Experience</label>
							<input type="text" class="form-control" id="experience" name="experience" />
						</div>
					</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>

		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Payment/Min</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="myForm" action="#" method="post" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>
				<div id="contentDiv" class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button id="myButton" type="button" class="btn btn-primary">Save</button>
				</div>
			</form>

		</div>
	</div>
</div>

<!-- <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Astrologer Import UploadCsv</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="#" method="post" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="csv_file" class="form-label">File</label>
								<input type="file" class="form-control" id="csv_file" name="csv_file">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>

		</div>
	</div>
</div> -->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
	$(document).ready(function() {
		$('.datatables').DataTable({
			processing: true,
			serverSide: true,
			ajax: "<?php echo route('admin.astrologer.index'); ?>",

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
						var imagePath = "<?php echo e(asset('images')); ?>" + '/' + data;
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
				{
					data: 'phone',
					name: 'phone'
				},
				{
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
					data: 'experties',
					name: 'experties'
				},
				{
					data: 'language',
					name: 'language'
				},
				{
					data: 'description',
					name: 'description'
				},
				{
					data: 'experience',
					name: 'experience'
				},
				{
					data: 'education',
					name: 'education'
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

				// Add more column definitions here
			]
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
<script>
	$(document).ready(function() {
		$(document).on('change', '.is_active', function() {
			var statusId = $(this).data('id');
			var isActive = $(this).is(':checked');
			var newurl = "<?php echo e(url('/admin/is_active')); ?>/" + statusId;
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
		$(document).on('click', '#myButton', function() {
			var formData = $('#myForm').serialize();
			var newurl = "<?php echo e(url('/admin/charge-store')); ?>";
			$.ajax({
				// url: '/admin/charge-store',
				url: newurl,
				type: 'POST',
				data: formData,
				success: function(response) {
					alert(response.message);
					location.reload();
				},
			});

		});
	});
</script>

<script>
	$(document).ready(function() {
		$(document).on('click', '.comment_dollar', function() {
			var Id = $(this).data('id');
			var newurl = "<?php echo e(url('/admin/cost')); ?>/" + Id;
			$.ajax({
				// url: '/admin/cost/' + Id,
				url: newurl,
				type: 'get',
				success: function(response) {
					$('#contentDiv').html(response);
					$('#exampleModal1').modal('show');
				},
			});
		});
	});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Theallsif-astro\resources\views/admin/astrologer/astrologer.blade.php ENDPATH**/ ?>