@extends('frontend.layout.frontend')

@section('content-area')
<style>

</style>
<div class="bs-fullscreen">
    <div id="carousel-example" class="carousel slide carousel-bg" data-ride="carousel" data-interval="3000">
        <!-- Bottom dots {indicators} -->
        <!--<ol class="carousel-indicators">-->
        <!--  <li data-target="#carousel-example" data-slide-to="0" class="active"></li>-->
        <!--  <li data-target="#carousel-example" data-slide-to="1"></li>-->
        <!--  <li data-target="#carousel-example" data-slide-to="2"></li>-->
        <!--</ol>-->

        <div class="carousel-inner" role="listbox">
            <div class="item active" style="background-image: url(frontend/asset/images/1395704.webp);">
                <!--<div class="carousel-caption">-->
                <!--  This is Text-->
                <!--</div>-->
            </div>
            <div class="item" style="background-image: url(frontend/asset/images/0mkyuf.jpg);">
                <!--<div class="carousel-caption">-->
                <!-- This is Text-->
                <!--</div>-->
            </div>
            <div class="item" style="background-image: url(frontend/asset/images/content/about_img.jpg);">
                <!--<div class="carousel-caption">-->
                <!--  This is Text-->
                <!--</div>-->
            </div>
        </div>

        <a class="left carousel-control" href="#carousel-example" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<!--<div class="slideshow-container">-->
<!--  <div class="mySlides1">-->
<!--    <img src="asset/images/1395704.webp" style="width:100%">-->
<!--  </div>-->

<!--  <div class="mySlides1">-->
<!--    <img src="asset/images/0mkyuf.jpg" style="width:100%">-->
<!--  </div>-->

<!--<div class="mySlides1">-->
<!--  <img src="asset/images/content/about_img.jpg" style="width:100%">-->
<!--</div>-->

<!--  <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>-->
<!--  <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>-->
<!--</div>-->
<!--<script>-->
<!--let slideIndex = [1,1];-->
<!--let slideId = ["mySlides1", "mySlides2"]-->
<!--showSlides(1, 0);-->
<!--showSlides(1, 1);-->

<!--function plusSlides(n, no) {-->
<!--  showSlides(slideIndex[no] += n, no);-->
<!--}-->

<!--function showSlides(n, no) {-->
<!--  let i;-->
<!--  let x = document.getElementsByClassName(slideId[no]);-->
<!--  if (n > x.length) {slideIndex[no] = 1}    -->
<!--  if (n < 1) {slideIndex[no] = x.length}-->
<!--  for (i = 0; i < x.length; i++) {-->
<!--     x[i].style.display = "none";  -->
<!--  }-->
<!--  x[slideIndex[no]-1].style.display = "block";  -->
<!--}-->
<!--</script>-->

<!--<div class="hs_latest_news_main_wrapper " style="padding: 35px;">-->
<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">-->
<!--        <div class="container ">-->
<!--            <div class="show-search-title">-->
<!--            <div class="row ">-->

<!--                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">-->
<!--                <h3>Showing 498 Astrologers</h3>-->
<!--                </div>-->

<!--                 <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">-->
<!--                <h3>Search & Filter </h3>-->
<!--                </div>-->

<!--                </div>-->
<!--                </div>-->
<!--                </div>-->
<!--                </div>-->
<!--                </div>-->

