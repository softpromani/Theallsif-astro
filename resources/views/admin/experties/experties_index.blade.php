@extends('admin.app')
@section('title')
    Dashbard || Experites
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
      <div class="card-title">
      	<form action="{{isset($experties)?route('admin.experties.update',$experties->id):route('admin.experties.store')}}" method="post">
      			@csrf
      			@if(isset($experties))
      			@method("PUT")
      			@endif
	      	<div class="row">
	      		<div class="col-6">
	      			<div >
					    <label for="experties" class="form-label">Experties</label>
					    <input type="test" class="form-control" id="experties" value="{{isset($experties)?$experties->experties:''}}" name="experties">
					</div>
				</div>
	      		<div class="col-6 mt-4">
	      			<button type="submit" class="btn btn-primary">{{isset($experties)?"Update":"Add"}}</button>
	      		</div>
	      	</div>
      	</form>
      	
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
            <th>Experties</th>
            <th>Actions</th>
          </tr>
        </thead>
        
      </table>
</div>
</div>
@endsection

@push('scripts')
 <script>
        $(document).ready(function() {
            $('.datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.experties.index') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'experties', name: 'experties' },
                    {data: 'action', name: 'action',  orderable: true, searchable: true},

                    // Add more column definitions here
                ]
            });
        });
    </script>
@endpush
