<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>공방소개 > 콘치아토레</title>
        <meta name="description" content="">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/sub.css"> 
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="js/common.js"></script>
        <script type="text/javascript" src="js/sub.js"></script>

        
        <!--[if lt IE 9]>
			<script type="text/javascript" src="js/html5.js"></script>
		<![endif]-->
        
    </head>
    <body>
    	<?php include "skip.html"; ?>
		<?php
            include('config.php');
            session_start();
            if(!isset($_SESSION['login_user'])) {
                include "header.html";
            }else {
                include "header_login.html";
            }
          ?>
		<section id="content">
        <div id="b_wrap">
        <div id="b_brandText" class="f_l">
        <h2>Conciatore</h2>
            
            <p> 가죽제품을 만드는 가죽공방. 소규모의 공방으로, <br/>유행보다는 개인의 취향을 존중하여 주문제작을 주로 취급합니다. </p>
            
            <p>
            비능률적이고 더디지만, 가죽제품이 더욱 빛날 수 있게<br/> 진정한 핸드메이드를 추구하는 콘치아토레는, <br/>제작자 한 사람이 하나의 제품을 시작부터 끝까지 만드는 완전 자체제작을 고집합니다.
            </p>
            
            <p>
            좋은 가죽으로 잘 만든 제품은 오래 사용 할 수록 '낡지' 않고 '변화' 됩니다. <br/>매달 이탈리아에서 직접 공수해온 최상의 가죽을 사용하는 <br/>콘치아토레의 상품은 오래 쓸수록 멋지게 변화됩니다.
            </p>
			<ul>
				<li><a href="#none"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#none"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				<li><a href="#none"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
			</ul>
        </div>
            
        <div id="b_brandImg" class="f_r">
			<ul>
				<li class="p_r" tabIndex="0">
					<img src="images/brand/brand_img_1.png" alt="브랜드소개1">
					<p>Since 2006...<br/><span>2006년 이탈리아 유학으로 시작된 10년동안의 튼튼한 배움,<br/> 2016년 콘치아토레로 발돋움합니다.</span></p>
				</li>
				<li class="p_r" tabIndex="0">
					<img src="images/brand/brand_img_2.png" alt="브랜드소개2">
					<p>One-man Service<br/><span>가죽 선정부터 디자인 상담, 본격적인 제작부터 모든 과정을<br/> 콘치아토레의 허혜성 디자이너 본인이 담당합니다.</span></p>
				</li>
				<li class="p_r" tabIndex="0">
					<img src="images/brand/brand_img_3.png" alt="브랜드소개3">
					<p>After Service<br/><span>콘치아토레 상품을 사용하다 제품에 문제가 생긴 경우,<br/>연락을 주시면 제작했던 디자이너가 직접 수선해드립니다.</span></p>
				</li>
				<li class="p_r" tabIndex="0">
					<img src="images/brand/brand_img_4.png" alt="브랜드소개4">
					<p>Best Quality<br/><span>이탈리아에서 허혜성 디자이너가 직접 공수해온 최상의 가죽을 사용하며,<br/> 제작 중간의 컨펌 작업과 완벽한 마감처리를 보장합니다.</span></p>
				</li>
			</ul>
			<!-- map -->
			<?php include "map.html"; ?>
			<script src="js/maps.js">

			</script>
			<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5qR9kGyWRO05ToLN7nURlyfUBdLj3tkA&signed_in=true&callback=initMap"></script>
			 <!-- // map -->
        </div>
        </div><!-- // wrap -->
		</section>

		<?php include "footer.html"; ?>
    </body>
</html>