<div class="hs_latest_news_main_wrapper mobile-view-astro" style="padding: 25px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="container ">
            <div class="row ">

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 right-side-astro ">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <h3 style="margin-bottom: 20px;">Showing {{$astrologers->count()}} Astrologers</h3>
                    </div>

                    <!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
                    <!--<h3 style="margin-bottom: 20px;font-size:12px">Sort By</h3>-->
                    <!--</div>-->
                    @foreach($astrologers as $astrologer)
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="card-astro">

                            <div class="row">
                                <div class="col-md-5">
                                    <a href="{{route('details',$astrologer->id) }}">
                                        @if($astrologer->image !=null)
                                        <img class="card-astro-img" src="{{asset('images/'.$astrologer->image)}}" alt="blog_img">
                                        @else
                                        <img class="card-astro-img" src="{{ asset('frontend/asset/images/content/news_img1.jpg') }} " alt="blog_img ">
                                        @endif
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h3 class="astro-title-name">{{$astrologer->full_name ?? ''}}</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="astro-title-rating">4.5<i class="fa fa-star" aria-hidden="true"></i></h4>
                                        </div>
                                    </div>

                                    <span>Exp- {{$astrologer->experience ?? ''}}+</span><br>
                                    <span>@foreach(json_decode($astrologer->experties) as $expertie){{$expertie ??''}} @endforeach</span><br>
                                    <span>@foreach(json_decode($astrologer->language) as $lang){{$lang ??''}} @endforeach</span><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="astro-call-btn">
                                                <a href="#" @if($data=Auth::guard('customer')->user()) disable @endif >Call ${{$astrologer->costs->astrologer_cost ??''}}/Min,</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="astro-chat-btn">
                                                <a href="{{url('chatify',$astrologer->customer_astrologer->id ??'') }}">Chat {{$astrologer->costs->astrologer_cost ?? ''}}/Min,</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    @endforeach




                    <!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
                    <!--       <div class="card-astro">-->
                    <!--    <div class="row">-->

                    <!--        <div class="col-md-5">-->
                    <!--            <img class="card-astro-img"src="{{ asset('frontend/asset/images/content/news_img1.jpg') }} " alt="blog_img " > -->
                    <!--        </div>-->
                    <!--         <div class="col-md-7">-->
                    <!--             <div class="row">-->
                    <!--                 <div class="col-md-8">-->
                    <!--                     <h3 class="astro-title-name">Raj Siddhartha</h3>-->
                    <!--                 </div>-->
                    <!--                 <div class="col-md-4">-->
                    <!--                     <h4 class="astro-title-rating">4.5<i class="fa fa-star" aria-hidden="true"></i></h4>-->
                    <!--                 </div>-->
                    <!--             </div>-->

                    <!--            <span>Exp- 7 Years+</span><br>-->
                    <!--            <span>Love & Vedic Astrology</span><br>-->
                    <!--            <span>Hindi</span><br>-->
                    <!--            <div class="row">-->
                    <!--                <div class="col-md-6">-->
                    <!--                    <div  class="astro-call-btn">-->
                    <!--                    <a href="#">Call $50,$40/Min,</a>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-6">-->
                    <!--                  <div  class="astro-chat-btn">-->
                    <!--                    <a href="#">Chat $50,$40/Min,</a>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->

                    <!--    </div>-->

                    <!--    </div>-->

                    <!--    </div>-->

                    <!--     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
                    <!--       <div class="card-astro">-->
                    <!--    <div class="row">-->

                    <!--        <div class="col-md-5">-->
                    <!--            <img class="card-astro-img"src="{{ asset('frontend/asset/images/content/news_img1.jpg') }} " alt="blog_img " > -->
                    <!--        </div>-->
                    <!--         <div class="col-md-7">-->
                    <!--            <div class="row">-->
                    <!--                 <div class="col-md-8">-->
                    <!--                     <h3 class="astro-title-name">Raj Siddhartha</h3>-->
                    <!--                 </div>-->
                    <!--                 <div class="col-md-4">-->
                    <!--                     <h4 class="astro-title-rating">4.5<i class="fa fa-star" aria-hidden="true"></i></h4>-->
                    <!--                 </div>-->
                    <!--             </div>-->
                    <!--            <span>Exp- 7 Years+</span><br>-->
                    <!--            <span>Love & Vedic Astrology</span><br>-->
                    <!--            <span>Hindi</span><br>-->
                    <!--            <div class="row">-->
                    <!--                <div class="col-md-6">-->
                    <!--                    <div  class="astro-call-btn">-->
                    <!--                    <a href="#">Call $50,$40/Min,</a>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-6">-->
                    <!--                  <div  class="astro-chat-btn">-->
                    <!--                    <a href="#">Chat $50,$40/Min,</a>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->

                    <!--    </div>-->

                    <!--    </div>-->

                    <!--    </div>-->

                    <!--     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
                    <!--       <div class="card-astro">-->
                    <!--    <div class="row">-->

                    <!--        <div class="col-md-5">-->
                    <!--            <img class="card-astro-img"src="{{ asset('frontend/asset/images/content/news_img1.jpg') }} " alt="blog_img " > -->
                    <!--        </div>-->
                    <!--         <div class="col-md-7">-->
                    <!--           <div class="row">-->
                    <!--                 <div class="col-md-8">-->
                    <!--                     <h3 class="astro-title-name">Raj Siddhartha</h3>-->
                    <!--                 </div>-->
                    <!--                 <div class="col-md-4">-->
                    <!--                     <h4 class="astro-title-rating">4.5<i class="fa fa-star" aria-hidden="true"></i></h4>-->
                    <!--                 </div>-->
                    <!--             </div>-->
                    <!--            <span>Exp- 7 Years+</span><br>-->
                    <!--            <span>Love & Vedic Astrology</span><br>-->
                    <!--            <span>Hindi</span><br>-->
                    <!--            <div class="row">-->
                    <!--                <div class="col-md-6">-->
                    <!--                    <div  class="astro-call-btn">-->
                    <!--                    <a href="#">Call $50,$40/Min,</a>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-6">-->
                    <!--                  <div  class="astro-chat-btn">-->
                    <!--                    <a href="#">Chat $50,$40/Min,</a>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->

                    <!--    </div>-->

                    <!--    </div>-->

                    <!--    </div>-->

                    <!--     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
                    <!--       <div class="card-astro">-->
                    <!--    <div class="row">-->

                    <!--        <div class="col-md-5">-->
                    <!--            <img class="card-astro-img"src="{{ asset('frontend/asset/images/content/news_img1.jpg') }} " alt="blog_img " > -->
                    <!--        </div>-->
                    <!--         <div class="col-md-7">-->
                    <!--            <div class="row">-->
                    <!--                 <div class="col-md-8">-->
                    <!--                     <h3 class="astro-title-name">Raj Siddhartha</h3>-->
                    <!--                 </div>-->
                    <!--                 <div class="col-md-4">-->
                    <!--                     <h4 class="astro-title-rating">4.5<i class="fa fa-star" aria-hidden="true"></i></h4>-->
                    <!--                 </div>-->
                    <!--             </div>-->
                    <!--            <span>Exp- 7 Years+</span><br>-->
                    <!--            <span>Love & Vedic Astrology</span><br>-->
                    <!--            <span>Hindi</span><br>-->
                    <!--            <div class="row">-->
                    <!--                <div class="col-md-6">-->
                    <!--                    <div  class="astro-call-btn">-->
                    <!--                    <a href="#">Call $50,$40/Min,</a>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-6">-->
                    <!--                  <div  class="astro-chat-btn">-->
                    <!--                    <a href="#">Chat $50,$40/Min,</a>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->

                    <!--    </div>-->

                    <!--    </div>-->

                    <!--    </div>-->

                    <!--     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
                    <!--       <div class="card-astro">-->
                    <!--    <div class="row">-->

                    <!--        <div class="col-md-5">-->
                    <!--            <img class="card-astro-img"src="{{ asset('frontend/asset/images/content/news_img1.jpg') }} " alt="blog_img " > -->
                    <!--        </div>-->
                    <!--         <div class="col-md-7">-->
                    <!--            <div class="row">-->
                    <!--                 <div class="col-md-8">-->
                    <!--                     <h3 class="astro-title-name">Raj Siddhartha</h3>-->
                    <!--                 </div>-->
                    <!--                 <div class="col-md-4">-->
                    <!--                     <h4 class="astro-title-rating">4.5<i class="fa fa-star" aria-hidden="true"></i></h4>-->
                    <!--                 </div>-->
                    <!--             </div>-->
                    <!--            <span>Exp- 7 Years+</span><br>-->
                    <!--            <span>Love & Vedic Astrology</span><br>-->
                    <!--            <span>Hindi</span><br>-->
                    <!--            <div class="row">-->
                    <!--                <div class="col-md-6">-->
                    <!--                    <div  class="astro-call-btn">-->
                    <!--                    <a href="#">Call $50,$40/Min,</a>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-6">-->
                    <!--                  <div  class="astro-chat-btn">-->
                    <!--                    <a href="#">Chat $50,$40/Min,</a>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->

                    <!--    </div>-->

                    <!--    </div>-->

                    <!--    </div>-->
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                    <h3>Sarch and Filter</h3>
                </div>


                <div class="rating-area">
                    <h4>Rating</h4>
                    <input type="checkbox"> 4 & Above<br>
                    <input type="checkbox"> 3 & Above<br>
                    <input type="checkbox"> 2 & Above<br>
                    <input type="checkbox"> 1 & Above<br>
                    <span class="border-bottom-siderbar"></span>
                </div>

                <div class="rating-area">
                    <h4>Skills</h4>
                    <input type="checkbox"> Vedic Astrology<br>
                    <input type="checkbox"> Tarot Expert<br>
                    <input type="checkbox"> Numerology<br>
                    <input type="checkbox"> Naadi<br>
                    <span class="border-bottom-siderbar"></span>
                </div>

                <div class="rating-area">
                    <h4>Language </h4>
                    <input type="checkbox"> English<br>
                    <input type="checkbox"> Hindi<br>
                    <input type="checkbox"> Odia<br>
                    <input type="checkbox"> Tamil<br>
                    <span class="border-bottom-siderbar"></span>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <div class="hs_latest_news_main_wrapper " style="padding: 35px;">-->
