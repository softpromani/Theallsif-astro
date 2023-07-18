@extends('admin.app')
@section('title')
Dashbard || Admin
@endsection

@section('content-main')

<style type="text/css">
  .file-input {
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
  }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
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
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <div class="row">
    <!-- View sales -->

    <div class="col-xl-4 mb-4 col-lg-5 col-12">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-7">
            <div class="card-body text-nowrap">
              <h5 class="card-title">Congratulations 🎉</h5>
              <p class="mb-4">{{Auth::user()->name}}</p>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">Profile View</button>
              <!-- <a href="{{route('admin.profile.index')}}" class="btn btn-primary"  data-bs-toggle="modal"
                          data-bs-target="#largeModal">>Profile View</a> -->
            </div>
          </div>
          <div class="col-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="../../assets/img/illustrations/card-advance-sale.png" height="140" alt="view sales" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8 mb-4 col-lg-7 col-12">
      <div class="card h-100">
        <div class="card-header">
          <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title mb-0">Statistics</h5>
            <small class="text-muted">Updated 1 month ago</small>
          </div>
        </div>
        <div class="card-body">
          <div class="row gy-3">
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-info me-3 p-2">
                  <i class="ti ti-users ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">{{\App\Models\Astrologer::get()->count()}}+</h5>
                  <small>Astrologers</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-primary me-3 p-2">
                  <i class="ti ti-chart-pie-2 ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">230k</h5>
                  <small>Sales</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-danger me-3 p-2">
                  <i class="ti ti-shopping-cart ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">1.423k</h5>
                  <small>Products</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-success me-3 p-2">
                  <i class="ti ti-currency-dollar ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">$9745</h5>
                  <small>Revenue</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- modal profile view -->
@php
$admin=Auth::user();
@endphp

<div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.image-profile',$admin->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-2">
              <div class="avatar avatar-xl">
                @if($admin->pic)
                <img src="{{asset($admin->pic)}}" id="preview" alt="Avatar" class="rounded-circle" />
                @else
                <img src="{{asset('assets/img/avatars/1.png')}}" id="preview" alt="Avatar" class="rounded-circle" />
                @endif
                <input type="file" name="pic" class="file-input" onchange="previewImage()" capture="camera">
              </div>
            </div>
            <div class="col-3 mt-4">
              <button type="submit" class="btn btn-primary btn-sm">Upload Image</button>
            </div>
          </div>
        </form>
        <form action="{{route('admin.profile.update',$admin->id)}}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="row g-2">
            <div class="col-6 mb-0">
              <label for="name" class="form-label">Name</label>
              <input type="text" id="name" name="name" value="{{$admin->name??''}}" class="form-control" />
            </div>
            <div class="col-6 mb-0">
              <label for="email" class="form-label">Email</label>
              <input type="text" id="email" name="email" value="{{$admin->email??''}}" class="form-control" />
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
@push('scripts')

<script>
  function previewImage() {
    var preview = document.querySelector('#preview');
    var file = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();

    reader.onloadend = function() {
      preview.src = reader.result;
    }

    if (file) {
      reader.readAsDataURL(file);
    } else {
      preview.src = "";
    }
  }
</script>

<div id="template-customizer" class="invert-bg-white" style="visibility: visible">
  @php
  $superadminId = session('superadmin_id');
  $eid=Crypt::encrypt($superadminId);
  @endphp
  <a href="{{ route('admin.loginUsingId', $eid) }}" class="template-customizer-open-btn" tabindex="-1">
    <i class="menu-icon tf-icons ti ti-user" style="visibility: visible"></i>
  </a>

</div>

@endpush