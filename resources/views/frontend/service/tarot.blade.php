@extends('frontend.layout.frontend')

@section('content-area')
<!-- main_header_wrapper end -->
<!-- hs About Title Start -->
<div class="hs_indx_title_main_wrapper">
    <div class="hs_title_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
                <div class="hs_indx_title_left_wrapper">
                    <h2>Tarot</h2>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  full_width">
                <div class="hs_indx_title_right_wrapper">
                    <ul>
                        <li><a href="#">Home</a> &nbsp;&nbsp;&nbsp;> </li>
                        <li>Tarot</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- hs About Title End -->
<!-- hs sidebar Start -->
<div class="hs_kd_sidebar_main_wrapper hs_num_sidebar_main_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="hs_kd_left_sidebar_main_wrapper">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="hs_trt_img_wrapper">
                                <img src="{{asset('frontend/asset/images/content/kundali/tarot_1.jpg')}}" alt="tarot" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="hs_kd_first_sec_wrapper hs_trt_first_cont">
                                <h2>Universal 6 Card</h2>
                                <h4><span>&nbsp;</span></h4>
                                <p>Aenean sollicitudin, lorem quis bibendum ctor, nisi elit consequat ipsum, nec sagittis sem nh id elit. Duis sed odio sit amet nibh vulputate us a sit amet mauris. Morbi accumsan ipsum lit. Nam nec tellus a odio tincidunt
                                    auctor a orare odio. Sed on mauris vitae erat consequat actor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos aos. Mauris in erat justo. Nullam ac urna eu felis dapibus
                                    condimentum sit amet a augue. Sd non neque elit. Sed ut imperdiet nisi. Proin um fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit uris egestas.</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hs_trt_second_cont">
                                <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a
                                    odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Clvass aptent taciti sociosqu ad litora torquent pe conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam
                                    ac urna eu felis dapibus condimentum sit amt a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc.</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hs_kd_first_sec_wrapper hs_trt_third_cont">
                                <h2>Welcome to Aeclectic Tarot!</h2>
                                <h4><span>&nbsp;</span></h4>
                                <p>Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit as consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a
                                    sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia
                                    nostra, per inceptos himenaeos. Mauris erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue.</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hs_kd_first_sec_wrapper hs_trt_third_cont">
                                <h2>Pick a card</h2>
                                <h4><span>&nbsp;</span></h4>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hs_trt_cards_main_wrapper">
                                <ul>
                                    <li class="hs_card_hover">
                                        <div class="hs_trt_card1">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/card1.jpg')}}" alt="card_img">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/p01.jpg')}}" alt="card_img">
                                        </div>
                                    </li>
                                    <li class="hs_card_hover">
                                        <div class="hs_trt_card1">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/card2.jpg')}}" alt="card_img">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/p02.jpg')}}" alt="card_img">
                                        </div>
                                    </li>
                                    <li class="hs_card_hover">
                                        <div class="hs_trt_card1">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/card1.jpg')}}" alt="card_img">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/p03.jpg')}}" alt="card_img">
                                        </div>
                                    </li>
                                    <li class="hs_card_hover">
                                        <div class="hs_trt_card1">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/card2.jpg')}}" alt="card_img">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/p04.jpg')}}" alt="card_img">
                                        </div>
                                    </li>
                                    <li class="hs_card_hover">
                                        <div class="hs_trt_card1">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/card1.jpg')}}" alt="card_img">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/p05.jpg')}}" alt="card_img">
                                        </div>
                                    </li>
                                    <li class="hs_card_hover">
                                        <div class="hs_trt_card1">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/card2.jpg')}}" alt="card_img">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/p06.jpg')}}" alt="card_img">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hs_kd_first_sec_wrapper hs_trt_third_cont">
                                <h2>What's Popular in Tarot Cards Now</h2>
                                <h4><span>&nbsp;</span></h4>
                                <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a
                                    odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torqent per conubia nostra, per inceptos himenaeos. Mauris in erat justo.</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hs_trt_card_bottom_wrapper">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="hs_trt_card_bottom_box_wrapper">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/trt1.jpg')}}" alt="trt_card">
                                            <h2><a href="#">Ostara Tarot</a></h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="hs_trt_card_bottom_box_wrapper">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/trt2.jpg')}}" alt="trt_card">
                                            <h2><a href="#">Vice-Versa Tarot</a></h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="hs_trt_card_bottom_box_wrapper">
                                            <img src="{{asset('frontend/asset/images/content/kundali/card/trt3.jpg')}}" alt="trt_card">
                                            <h2><a href="#">Healing Light Tarot</a></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="hs_kd_right_sidebar_main_wrapper">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hs_kd_right_first_sec_wrapper">
                                <div class="hs_kd_right_first_sec_heading">
                                    <h2>kundali patrikla</h2>
                                </div>
                                <div class="hs_kd_right_first_sec_img_heading">
                                    <img src="{{asset('frontend/asset/images/content/kundali/patrika.jpg')}}" alt="patrika" />
                                </div>
                                <div class="hs_kd_right_first_sec_img_price_heading">
                                    <ul>
                                        <li>Kundli Patrika</li>
                                        <li>$26</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hs_kd_right_first_sec_wrapper2">
                                <div class="hs_kd_right_first_sec_heading">
                                    <h2>Mangala Dosha</h2>
                                </div>
                                <div class="hs_kd_right_first_sec_img_heading">
                                    <img src="{{asset('frontend/asset/images/content/kundali/patrika2.jpg')}}" alt="patrika" />
                                </div>
                                <div class="hs_kd_right_first_sec_img_price_heading">
                                    <ul>
                                        <li>Kundli Patrika</li>
                                        <li>$26</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hs_kd_right_first_sec_wrapper2">
                                <div class="hs_kd_right_first_sec_heading">
                                    <h2>Black magic</h2>
                                </div>
                                <div class="hs_kd_right_first_sec_img_heading">
                                    <img src="{{asset('frontend/asset/images/content/kundali/patrika3.jpg')}}" alt="patrika" />
                                </div>
                                <div class="hs_kd_right_first_sec_img_price_heading">
                                    <ul>
                                        <li>Kundli Patrika</li>
                                        <li>$26</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hs_kd_right_second_sec_wrapper">
                                <div class="hs_kd_right_second_img_wrapper">
                                    <img src="{{asset('frontend/asset/images/content/kundali/love_img.jpg')}}" alt="love_img" />
                                </div>
                                <div class="hs_kd_right_second_img_cont_wrapper">
                                    <p>How Will Be Your</p>
                                    <h3>Love Life?</h3>
                                    <ul>
                                        <li><a href="#">find now for free</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- hs sidebar End -->
@endsection
<!-- script for particular page -->
@section('script-area')

@endsection