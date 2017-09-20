<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>가죽공방 콘치아토레</title>
		<!--[if lt IE 8]> 
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script> 
		<![endif]-->
      <!--[if lt IE 9]>
         <script type="text/javascript" src="js/html5.js"></script>
         <script type="text/javascript" src="js/respond.min.js"></script>
      <![endif]-->
      <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
      <script type="text/javascript" src="js/slide_banner.js"></script>
      <script type="text/javascript" src="js/common.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="css/common.css">
      <link rel="stylesheet" href="css/main.css">
      <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
      
      
      
      <!-- 탭메뉴 고정 -->
    <script type=text/javascript>
	    
        $(document).ready(function(){      
            $('#i_magazine > div > a img').on('mouseover focus', function() {
                $('#i_magazine > div > a img').not(this).css('opacity','0.6');
            });
            $('#i_magazine > div > a img').on('mouseleave focusout', function() {
                $('#i_magazine > div > a img').not(this).css('opacity','1');
            });
            
            
        });

    </script>
    </head>
  <body>
      <?php include "skip.html"; ?>
      
      <div id="header_video">
		
        <div id="m_top_logo">
			<img src="images/main/header_logo.png" alt="상단로고">
			<p class="center">가죽공방 콘치아토레는 이탈리아어로 ‘가죽공정의 인련의 과정을 다루는 사람’이라는 뜻 입니다.</p>
		</div>
       <ul id="m_top_menu">
            <li>
               <a href="onlinestore.php?category=all&no=1"><img src="images/main/storenav.png" alt="온라인스토어" /><p>스토어</p></a>
            </li>
            <li>
               <a href="brand.php"><img src="images/main/workshopnav.png" alt="공방소개"><p>공방소개</p></a>
            </li>
            <li>
               <a href="leather.php"><img src="images/main/leathernav.png" alt="가죽소개"><p>가죽소개</p></a>
            </li>
            <li>
               <a href="class.php"><img src="images/main/classnav.png" alt="클래스소개"><p>클래스</p></a>
            </li>
            <li>
               <a href="magazine.php"><img src="images/main/magazinenav.png" alt="매거진"><p>매거진</p></a>
            </li>
        </ul>	
        <video id="videobcg" class="video-js vjs-default-skin" data-setup="{}" preload="auto" autoplay="true" loop="loop" muted="muted"><source src="video.mp4" type="video/mp4" width="100%" height="1071px">
        <img src="images/main/videoimg.jpg"alt="메인"/>
        </video>
      </div>
	
      <?php
        include('config.php');
        session_start();
        if(!isset($_SESSION['login_user'])) {
            include "header.html";
        }else {
            include "header_login.html";
        }
