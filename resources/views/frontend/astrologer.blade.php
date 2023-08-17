@extends('frontend.layout.frontend')

@section('content-area')
<style>
    .consult-box {
        box-shadow: 0px 0px 35px -20px;
        border-radius: 10px;
        margin-bottom: 40px;
    }

    .consult-area {
        background: #f1f0f0;
        border-radius: 10px 10px 0px 0px;
        padding: 10px;
    }

    .consult-title {
        font-size: 16px;
    }

    .cosult-completed {
        font-size: 16px;
        text-align: right;
        color: #07d507;
    }

    .consul-mode-commnuni {
        padding: 10px;
    }

    .consult-communi-title {
        font-size: 15px;
        margin-bottom: 15px;
    }

    .consult-commni-icon-text {
        font-size: 15px;
        margin-bottom: 15px;
    }

    .consult-commni-icon-text i {
        color: red;
    }

    .consult-communication-area {
        margin-bottom: 20px;
        margin-top: 20px;
        border-bottom: 1px solid #cbcbcb;
    }

    button.consult-again-btn {
        /* text-align: center; */
        margin: 15px auto;
        /* align-items: center; */
        /* justify-content: center; */
        display: block;
        /* margin: 0px 0px; */
        background: #fff;
        border: 1px solid red;
        border-radius: 10px 0px;
        color: red;
        padding: 5px;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<div class="hs_indx_title_main_wrapper">
    <div class="hs_title_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
                <div class="hs_indx_title_left_wrapper">
                    <h2>Call & Chat History</h2>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  full_width">
                <div class="hs_indx_title_right_wrapper">
                    <ul>
                        <li><a href="#">Home</a> &nbsp;&nbsp;&nbsp;> </li>
                        <li>Call & Chat History</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hs_latest_news_main_wrapper mobile-view-astro" style="padding: 25px;margin-top: 5%;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="container " style="margin-top:20px;">
            <div class="row ">

                <!---- End Card ------>

                <!--- Start Card ------->
                <div class="col-md-12">
                    <div class="consult-box" style="margin-top:40px;box-shadow:none;">
                        <h2 style="font-size:30px;padding-left:10px;">Call & Chat History &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label></h2>

                        <a href="{{route('astrologyprofile')}}">
                            <h3 style="padding-bottom:30px;padding-top:20px;padding-left:10px;color:blue;text-align:center;">View Profile Detail</h3>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="consult-box">


                        <div class="consult-area">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="consult-title">Abc</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="cosult-completed"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Completed</h3>
                                </div>
                            </div>
                        </div>
                        <div class="consul-mode-commnuni">

                            <div class="consult-communication-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="consult-commni-icon-text"><i class="fa fa-phone" aria-hidden="true"></i></h3>

                                        <h3 class="consult-communi-title">Date</h3>
                                        <h3 class="consult-communi-title">Time</h3>

                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="consult-commni-icon-text">Call</h3>
                                        <h3 class="consult-commni-icon-text"><i class="fa fa-calendar" aria-hidden="true"></i> 14.05.2023</h3>


                                        <h3 class="consult-commni-icon-text"><i class="fa fa-clock-o" aria-hidden="true"></i> 05.30PM</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="consult-communi-title">Total</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="consult-commni-icon-text"><i class="fa fa-inr" aria-hidden="true"></i> 58.8</h3>
                                </div>
                            </div>
                            <button class="consult-again-btn">Assign remady</button>
                        </div>
                    </div>
                </div>

                <!---- End Card ------>



                <!--- Start Card ------->
                <div class="col-md-4">
                    <div class="consult-box">
                        <div class="consult-area">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="consult-title">Abc</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="cosult-completed" style="color:coral;"><i class="fa fa-times-circle-o" aria-hidden="false"></i> Failed</h3>
                                </div>
                            </div>
                        </div>
                        <div class="consul-mode-commnuni">

                            <div class="consult-communication-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="consult-commni-icon-text"><i class="fa fa-comment" aria-hidden="true"></i></h3>

                                        <h3 class="consult-communi-title">Date</h3>
                                        <h3 class="consult-communi-title">Time</h3>

                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="consult-commni-icon-text">Message</h3>
                                        <h3 class="consult-commni-icon-text"><i class="fa fa-calendar" aria-hidden="true"></i> 14.05.2023</h3>


                                        <h3 class="consult-commni-icon-text"><i class="fa fa-clock-o" aria-hidden="true"></i> 05.30PM</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="consult-communi-title">Total</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="consult-commni-icon-text"><i class="fa fa-inr" aria-hidden="true"></i> 58.8</h3>
                                </div>
                            </div>
                            <button class="consult-again-btn">Assign remady</button>
                        </div>
                    </div>
                </div>

                <!---- End Card ------>

                <!--- Start Card ------->
                <div class="col-md-4">
                    <div class="consult-box">
                        <div class="consult-area">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="consult-title">Abc</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="cosult-completed" style="color:coral;"><i class="fa fa-times-circle-o" aria-hidden="false"></i> Failed</h3>
                                </div>
                            </div>
                        </div>
                        <div class="consul-mode-commnuni">

                            <div class="consult-communication-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="consult-commni-icon-text"><i class="fa fa-phone" aria-hidden="true"></i></h3>

                                        <h3 class="consult-communi-title">Date</h3>
                                        <h3 class="consult-communi-title">Time</h3>

                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="consult-commni-icon-text">Call</h3>
                                        <h3 class="consult-commni-icon-text"><i class="fa fa-calendar" aria-hidden="true"></i> 14.05.2023</h3>


                                        <h3 class="consult-commni-icon-text"><i class="fa fa-clock-o" aria-hidden="true"></i> 05.30PM</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="consult-communi-title">Total</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="consult-commni-icon-text"><i class="fa fa-inr" aria-hidden="true"></i> 58.8</h3>
                                </div>
                            </div>
                            <button class="consult-again-btn">Assign remady</button>
                        </div>
                    </div>
                </div>

                <!---- End Card ------>

            </div>
        </div>
    </div>
</div>






@endsection
<!-- script for particular page -->
@section('script-area')

@endsection