<!--     <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">-->
<!--        <div class="container ">-->
<!--            <div class="row ">-->
<!--                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">-->



<!--                    </div>-->




<!--                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">-->
<!--                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
<!--                         <div class="card-astro">-->
<!--                        <div class="row">-->

<!--                            <div class="col-md-5">-->
<!--                                <img class="card-astro-img"src="{{ asset('frontend/asset/images/content/news_img1.jpg') }} " alt="blog_img " > -->
<!--                            </div>-->
<!--                             <div class="col-md-7">-->
<!--                                <h3>Astro Shiv</h3>-->
<!--                                <span>Exp- 7 Years+</span><br>-->
<!--                                <span>Love & Vedic Astrology</span><br>-->
<!--                                <span>Hindi</span><br>-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div  class="astro-call-btn">-->
<!--                                        <a href="#">Call $50,$40/Min,</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                      <div  class="astro-chat-btn">-->
<!--                                        <a href="#">Chat $50,$40/Min,</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                        </div>-->
<!--                        </div>-->

<!--                        </div>-->



<!--                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
<!--                           <div class="card-astro">-->
<!--                        <div class="row">-->

<!--                            <div class="col-md-5">-->
<!--                                <img class="card-astro-img"src="{{ asset('frontend/asset/images/content/news_img1.jpg') }} " alt="blog_img " > -->
<!--                            </div>-->
<!--                             <div class="col-md-7">-->
<!--                                <h3>Astro Shiv</h3>-->
<!--                                <span>Exp- 7 Years+</span><br>-->
<!--                                <span>Love & Vedic Astrology</span><br>-->
<!--                                <span>Hindi</span><br>-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div  class="astro-call-btn">-->
<!--                                        <a href="#">Call $50,$40/Min,</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                      <div  class="astro-chat-btn">-->
<!--                                        <a href="#">Chat $50,$40/Min,</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                        </div>-->
<!--                        </div>-->

