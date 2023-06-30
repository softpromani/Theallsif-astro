@extends('admin.app')
@section('title')
    Dashbard || Add Astrologer
@endsection
@section('content-main')
<div class="row">
	<div class="col">
	  <div class="card mb-4">
	    <h5 class="card-header">Astrologer Update</h5>
	    <form action="{{route('admin.astrologer.update',$edit->id)}}" method="post" enctype="multipart/form-data">
	    	@csrf
	    	@method('PUT')
	    <div class="card-body">
	    	<div class="row">
	    		<div class="col-6">
	    			
	    			<div>
			        <label for="first_name" class="form-label">First Name</label>
			        <input type="text" class="form-control" id="first_name" value="{{$edit->first_name}}" name="first_name"/>
			      </div>
	    		</div>
	    		<div class="col-6">
	    			<div>
			        <label for="last_name" class="form-label">Last Name</label>
			        <input type="text" class="form-control" id="last_name" value="{{$edit->last_name}}" name="last_name"/>
			      </div>
	    		</div>
	    		<div class="col-6">
	    			<div>
			        <label for="email" class="form-label">Email</label>
			        <input type="text" class="form-control" id="email" value="{{$edit->email}}" name="email"/>
			      </div>
	    		</div>
	    		<div class="col-6">
	    			<div>
			        <label for="phone" class="form-label">Phone</label>
			        <input type="text" class="form-control" id="phone" value="{{$edit->phone}}" name="phone"/>
			      </div>
	    		</div>
	    		<div class="col-6">
	    			<div>
			        <label for="country" class="form-label">Country</label>
			        <input type="text" class="form-control" id="country" value="{{$edit->country}}" name="country"/>
			      </div>
	    		</div>
	    		<div class="col-6">
	    			<div>
			        <label for="image" class="form-label">Image</label>
			        <input type="file" class="form-control" id="image" value="{{$edit->image}}" name="image"/>
			      </div>
	    		</div>
	    	</div>  
	    	<div class="mt-3">
				    <div class="text-end">
				        <button type="submit" class="btn btn-primary">Update</button>
				    </div>
				</div>
	    </div>
	  </form>
	  </div>
	</div>
</div>

@endsection