//        $user_check=$_SESSION['login_user'];
 
      ?>
    
      
    <div id="i_brand" class="p_r">
        <h2 class="p_a">conciatore</h2>
        <p class="p_a">라이프스타일을 위한 가죽제품을 만듭니다.<br>
            비능률적이고 더디지만, 진정한 핸드메이드를 추구합니다.<br/>
            이탈리안 베지터블 테닝 가죽만을 사용합니다.<br>
        </p>
        <a href="brand.php" class="more p_a">MORE+</a>
    </div>
    
    <div id="i_product" class="clear">
        <h2>product</h2>
        <ul class="i_product_menu">
            <li>
                <a href="#none" class='md on'>MD PICK'S</a>
            </li>
            <li>
                <a href="#none" class="best">BEST SELLER</a>
            </li>
        </ul>
        <ul class="m_storemain clear" id="i_md">
            <li>
                <a href="detail.php">
                    <img src="images/main/set7.jpg" width="345" alt="">
                    <p>S1082 INDIGO<br/><span>￦157,000</span></p>
                </a>
            </li>
            <li>
                <a href="detail.php">
                    <img src="images/main/set2.jpg" width="345" alt="">
                    <p>S5571 CLARET<br/><span>￦376,000</span></p>
                </a>
            </li>
            <li>
                <a href="detail.php">
                    <img src="images/main/set6.jpg" width="345" alt="">
                    <p>L8130 OLD NEWTON<br/><span>￦650,000</span></p>
                </a>
            </li>
            <li>
                <a href="detail.php">
                    <img src="images/main/set8.jpg" width="345" alt="">
                    <p>B8665 HAVANA<br/><span>￦244,000</span></p>
                </a>
            </li>
        </ul>
        <ul class="m_storemain clear" id="i_best">
            <li>
                <a href="detail.php">
                    <img src="images/main/set4.jpg" width="345" alt="">
                    <p>ALLIGATOR PASSPORT<br/><span>￦29,000</span></p>
                </a>
            </li>
            <li>
                <a href="detail.php">
                    <img src="images/main/set1.jpg" width="345" alt="">
                    <p>S1082 OLD NEWTON<br/><span>￦194,000</span></p>
                </a>
            </li>
            <li>
                <a href="detail.php">
                    <img src="images/main/set5.jpg" width="345" alt="">
                    <p>L8021 CLARET<br/><span>￦450,000</span></p>
                </a>
            </li>
            <li>
                <a href="detail.php">
                    <img src="images/main/set9.jpg" width="345" alt="">
                    <p>Calfskin Leather<br/><span>￦62,000</span></p>
                </a>
            </li>
        </ul>
    </div>
    <div id="i_class_wrap">
        <div id="i_class">
            <ul>
                <li class="visual_0">
                    <h2>Introductory Class</h2>
                    <p>기초반은 가방을 제작하기 위한 기법을 전반적으로 배우는 과정입니다.<br>
                    가방제작에 필요한 기법이 적용된 소품을 제작하는 과정을 통해<br>
                    기초 패턴에 대한 이해와 도구 사용법을 습득할 수 있습니다.</p>
                    <a href="class_intro.php" class="more">MORE +</a>
                </li>
                <li class="visual_1">
                    <h2>Intermediate Class</h2>
                    <p>기초반은 가방을 제작하기 위한 기법을 전반적으로 배우는 과정입니다.<br>
                    가방제작에 필요한 기법이 적용된 소품을 제작하는 과정을 통해<br>
                    기초 패턴에 대한 이해와 도구 사용법을 습득할 수 있습니다.</p>
                    <a href="class_intro.php" class="more">MORE +</a>
                </li>
                <li class="visual_2">
                    <h2>High-level Class</h2>
                    <p>기초반은 가방을 제작하기 위한 기법을 전반적으로 배우는 과정입니다.<br>
                    가방제작에 필요한 기법이 적용된 소품을 제작하는 과정을 통해<br>
                    기초 패턴에 대한 이해와 도구 사용법을 습득할 수 있습니다.</p>
                    <a href="class_intro.php" class="more">MORE +</a>
                </li>
            </ul>
        </div>
        <ul id="buttonList">
            <li class="on"><a href="#none">배너1</a></li>
            <li><a href="#none">배너2</a></li>
            <li><a href="#none">배너3</a></li>
        </ul>
    </div>
      <script type=text/javascript>
           $('#i_best').css('display','none');
            $('.md').on('click focus',function(){
                $('.md').addClass('on');
                $('.best').removeClass('on');
                $('#i_best').css('display','none');
                $('#i_md').css('display','block');
            });
            $('.best').on('click focus', function(){
                $('.md').removeClass('on');
                $('.best').addClass('on');
                $('#i_best').css('display','block');
                $('#i_md').css('display','none');
            });
      </script>
      
    <!-- magazine --> 
    <div id="i_magazine">
        <h2 class="center">magazine</h2>
            
        <div id="i_mz_1" class="wid f_l">
            <a href="#none"><img src="images/main/magazine_1.png" alt=""></a>
            <p class="f_l"><span class="f_s">21</span> <br>JUNE<br> 2016</p>
            <h3 class="f_l">시간을 기록하는 가죽<br>Classic Wallet Case</h3>
            <a href="#none" class="i_mz_more f_l">MORE +</a>
        </div>
            
        <div id="i_mz_2" class="wid f_l">
            <a href="#none"><img src="images/main/magazine_2.png" alt=""></a>
            <p class="f_l"><span class="f_s">30</span> <br>MAY<br> 2016</p>
            <h3 class="f_l">레더 컵코스터 : 에이징<br>Coaster ageing</h3>
            <a href="#none" class="i_mz_more f_l">MORE +</a>
        </div>
            
        <div id="i_mz_3" class="wid f_l">
            <a href="#none"><img src="images/main/magazine_3.png" alt=""></a>
            <p class="f_l"><span class="f_s">3</span> <br>MAY<br> 2016</p>
            <h3 class="f_l">새로운 삶을 위한 퇴근<br>330 Laptop Briefcase</h3>
            <a href="#none" class="i_mz_more f_l">MORE +</a>
        </div>
            
        <div id="i_mz_4" class="wid f_l">
            <a href="#none"><img src="images/main/magazine_4.png" alt=""></a>
            <p class="f_l"><span class="f_s">17</span> <br>APRIL<br> 2016</p>
            <h3 class="f_l">선원들의 낭만을 가진 디티백<br>Waxed Canvas 630</h3>
            <a href="#none" class="i_mz_more f_l">MORE +</a>
        </div>
    </div>
    <!-- // magazine -->        
	<div id="i_visual" class="clear">
	</div>
    <!-- map -->
    <?php include "map.html"; ?>
        <script src="js/maps.js">

        </script>
        <script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5qR9kGyWRO05ToLN7nURlyfUBdLj3tkA&signed_in=true&callback=initMap"></script>
    
    
      <!-- // map -->
    
    <?php include "footer.html"; ?>
  </body>
</html>


