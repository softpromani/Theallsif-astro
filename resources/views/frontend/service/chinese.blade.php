@extends('frontend.layout.frontend')

@section('content-area')
<!-- main_header_wrapper Start -->
<div class="main_header_wrapper">
	<!-- hs Navigation Start -->
	<div class="hs_navigation_header_wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-5 col-sm-5 col-xs-5">
					<div class="hs_header_add_wrapper border_icon hidden-sm hidden-xs">
						<div class="hs_header_add_icon">
							<i class="fa fa-home"></i>
						</div>
						<div class="hs_header_add_icon_cont">
							<p>601 , Ram Nagar Dewas</p>
						</div>
					</div>
					<div class="hs_header_add_wrapper">
						<div class="hs_header_add_icon last">
							<i class="fa fa-phone"></i>
						</div>
						<div class="hs_header_add_icon_cont">
							<p>+1800-123-123</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-7 col-sm-7 col-xs-7">
					<div class="hs_top_right_wrapper">
						<div class="hs_navi_searchbar_wrapper hidden-sm hidden-xs">
							<input type="text" placeholder="Search here">
							<button><i class="fa fa-search"></i></button>
						</div>
						<ul class="cart_login_wrapper">
							<li class="dropdown menu-button hs_navi_cart_wrapper">
								<a class="menu-button" href="#"><i class="flaticon-shop"></i><span>3</span></a>
								<ul class="dropdown-menu">
									<li class="cc_cart_wrapper1">
										<div class="cc_cart_img_wrapper">
											<img src="{{asset('frontend/asset/images/content/cart_img.jpg')}}" alt="cart_img" />
										</div>
										<div class="cc_cart_cont_wrapper">
											<h4><a href="#">Gemstone</a></h4>
											<p>Quantity : 2 × $45</p>
											<h5>$90</h5>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
									</li>
									<li class="cc_cart_wrapper1">
										<div class="cc_cart_img_wrapper">
											<img src="{{asset('frontend/asset/images/content/cart_img.jpg')}}" alt="cart_img" />
										</div>
										<div class="cc_cart_cont_wrapper">
											<h4><a href="#">Gemstone</a></h4>
											<p>Quantity : 2 × $45</p>
											<h5>$90</h5>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
									</li>
									<li class="cc_cart_wrapper1">
										<div class="cc_cart_img_wrapper">
											<img src="{{asset('frontend/asset/images/content/cart_img.jpg')}}" alt="cart_img" />
										</div>
										<div class="cc_cart_cont_wrapper">
											<h4><a href="#">Gemstone</a></h4>
											<p>Quantity : 2 × $45</p>
											<h5>$90</h5>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
									</li>
									<li class="cc_cart_wrapper1">
										<div class="hs_effect_btn ceckout_btn">
											<ul>
												<li><a href="#" class="hs_btn_hover">checkout</a></li>
											</ul>
										</div>
									</li>
								</ul>
							</li>
							<li class="dropdown menu-button hs_top_user_profile">
								<a href="#">
									<img src="{{asset('frontend/asset/images/header/top_user.png"')}} alt=" user">
									<span class="hidden-xs">Login / Register</span>
								</a>
								<ul class="dropdown-menu">
									<li class="signin_dropdown">
										<a href="#" class="btn btn-primary"> <span>Login with Facebook</span> <i class="fa fa-facebook"></i> </a>
										<a href="#" class="btn btn-primary google-plus"> Login with Google <i class="fa fa-google-plus"></i> </a>
										<h2>or</h2>
										<div class="formsix-pos">
											<div class="form-group i-email">
												<input type="email" class="form-control" required="" id="emailTen" placeholder="Email Address *">
											</div>
										</div>
										<div class="formsix-e">
											<div class="form-group i-password">
												<input type="password" class="form-control" required="" id="namTen-first" placeholder="Password *">
											</div>
										</div>
										<div class="remember_box">
											<label class="control control--checkbox">Remember me
												<input type="checkbox">
												<span class="control__indicator"></span>
											</label>
											<a href="#" class="forget_password">
												Forgot Password
											</a>
										</div>
										<div class="hs_effect_btn">
											<ul>
												<li data-animation="animated flipInX"><a href="#" class="hs_btn_hover">Login</a></li>
											</ul>
										</div>
										<div class="sign_up_message">
											<p>Don’t have an account ? <a href="#"> Sign up </a> </p>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- hs Navigation End -->
	<!-- hs top header Start -->
	<div class="hs_header_Wrapper hidden-sm hidden-xs">
		<div class="container">
			<!-- hs top header Start -->
			<div class="hs_top_header_main_Wrapper">
				<div class="hs_header_logo_left">
					<div class="hs_logo_wrapper">
						<a href="index.html"><img src="{{asset('frontend/asset/images/header/logo.png')}}" class="img-responsive" alt="logo" title="Logo" /></a>
					</div>
				</div>
				<div class="hs_header_logo_right">
					<nav class="hs_main_menu">
						<ul>
							<li>
							<li><a class="menu-button" href="index.html">Home</a></li>
							</li>
							<li>
								<a class="menu-button" href="about.html">About Us</a>
							</li>
							<li>
								<a class="menu-button" href="aries.html">Horoscope </a>
							</li>
							<li class="dropdown menu-button">
								<a class="menu-button" href="#">Services</a>
								<ul class="dropdown-menu hs_mega_menu">
									<li>
										<a class="menu-button" href="aries.html">Aries</a>
									</li>
									<li>
										<a class="menu-button" href="chinese.html">Chinese</a>
									</li>
									<li>
										<a class="menu-button" href="chinese_single.html">Chinese-Single</a>
									</li>
									<li>
										<a class="menu-button" href="crystal.html">Crystal</a>
									</li>
									<li>
										<a class="menu-button" href="kundli_dosh.html">Kundli-Dosh</a>
									</li>
									<li>
										<a class="menu-button" href="numerology.html">Numerology</a>
									</li>
									<li>
										<a class="menu-button" href="palm.html">Palm</a>
									</li>
									<li>
										<a class="menu-button" href="tarot.html">Tarot</a>
									</li>
									<li>
										<a class="menu-button" href="tarot_single.html">Tarot-Single</a>
									</li>
									<li>
										<a class="menu-button" href="vastu_shastra.html">Vastu-Shastra</a>
									</li>
								</ul>
							</li>
							<li class="dropdown menu-button">
								<a class="menu-button" href="#">Shop</a>
								<ul class="dropdown-menu">
									<li>
										<a class="menu-button" href="shop.html">Shop</a>
									</li>
									<li>
										<a class="menu-button" href="shop_single.html">Shop-Single</a>
									</li>
								</ul>
							</li>
							<li class="dropdown menu-button">
								<a class="menu-button" href="#">News </a>
								<ul class="dropdown-menu">
									<li>
										<a class="menu-button" href="blog_categories.html">Blog-Categories</a>
									</li>
									<li>
										<a class="menu-button" href="blog_single.html">Blog-Single</a>
									</li>
								</ul>
							</li>
							<li>
								<a class="menu-button" href="contact.html">Contact </a>
							</li>
						</ul>
					</nav>
					<div class="hs_btn_wrapper hidden-md">
						<ul>
							<li><a href="contact.html" class="hs_btn_hover">Appointments</a></li>
						</ul>
					</div>
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
						<a href="index.html"><img src="{{asset('frontend/asset/images/header/logo.png')}}" alt="Logo" title="Logo"></a>
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
							<h2><a href="index.html">Jyotish</a></h2>
							<a href="#0" class="cd-close">Close</a>
							<ul class="cd-dropdown-content">
								<li>
									<form class="cd-search">
										<input type="search" placeholder="Search...">
									</form>
								</li>
								<li><a href="index.html">Home</a></li>
								<li>
									<a href="about.html">About US</a>
								</li>
								<li>
									<a href="aries.html">Horoscope </a>
								</li>
								<!-- .has-children -->
								<li class="has-children">
									<a href="#">Services</a>
									<ul class="cd-secondary-dropdown is-hidden">
										<li class="go-back"><a href="#0">Menu</a></li>
										<li>
											<a href="aries.html">Aries</a>
										</li>
										<!-- .has-children -->
										<li>
											<a href="chinese.html">Chinese</a>
										</li>
										<!-- .has-children -->
										<li>
											<a href="chinese_single.html">Chinese-Single</a>
										</li>
										<!-- .has-children -->
										<li>
											<a href="crystal.html">Crystal</a>
										</li>
										<!-- .has-children -->
										<li>
											<a href="kundli_dosh.html">Kundli-Dosh</a>
										</li>
										<!-- .has-children -->
										<li>
											<a href="numerology.html">Numerology</a>
										</li>
										<!-- .has-children -->
										<li>
											<a href="palm.html">Palm</a>
										</li>
										<!-- .has-children -->
										<li>
											<a href="tarot.html">Tarot</a>
										</li>
										<!-- .has-children -->
										<li>
											<a href="tarot_single.html">Tarot-Single</a>
										</li>
										<!-- .has-children -->
										<li>
											<a href="vastu_shastra.html">Vastu-Shastra</a>
										</li>
										<!-- .has-children -->
									</ul>
									<!-- .cd-secondary-dropdown -->
								</li>
								<!-- .has-children -->
								<li class="has-children">
									<a href="#">Shop</a>
									<ul class="cd-secondary-dropdown is-hidden">
										<li class="go-back"><a href="#0">Menu</a></li>
										<li>
											<a href="shop.html">Shop</a>
										</li>
										<!-- .has-children -->
										<li>
											<a href="shop_single.html">Shop-Single</a>
										</li>
										<!-- .has-children -->
									</ul>
									<!-- .cd-secondary-dropdown -->
								</li>
								<!-- .has-children -->
								<li class="has-children">
									<a href="#">News</a>
									<ul class="cd-secondary-dropdown is-hidden">
										<li class="go-back"><a href="#0">Menu</a></li>
										<li>
											<a href="blog_categories.html">Blog-Categories</a>
										</li>
										<!-- .has-children -->
										<li>
											<a href="blog_single.html">Blog-Single</a>
										</li>
										<!-- .has-children -->
									</ul>
									<!-- .cd-secondary-dropdown -->
								</li>
								<!-- .has-children -->
								<li>
									<a href="contact.html">Contact</a>
								</li>
								<li><a href="contact.html" class="hs_btn_hover">Appointments</a></li>
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
<!-- hs About Title Start -->
<div class="hs_indx_title_main_wrapper">
	<div class="hs_title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
				<div class="hs_indx_title_left_wrapper">
					<h2>Chinese Horoscope</h2>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  full_width">
				<div class="hs_indx_title_right_wrapper">
					<ul>
						<li><a href="#">Home</a> &nbsp;&nbsp;&nbsp;> </li>
						<li>Chinese Horoscope</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- hs About Title End -->
