<?php $__env->startSection('title'); ?>
Dashbard || Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-main'); ?>

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
  <?php if($errors->any()): ?>
  <div class="alert alert-danger">
    <ul>
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li><?php echo e($error); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
  <?php endif; ?>
  <div class="row">
    <!-- View sales -->

    <div class="col-xl-4 mb-4 col-lg-5 col-12">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-7">
            <div class="card-body text-nowrap">
              <h5 class="card-title">Congratulations 🎉</h5>
              <p class="mb-4"><?php echo e(Auth::user()->name); ?></p>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">Profile View</button>
              <!-- <a href="<?php echo e(route('admin.profile.index')); ?>" class="btn btn-primary"  data-bs-toggle="modal"
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
                  <h5 class="mb-0"><?php echo e(\App\Models\Astrologer::get()->count()); ?>+</h5>
                  <small>Astrologers</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-primary me-3 p-2">
                  <i class="ti ti-users ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0"><?php echo e(\App\Models\Customer::where('role','customer')->get()->count()); ?>+</h5>
                  <small>Customers</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-danger me-3 p-2">
                  <i class="ti ti-users ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0"><?php echo e(\App\Models\User::get()->count()); ?>+</h5>
                  <small>Employee</small>
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

    <div class="col-12 mb-4">
      <div class="card">
        <div class="card-header flex-nowrap header-elements">
          <h5 class="card-title mb-0">Revenue Data</h5>
          <div class="card-header-elements ms-auto py-0 d-none d-sm-block">
            <div class="btn-group" role="group" aria-label="radio toggle button group">
              <input type="radio" class="btn-check" name="btnradio" id="dailyRadio" checked="">
              <label class="btn btn-outline-secondary waves-effect" for="dailyRadio">Daily</label>

              <input type="radio" class="btn-check" name="btnradio" id="monthlyRadio">
              <label class="btn btn-outline-secondary waves-effect" for="monthlyRadio">Monthly</label>

              <input type="radio" class="btn-check" name="btnradio" id="yearlyRadio">
              <label class="btn btn-outline-secondary waves-effect" for="yearlyRadio">Yearly</label>
            </div>
          </div>
        </div>
        <div class="card-body pt-2">
          <canvas id="scatterChart" class="chartjs" data-height="435" height="410" width="959" style="display: block; box-sizing: border-box; height: 205px; width: 479.5px;"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- modal profile view -->
<?php
$admin=Auth::user();
?>

<div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo e(route('admin.image-profile',$admin->id)); ?>" method="post" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="row">
            <div class="col-2">
              <div class="avatar avatar-xl">
                <?php if($admin->pic): ?>
                <img src="<?php echo e(asset($admin->pic)); ?>" id="preview" alt="Avatar" class="rounded-circle" />
                <?php else: ?>
                <img src="<?php echo e(asset('assets/img/avatars/1.png')); ?>" id="preview" alt="Avatar" class="rounded-circle" />
                <?php endif; ?>
                <input type="file" name="pic" class="file-input" onchange="previewImage()" capture="camera">
              </div>
            </div>
            <div class="col-3 mt-4">
              <button type="submit" class="btn btn-primary btn-sm">Upload Image</button>
            </div>
          </div>
        </form>
        <form action="<?php echo e(route('admin.profile.update',$admin->id)); ?>" method="post" enctype="multipart/form-data">
          <?php echo method_field('PUT'); ?>
          <?php echo csrf_field(); ?>
          <div class="row g-2">
            <div class="col-6 mb-0">
              <label for="name" class="form-label">Name</label>
              <input type="text" id="name" name="name" value="<?php echo e($admin->name??''); ?>" class="form-control" />
            </div>
            <div class="col-6 mb-0">
              <label for="email" class="form-label">Email</label>
              <input type="text" id="email" name="email" value="<?php echo e($admin->email??''); ?>" class="form-control" />
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

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Theallsif-astro\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>