<!--                        </div>-->

<!--                    </div>-->

<!--                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">-->
<!--                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
<!--                         <div class="card-astro">-->
<!--                        <div class="row">-->

<!--                            <div class="col-md-5">-->
<!--                                <img class="card-astro-img"src="{{ asset('frontend/asset/images/content/news_img1.jpg') }} " alt="blog_img " > -->
<!--                            </div>-->
<!--                             <div class="col-md-7">-->
<!--                                <h3>Astro Shiv</h3>-->
<!--                                <span>Exp- 7 Years+</span><br>-->
<!--                                <span>Love & Vedic Astrology</span><br>-->
<!--                                <span>Hindi</span><br>-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div  class="astro-call-btn">-->
<!--                                        <a href="#">Call $50,$40/Min,</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                      <div  class="astro-chat-btn">-->
<!--                                        <a href="#">Chat $50,$40/Min,</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                        </div>-->
<!--                        </div>-->

<!--                        </div>-->



<!--                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
<!--                           <div class="card-astro">-->
<!--                        <div class="row">-->

<!--                            <div class="col-md-5">-->
<!--                                <img class="card-astro-img"src="{{ asset('frontend/asset/images/content/news_img1.jpg') }} " alt="blog_img " > -->
<!--                            </div>-->
<!--                             <div class="col-md-7">-->
<!--                                <h3>Astro Shiv</h3>-->
<!--                                <span>Exp- 7 Years+</span><br>-->
<!--                                <span>Love & Vedic Astrology</span><br>-->
<!--                                <span>Hindi</span><br>-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div  class="astro-call-btn">-->
<!--                                        <a href="#">Call $50,$40/Min,</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                      <div  class="astro-chat-btn">-->
<!--                                        <a href="#">Chat $50,$40/Min,</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                        </div>-->
<!--                        </div>-->

<!--                        </div>-->



<!--                    </div>-->




<!--                  </div>-->

<!--                    </div>-->
<!--                    </div>-->
<!--</div>-->


<!-- hs_slider_bottom_wrapper Start -->
<!-- <div class="hs_slider_bottom_wrapper ">
            <div class="container ">
                <div class="row ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <div class="hs_slider_bottom_box ">
                            <form>
                                <div class="form-group ">
                                    <input type="text " class="form-control " name="nameOne " placeholder="My Name is ">
                                </div>
                                <div class="form-group ">
                                    <select class="gender_select " name="gender ">
										<option value="male ">Male</option>
										<option value="female ">Female</option>
									</select>
                                </div>
                                <div class="form-group ">
                                    <input type="text " class="form-control " id="datepicker ">
                                </div>
                                <div class="form-group ">
                                    <select class="phone_select " name="phone ">
										<option value="india ">+91(india) </option>
										<option value="india ">+91(india) </option>
									</select>
                                </div>
                                <div class="form-group ">
                                    <input type="text " class="form-control " name="phone_no " placeholder="Mobile Number ">
                                </div>
                                <div class="form-group ">
                                    <input type="email " class="form-control " name="email " placeholder="Email ">
                                </div>
                                <div class="form-group ">
                                    <input type="password " class="form-control " name="Password " placeholder="Password ">
                                </div>
                                <div class="remember_box ">
                                    <label class="control control--checkbox "> Terms-and-conditions
									<input type="checkbox ">
										<span class="control__indicator "></span>
									</label>
                                </div>
                                <div class="hs_effect_btn ">
                                    <ul>
                                        <li data-animation="animated flipInX "><a href="# " class="hs_btn_hover ">Get Free Account</a></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
<!-- hs_slider_bottom_wrapper End -->

