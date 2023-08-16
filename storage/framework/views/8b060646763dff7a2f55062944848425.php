<!-- hs top header Start -->

<style>
  .card-icon-menu:before {
    height: 0px !important;
  }

  .card-icon-menu i {
    border: 1px solid;
    padding: 5px;
    border-radius: 8px;
  }

  .modal-header {
    padding: 15px;
    border-bottom: 1px solid #e5e5e5;
    background: linear-gradient(220deg, rgb(255 255 255) 10%, #FACC2E 0%);
    color: #fff;
    border-radius: 5px 5px 0px 0px;
  }

  .close {
    float: right;
    font-size: 20px;
    font-weight: bold;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: 1;
  }

  .otp-input-field {
    width: 35em;
    padding: 8px;
    border-radius: 0px 20px 0px 20px;
    border: 1px solid #c7c7c7;
  }

  .otp-submit {
    width: 98%;
    background: #facc2e;
    border: none;
    padding: 10px;
    color: #fff;
    border-radius: 0px 20px 0px 20px;
  }

  @media screen and (max-width: 768px) {
    .gradients {

      display: inline !important;
      margin-left: 20px;

    }
  }


  .right-side-about-astro {
    border: 1px solid #bfbfbf;
    padding: 20px;
    border-radius: 8px;
  }

  .right-sider-icon {
    border: 1px solid #FACC2E;
    padding: 12px 0px 12px 5px;
    border-radius: 50px;
  }

  .right-sider-icon i {
    text-align: center;
    display: block;
    font-size: 30px;
  }

  .left-side-card {
    border: 1px solid #bfbfbf;
    padding-top: 150px;
    padding-bottom: 50px;
    padding-left: 50px;
    padding-right: 50px;
    border-radius: 10px;
    background: linear-gradient(0deg, rgb(255 255 255) 50%, #FACC2E 50%);
  }

  .left-side-internal-card {
    border: 1px solid #bfbfbf;
    background: #fff;
    padding: 30px;
    border-radius: 20px;
  }

  .left-side-internal-card img {
    width: 185px;
    border-radius: 100px;
    height: 180px;
    margin-top: -125px;
  }

  .left-side-internal-card h3 {
    font-size: 20px;
    margin-top: 10px;
  }

  .left-side-internal-card p {
    font-size: 14px;
  }

  .right-side-love-btn1 {
    border: 1px solid blue;
    padding: 5px;
    font-size: 14px;
    border-radius: 50px;
  }

  .right-side-love-btn2 {
    border: 1px solid orange;
    padding: 5px;
    font-size: 14px;
    border-radius: 50px;
  }

  .astro-three-tab {
    margin-top: 25px;
    text-align: center;
  }

  .astro-detail-btn a {
    font-size: 14px;
    padding: 5px;
  }

  .astro-detail-btn {
    margin-top: 20px;
  }

  .astro-about-leftside {
    margin-top: 25px;
  }





  .input-row {
    display: flex;
    align-items: flex-end;
  }

  .input-container {
    margin-right: 20px;
  }

  .input-container:last-child {
    margin-right: 0;
  }

  .input-container label {
    font-size: 14px;
    margin-bottom: 5px;
    display: block;
  }

  .input-text {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
  }

  @media (max-width: 480px) {
    .input-row {
      flex-direction: column;
      align-items: flex-start;
    }

    .input-container {
      width: 100%;
      margin-right: 0;
      margin-bottom: 10px;
    }
  }
</style>
<link rel="stylesheet" href="<?php echo e(asset('frontend/asset/build/css/intlTelInput.css')); ?>" />
<!--<link rel="stylesheet" href="<?php echo e(asset('asset/build/css/demo.css')); ?>" />-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">


<!--Profile and Edit Profile -->
<?php if($data=Auth::guard('customer')->user()): ?>
<div class="modal fade" id="mobileProfile" tabindex="-1" aria-labelledby="mobileNumberModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-9">
            <h2 class="modal-title " id="mobileNumberModalLabel">Profile</h2>
            <p>100% Private Consults, Personalised Remedies, Daily Horoscope and More</p>
          </div>
          <div class="col-md-3">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="row ">

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="left-side-card">
              <div class="left-side-internal-card">
                <?php if($data->role == 'customer'): ?>
                <div class="row">
                  <div class="col-md-5">
                    <?php if($data->image !=null): ?>
                    <img src="<?php echo e(asset('images/'.$data->image)); ?>" alt="blog_img">
                    <?php else: ?>
                    <img src="https://8bittask.com/astrologynew/frontend/asset/images/content/news_img1.jpg " alt="blog_img">
                    <?php endif; ?>
                    <h3><?php echo e($data->full_name ?? ''); ?></h3>
                    <p><?php echo e($data->dob ?? ''); ?>, <?php echo e($data->dob_time ?? ''); ?></p>
                    <!--<span>Languages: Punjabi, English, Hindi</span>-->
                  </div>

                  <div class="col-md-7">
                    <div class="row">
                      <div class="col-md-6">
                        <a href="#" class="right-side-love-btn1"><?php echo e($data->email ??''); ?></a>
                      </div>
                      <div class="col-md-6">
                        <a href="#" class="right-side-love-btn2"><?php echo e($data->phone ??''); ?></a>
                      </div>
                    </div>
                    <div class="astro-three-tab">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><?php echo e($data->country ??''); ?></h4>
                          <p>Country</p>
                        </div>
                        <div class="col-md-4">
                          <h4><?php echo e($data->state ??''); ?></h4>
                          <p>State</p>
                        </div>
                        <div class="col-md-4">
                          <h4><?php echo e($data->city ??''); ?></h4>
                          <p>City</p>
                        </div>
                      </div>
                    </div>
                    <div class="astro-detail-btn">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="astro-call-btn">
                            <a href="#" data-toggle="modal" data-target="#mobileProfileEdit">Edit</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <?php else: ?>
                <div class="row">
                  <div class="col-md-5">
                    <?php if($data->image !=null): ?>
                    <img src="<?php echo e(asset('images/'.$data->image)); ?>" alt="blog_img">
                    <?php else: ?>
                    <img src="https://8bittask.com/astrologynew/frontend/asset/images/content/news_img1.jpg " alt="blog_img">
                    <?php endif; ?>
                    <h3><?php echo e($data->full_name ??''); ?></h3>
                    <p>
                      <?php $__currentLoopData = json_decode($data->astrologer->experties); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expertie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php echo e($expertie); ?>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                    <span>Languages:
                      <?php $__currentLoopData = json_decode($data->astrologer->language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php echo e($lang); ?>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </span>
                  </div>

                  <div class="col-md-7">
                    <div class="row">
                      <div class="col-md-6">
                        <a href="#" class="right-side-love-btn1"><?php echo e($data->astrologer->email ?? ''); ?></a>
                      </div>
                      <div class="col-md-6">
                        <a href="#" class="right-side-love-btn2"><?php echo e($data->astrologer->phone ?? ''); ?></a>
                      </div>
                    </div>
                    <div class="astro-three-tab">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><?php echo e($data->astrologer->experience ?? ''); ?>+</h4>
                          <p>Experience</p>
                        </div>
                        <div class="col-md-4">
                          <h4><?php echo e($data->astrologer->city ?? ''); ?></h4>
                          <p>City</p>
                        </div>
                        <div class="col-md-4">
                          <h4><?php echo e($data->astrologer->education ?? ''); ?></h4>
                          <p>Education</p>
                        </div>
                      </div>
                    </div>
                    <div class="astro-detail-btn">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="astro-call-btn">
                            <a href="#" data-toggle="modal" data-target="#mobileProfileEdit">Edit</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>

  </div>
</div>
<?php endif; ?>

<!--Profile Edit-->
<?php if($data=Auth::guard('customer')->user()): ?>
<div class="modal fade" id="mobileProfileEdit" tabindex="-1" aria-labelledby="mobileNumberModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-9">
            <h2 class="modal-title " id="mobileNumberModalLabel">Profile Edit</h2>
            <p>100% Private Consults, Personalised Remedies, Daily Horoscope and More</p>
          </div>
          <div class="col-md-3">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="row ">

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="left-side-card">
              <div class="left-side-internal-card">
                <form action="<?php echo e(route('updateProfile',$data->id)); ?>" method="post" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <!--<?php echo method_field('PUT'); ?>-->
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6" hidden>
                        <div class="mb-3">
                          <label for="astrologer_id" class="form-label">Role</label>
                          <input type="text" class="form-control" id="astrologer_id" name="astrologer_id" value="<?php echo e($data->astrologer_id ?? ''); ?>">
                        </div>
                      </div>
                      <div class="col-md-6" hidden>
                        <div class="mb-3">
                          <label for="role" class="form-label">Role</label>
                          <input type="text" class="form-control" id="role" name="role" value="<?php echo e($data->role ?? ''); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="first_name" class="form-label">First Name</label>
                          <input type="test" class="form-control" id="first_name" name="first_name" value="<?php echo e($data->first_name ?? ''); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="last_name" class="form-label">Last Name</label>
                          <input type="test" class="form-control" id="last_name" name="last_name" value="<?php echo e($data->last_name ?? ''); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" class="form-control" id="email" name="email" value="<?php echo e($data->email ?? ''); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="phone" class="form-label">Phone</label>
                          <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e($data->phone ?? ''); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="Country" class="form-label">Country</label>
                          <input type="text" class="form-control" id="Country" name="country" value="<?php echo e($data->country ?? ''); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="State" class="form-label">State</label>
                          <input type="text" class="form-control" id="State" name="state" value="<?php echo e($data->state ?? ''); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="City" class="form-label">City</label>
                          <input type="text" class="form-control" id="City" name="city" value="<?php echo e($data->city ?? ''); ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="image" class="form-label">Image</label>
                          <input type="file" class="form-control" id="image" name="image">
                        </div>
                      </div>
                      <?php if($data->role =='customer'): ?>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="dob" class="form-label">Date Of Birth</label>
                          <input type="date" class="form-control" id="dob" name="dob" value="<?php echo e($data->dob ?? ''); ?>">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="c" class="form-label">DOB Time</label>
                          <input type="time" class="form-control" id="dob_time" name="dob_time" value="<?php echo e($data->dob_time ?? ''); ?>">
                        </div>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php endif; ?>

<!--Login and Signup Modal -->

<div class="modal fade" id="mobileNumberModal" tabindex="-1" aria-labelledby="mobileNumberModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">

          <div class="col-md-9">
            <h2 class="modal-title" id="mobileNumberModalLabel">Login</h2>
            <p>100% Private Consults, Personalised Remedies, Daily Horoscope and More</p>
          </div>
          <div class="col-md-3">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>


      </div>
      <div class="modal-body">
        <h3>Enter your mobile number</h3><br>
        <p style="margin-bottom: 30px;">You will receive OTP on this number</p>

        <div class="otp-form">
          <form id="mysendOTP" action="<?php echo e(route('sendOTP')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <!-- <label>Mobile Number</label><br>
            <input type="tel" id="phone" name="phone" class="otp-input-field" placeholder="Mobile Number"><br><br>
            <input type="hidden" id="country_code" class="otp-input-field" placeholder="Mobile Number" name="country_code" /> -->

            <div class="input-row">
              <div class="input-container">
                <label for="country_code">Country Code</label>
                <input type="text" id="country_code" class="input-text" name="country_code" value="+91">
              </div>
              <div class="input-container">
                <label for="phone">Phone Number</label>
                <input type="tel" class="input-text" placeholder="9*********" id="phone" name="phone">
              </div>
              <div class="input-container">
                <label for="referral_code">Referral Code</label>
                <input type="text" class="input-text" id="referral_code" name="referral_code">
              </div>
            </div>
            <br>
            <button type="button" class="otp-submit" onclick="submitMobileNumber()">Submit</button>

          </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>
        <!-- <script>
          // Initialize the input field with the library
          var input = document.querySelector("#phone-input");
          var iti = window.intlTelInput(input, {
            initialCountry: "in", // Set the default country to India
            separateDialCode: true, // Show the country code separately
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js" // Required script for utility functions
          });
        </script> -->
        <script src="<?php echo e(asset('frontend/asset/build/js/intlTelInput.js')); ?>"></script>
        <!-- <script>
          var input = document.querySelector("#phone");
          console.log(input);
          window.intlTelInput(input, {
            // allowDropdown: false,
            // autoInsertDialCode: true,
            // autoPlaceholder: "off",
            // dropdownContainer: document.body,
            // excludeCountries: ["us"],
            // formatOnDisplay: false,
            // geoIpLookup: function(callback) {
            //   fetch("https://ipapi.co/json")
            //     .then(function(res) { return res.json(); })
            //     .then(function(data) { callback(data.country_code); })
            //     .catch(function() { callback("us"); });
            // },
            // hiddenInput: "full_number",
            // initialCountry: "auto",
            // localizedCountries: { 'de': 'Deutschland' },
            // nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            // separateDialCode: true,
            // showFlags: false,
            utilsScript: "build/js/utils.js"
          });
        </script> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>

<!-- The OTP verification modal -->
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Enter your mobile number</h3><br>
        <!--<h5 class="modal-title" id="otpModalLabel">OTP Verification</h5>-->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="myverifyOTP" action="<?php echo e(route('verifyOTP')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
          <p id="otpMessage"></p>
          <p id="otpError"></p>
          <!-- OTP input -->
          <input type="hidden" id="phone_number" class="otp-input-field" placeholder="Mobile Number" name="phone_number" />
          <input type="text" id="otp" class="otp-input-field otp-input" placeholder="OTP" name="otp" />
        </div>
        <div class="modal-footer">
          <!-- Verify button -->
          <button type="button" class="otp-submit" onclick="verifyOTP()">Verify</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  // Function to submit the mobile number and open the OTP modal
  function submitMobileNumber() {
    var phone = document.getElementById("phone").value;
    // You can add your logic here to validate the mobile number
    // For this example, let's just check if it's a valid 10-digit number
    var mobileNumberPattern = /^\d{10}$/;
    if (phone.match(mobileNumberPattern)) {


      var formData = $('#mysendOTP').serialize();

      $.ajax({
        url: $('#mysendOTP').attr('action'),
        type: 'POST',
        data: formData,
        success: function(response) {
          // Close the mobile number modal
          $('#mobileNumberModal').modal('hide');

          // Update the OTP message
          var phone = response.country_code + response.phone;
          $('#otpMessage').html("You will receive OTP on" + response.country_code + response.phone);
          $('#phone_number').val(phone);
          // Open the OTP modal
          $('#otpModal').modal('show');

        },
        error: function(error) {
          alert("Invalid mobile number");
        }
      });

    } else {
      alert("Invalid mobile number");
    }
  }

  // Function to verify OTP
  function verifyOTP() {
    var otp = document.getElementById("otp").value;

    var formData = $('#myverifyOTP').serialize();

    $.ajax({
      url: $('#myverifyOTP').attr('action'),
      type: 'POST',
      data: formData,
      success: function(response) {
        // You can add your logic here to verify the OTP
        // For this example, let's just display an alert
        console.log(response);
        if (response.otp !== 'Invalid or expired OTP') {
          $('#otpModal').modal('hide');
          if (response.role !== 'customer') {
            window.location.href = "<?php echo e(url('/astrologer')); ?>";
          } else {
            window.location.href = "<?php echo e(url('/home')); ?>";
          }
          //  location.reload();
        } else {

          $('#otpError').html(response.otp);
          // $('#otpModal').modal('hide'); 
        }
      },
      error: function(error) {
        alert("Invalid OTP");
      }
    });
  }
</script>
<div class="hs_header_Wrapper hidden-sm hidden-xs">
  <!--<div class="container">-->
  <!-- hs top header Start -->
  <div class="hs_top_header_main_Wrapper">
    <div class="hs_header_logo_left" style="width:40%;">
      <div class="hs_logo_wrappe">
        <!--<a href="index.html"><img src="<?php echo e(asset('asset/images/header/logo.png')); ?>" class="img-responsive" alt="logo" title="Logo" /></a>-->
        <h2><a href="<?php echo e(route('login')); ?>" style="    top: 15px;
    position: relative;
    color:black;
">Astrology</a></h2>
      </div>
    </div>

    <div class="hs_header_logo_right" style="width:60%;">
      <nav class="hs_main_menu">
        <ul>
          <li>
            <a class="gradients" href="<?php echo e(route('astrologer')); ?>">
              Astrologer</a>
          </li>
          <li>
            <a class="gradients" href="<?php echo e(route('consultHistroy')); ?>">
              Download App</a>
          </li>

          <li>
            <a class="menu-button" href="<?php echo e(route('zodiacsigns')); ?>">Zodiac Signs </a>
          </li>
          <li>
            <a class="menu-button" href="<?php echo e(route('contactus')); ?>">Contact Us </a>
          </li>

          <?php if($data=Auth::guard('customer')->user()): ?>

          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">Profile
                <img src="<?php echo e(asset('frontend/assets/img/avatars/1.png')); ?>" alt class="h-auto rounded-circle" />
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="#">
                  <div class="d-flex">
                    <!--<div class="flex-shrink-0 me-3">-->
                    <!--  <div class="avatar avatar-online">-->
                    <!--    <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />-->
                    <!--  </div>-->
                    <!--</div>-->
                    <div class="flex-grow-1">
                      <span class="fw-semibold d-block"><?php echo e($data->full_name ?? ''); ?></span>
                      <small class="text-muted"><?php echo e($data->role ?? ''); ?></small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#mobileProfile">
                  <i class="ti ti-user-check me-2 ti-sm"></i>
                  <span class="align-middle">My Profile</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCenter">
                  <i class="ti ti-user-check me-2 ti-sm"></i>
                  <span class="align-middle">Change Password</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">
                  <i class="ti ti-logout me-2 ti-sm"></i>
                  <span class="align-middle">Log Out</span>
                </a>
              </li>
            </ul>
          </li>

          <?php else: ?>
          <li>
            <a class="menu-button" data-toggle="modal" data-target="#mobileNumberModal" href="#">Login/Signup </a>
          </li>
          <?php endif; ?>
          <li>

            <a class="card-icon-menu" href="<?php echo e(route('payment')); ?>"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
            </a>
          </li>
          <!--                                <li>-->
          <!--                                    <li><a class="menu-button" href="#">Consult Astros-->
          <!--</a></li>-->
          <!--                                </li>-->
          <!--                               <li class="dropdown menu-button">-->
          <!--                                    <a class="menu-button" href="<?php echo e(route('blog')); ?>">Blog </a>-->
          <!--<ul class="dropdown-menu">
<!--                                        <li>-->
          <!--                                            <a class="menu-button" href="blog_categories.html">Blog-Categories</a>-->
          <!--                                        </li>-->
          <!--                                        <li>-->
          <!--                                            <a class="menu-button" href="blog_single.html">Blog-Single</a>-->
          <!--                                        </li>-->
          <!--                                    </ul>-->
          <!--                                </li>-->

          <!--<li>-->
          <!--    <a class="menu-button" href="#">Horoscope </a>-->
          <!--</li>-->
          <!--<li class="dropdown menu-button">-->
          <!--    <a class="menu-button" href="#">राशिफल</a>-->
          <!--<ul class="dropdown-menu hs_mega_menu">-->
          <!--    <li>-->
          <!--        <a class="menu-button" href="<?php echo e(route('service.aries')); ?>">Aries</a>-->
          <!--    </li>-->
          <!--    <li>-->
          <!--        <a class="menu-button" href="<?php echo e(route('service.chinese')); ?>">Chinese</a>-->
          <!--    </li>-->
          <!--    <li>-->
          <!--        <a class="menu-button" href="<?php echo e(route('service.chinese_single')); ?>">Chinese-Single</a>-->
          <!--    </li>-->
          <!--    <li>-->
          <!--        <a class="menu-button" href="<?php echo e(route('service.crystal')); ?>">Crystal</a>-->
          <!--    </li>-->
          <!--    <li>-->
          <!--        <a class="menu-button" href="<?php echo e(route('service.kundli_dosh')); ?>">Kundli-Dosh</a>-->
          <!--    </li>-->
          <!--    <li>-->
          <!--        <a class="menu-button" href="<?php echo e(route('service.numerology')); ?>">Numerology</a>-->
          <!--    </li>-->
          <!--    <li>-->
          <!--        <a class="menu-button" href="<?php echo e(route('service.palm')); ?>">Palm</a>-->
          <!--    </li>-->
          <!--    <li>-->
          <!--        <a class="menu-button" href="<?php echo e(route('service.tarot')); ?>">Tarot</a>-->
          <!--    </li>-->
          <!--    <li>-->
          <!--        <a class="menu-button" href="<?php echo e(route('service.tarot_single')); ?>">Tarot-Single</a>-->
          <!--    </li>-->
          <!--    <li>-->
          <!--        <a class="menu-button" href="<?php echo e(route('service.vastu_shastra')); ?>">Vastu-Shastra</a>-->
          <!--    </li>-->
          <!--</ul>-->
          <!--</li>-->


          <!--<li class="dropdown menu-button">
                                    <a class="menu-button" href="#">Shop</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="menu-button" href="shop.html">Shop</a>
                                        </li>
                                        <li>
                                            <a class="menu-button" href="shop_single.html">Shop-Single</a>
                                        </li>
                                    </ul>
                                </li>-->

        </ul>
      </nav>
      <!-- <div class="hs_btn_wrapper hidden-md">
                            <ul>
                                <li><a href="contact.html" class="hs_btn_hover">Appointments</a></li>
                            </ul>
                        </div>-->
    </div>
  </div>
  <!-- hs top header End -->
</div>
</div>
<header class="mobail_menu visible-sm visible-xs">
  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-sm-6">
        <div class="hs_logo">
          <!--<a href="index.html"><img src="<?php echo e(asset('asset/images/header/logo.png')); ?>" alt="Logo" title="Logo"></a>-->
          <h2 style="padding-top:10px;"><a href="<?php echo e(route('login')); ?>" style="
    color:black;
">Astrology</a></h2>
        </div>
      </div>
      <div class="col-xs-6 col-sm-6">
        <div class="cd-dropdown-wrapper">
          <a class="house_toggle" href="#0">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="511.63px" height="511.631px" viewBox="0 0 511.63 511.631" style="enable-background:new 0 0 511.63 511.631;" xml:space="preserve">
              <g>
                <g>
                  <path d="M493.356,274.088H18.274c-4.952,0-9.233,1.811-12.851,5.428C1.809,283.129,0,287.417,0,292.362v36.545
											c0,4.948,1.809,9.236,5.424,12.847c3.621,3.617,7.904,5.432,12.851,5.432h475.082c4.944,0,9.232-1.814,12.85-5.432
											c3.614-3.61,5.425-7.898,5.425-12.847v-36.545c0-4.945-1.811-9.233-5.425-12.847C502.588,275.895,498.3,274.088,493.356,274.088z" />
                  <path d="M493.356,383.721H18.274c-4.952,0-9.233,1.81-12.851,5.427C1.809,392.762,0,397.046,0,401.994v36.546
											c0,4.948,1.809,9.232,5.424,12.854c3.621,3.61,7.904,5.421,12.851,5.421h475.082c4.944,0,9.232-1.811,12.85-5.421
											c3.614-3.621,5.425-7.905,5.425-12.854v-36.546c0-4.948-1.811-9.232-5.425-12.847C502.588,385.53,498.3,383.721,493.356,383.721z" />
                  <path d="M506.206,60.241c-3.617-3.612-7.905-5.424-12.85-5.424H18.274c-4.952,0-9.233,1.812-12.851,5.424
											C1.809,63.858,0,68.143,0,73.091v36.547c0,4.948,1.809,9.229,5.424,12.847c3.621,3.616,7.904,5.424,12.851,5.424h475.082
											c4.944,0,9.232-1.809,12.85-5.424c3.614-3.617,5.425-7.898,5.425-12.847V73.091C511.63,68.143,509.82,63.861,506.206,60.241z" />
                  <path d="M493.356,164.456H18.274c-4.952,0-9.233,1.807-12.851,5.424C1.809,173.495,0,177.778,0,182.727v36.547
											c0,4.947,1.809,9.233,5.424,12.845c3.621,3.617,7.904,5.429,12.851,5.429h475.082c4.944,0,9.232-1.812,12.85-5.429
											c3.614-3.612,5.425-7.898,5.425-12.845v-36.547c0-4.952-1.811-9.231-5.425-12.847C502.588,166.263,498.3,164.456,493.356,164.456z" />
                </g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
            </svg>
          </a>
          <nav class="cd-dropdown">
            <h2><a href="<?php echo e(route('login')); ?>">Astrology</a></h2>
            <a href="#0" class="cd-close">Close</a>
            <ul class="cd-dropdown-content">
              <!--<li>-->
              <!--    <form class="cd-search">-->
              <!--        <input type="search" placeholder="Search...">-->
              <!--    </form>-->
              <!--</li>-->
              <li><a class="gradients" href="<?php echo e(route('astrologer')); ?>">
                  Astrologer</a></li>
              <li>
                <a class="gradients" href="<?php echo e(route('consultHistroy')); ?>">
                  Download App</a>
              </li>
              <li>
                <a href="<?php echo e(route('zodiacsigns')); ?>">Zodiac Signs </a>
              </li>
              <li>
                <a href="<?php echo e(route('contactus')); ?>">Contact Us </a>
              </li>
              <?php if(Auth::guard('customer')->user()): ?>
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">Profile
                    <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <!--<div class="flex-shrink-0 me-3">-->
                        <!--  <div class="avatar avatar-online">-->
                        <!--    <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />-->
                        <!--  </div>-->
                        <!--</div>-->
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block"><?php echo e($data->full_name ?? ''); ?></span>
                          <small class="text-muted"><?php echo e($data->role ?? ''); ?></small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#mobileProfile">
                      <i class="ti ti-user-check me-2 ti-sm"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCenter">
                      <i class="ti ti-user-check me-2 ti-sm"></i>
                      <span class="align-middle">Change Password</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">
                      <i class="ti ti-logout me-2 ti-sm"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>

              <?php else: ?>
              <li>
                <a class="menu-button" data-toggle="modal" data-target="#mobileNumberModal" href="#">Login/Signup </a>
              </li>
              <?php endif; ?>
              <li>

                <a class="card-icon-menu" href="<?php echo e(route('payment')); ?>"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                </a>
              </li>
              <!-- .has-children -->
              <!--<li class="has-children">-->
              <!--    <a href="#">Services</a>-->
              <!--    <ul class="cd-secondary-dropdown is-hidden">-->
              <!--        <li class="go-back"><a href="#0">Menu</a></li>-->
              <!--        <li>-->
              <!--            <a href="<?php echo e(route('service.aries')); ?>">Aries</a>-->
              <!--        </li>-->
              <!-- .has-children -->
              <!--        <li>-->
              <!--            <a href="<?php echo e(route('service.chinese')); ?>">Chinese</a>-->
              <!--        </li>-->
              <!-- .has-children -->
              <!--        <li>-->
              <!--            <a href="<?php echo e(route('service.chinese_single')); ?>">Chinese-Single</a>-->
              <!--        </li>-->
              <!-- .has-children -->
              <!--        <li>-->
              <!--            <a href="<?php echo e(route('service.crystal')); ?>">Crystal</a>-->
              <!--        </li>-->
              <!-- .has-children -->
              <!--        <li>-->
              <!--            <a href="<?php echo e(route('service.kundli_dosh')); ?>">Kundli-Dosh</a>-->
              <!--        </li>-->
              <!-- .has-children -->
              <!--        <li>-->
              <!--            <a href="<?php echo e(route('service.numerology')); ?>">Numerology</a>-->
              <!--        </li>-->
              <!-- .has-children -->
              <!--        <li>-->
              <!--            <a href="<?php echo e(route('service.palm')); ?>">Palm</a>-->
              <!--        </li>-->
              <!-- .has-children -->
              <!--        <li>-->
              <!--            <a href="<?php echo e(route('service.tarot')); ?>">Tarot</a>-->
              <!--        </li>-->
              <!-- .has-children -->
              <!--        <li>-->
              <!--            <a href="route('service.tarot_single')">Tarot-Single</a>-->
              <!--        </li>-->
              <!-- .has-children -->
              <!--        <li>-->
              <!--            <a href="<?php echo e(route('service.vastu_shastra')); ?>">Vastu-Shastra</a>-->
              <!--        </li>-->
              <!-- .has-children -->
              <!--    </ul>-->
              <!-- .cd-secondary-dropdown -->
              <!--</li>-->
              <!-- .has-children -->
              <!--<li class="has-children">
                                        <a href="#">Shop</a>
                                        <ul class="cd-secondary-dropdown is-hidden">
                                            <li class="go-back"><a href="#0">Menu</a></li>
                                            <li>
                                                <a href="shop.html">Shop</a>
                                            </li>
                                            <!-- .has-children -->
              <!-- <li>
                                                <a href="shop_single.html">Shop-Single</a>
                                            </li>
                                            <!-- .has-children -->
              <!--</ul>-->
              <!-- .cd-secondary-dropdown -->
              <!-- </li>-->
              <!-- .has-children -->
              <!--<li class="has-children">-->
              <!--    <a href="<?php echo e(route('blog')); ?>">Blog</a>-->
              <!-- <ul class="cd-secondary-dropdown is-hidden">
                                    <!--        <li class="go-back"><a href="#0">Menu</a></li>-->
              <!--        <li>-->
              <!--            <a href="blog_categories.html">Blog-Categories</a>-->
              <!--        </li>-->
              <!-- .has-children -->
              <!--<li>
                                    <!--            <a href="blog_single.html">Blog-Single</a>-->
              <!--        </li>-->
              <!-- .has-children -->
              <!--</ul>
                                        <!-- .cd-secondary-dropdown -->
              <!--</li>-->
              <!-- .has-children -->
              <!--<li>-->
              <!--    <a href="<?php echo e(route('contact_us')); ?>">Contact Us</a>-->
              <!--</li>-->
              <!-- <li><a href="contact.html" class="hs_btn_hover">Appointments</a></li>-->
            </ul>
            <!-- .cd-dropdown-content -->
          </nav>
          <!-- .cd-dropdown -->
        </div>
      </div>
    </div>
  </div>
  <!-- .cd-dropdown-wrapper -->
</header>
</div>
<!-- main_header_wrapper end -->
<!-- hs Slider Start -->
<!-- hs Slider End -->
<!-- hs sign wrapper Start --><?php /**PATH E:\Theallsif-astro\resources\views/frontend/include/nav.blade.php ENDPATH**/ ?>