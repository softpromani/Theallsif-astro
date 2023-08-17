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
</style>
<div class="hs_latest_news_main_wrapper mobile-view-astro" style="padding: 25px;margin-top: 5%;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="container ">
            <div class="row ">
                <!--- Start Card ------->
                <div class="col-md-4">
                    <div class="consult-box">
                        <div class="consult-area">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="consult-title">Raj Siddhartha</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="cosult-completed"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Completed</h3>
                                </div>
                            </div>
                        </div>
                        <div class="consul-mode-commnuni">
                            <span>Made Of Communication</span>
                            <div class="consult-communication-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="consult-communi-title">Call</h3>
                                        <h3 class="consult-communi-title">Date</h3>
                                        <h3 class="consult-communi-title">Time</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="consult-commni-icon-text"><i class="fa fa-phone" aria-hidden="true"></i></h3>
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
                            <button class="consult-again-btn">Consult Again</button>
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
                                    <h3 class="consult-title">Raj Siddhartha</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="cosult-completed"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Completed</h3>
                                </div>
                            </div>
                        </div>
                        <div class="consul-mode-commnuni">
                            <span>Made Of Communication</span>
                            <div class="consult-communication-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="consult-communi-title">Call</h3>
                                        <h3 class="consult-communi-title">Date</h3>
                                        <h3 class="consult-communi-title">Time</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="consult-commni-icon-text"><i class="fa fa-phone" aria-hidden="true"></i></h3>
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
                            <button class="consult-again-btn">Consult Again</button>
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
                                    <h3 class="consult-title">Raj Siddhartha</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="cosult-completed"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Completed</h3>
                                </div>
                            </div>
                        </div>
                        <div class="consul-mode-commnuni">
                            <span>Made Of Communication</span>
                            <div class="consult-communication-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="consult-communi-title">Call</h3>
                                        <h3 class="consult-communi-title">Date</h3>
                                        <h3 class="consult-communi-title">Time</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="consult-commni-icon-text"><i class="fa fa-phone" aria-hidden="true"></i></h3>
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
                            <button class="consult-again-btn">Consult Again</button>
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
                                    <h3 class="consult-title">Raj Siddhartha</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="cosult-completed"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Completed</h3>
                                </div>
                            </div>
                        </div>
                        <div class="consul-mode-commnuni">
                            <span>Made Of Communication</span>
                            <div class="consult-communication-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="consult-communi-title">Call</h3>
                                        <h3 class="consult-communi-title">Date</h3>
                                        <h3 class="consult-communi-title">Time</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="consult-commni-icon-text"><i class="fa fa-phone" aria-hidden="true"></i></h3>
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
                            <button class="consult-again-btn">Consult Again</button>
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
                                    <h3 class="consult-title">Raj Siddhartha</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="cosult-completed"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Completed</h3>
                                </div>
                            </div>
                        </div>
                        <div class="consul-mode-commnuni">
                            <span>Made Of Communication</span>
                            <div class="consult-communication-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="consult-communi-title">Call</h3>
                                        <h3 class="consult-communi-title">Date</h3>
                                        <h3 class="consult-communi-title">Time</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="consult-commni-icon-text"><i class="fa fa-phone" aria-hidden="true"></i></h3>
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
                            <button class="consult-again-btn">Consult Again</button>
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