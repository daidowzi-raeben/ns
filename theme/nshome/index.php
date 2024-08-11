

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/*
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
*/

include_once(G5_THEME_PATH.'/head.main.php');
?>
	<div id="contents" class="div-cont">
    <div id="mVisual">
      <div class="swiper">
        <ul class="swiper-wrapper">
          <li class="swiper-slide" style="background:url(_Img/Main/img1.png) no-repeat">1</li>
          <li class="swiper-slide" style="background:url(_Img/Main/img2.png) no-repeat">2</li>
          <li class="swiper-slide" style="background:url(_Img/Main/img3.png) no-repeat">3</li>
        </ul>
        <div class="swiper-pagination"></div>
        <div class="btns">
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
          <button class="btn pause">❚❚</button>
          <button class="btn play" style="display:none">▶</button>
        </div>
        
      </div>
      <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
      <script type="text/javascript">
        const swiper = new Swiper('.swiper', {
          loop: true,
          autoplay: {
            delay: 5000,
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          
        });
        $('.swiper .pause').on('click', function() {
          swiper.autoplay.stop();
          $('.swiper .pause').css('display', 'none');
          $('.swiper .play').css('display', 'block');
        })
        $('.swiper .play').on('click', function() {
          swiper.autoplay.start();
          $('.swiper .pause').css('display', 'block');
          $('.swiper .play').css('display', 'none');
        })
      </script>
      <div class="main-notice">
        <div class="main-notice--wrap">
          <div class="main-notice--tit" data-aos="fade-up" data-aos-duration="1000">NOTICE</div>
          <div class="main-notice--sub" data-aos="fade-up" data-aos-duration="1000">
            새로운 소식들을 전해드립니다.
            <a href="" class="more"><img src="./_Img/icon/plus.png" alt="" /></a>
          </div>
          <div data-aos="fade-up" data-aos-duration="1000">
            <?php echo latest('notice', 'notice', 4, 50); ?>
          </div>
        </div>
      </div>
      <div class="main-con">
        <div class="main-con--wrap">
          <div class="main-con--tit" data-aos="fade-up" data-aos-duration="1000">
            OUR<br />SERVICE
            <div class="main-con--sub">
              윤리적이고 투명한 기업 경영과<br />
              청렴하고 공정한 기업 문화를<br />
              위한 서비스를 제공합니다.
            </div>
          </div>
          <div class="main-con--img">
            <div class="left">
              <a href="/Guide/guide01.php" class="img-wrap" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
                <img src="./_Img/Main/main_con1.png" alt="" />
                <div class="hover-icon">
                  <img src="./_Img/Icon/arrow_right_wh.png" />
                </div>
              </a>
              <a href="/Mileage/mileage01.php" class="img-wrap" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
                <img src="./_Img/Main/main_con3.png" alt="" />
                <div class="hover-icon">
                  <img src="./_Img/Icon/arrow_right_wh.png" />
                </div>
              </a>
            </div>
            <div class="right">
              <a href="/Edu/edu05.php" class="img-wrap" data-aos="fade-up" data-aos-duration="1000">
                <img src="./_Img/Main/main_con2.png" alt="" />
                <div class="hover-icon">
                  <img src="./_Img/Icon/arrow_right_wh.png" />
                </div>
              </a>
              <a href="Community/community02.php" class="img-wrap" data-aos="fade-up" data-aos-duration="1000">
                <img src="./_Img/Main/main_con4.png" alt="" />
                <div class="hover-icon">
                  <img src="./_Img/Icon/arrow_right_wh.png" />
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="msec-cont">
        <div class="msec-02">
          <?php echo latest('notice', 'notice', 4, 50); ?>
          <div class="msec-quick"> <a href="Community/community02.php" alt="내부제보" ><img src="_Img/Main/b_info.jpg" width="412" height="201" /></a> </div>
        </div>
      </div> -->
    </div>
    <!-- page end // -->
	</div>
<?php
include_once(G5_THEME_PATH.'/tail.main.php');
?>