<!-- hs latest news wrapper Start -->
<!--<div class="hs_latest_news_main_wrapper " style="padding: 35px;">-->
<!--    <div class="container ">-->
<!--        <div class="row ">-->
<!--            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">-->
<!--                <div class="hs_about_heading_main_wrapper ">-->
<!--                    <div class="hs_about_heading_wrapper ">-->
<!--                        <h2>Top <span> Astrologers</span></h2>-->
<!--                        <h4><span>&nbsp;</span></h4>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">-->
<!--                <div class="hs_lest_news_box_wrapper ">-->
<!--                    <div class="hs_lest_news_img_wrapper ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }} " alt="blog_img ">-->
<!--                        <ul>-->
<!--                            <li><a href="# "><i class="fa fa-phone "></i>&nbsp; Call Now</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                    <div class="hs_lest_news_cont_wrapper ">-->
<!--                        <div class="hs_lest_news_meta_wrapper ">-->
<!--                            <ul>-->
<!--                                <li>-->
<!--                                    <a href="# ">By - Admin</a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="# ">256 Comments</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                        <h5>Proin gravida nibh vel velit auctor aliquet.</h5>-->
<!--                        <p>Lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet.</p>-->
<!--                        <h4><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h4>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">-->
<!--                <div class="hs_lest_news_box_wrapper ">-->
<!--                    <div class="hs_lest_news_img_wrapper ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/news_img2.jpg ') }}" alt="blog_img ">-->
<!--                        <ul>-->
<!--                            <li><a href="# "><i class="fa fa-phone "></i>&nbsp; Call Now</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                    <div class="hs_lest_news_cont_wrapper ">-->
<!--                        <div class="hs_lest_news_meta_wrapper ">-->
<!--                            <ul>-->
<!--                                <li>-->
<!--                                    <a href="# ">By - Admin</a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="# ">256 Comments</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                        <h5>Proin gravida nibh vel velit auctor aliquet.</h5>-->
<!--                        <p>Lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet.</p>-->
<!--                        <h4><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h4>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">-->
<!--                <div class="hs_lest_news_box_wrapper ">-->
<!--                    <div class="hs_lest_news_img_wrapper ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/news_img3.jpg ') }}" alt="blog_img ">-->
<!--                        <ul>-->
<!--                            <li><a href="# "><i class="fa fa-phone "></i>&nbsp; Call Now</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                    <div class="hs_lest_news_cont_wrapper ">-->
<!--                        <div class="hs_lest_news_meta_wrapper ">-->
<!--                            <ul>-->
<!--                                <li>-->
<!--                                    <a href="# ">By - Admin</a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="# ">256 Comments</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                        <h5>Proin gravida nibh vel velit auctor aliquet.</h5>-->
<!--                        <p>Lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet.</p>-->
<!--                        <h4><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h4>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">-->
<!--                <div class="hs_effect_btn ">-->
<!--                    <ul>-->
<!--                        <li><a href="# " class="hs_btn_hover ">View All</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!-- hs latest news wrapper End -->

<!-- hs_sign_wrapper Start -->
<!--<div class="hs_sign_wrapper ">-->
<!--    <div class="container ">-->
<!--        <div class="hs_sign_heading_wrapper ">-->
<!--            <div class="hs_about_heading_main_wrapper ">-->
<!--                <div class="hs_about_heading_wrapper ">-->
<!--                    <h2><i class="fa fa-clock "></i>Choose Your <span>Zodiac Sign</span></h2>-->
<!--                    <h4><span>&nbsp;</span></h4>-->
<!--                    <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum<br> auctor, nisi elit consequat hello Aenean world.</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row ">-->
<!--            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 ">-->
<!--                <div class="hs_sign_box ">-->
<!--                    <div class="sign_box_img ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/icon1.png')  }}" alt="icon1 ">-->
<!--                    </div>-->
<!--                    <div class="sign_box_cont ">-->
<!--                        <h2>Aries</h2>-->
<!--                        <p>31 Mar - 12 Oct</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 ">-->
<!--                <div class="hs_sign_box ">-->
<!--                    <div class="sign_box_img ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/icon2.png') }} " alt="icon2 ">-->
<!--                    </div>-->
<!--                    <div class="sign_box_cont ">-->
<!--                        <h2>Taurus</h2>-->
<!--                        <p>31 Mar - 12 Oct</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 ">-->
<!--                <div class="hs_sign_box ">-->
<!--                    <div class="sign_box_img ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/icon3.png') }} " alt="icon3 ">-->
<!--                    </div>-->
<!--                    <div class="sign_box_cont ">-->
<!--                        <h2>Gemini</h2>-->
<!--                        <p>31 Mar - 12 Oct</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 ">-->
<!--                <div class="hs_sign_box ">-->
<!--                    <div class="sign_box_img ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/icon4.png') }} " alt="icon4 ">-->
<!--                    </div>-->
<!--                    <div class="sign_box_cont ">-->
<!--                        <h2>Cancer</h2>-->
<!--                        <p>31 Mar - 12 Oct</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 ">-->
<!--                <div class="hs_sign_box ">-->
<!--                    <div class="sign_box_img ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/icon5.png ') }}" alt="icon5 ">-->
<!--                    </div>-->
<!--                    <div class="sign_box_cont ">-->
<!--                        <h2>leo</h2>-->
<!--                        <p>31 Mar - 12 Oct</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 ">-->
<!--                <div class="hs_sign_box ">-->
<!--                    <div class="sign_box_img ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/icon6.png ') }}" alt="icon6 ">-->
<!--                    </div>-->
<!--                    <div class="sign_box_cont ">-->
<!--                        <h2>Virgo</h2>-->
<!--                        <p>31 Mar - 12 Oct</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 ">-->
<!--                <div class="hs_sign_box ">-->
<!--                    <div class="sign_box_img ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/icon7.png' ) }}" alt="icon7 ">-->
<!--                    </div>-->
<!--                    <div class="sign_box_cont ">-->
<!--                        <h2>Libra</h2>-->
<!--                        <p>31 Mar - 12 Oct</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 ">-->
<!--                <div class="hs_sign_box ">-->
<!--                    <div class="sign_box_img ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/icon8.png' ) }}" alt="icon8 ">-->
<!--                    </div>-->
<!--                    <div class="sign_box_cont ">-->
<!--                        <h2>Scorpio</h2>-->
<!--                        <p>31 Mar - 12 Oct</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 ">-->
<!--                <div class="hs_sign_box ">-->
<!--                    <div class="sign_box_img ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/icon9.png') }} " alt="icon9 ">-->
<!--                    </div>-->
<!--                    <div class="sign_box_cont ">-->
<!--                        <h2>Sagittairus</h2>-->
<!--                        <p>31 Mar - 12 Oct</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 ">-->
<!--                <div class="hs_sign_box ">-->
<!--                    <div class="sign_box_img ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/icon10.png ') }}" alt="icon10 ">-->
<!--                    </div>-->
<!--                    <div class="sign_box_cont ">-->
<!--                        <h2>Capricorn</h2>-->
<!--                        <p>31 Mar - 12 Oct</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 ">-->
<!--                <div class="hs_sign_box ">-->
<!--                    <div class="sign_box_img ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/icon11.png ') }}" alt="icon11 ">-->
<!--                    </div>-->
<!--                    <div class="sign_box_cont ">-->
<!--                        <h2>Aquarius</h2>-->
<!--                        <p>31 Mar - 12 Oct</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 ">-->
<!--                <div class="hs_sign_box ">-->
<!--                    <div class="sign_box_img ">-->
<!--                        <img src="{{ asset('frontend/asset/images/content/icon12.png') }} " alt="icon12 ">-->
<!--                    </div>-->
<!--                    <div class="sign_box_cont ">-->
<!--                        <h2>Pisces</h2>-->
<!--                        <p>31 Mar - 12 Oct</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!-- hs_sign_wrapper Start -->
<!--</div>-->
<!-- hs sign wrapper End -->
<!-- hs title wrapper Start -->
<!--<div class="hs_title_main_wrapper ">
        <div class="container ">
            <div class="row ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="hs_about_heading_main_wrapper ">
                        <div class="hs_about_heading_wrapper ">
                            <h2>Our Most <span>Services</span></h2>
                            <h4><span>&nbsp;</span></h4>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum<br> auctor, nisi elit consequat hello Aenean world.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                    <div class="hs_title_box_main_wrapper ">
                        <div class="hs_title_img_wrapper ">
                            <img src="images/content/title_img1.jpg " alt="totle_img ">
                            <ul>
                                <li>$14</li>
                            </ul>
                        </div>
                        <div class="hs_title_img_cont_wrapper ">
                            <h2><a href="# ">Tarot Reading</a></h2>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis.</p>
                            <h5><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                    <div class="hs_title_box_main_wrapper ">
                        <div class="hs_title_img_wrapper ">
                            <img src="images/content/title_img2.jpg " alt="totle_img ">
                            <ul>
                                <li>$12</li>
                            </ul>
                        </div>
                        <div class="hs_title_img_cont_wrapper ">
                            <h2><a href="# ">Crystal ball reading</a></h2>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis.</p>
                            <h5><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                    <div class="hs_title_box_main_wrapper ">
                        <div class="hs_title_img_wrapper ">
                            <img src="images/content/title_img3.jpg " alt="totle_img ">
                            <ul>
                                <li>$22</li>
                            </ul>
                        </div>
                        <div class="hs_title_img_cont_wrapper ">
                            <h2><a href="# ">Palm Reading</a></h2>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis.</p>
                            <h5><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="hs_effect_btn ">
                        <ul>
                            <li><a href="# " class="hs_btn_hover ">View All</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
