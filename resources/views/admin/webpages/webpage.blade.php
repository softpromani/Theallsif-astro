@extends('admin.app')
@section('title')
Dashbard || Add Web-Page
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

        <form action="{{route('admin.webpageUpdate')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="select2success" class="form-label">Type</label>
                        <div class="select2-primary" style="z-index: 999999999 !important;">
                            <select id="select2success" class="select2 form-select" name="type">
                                <option selected disabled>Select Type</option>
                                <option value="privacy-policy">Privacy & Policy</option>
                                <option value="terms-condition">Terms & Condition</option>
                                <option value="about-us">About Us</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12 mb-2" id="contentDiv">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea type="text" class="form-control" id="editor" name="description" rows="8"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>



        <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
        </div>
    </div>
    <!-- 
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

    </div> -->

</div>

<!-- <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Payment/Min</h5>
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
</div> -->

@endsection
@push('scripts')
<!-- <script>
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
</script> -->

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
        $(document).on('change', '#select2success', function() {
            var type = $(this).val();
            var newurl = "{{ url('/admin/web-pages') }}/" + type;

            $.ajax({
                url: newurl,
                type: 'get',
                success: function(response) {
                    // Assuming 'editor' is your CKEditor instance
                    CKEDITOR.instances.editor.setData(response);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX request error:", error);
                }
            });
        });
    });
</script>

@endpush