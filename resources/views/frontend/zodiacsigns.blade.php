@extends('frontend.layout.frontend')

@section('content-area')
<style>
  .product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    grid-gap: 20px;
  }

  .product {
    padding: 20px;
    border-radius: 25% 0%;
  }


  .product-images {
    height: 200px;
    overflow: hidden;
  }

  .product-slider {
    display: flex;
    animation: slide 5s infinite;
  }

  .product-slider img {
    width: 100%;
    height: auto;
    border-radius: 8px;
  }

  @keyframes slide {
    0% {
      transform: translateX(0);
    }

    20% {
      transform: translateX(-100%);
    }

    40% {
      transform: translateX(-200%);
    }

    60% {
      transform: translateX(-300%);
    }

    80% {
      transform: translateX(-400%);
    }

    100% {
      transform: translateX(-500%);
    }
  }

  .product-details {
    margin-top: 10px;
  }

  .product-title {
    font-size: 16px;
    font-weight: bold;
  }

  .product-description {
    font-size: 14px;
  }

  .product-price {
    font-size: 18px;
    font-weight: bold;
    color: #f00;
  }
</style>
<div class="hs_indx_title_main_wrapper">
  <div class="hs_title_img_overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
        <div class="hs_indx_title_left_wrapper">
          <h2>Zodiac Signs</h2>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  full_width">
        <div class="hs_indx_title_right_wrapper">
          <ul>
            <li><a href="#">Home</a> &nbsp;&nbsp;&nbsp;> </li>
            <li>Zodiac Signs</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="hs_latest_news_main_wrapper mobile-view-astro" style="padding: 25px;margin-top: 5%;">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
    <div class="container ">
      <div class="row ">
        <div class="col-md-12">
          <div class="product-grid">

            <div class="product card-astro">
              <a href="#">
                <div class="product-images">
                  <div class="product-slider">
                    <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }}" alt="Product 1 Image 1">-->
                    <img src="{{ asset('frontend/asset/images/content/img1.jpg') }}" alt="Product 1 Image 2">
                    <img src="{{ asset('frontend/asset/images/content/img3.webp') }}" alt="Product 1 Image 3">
                  </div>
                </div>
                <div class="product-details">
                  <h3 class="product-title">Aries</h3>
                  <p class="product-description">This is Dummy Text</p>
                </div>
              </a>
            </div>

            <div class="product card-astro">
              <a href="#">
                <div class="product-images">
                  <div class="product-slider">
                    <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }}" alt="Product 1 Image 1">-->
                    <img src="{{ asset('frontend/asset/images/content/img1.jpg') }}" alt="Product 1 Image 2">
                    <img src="{{ asset('frontend/asset/images/content/img3.webp') }}" alt="Product 1 Image 3">
                  </div>
                </div>
                <div class="product-details">
                  <h3 class="product-title">Aries</h3>
                  <p class="product-description">This is Dummy Text</p>
                </div>
              </a>
            </div>

            <div class="product card-astro">
              <a href="#">
                <div class="product-images">
                  <div class="product-slider">
                    <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }}" alt="Product 1 Image 1">-->
                    <img src="{{ asset('frontend/asset/images/content/img1.jpg') }}" alt="Product 1 Image 2">
                    <img src="{{ asset('frontend/asset/images/content/img3.webp') }}" alt="Product 1 Image 3">
                  </div>
                </div>
                <div class="product-details">
                  <h3 class="product-title">Aries</h3>
                  <p class="product-description">This is Dummy Text</p>
                </div>
              </a>
            </div>


            <div class="product card-astro">
              <a href="#">
                <div class="product-images">
                  <div class="product-slider">
                    <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }}" alt="Product 1 Image 1">-->
                    <img src="{{ asset('frontend/asset/images/content/img1.jpg') }}" alt="Product 1 Image 2">
                    <img src="{{ asset('frontend/asset/images/content/img3.webp') }}" alt="Product 1 Image 3">
                  </div>
                </div>
                <div class="product-details">
                  <h3 class="product-title">Aries</h3>
                  <p class="product-description">This is Dummy Text</p>
                </div>
              </a>
            </div>


            <div class="product card-astro">
              <a href="#">
                <div class="product-images">
                  <div class="product-slider">
                    <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }}" alt="Product 1 Image 1">-->
                    <img src="{{ asset('frontend/asset/images/content/img1.jpg') }}" alt="Product 1 Image 2">
                    <img src="{{ asset('frontend/asset/images/content/img3.webp') }}" alt="Product 1 Image 3">
                  </div>
                </div>
                <div class="product-details">
                  <h3 class="product-title">Aries</h3>
                  <p class="product-description">This is Dummy Text</p>
                </div>
              </a>
            </div>

            <div class="product card-astro">
              <a href="#">
                <div class="product-images">
                  <div class="product-slider">
                    <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }}" alt="Product 1 Image 1">-->
                    <img src="{{ asset('frontend/asset/images/content/img1.jpg') }}" alt="Product 1 Image 2">
                    <img src="{{ asset('frontend/asset/images/content/img3.webp') }}" alt="Product 1 Image 3">
                  </div>
                </div>
                <div class="product-details">
                  <h3 class="product-title">Aries</h3>
                  <p class="product-description">This is Dummy Text</p>
                </div>
              </a>
            </div>

            <div class="product card-astro">
              <a href="#">
                <div class="product-images">
                  <div class="product-slider">
                    <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }}" alt="Product 1 Image 1">-->
                    <img src="{{ asset('frontend/asset/images/content/img1.jpg') }}" alt="Product 1 Image 2">
                    <img src="{{ asset('frontend/asset/images/content/img3.webp') }}" alt="Product 1 Image 3">
                  </div>
                </div>
                <div class="product-details">
                  <h3 class="product-title">Aries</h3>
                  <p class="product-description">This is Dummy Text</p>
                </div>
              </a>
            </div>

            <div class="product card-astro">
              <a href="#">
                <div class="product-images">
                  <div class="product-slider">
                    <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }}" alt="Product 1 Image 1">-->
                    <img src="{{ asset('frontend/asset/images/content/img1.jpg') }}" alt="Product 1 Image 2">
                    <img src="{{ asset('frontend/asset/images/content/img3.webp') }}" alt="Product 1 Image 3">
                  </div>
                </div>
                <div class="product-details">
                  <h3 class="product-title">Aries</h3>
                  <p class="product-description">This is Dummy Text</p>
                </div>
              </a>
            </div>
            <!-- Add more product entries as needed -->
          </div>






          <!--                    <div class="product-grid">-->
          <!--  <div class="product">-->
          <!--    <div class="product-images">-->
          <!--      <div class="product-slider">-->
          <!--        <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }}" alt="Product 1 Image 1">-->
          <!--        <img src="{{ asset('frontend/asset/images/content/img1.jpg') }}" alt="Product 1 Image 2">-->
          <!--        <img src="{{ asset('frontend/asset/images/content/img3.webp') }}" alt="Product 1 Image 3">-->
          <!--      </div>-->
          <!--    </div>-->
          <!--    <div class="product-details">-->
          <!--      <h3 class="product-title">Aries</h3>-->
          <!--      <p class="product-description">Mar 21 - Apr 19</p>-->
          <!--<p class="product-price">$19.99</p>-->
          <!--    </div>-->
          <!--  </div>-->

          <!--  <div class="product">-->
          <!--    <div class="product-images">-->
          <!--      <div class="product-slider">-->
          <!--        <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }}" alt="Product 1 Image 1">-->
          <!--        <img src="{{ asset('frontend/asset/images/content/img1.jpg') }}" alt="Product 1 Image 2">-->
          <!--        <img src="{{ asset('frontend/asset/images/content/img3.webp') }}" alt="Product 1 Image 3">-->
          <!--      </div>-->
          <!--    </div>-->
          <!--    <div class="product-details">-->
          <!--      <h3 class="product-title">Aries</h3>-->
          <!--      <p class="product-description">Mar 21 - Apr 19</p>-->
          <!--<p class="product-price">$29.99</p>-->
          <!--    </div>-->
          <!--  </div>-->

          <!--  <div class="product">-->
          <!--    <div class="product-images">-->
          <!--      <div class="product-slider">-->
          <!--        <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }}" alt="Product 1 Image 1">-->
          <!--        <img src="{{ asset('frontend/asset/images/content/img1.jpg') }}" alt="Product 1 Image 2">-->
          <!--        <img src="{{ asset('frontend/asset/images/content/img3.webp') }}" alt="Product 1 Image 3">-->
          <!--      </div>-->
          <!--    </div>-->
          <!--    <div class="product-details">-->
          <!--      <h3 class="product-title">Aries</h3>-->
          <!--      <p class="product-description">Mar 21 - Apr 19</p>-->
          <!--<p class="product-price">$29.99</p>-->
          <!--    </div>-->
          <!--  </div>-->

          <!--  <div class="product">-->
          <!--    <div class="product-images">-->
          <!--      <div class="product-slider">-->
          <!--        <img src="{{ asset('frontend/asset/images/content/news_img1.jpg') }}" alt="Product 1 Image 1">-->
          <!--        <img src="{{ asset('frontend/asset/images/content/img1.jpg') }}" alt="Product 1 Image 2">-->
          <!--        <img src="{{ asset('frontend/asset/images/content/img3.webp') }}" alt="Product 1 Image 3">-->
          <!--      </div>-->
          <!--    </div>-->
          <!--    <div class="product-details">-->
          <!--      <h3 class="product-title">Aries</h3>-->
          <!--      <p class="product-description">Mar 21 - Apr 19</p>-->
          <!--<p class="product-price">$29.99</p>-->
          <!--    </div>-->
          <!--  </div>-->
          <!-- Add more product entries as needed -->
          <!--</div>-->

        </div>


      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    $('.product-slider').each(function() {
      var $slider = $(this);
      var $images = $slider.find('img');
      var slideIndex = 0;

      function showSlide(index) {
        $images.removeClass('active');
        $images.eq(index).addClass('active');
      }

      function nextSlide() {
        slideIndex = (slideIndex + 1) % $images.length;
        showSlide(slideIndex);
      }

      setInterval(nextSlide, 5000);
    });
  });
</script>

@endsection
<!-- script for particular page -->
@section('script-area')

@endsection