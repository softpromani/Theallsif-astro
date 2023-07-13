@extends('admin.app')
@section('title')
Dashbard || Add Astrologer
@endsection
@section('content-main')
<div class="card">
	<div class="card-header border-bottom">
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
		@endif
		@if(session('error'))
		<div class="alert alert-danger">
			{{ session('error') }}
		</div>
		@endif

		@can('astrologer_create')
		<div class="card-title mb-3">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
				Add
			</button>
		</div>
		@endcan
		<div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
			<div class="col-md-4 user_role"></div>
			<div class="col-md-4 user_plan"></div>
			<div class="col-md-4 user_status"></div>
		</div>
	</div>

	@can('astrologer_read')
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
	@endcan

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Astrologer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="{{route('admin.astrologer.store')}}" method="post" enctype="multipart/form-data">
				@csrf
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
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control" id="email" name="email">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="phone" class="form-label">Phone</label>
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
								<label for="image" class="form-label">Image</label>
								<input type="file" class="form-control" id="image" name="image">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-4">
							<label for="select2success" class="form-label">Experties</label>
							<div class="select2-primary" style="z-index: 999999999 !important;">
								@php
								$exp=\App\Models\Experties::get();
								@endphp
								<select id="select2success" class="select2 form-select" name="experties[]" multiple="multiple">
									@foreach($exp as $e)
									<option value="{{$e->experties}}">{{$e->experties}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6 mb-4">
							<label for="select2successpr" class="form-label">Language</label>
							<div class="select2-primary" style="z-index: 999999999 !important;">
								@php
								$lang=\App\Models\Language::get();
								@endphp
								<select id="select2pr" class="select2 form-select" name="language[]" multiple="multiple">
									@foreach($lang as $l)
									<option value="{{$l->language}}">{{$l->language}}</option>
									@endforeach
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
				<h5 class="modal-title" id="exampleModalLabel">Add Payment/(hr,min,sec)</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="myForm" action="#" method="post" enctype="multipart/form-data">
				@csrf
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

@endsection
@push('scripts')
<script>
	$(document).ready(function() {
		$('.datatables').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{!! route('admin.astrologer.index') !!}",

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
						var imagePath = "{{ asset('images') }}" + '/' + data;
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
			var newurl = "{{ url('/admin/is_active') }}/" + statusId;
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
			var newurl = "{{ url('/admin/charge-store') }}";
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
			var newurl = "{{ url('/admin/cost') }}/" + Id;
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
@endpush