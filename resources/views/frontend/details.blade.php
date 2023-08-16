@extends('frontend.layout.frontend')
@section('content-area')
<!--<style>-->
<!--    .right-side-about-astro {-->
<!--    border: 1px solid #bfbfbf;-->
<!--    padding: 20px;-->
<!--    border-radius: 8px;-->
<!--}-->
<!--.right-sider-icon {-->
<!--    border: 1px solid #FACC2E;-->
<!--    padding: 12px 0px 12px 5px;-->
<!--    border-radius: 50px;-->
<!--}-->
<!--.right-sider-icon i {-->
<!--    text-align: center;-->
<!--    display: block;-->
<!--    font-size: 30px;-->
<!--}-->
<!--.left-side-card {-->
<!--    border: 1px solid #bfbfbf;-->
<!--    padding-top: 150px;-->
<!--    padding-bottom: 50px;-->
<!--    padding-left: 50px;-->
<!--    padding-right: 50px;-->
<!--    border-radius: 10px;-->
<!--    background: linear-gradient(0deg, rgb(255 255 255) 50%, #FACC2E 50%);-->
<!--}-->
<!--.left-side-internal-card {-->
<!--    border: 1px solid #bfbfbf;-->
<!--    background: #fff;-->
<!--    padding: 30px;-->
<!--    border-radius: 20px;-->
<!--}-->
<!--.left-side-internal-card img{-->
<!--    width: 185px;-->
<!--    border-radius: 100px;-->
<!--    height: 180px;-->
<!--    margin-top: -125px;-->
<!--}-->
<!--.left-side-internal-card h3{-->
<!--    font-size:20px;-->
<!--    margin-top:10px;-->
<!--}-->
<!--.left-side-internal-card p{-->
<!--    font-size:14px;-->
<!--}-->
<!--.right-side-love-btn1 {-->
<!--    border: 1px solid blue;-->
<!--    padding: 5px;-->
<!--    font-size: 14px;-->
<!--    border-radius: 50px;-->
<!--}-->
<!--.right-side-love-btn2 {-->
<!--    border: 1px solid orange;-->
<!--    padding: 5px;-->
<!--    font-size: 14px;-->
<!--    border-radius: 50px;-->
<!--}-->
<!--.astro-three-tab {-->
<!--    margin-top: 25px;-->
<!--    text-align: center;-->
<!--}-->
<!--.astro-detail-btn a {-->
<!--    font-size: 14px;-->
<!--    padding: 5px;-->
<!--}-->
<!--.astro-detail-btn{-->
<!--     margin-top: 20px; -->
<!--}-->
<!--.astro-about-leftside {-->
<!--    margin-top: 25px;-->
<!--}-->
<!--</style>-->


<div class="hs_latest_news_main_wrapper mobile-view-astro" style="padding: 25px;margin-top: 5%;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="container ">
            <div class="row ">

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                    <div class="left-side-card">
                        <div class="left-side-internal-card">
                            <div class="row">
                                <div class="col-md-5">
                                    @if($astrologer->image !=null)
                                    <img src="{{asset('images/'.$astrologer->image)}}" alt="blog_img">
                                    @else
                                    <img src="https://8bittask.com/astrologynew/asset/images/content/news_img1.jpg " alt="blog_img">
                                    @endif

                                    <h3>{{$astrologer->full_name ?? ''}}</h3>
                                    <p>@foreach(json_decode($astrologer->experties) as $expertie){{$expertie ??''}} @endforeach</p>
                                    <span>Languages: @foreach(json_decode($astrologer->language) as $lang){{$lang ??''}} @endforeach</span>
                                </div>

                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="right-side-love-btn1">Love Astrology</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="right-side-love-btn2">Love Astrology</a>
                                        </div>
                                    </div>
                                    <div class="astro-three-tab">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4>{{$astrologer->experience ?? ''}}+</h4>
                                                <p>Experience</p>
                                            </div>
                                            <div class="col-md-4">
                                                <h4>14200+</h4>
                                                <p>Consultation</p>
                                            </div>
                                            <div class="col-md-4">
                                                <h4>5</h4>
                                                <p>Rating</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="astro-detail-btn">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="astro-call-btn">
                                                    <a href="#">Call ${{$astrologer->costs->astrologer_cost ??''}}/Min,</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="astro-chat-btn">
                                                    <a href="#">Chat ${{$astrologer->costs->astrologer_cost ??''}}/Min,</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>



                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">

                    <div class="right-side-about-astro">
                        <h3 style="margin-bottom:10px;">About Astro</h3>
                        <p>{{$astrologer->description ?? ''}}</p>
                        <div class="astro-about-leftside">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="right-sider-icon">
                                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <p>Education - {{$astrologer->education ?? ''}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
<!-- script for particular page -->
@section('script-area')

@endsection