<!-- hs title wrapper End -->
<!-- hs news slider wrapper Start -->
<!--  <div class="hs_news_slider_main_wrapper ">
        <!-- hs_news_slider_bg_main_wrapper Start -->
<!-- <div class="hs_news_slider_bg_main_wrapper ">
            <div class="container ">
                <div class="row ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <div class="hs_news_slider_bg_wrapper ">
                            <div class="hs_news_slider_bg_overlay "></div>
                            <div class="row ">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                    <div class="hs_news_slider_wrapper ">
                                        <div class="owl-carousel owl-theme ">
                                            <div class="item ">
                                                <div class="hs_news_slider_cont_wrapper ">
                                                    <h2>Today Horoscope</h2>
                                                    <h3>Believe in things that can fortunately<br> change your life</h3>
                                                    <p>This is Photoshop's version of Lorem ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem<br> quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                                                    <div class="hs_effect_btn hs_news_slider_btn_wrapper ">
                                                        <ul>
                                                            <li><a href="# " class="hs_btn_hover ">Read more</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item ">
                                                <div class="hs_news_slider_cont_wrapper ">
                                                    <h2>Today Horoscope</h2>
                                                    <h3>Believe in things that can fortunately<br> change your life</h3>
                                                    <p>This is Photoshop's version of Lorem ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem<br> quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                                                    <div class="hs_effect_btn hs_news_slider_btn_wrapper ">
                                                        <ul>
                                                            <li><a href="# " class="hs_btn_hover ">Read more</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item ">
                                                <div class="hs_news_slider_cont_wrapper ">
                                                    <h2>Today Horoscope</h2>
                                                    <h3>Believe in things that can fortunately<br> change your life</h3>
                                                    <p>This is Photoshop's version of Lorem ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem<br> quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                                                    <div class="hs_effect_btn hs_news_slider_btn_wrapper ">
                                                        <ul>
                                                            <li><a href="# " class="hs_btn_hover ">Read more</a></li>
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
                </div>
            </div>
        </div>-->
