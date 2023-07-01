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
      <div class="card-title mb-3">
      	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
		  			Add
				</button>
      </div>
      <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
        <div class="col-md-4 user_role"></div>
        <div class="col-md-4 user_plan"></div>
        <div class="col-md-4 user_status"></div>
      </div>
    </div>
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
            <th>Country</th>
            <th>Actions</th>
          </tr>
        </thead>
        
      </table>
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
								    <label for="City" class="form-label">City</label>
								    <input type="test" class="form-control" id="City" name="country">
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
    <label for="select2Primary" class="form-label">Primary</label>
    <div class="select2-primary">
        <select id="select2Primary" class="select2 form-select" multiple="multiple">
            <option value="1" selected>Option1</option>
            <option value="2" selected>Option2</option>
            <option value="3">Option3</option>
            <option value="4">Option4</option>
        </select>
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
                ajax: '{!! route('admin.astrologer.index') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {
				                data: 'image',
				                name: 'image',
				                orderable: true,
				                searchable: false,
				               		render: function(data, type, full, meta) {
									        var imagePath = '{{ asset('images') }}' + '/' + data;
									        return '<div class="avatar me-2"><img src="' + imagePath + '" alt="Avatar" class="rounded-circle" /></div>';
									    }
				            },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'country', name: 'country' },
                    {data: 'action', name: 'action',  orderable: true, searchable: true},

                    // Add more column definitions here
                ]
            });
        });
    </script>
    <script>
    $(document).ready(function() {
        $('#select2Primary').select2();
    });
</script>
@endpush