<!-- hs chinese wrapper Start -->
<div class="hs_chinese_main_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="hs_kd_first_sec_wrapper">
					<h2>The Chinese Zodiac</h2>
					<h4><span>&nbsp;</span></h4>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="hs_cn_icon_wrapper">
					<div class="row">
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<div class="hs_sign_box">
								<div class="sign_box_img">
									<img src="{{asset('frontend/asset/images/content/c_icon1.png')}}" alt="icon1">
								</div>
								<div class="sign_box_cont">
									<h2>Rat</h2>
									<p>31 Mar - 12 Oct</p>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<div class="hs_sign_box">
								<div class="sign_box_img">
									<img src="{{asset('frontend/asset/images/content/c_icon2.png')}}" alt="icon2">
								</div>
								<div class="sign_box_cont">
									<h2>Ox</h2>
									<p>31 Mar - 12 Oct</p>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<div class="hs_sign_box">
								<div class="sign_box_img">
									<img src="{{asset('frontend/asset/images/content/c_icon3.png')}}" alt="icon3">
								</div>
								<div class="sign_box_cont">
									<h2>Tiger</h2>
									<p>31 Mar - 12 Oct</p>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<div class="hs_sign_box">
								<div class="sign_box_img">
									<img src="{{asset('frontend/asset/images/content/c_icon4.png')}}" alt="icon4">
								</div>
								<div class="sign_box_cont">
									<h2>Rabbit</h2>
									<p>31 Mar - 12 Oct</p>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<div class="hs_sign_box">
								<div class="sign_box_img">
									<img src="{{asset('frontend/asset/images/content/c_icon5.png')}}" alt="icon5">
								</div>
								<div class="sign_box_cont">
									<h2>Dragon</h2>
									<p>31 Mar - 12 Oct</p>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<div class="hs_sign_box">
								<div class="sign_box_img">
									<img src="{{asset('frontend/asset/images/content/c_icon6.png')}}" alt="icon6">
								</div>
								<div class="sign_box_cont">
									<h2>Snake</h2>
									<p>31 Mar - 12 Oct</p>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<div class="hs_sign_box">
								<div class="sign_box_img">
									<img src="{{asset('frontend/asset/images/content/c_icon7.png')}}" alt="icon7">
								</div>
								<div class="sign_box_cont">
									<h2>Horse</h2>
									<p>31 Mar - 12 Oct</p>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<div class="hs_sign_box">
								<div class="sign_box_img">
									<img src="{{asset('frontend/asset/images/content/c_icon8.png')}}" alt="icon8">
								</div>
								<div class="sign_box_cont">
									<h2>Goat</h2>
									<p>31 Mar - 12 Oct</p>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<div class="hs_sign_box">
								<div class="sign_box_img">
									<img src="{{asset('frontend/asset/images/content/c_icon9.png')}}" alt="icon9">
								</div>
								<div class="sign_box_cont">
									<h2>Monkey</h2>
									<p>31 Mar - 12 Oct</p>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<div class="hs_sign_box">
								<div class="sign_box_img">
									<img src="{{asset('frontend/asset/images/content/c_icon10.png')}}" alt="icon10">
								</div>
								<div class="sign_box_cont">
									<h2>Rooster</h2>
									<p>31 Mar - 12 Oct</p>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<div class="hs_sign_box">
								<div class="sign_box_img">
									<img src="{{asset('frontend/asset/images/content/c_icon11.png')}}" alt="icon11">
								</div>
								<div class="sign_box_cont">
									<h2>Dog</h2>
									<p>31 Mar - 12 Oct</p>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<div class="hs_sign_box">
								<div class="sign_box_img">
									<img src="{{asset('frontend/asset/images/content/c_icon12.png')}}" alt="icon12">
								</div>
								<div class="sign_box_cont">
									<h2>Pig</h2>
									<p>31 Mar - 12 Oct</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- hs chinese wrapper End -->