<!-- hs_news_slider_bg_main_wrapper end -->
<!--   </div>-->
<!-- hs news slider wrapper end -->
<!-- hs about ind wrapper Start -->
<!--<div class="hs_about_indx_main_wrapper ">-->
<!--    <div class="container ">-->
<!--        <div class="row ">-->
<!--            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
<!--                <div class="hs_about_left_img_wrapper ">-->
<!--                    <img src="{{ asset('frontend/asset/images/content/about_img.jpg ') }}" alt="about_img " />-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
<!--                <div class="hs_about_heading_main_wrapper ">-->
<!--                    <div class="hs_about_heading_wrapper ">-->
<!--                        <h2>About <span>9StarSastro</span></h2>-->
<!--                        <h4><span>&nbsp;</span></h4>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="hs_about_right_cont_wrapper ">-->
<!--                    <h1>+1800-123-123</h1>-->
<!--                    <h2>Horoscope Revels The Will Of God</h2>-->
<!--                    <p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti<br><br>                            sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue.</p>-->

<!--                    <div class="hs_effect_btn hs_about_btn ">-->
<!--                        <ul>-->
<!--                            <li><a href="# " class="hs_btn_hover ">Read more</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!-- hs about ind wrapper End -->
<!-- hs testi slider wrapper Start -->
<!--<div class="hs_testi_slider_main_wrapper ">-->
<!--    <div class="container ">-->
<!--        <div class="row ">-->
<!--            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">-->
<!--                <div class="hs_about_heading_main_wrapper ">-->
<!--                    <div class="hs_about_heading_wrapper ">-->
<!--                        <h2>What clients <span> are saying</span></h2>-->
<!--                        <h4><span>&nbsp;</span></h4>-->
<!--                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum<br> auctor, nisi elit consequat hello Aenean world.</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">-->
<!--                <div class="hs_testi_slider_wrapper ">-->
<!--                    <div class="owl-carousel owl-theme ">-->
<!--                        <div class="item ">-->
<!--                            <div class="row ">-->
<!--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">-->
<!--                                    <div class="testimonial_slider_content ">-->
<!--                                        <img src="{{ asset('frontend/asset/images/content/testi_client_img1.jpg ') }}" class="img-responsive " alt="section3_t2__img " />-->
<!--                                        <h5>Ralph Rios</h5>-->
<!--                                        <small>Creative Director</small>-->
<!--                                        <h4><span>&nbsp;</span></h4>-->
<!--                                        <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer galley of type.</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-xs ">-->
<!--                                    <div class="testimonial_slider_content ">-->
<!--                                        <img src="{{ asset('frontend/asset/images/content/testi_client_img2.jpg ') }}" class="img-responsive " alt="section3_t2__img " />-->
<!--                                        <h5>Ralph Rios</h5>-->
<!--                                        <small>Creative Director</small>-->
<!--                                        <h4><span>&nbsp;</span></h4>-->
<!--                                        <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer galley of type.</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="item ">-->
<!--                            <div class="row ">-->
<!--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">-->
<!--                                    <div class="testimonial_slider_content ">-->
<!--                                        <img src="{{ asset('frontend/asset/images/content/testi_client_img1.jpg ') }}" class="img-responsive " alt="section3_t2__img " />-->
<!--                                        <h5>Ralph Rios</h5>-->
<!--                                        <small>Creative Director</small>-->
<!--                                        <h4><span>&nbsp;</span></h4>-->
<!--                                        <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer galley of type.</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-xs ">-->
<!--                                    <div class="testimonial_slider_content ">-->
<!--                                        <img src="{{ asset('frontend/asset/images/content/testi_client_img2.jpg') }} " class="img-responsive " alt="section3_t2__img " />-->
<!--                                        <h5>Ralph Rios</h5>-->
<!--                                        <small>Creative Director</small>-->
<!--                                        <h4><span>&nbsp;</span></h4>-->
<!--                                        <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer galley of type.</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="item ">-->
<!--                            <div class="row ">-->
<!--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">-->
<!--                                    <div class="testimonial_slider_content ">-->
<!--                                        <img src="{{ asset('frontend/asset/images/content/testi_client_img1.jpg') }} " class="img-responsive " alt="section3_t2__img " />-->
<!--                                        <h5>Ralph Rios</h5>-->
<!--                                        <small>Creative Director</small>-->
<!--                                        <h4><span>&nbsp;</span></h4>-->
<!--                                        <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer galley of type.</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-xs ">-->
<!--                                    <div class="testimonial_slider_content ">-->
<!--                                        <img src="{{ asset('frontend/asset/images/content/testi_client_img2.jpg ') }}" class="img-responsive " alt="section3_t2__img " />-->
<!--                                        <h5>Ralph Rios</h5>-->
<!--                                        <small>Creative Director</small>-->
<!--                                        <h4><span>&nbsp;</span></h4>-->
<!--                                        <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer galley of type.</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!-- hs testi slider wrapper End -->
<!-- hs service wrapper Start -->
<!--<div class="hs_service_main_wrapper ">
        <div class="container ">
            <div class="row ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="hs_about_heading_main_wrapper ">
                        <div class="hs_about_heading_wrapper ">
                            <h2>Our <span> services</span></h2>
                            <h4><span>&nbsp;</span></h4>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum<br> auctor, nisi elit consequat hello Aenean world.</p>
                        </div>
                    </div>
                </div>
                <div class="portfolio-area ptb-100 ">
                    <div class="container ">
                        <div class="row ">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="hs_service_main_box_wrapper ">
                                    <div class="hs_service_icon_wrapper ">
                                        <i class="flaticon-success "></i>
                                        <div class="btc_step_overlay "></div>
                                    </div>
                                    <div class="hs_service_icon_cont_wrapper ">
                                        <h2>Career</h2>
                                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean .</p>
                                        <h5><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="hs_service_main_box_wrapper ">
                                    <div class="hs_service_icon_wrapper ">
                                        <i class="flaticon-marry-me "></i>
                                        <div class="btc_step_overlay "></div>
                                    </div>
                                    <div class="hs_service_icon_cont_wrapper ">
                                        <h2>marriage</h2>
                                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean .</p>
                                        <h5><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="hs_service_main_box_wrapper ">
                                    <div class="hs_service_icon_wrapper ">
                                        <i class="flaticon-islamic-temple "></i>
                                        <div class="btc_step_overlay "></div>
                                    </div>
                                    <div class="hs_service_icon_cont_wrapper ">
                                        <h2>Worship lesson</h2>
                                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean .</p>
                                        <h5><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="hs_service_main_box_wrapper ">
                                    <div class="hs_service_icon_wrapper ">
                                        <i class="flaticon-pregnancy "></i>
                                        <div class="btc_step_overlay "></div>
                                    </div>
                                    <div class="hs_service_icon_cont_wrapper ">
                                        <h2>Pregnancy</h2>
                                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean .</p>
                                        <h5><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="hs_service_main_box_wrapper ">
                                    <div class="hs_service_icon_wrapper ">
                                        <i class="flaticon-engagement-ring "></i>
                                        <div class="btc_step_overlay "></div>
                                    </div>
                                    <div class="hs_service_icon_cont_wrapper ">
                                        <h2>Manglik Dosha</h2>
                                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean .</p>
                                        <h5><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="hs_service_main_box_wrapper ">
                                    <div class="hs_service_icon_wrapper ">
                                        <i class="flaticon-animal "></i>
                                        <div class="btc_step_overlay "></div>
                                    </div>
                                    <div class="hs_service_icon_cont_wrapper ">
                                        <h2>Kundli Dosha</h2>
                                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean .</p>
                                        <h5><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="hs_service_main_box_wrapper ">
                                    <div class="hs_service_icon_wrapper ">
                                        <i class="flaticon-giftboxes "></i>
                                        <div class="btc_step_overlay "></div>
                                    </div>
                                    <div class="hs_service_icon_cont_wrapper ">
                                        <h2>Festivals</h2>
                                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean .</p>
                                        <h5><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="hs_service_main_box_wrapper ">
                                    <div class="hs_service_icon_wrapper ">
                                        <i class="flaticon-baby-with-diaper "></i>
                                        <div class="btc_step_overlay "></div>
                                    </div>
                                    <div class="hs_service_icon_cont_wrapper ">
                                        <h2>Name Analysis</h2>
                                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean .</p>
                                        <h5><a href="# ">Read More <i class="fa fa-long-arrow-right "></i></a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
