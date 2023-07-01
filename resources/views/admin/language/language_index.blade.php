@extends('admin.app')
@section('title')
    Dashbard || Language
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
      	<form action="{{isset($language)?route('admin.language.update',$language->id):route('admin.language.store')}}" method="post">
      			@csrf
      			@if(isset($language))
      			@method("PUT")
      			@endif
	      	<div class="row">
	      		<div class="col-6">
	      			<div >
					    <label for="language" class="form-label">Language</label>
					    <input type="test" class="form-control" id="language" value="{{isset($language)?$language->language:''}}" name="language">
					</div>
				</div>
	      		<div class="col-6 mt-4">
	      			<button type="submit" class="btn btn-primary">{{isset($language)?"Update":"Add"}}</button>
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
            <th>Language</th>
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
                ajax: '{!! route('admin.language.index') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'language', name: 'lanaguage' },
                    {data: 'action', name: 'action',  orderable: true, searchable: true},

                    // Add more column definitions here
                ]
            });
        });
    </script>
@endpush