<!-- hs sidebar Start -->
<div class="hs_kd_sidebar_main_wrapper hs_num_sidebar_main_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<div class="hs_kd_left_sidebar_main_wrapper">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="hs_kd_first_sec_wrapper">
								<h2>Enter your date of birth:</h2>
								<h4><span>&nbsp;</span></h4>
								<p>Enter your birth information below to calculate your Chinese Sign:</p>
							</div>
							<div class="row">
								<div class="col-lg-8 col-md-3 col-sm-3 col-xs-12">
									<div class="hs_num_input_wrapper i-date">
										<input type="text" id="datepicker2">
									</div>
								</div>
								<div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
									<div class="hs_num_input_btn_wrapper">
										<ul>
											<li><a href="#">Submit</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="hs_kd_first_sec_wrapper hs_cn_first_sec_wrapper">
								<h2>What Your Chinese Zodiac Animal Sign Is</h2>
								<h4><span>&nbsp;</span></h4>
								<p>Your Chinese Zodiac sign is derived from your birth year, according to the Chinese lunar calendar. See the years of each animal below or use the calculator on the right to determine your own sign. Those born in January
									and February take care: Chinese (Lunar) New Year moves between 21 January and February 20. If you were born in January or February, check whether your birth date falls before or after Chinese New Year to know what
									your Chinese zodiac year is.</p>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="hs_pr_second_cont_wrapper hs_ar_second_sec_cont_list_wrapper">
								<ul>
									<li>
										<div class="hs_pr_icon_wrapper">
											<i class="fa fa-circle"></i>
										</div>
										<div class="hs_pr_icon_cont_wrapper hs_ar_icon_cont_wrapper">
											<span>RAT</span> : 2008, 1996, 1984, 1972, 1960
										</div>
									</li>
									<li>
										<div class="hs_pr_icon_wrapper">
											<i class="fa fa-circle"></i>
										</div>
										<div class="hs_pr_icon_cont_wrapper hs_ar_icon_cont_wrapper">
											<span>OX</span> 2008, 1996, 1984, 1972, 1960
										</div>
									</li>
									<li>
										<div class="hs_pr_icon_wrapper">
											<i class="fa fa-circle"></i>
										</div>
										<div class="hs_pr_icon_cont_wrapper hs_ar_icon_cont_wrapper">
											<span>TIGER</span> 2008, 1996, 1984, 1972, 1960
										</div>
									</li>
									<li>
										<div class="hs_pr_icon_wrapper">
											<i class="fa fa-circle"></i>
										</div>
										<div class="hs_pr_icon_cont_wrapper hs_ar_icon_cont_wrapper">
											<span> RABBIT </span> 2008, 1996, 1984, 1972, 1960
										</div>
									</li>
									<li>
										<div class="hs_pr_icon_wrapper">
											<i class="fa fa-circle"></i>
										</div>
										<div class="hs_pr_icon_cont_wrapper hs_ar_icon_cont_wrapper">
											<span> DRAGON </span> 2008, 1996, 1984, 1972, 1960
										</div>
									</li>
									<li>
										<div class="hs_pr_icon_wrapper">
											<i class="fa fa-circle"></i>
										</div>
										<div class="hs_pr_icon_cont_wrapper hs_ar_icon_cont_wrapper">
											<span> SNAKE </span> 2008, 1996, 1984, 1972, 1960
										</div>
									</li>
									<li>
										<div class="hs_pr_icon_wrapper">
											<i class="fa fa-circle"></i>
										</div>
										<div class="hs_pr_icon_cont_wrapper hs_ar_icon_cont_wrapper">
											<span> HORSE </span> 2008, 1996, 1984, 1972, 1960
										</div>
									</li>
									<li>
										<div class="hs_pr_icon_wrapper">
											<i class="fa fa-circle"></i>
										</div>
										<div class="hs_pr_icon_cont_wrapper hs_ar_icon_cont_wrapper">
											<span> GOAT </span> 2008, 1996, 1984, 1972, 1960
										</div>
									</li>
									<li>
										<div class="hs_pr_icon_wrapper">
											<i class="fa fa-circle"></i>
										</div>
										<div class="hs_pr_icon_cont_wrapper hs_ar_icon_cont_wrapper">
											<span> MONKEY </span> 2008, 1996, 1984, 1972, 1960
										</div>
									</li>
									<li>
										<div class="hs_pr_icon_wrapper">
											<i class="fa fa-circle"></i>
										</div>
										<div class="hs_pr_icon_cont_wrapper hs_ar_icon_cont_wrapper">
											<span> ROOSTER </span> 2008, 1996, 1984, 1972, 1960
										</div>
									</li>
									<li>
										<div class="hs_pr_icon_wrapper">
											<i class="fa fa-circle"></i>
										</div>
										<div class="hs_pr_icon_cont_wrapper hs_ar_icon_cont_wrapper">
											<span> DOG </span> 2008, 1996, 1984, 1972, 1960
										</div>
									</li>
									<li>
										<div class="hs_pr_icon_wrapper">
											<i class="fa fa-circle"></i>
										</div>
										<div class="hs_pr_icon_cont_wrapper hs_ar_icon_cont_wrapper">
											<span> PIG </span> 2008, 1996, 1984, 1972, 1960
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="hs_kd_first_sec_wrapper hs_cn_first_sec_wrapper">
								<h2>Chinese Zodiac Love Compatibility. for You?</h2>
								<h4><span>&nbsp;</span></h4>
								<p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a
									odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit.</p>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="hs_cn_second_sec_wrapper">
								<h2>Chinese Zodiac Love Compatibility Test</h2>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="hs_num_input_wrapper i-name">
										<input type="text" placeholder="Boy's Name">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="hs_num_input_wrapper i-date">
										<input type="text" id="datepicker3">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="hs_num_input_wrapper i-name">
										<input type="text" placeholder="Girl's Name">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="hs_num_input_wrapper i-date">
										<input type="text" id="datepicker4">
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="hs_num_input_btn_wrapper hs_cn_birth_btn_wrapper">
										<ul>
											<li><a href="#">match</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="hs_rs_four_sec_wrapper chinese_slider">
								<div class="hs_rs_four_sec_img_overlay_wrapper"></div>

								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="hs_rs_four_slider_wrapper">
											<div class="owl-carousel owl-theme">
												<div class="item">
													<div class="hs_rs_slider_inner_cont_wrapper">
														<h2>Now talk to best astrologers, Numerologists & Tarot<br> Readers anywhere, anytime with Astroyogi.</h2>
														<ul>
															<li><a href="#">Call Now</a></li>
														</ul>
													</div>
												</div>
												<div class="item">
													<div class="hs_rs_slider_inner_cont_wrapper">
														<h2>Now talk to best astrologers, Numerologists & Tarot<br> Readers anywhere, anytime with Astroyogi.</h2>
														<ul>
															<li><a href="#">Call Now</a></li>
														</ul>
													</div>
												</div>
												<div class="item">
													<div class="hs_rs_slider_inner_cont_wrapper">
														<h2>Now talk to best astrologers, Numerologists & Tarot<br> Readers anywhere, anytime with Astroyogi.</h2>
														<ul>
															<li><a href="#">Call Now</a></li>
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
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="hs_kd_right_sidebar_main_wrapper">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="hs_kd_right_first_sec_wrapper">
								<div class="hs_kd_right_first_sec_heading">
									<h2>Kundali Patrikla</h2>
								</div>
								<div class="hs_kd_right_first_sec_img_heading">
									<img src="{{asset('frontend/asset/images/content/kundali/cn1.jpg')}}" alt="patrika" />
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
									<img src="{{asset('frontend/asset/images/content/kundali/cn2.jpg')}}" alt="patrika" />
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
									<img src="{{asset('frontend/asset/images/content/kundali/cn3.jpg')}}" alt="patrika" />
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