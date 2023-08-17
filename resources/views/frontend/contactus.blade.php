@extends('frontend.layout.frontend')

@section('content-area')


<div class="hs_indx_title_main_wrapper">
    <div class="hs_title_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
                <div class="hs_indx_title_left_wrapper">
                    <h2>Contact Us</h2>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  full_width">
                <div class="hs_indx_title_right_wrapper">
                    <ul>
                        <li><a href="#">Home</a> &nbsp;&nbsp;&nbsp;> </li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- hs About Title End -->
<!-- hs contact us Title Start -->

<!-- hs contact us Title End -->
<!-- hs contact map Start -->

<!-- hs contact map End -->
<!-- hs contact form Start -->
<div class="hs_contact_indx_form_main_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="hs_about_heading_main_wrapper">
                    <div class="hs_about_heading_wrapper">
                        <h2>Fill Free To <span>Contact</span></h2>
                        <h4><span>&nbsp;</span></h4>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum<br> auctor, nisi elit consequat hello Aenean world.</p>
                    </div>
                </div>
            </div>
            <form>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="hs_kd_six_sec_input_wrapper">
                        <input type="text" name="first_name" class="require" placeholder="Name">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="hs_kd_six_sec_input_wrapper ">
                        <input type="email" name="email" class="require" placeholder="Email" data-valid="email" data-error="Email should be valid.">
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hs_kd_six_sec_input_wrapper ">
                        <input type="tel" name="phone" placeholder="Phone Number">

                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hs_kd_six_sec_input_wrapper ">
                        <textarea rows="6" name="message" class="require" placeholder="Comments"></textarea>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="response"></div>
                    <div class="hs_kd_six_sec_btn">
                        <ul>
                            <li>
                                <input type="hidden" name="form_type" value="contact">
                                <button type="button" class="hs_btn_hover submitForm">Submit</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
<!-- script for particular page -->
@section('script-area')

@endsection