<!--  </div>-->
<!-- /.container -->
<!--   </div>-->
<!--/.portfolio-area-->
<!--   </div>
        </div>
    </div>-->
<!-- hs service wrapper End -->
<!-- hs Counter wrapper Start -->
<!-- <div class="hs_counter_main_wrapper ">
        <div class="hs_counter_cont_wrapper ">
            <div class="count-description ">
                <span class="timer ">123</span>
                <h5 class="con1 ">Trusted by<br> Million Clients</h5>
            </div>
        </div>
        <div class="hs_counter_cont_wrapper hs_counter_cont_wrapper2 ">
            <div class="count-description ">
                <span class="timer ">16</span>
                <h5 class="con2 ">Years of<br> Experience
                </h5>
            </div>
        </div>
        <div class="hs_counter_cont_wrapper ">
            <div class="count-description ">
                <span class="timer ">13</span>
                <h5 class="con3 ">Types of <br> Horoscopes
                </h5>
            </div>
        </div>
        <div class="hs_counter_cont_wrapper hs_counter_cont_wrapper4 ">
            <div class="count-description ">
                <span class="timer ">16</span>
                <h5 class="con4 ">Qualified <br> Astrologers
                </h5>
            </div>
        </div>
        <div class="hs_counter_cont_wrapper hs_counter_cont_wrapper5 ">
            <div class="count-description ">
                <span class="timer ">36</span>
                <h5 class="con4 ">Sucess<br> Jyotish
                </h5>
            </div>
        </div>
    </div>-->
<!-- hs Counter wrapper End -->
<!-- hs astrology team wrapper Start -->
@endsection
<!-- script for particular page -->
@section('script-area')

@endsection