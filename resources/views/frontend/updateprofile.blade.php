@extends('frontend.layout.frontend')
@section('content-area')
<style>
  .card-payment {
    box-shadow: 0px 0px 35px -20px;
    padding: 0px;
    margin: 10px 0px 40px 0px;
    border-radius: 20px;
  }

  .edit-profile-heading {
    background: #FACC2E;
    padding: 10px;
    border-radius: 20px 20px 0px 0px;

  }

  .edit-profile-form {
    padding: 25px;
  }

  .update-profile-btn {
    background: #fff;
    border: 1px solid orange;
    padding: 5px 10px;
    border-radius: 20px;
    color: orange;
  }

  .update-profile-btn:hover {
    background: orange;
    color: #fff;

  }
</style>
<div class="hs_latest_news_main_wrapper mobile-view-astro" style="padding: 25px;margin-top: 5%;">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

    <div class="container ">

      <div class="row ">

        <div class="col-md-2">

        </div>

        <div class="col-md-8">
          <div class="card-payment">
            <div class="edit-profile-heading">
              <h3>Edit Profile</h3>
            </div>
            <div class="edit-profile-form">
              <form action="#">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Raj Siddhartha" name="name">
                </div>
                <div class="form-group">
                  <label for="dob">Date Of Birth</label>
                  <input type="date" class="form-control" id="dob" placeholder="10/08/1998" name="dob">
                </div>
                <div class="form-group">
                  <label for="bop">Birth Of Place</label>
                  <input type="text" class="form-control" id="bop" placeholder="Lucknow" name="bop">
                </div>
                <div class="form-group">
                  <label for="cob">City Of Birth</label>
                  <input type="text" class="form-control" id="cob" placeholder="Lucknow" name="cob">
                </div>
                <div class="form-group">
                  <label for="tob">Time Of Birth</label>
                  <input type="time" class="form-control" id="tob" placeholder="Lucknow" name="tob">
                </div>
                <div class="form-group">
                  <label for="sel1">Gender</label>
                  <select class="form-control" id="sel1">
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>

                  </select>
                </div>
                <button type="button" class="update-profile-btn">Submit</button>

              </form>
            </div>

          </div>
        </div>


        <div class="col-md-2">

        </div>







      </div>
    </div>
  </div>
</div>


@endsection
<!-- script for particular page -->
@section('script-area')

@endsection