<!DOCTYPE html>
<html lang="ko">
	<head>
			<meta charset="utf-8">
			<title>Introduction Course > Class > 콘치아토레</title>		
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
			<link rel="stylesheet" href="css/common.css" />
			<link rel="stylesheet" href="css/sub.css" />
            <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

		<!--[if lt IE 9]>
			<script type="text/javascript" src="js/html5.js"></script>
		<![endif]-->
		<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="js/common.js"></script>
		<script type="text/javascript" src="js/sub.js"></script>		
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
			
			
			<section id="content" class="cls_section">
				<h2 class="hid">기초반 안내페이지</h2>
				<div id="cls_main">
					<h3>introductory course</h3>
					<div class="line"></div>
					<p>수강 정원 : 3명<br/>장소 : 서울 강남구 삼성동 테헤란로 77길 승광빌딩 2층<br/>수강시간 : 주 2회 4시간<br/>월 25만원 (가죽에 따라 가격 변동 있습니다.)</p>
					<div class="line"></div>
					<a href="#none">신청하기</a>
			</div>
			<div id="cls_brand" class="clear" tabIndex="0">
					<div class="cls_br_st cls_br_l f_l"></div>
					<div class="cls_br_st cls_br_r f_r"></div>
					<div id="cls_br_wrap">
						<h4>conciatore</h4>
						<p>콘치아토레는 허혜성 디자이너가 이탈리아 피렌체의 '스쿠올라 델 쿠오이오' 디플로마 과정을 수료한 뒤 오픈한 가죽 공방으로, <br/>피렌체의 제작방식을 추구하며 합리적이고 수준 높은 가죽 공예 커리큘럼을 제공합니다.</p>
						<dl>
							<dt>입문반 커리큘럼</dt> 
							<dd>폰케이스→머니클립→클러치→파우치→쇼퍼백</dd>
						</dl>
					</div>
				</div>
				<div id="cls_back">
					<h4>introductory courses</h4>
					<p>가죽 공예에 대해 아무것도 모르는 초보자 분들부터 조금 관심이 있었던 분들을 위한 class</p>
				</div>
				<div id="cls_leather">
					<h4>LEATHER</h4>
					<p>콘치아토레 수업은 신청하는 사람이<br/>원하는 가죽을 고를 수 있습니다.<br/>(가죽에 따라 클래스의 가격에 변동이 있습니다.)</p>
					<ul>
						<li class="f_l">
							<a href="#none">
								<img src="images/class_intro/img4-3-1.jpg" width="220" height="220" alt="">
								<span class="cls_le_hid"><strong>+</strong>Detail</span>
							</a>
							<p>앨리게이터</p>
						</li>
						<li class="f_l">
							<a href="#none">
								<img src="images/class_intro/img4-3-2.jpg" width="220" height="220" alt="">
								<span class="cls_le_hid"><strong>+</strong>Detail</span>
							</a>
							<p>이구아나</p>
						</li>
						<li class="f_l">
							<a href="#none">
								<img src="images/class_intro/img4-3-3.jpg" width="220" height="220" alt="">
								<span class="cls_le_hid"><strong>+</strong>Detail</span>
							</a>
							<p>이탈카프</p>
						</li>
						<li class="f_l">
							<a href="#none">
								<img src="images/class_intro/img4-3-4.jpg" width="220" height="220" alt="">
								<span class="cls_le_hid"><strong>+</strong>Detail</span>
							</a>
							<p>비벨라</p>
						</li>
						<li class="f_l">
							<a href="#none">
								<img src="images/class_intro/img4-3-5.jpg" width="220" height="220" alt="">
								<span class="cls_le_hid"><strong>+</strong>Detail</span>
							</a>
							<p>키프</p>
						</li>
					</ul>
				</div>
				<div id="cls_gallery">
				<div id="cls_gall_wrap">
					<div class="cls_col1 f_l">
							<h4>GALLERY</h4>
								<a href="#none"><img src="images/class_intro/img4-4-1.jpg" width="369" height="328" alt="치수재기"></a>
						</div>
					<div class="cls_col2 f_l">
						<ul>
							<li><a href="#none"><img src="images/class_intro/img4-4-2.jpg" width="269" height="165" alt="왁스칠"></a></li>
							<li><a href="#none"><img src="images/class_intro/img4-4-3.jpg" width="269" height="138" alt="재단"></a></li>
							<li><a href="#none"><img src="images/class_intro/img4-4-4.jpg" width="269" height="337" alt="박음질"></a></li>
						</ul>
					</div>
					<div class="cls_col3 f_l">
						<ul>
							<li class="f_l mrg cls_col8"><a href="#none"><img src="images/class_intro/img4-4-6.jpg" width="220" height="157" alt="지퍼만들기"></a></li>
							<li class="f_l cls_col7"><a href="#none"><img src="images/class_intro/img4-4-5.jpg" width="149" height="157" alt="지퍼박음질"></a></li>
							<li><a href="#none"><img src="images/class_intro/img4-4-7.jpg" width="459" height="219" alt="타공"></a></li>
							<li><a href="#none"><img src="images/class_intro/img4-4-8.jpg" width="459" height="328" alt="재단"></a></li>
							<li class="f_l mrg cls_col5"><a href="#none"><img src="images/class_intro/img4-4-9.jpg" width="269" height="147" alt="본드칠"></a></li>
							<li class="f_l cls_col6"><a href="#none"><img src="images/class_intro/img4-4-10.jpg" width="179" height="147" alt="재단"></a></li>
						</ul>
					</div>
					<div class="cls_col4 f_l">
						<ul>
							<li><a href="#none"><img src="images/class_intro/img4-4-11.jpg" width="173" height="159" alt="마감질"></a></li>
							<li><a href="#none"><img src="images/class_intro/img4-4-12.jpg" width="173" height="150" alt="겉피조립"></a></li>
							<li class="cls_gall_box"></li>
						</ul>
					</div>
					<div class="cls_col9">
						<dl>
							<dt>Basic class</dt>
							<dd>가죽 입문의 기본 과정 : 반지갑 제작<br/>수업시간 3시간 2회 / 6시간 1회</dd>
							<dd><a href="#none">신청하기</a></dd>
						</dl>
					</div>
				</div>
				</div>
				<div id="cls_notice">
					<div id="cls_not_wrap">
						<h4>conciatore class<br/><span>신청 시 주의사항</span></h4>
						<p><i class="fa fa-check" aria-hidden="true"></i>콘치아토레의 모든 강좌는 강좌 시작전 5일까지는 전액 환불,<br/>3일까지는 50% 환불이 가능하며, 그 이후에는 환불이 불가능합니다.<br/>예) 1월 10일 클래스 : 5일까지는 전액 / 6일~ 8일까지는 50% / 8일 이후 환불불가</p>
						<p><i class="fa fa-check" aria-hidden="true"></i>환불을 원하실 경우, conciatore@gmail.com으로 성함과 주문하신 클래스 이름,<br/>일자를 포함하여 메일을 보내주세요. 무통장 결제하셨을 경우, <br/>환불받으실 계좌 정보도 보내주셔야 합니다.</p>
						<p><i class="fa fa-check" aria-hidden="true"></i>환불은 영업일 기준 3일 내로 처리되며, 카드사에 따라 상이할 수 있습니다.</p>
						<p><i class="fa fa-check" aria-hidden="true"></i>재화가 아닌 소규모 정원의 클래스 수강인 관계로 신중한 신청을 바랍니다.</p>
						<a href="#none">신청하기</a>
					</div>
				</div>
			</section>
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
