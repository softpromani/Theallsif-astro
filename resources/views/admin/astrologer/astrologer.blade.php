@extends('admin.app')
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
	 @if(session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
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
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Country</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        	@foreach($data as $d)
        	<tr>
        		<td>{{$loop->index+1}}</td>
        		<td>{{$d->first_name}}</td>
        		<td>{{$d->last_name}}</td>
        		<td>{{$d->email}}</td>
        		<td>{{$d->phone}}</td>
	    		<td>{{$d->country}}</td>
	    		<td>
	    		<a href="{{route('astrologer.edit',$d->id)}}"><i class="fa-sharp fa-solid fa-edit"></i></a>
	    		<form action="{{ route('astrologer.destroy', $d->id) }}" method="post">
				    @csrf
				    @method('DELETE')
				    <button type="submit" class="btn btn-link p-0"><i class="fa-sharp fa-solid fa-trash"></i></button>
				</form>
	    		</td>
        	</tr>
        	@endforeach
        </tbody>
      </table>
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Astrologer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="{{route('astrologer.store')}}" method="post" enctype="multipart/form-data">
        	@csrf
    		<div class="modal-body">
	        	<div class="mb-3">
				    <label for="first_name" class="form-label">First Name</label>
				    <input type="test" class="form-control" id="first_name" name="first_name">
				</div>
	        	<div class="mb-3">
				    <label for="last_name" class="form-label">Last Name</label>
				    <input type="test" class="form-control" id="last_name" name="last_name">
				</div>
	        	<div class="mb-3">
				    <label for="email" class="form-label">Email</label>
				    <input type="email" class="form-control" id="email" name="email">
				</div>
	        	<div class="mb-3">
				    <label for="phone" class="form-label">Phone</label>
				    <input type="number" class="form-control" id="phone" name="phone">
				</div>
	        	<div class="mb-3">
				    <label for="country" class="form-label">Country</label>
				    <input type="test" class="form-control" id="country" name="country">
				</div>
				<div class="mb-3">
				    <label for="image" class="form-label">Image</label>
				    <input type="file" class="form-control" id="image" name="image">
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
<script type="text/javascript">
	$(document).on('ready',function(){
		$('.datatables').DataTable();
	})
</script>
@endsection