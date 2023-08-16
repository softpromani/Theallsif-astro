@extends('frontend.layout.frontend')
@section('content-area')
<style>
    .card-payment {
        box-shadow: 0px 0px 35px -20px;
        padding: 30px;
        margin: 10px 0px 40px 0px;
        border-radius: 20px;
    }

    .promo-code {
        text-align: center;
        background-image: linear-gradient(to right, #800080, #008000);
        color: #fff;
        padding: 10px;
        margin: 15px 0px;
        border-radius: 25px 0px;
    }

    .add-payment {
        border: 1px solid #cfcfcf;
        padding: 20px;
        border-radius: 25px 0px;
    }

    .add-payment h5 {
        font-size: 18px;
        font-weight: 600;
        margin: 10px 0px;
        color: #008000;
    }

    .add-payment-title {
        color: #FACC2E;
    }

    .add-payment-boxes {
        margin: 30px 0px;
    }

    .add-payment-btn {
        background: purple;
        padding: 5px;
        border-top-right-radius: 20px;
        border-bottom-left-radius: 20px;
        margin-top: 10px;
    }

    .add-payment-btn {
        background: #FACC2E;
        padding: 10px;
        border: none;
        color: #fff;
        border-radius: 20px 0px;
        float: right;
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
                        <h3>Crurrent Balance : ₹562</h3>
                        <div class="promo-code">
                            <p>Use Code Wish - Pay ₹1000 and Get ₹3000 in your wallet! 3X Saving </p>
                        </div>
                        <p>Minimum 5 min chat/call balance required </p>
                        <h3 style="margin: 10px 0px;">Add Money to Astrology Wallet</h3>
                        <div class="add-payment-boxes">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="add-payment">
                                        <h4> &nbsp;&nbsp; </h4>
                                        <h5> ₹262</h5>
                                        <p>you'll get ₹352</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="add-payment">
                                        <h4 class="add-payment-title">New User</h4>
                                        <h5> ₹262</h5>
                                        <p>you'll get ₹352</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="add-payment">
                                        <h4 class="add-payment-title">Super Sale</h4>
                                        <h5> ₹262</h5>
                                        <p>you'll get ₹352</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="add-payment">
                                        <h4 class="add-payment-title">Super Value</h4>
                                        <h5> ₹262</h5>
                                        <p>you'll get ₹352</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="text" class="form-control" id="amount" placeholder="Add Amount" name="amount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="promocode">Get a Promocode</label>
                                    <input type="text" class="form-control" id="promocode" placeholder="Add Promocode Here" name="promocode">
                                </div>
                                <button type="submit" class="add-payment-btn">Proceed To Pay</button>
                            </div>
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