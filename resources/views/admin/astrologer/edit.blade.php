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

					<div class="row">
						<div class="col-6">

							<div>
								<label for="first_name" class="form-label">First Name</label>
								<input type="text" class="form-control" id="first_name" value="{{$edit->first_name}}" name="first_name" />
							</div>
						</div>
						<div class="col-6">
							<div>
								<label for="last_name" class="form-label">Last Name</label>
								<input type="text" class="form-control" id="last_name" value="{{$edit->last_name}}" name="last_name" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="father_name" class="form-label">Father Name</label>
								<input type="text" class="form-control" id="father_name" name="father_name" value="{{$edit->father_name}}">
							</div>
						</div>
						<div class="col-6">
							<div>
								<label for="email" class="form-label">Email</label>
								<input type="text" class="form-control" id="email" value="{{$edit->email}}" name="email" />
							</div>
						</div>
						<div class="col-6">
							@php
							if($edit->phone){
							$lastTenDigits = substr($edit->phone, -10);
							$remainingDigits = substr($edit->phone, 0, -10);
							}
							@endphp
							<label for="phone" class="form-label">Phone</label>
							<div class="mb-3 input-group">
								<div class="input-group-text col-2">
									<input class="form-input " type="text" value="{{isset($edit->phone)? $remainingDigits:'+91'}}" aria-label="Checkbox for following text input" name="country_code">
								</div>
								<input type="number" class="form-control" id="phone" name="phone" value="{{isset($edit->phone)? $lastTenDigits:''}}">
							</div>
							<!-- <div>
								<label for="phone" class="form-label">Phone</label>
								<input type="text" class="form-control" id="phone" value="{{$edit->phone}}" name="phone" />
							</div> -->
						</div>
						<div class="col-6">
							<div>
								<label for="country" class="form-label">Country</label>
								<input type="text" class="form-control" id="country" value="{{$edit->country}}" name="country" />
							</div>
						</div>
						<div class="col-6">
							<div>
								<label for="state" class="form-label">State</label>
								<input type="text" class="form-control" id="state" value="{{$edit->state}}" name="state" />
							</div>
						</div>
						<div class="col-6">
							<div>
								<label for="city" class="form-label">City</label>
								<input type="text" class="form-control" id="city" value="{{$edit->city}}" name="city" />
							</div>
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label for="pin_code" class="form-label">Pin Code</label>
								<input type="text" class="form-control" id="pin_code" name="pin_code" value="{{$edit->pin_code}}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="dob" class="form-label">Dob Date</label>
								<input type="date" class="form-control" id="dob" name="dob" value="{{$edit->dob}}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="dob_place" class="form-label">Dob Place</label>
								<input type="text" class="form-control" id="dob_place" name="dob_place" value="{{$edit->dob_place}}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="dob_time" class="form-label">Dob Time</label>
								<input type="time" class="form-control" id="dob_time" name="dob_time" value="{{$edit->dob_time}}">
							</div>
						</div>
						<div class="col-6">
							<div>
								<label for="image" class="form-label">Image</label>
								<input type="file" class="form-control" id="image" value="{{$edit->image}}" name="image" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="male" value="male" {{isset($edit)? ($edit->gender =='male' ?'checked':''):''}}>
								<label class="form-check-label" for="male">Male</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="female" value="female" {{isset($edit)? ($edit->gender =='female' ?'checked':''):''}}>
								<label class="form-check-label" for="female">Female</label>
							</div>
						</div>
						<div class="col-6">
							<label for="select2lang" class="form-label">Experties</label>
							<div class="select2-primary">
								<select id="select2lang" class="select2 form-select" name="experties[]" multiple="multiple">
									@foreach(json_decode($edit->experties) as $option)
									<option value="{{ $option }}" selected>{{ $option }}</option>
									@endforeach
									@php
									$selectedOptions = json_decode($edit->experties);
									$allOptions = \App\Models\Experties::pluck('experties');
									$unselectedOptions = $allOptions->diff($selectedOptions);
									@endphp
									@foreach($unselectedOptions as $option)
									<option value="{{ $option }}">{{ $option }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-6">
							<label for="select2primary" class="form-label">Language</label>
							<div class="select2-primary">
								<select id="select2primary" class="select2 form-select" name="language[]" multiple="multiple">
									@foreach(json_decode($edit->language) as $option)
									<option value="{{ $option }}" selected>{{ $option }}</option>
									@endforeach
									@php
									$selectedOptions = json_decode($edit->language);
									$allOptions = \App\Models\Language::pluck('language');
									$selectlang = $allOptions->diff($selectedOptions);
									@endphp
									@foreach($selectlang as $option)
									<option value="{{ $option }}">{{ $option }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="description" class="form-label">Description</label>
									<textarea type="text" class="form-control" id="Description" name="description">{{$edit->description}}</textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="education" class="form-label">Education</label>
									<textarea type="text" class="form-control" id="education" name="education">{{$edit->education}}</textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="experience" class="form-label">Experience</label>
								<input type="text" class="form-control" id="experience" name="experience" value="{{$edit->experience}}" />
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
@push('scripts')

<script>
	$(document).ready(function() {
		$('#select2primary').select2();
	});
</script>
<script>
	$(document).ready(function() {
		$('#select2lang').select2();
	});
</script>
@endpush