<!DOCTYPE html>
<html lang="ko">
	<head>
			<meta charset="utf-8">
			<title>Class > 콘치아토레</title>
		<!--[if lt IE 9]>
			<script type="text/javascript" src="js/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="css/common.css" />
		<link rel="stylesheet" href="css/sub.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        
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
		<section id="content" class="cl_section">
			<div id="cl_page">
				<div id="cl_intro" class="cl_div f_l" tabIndex="0">
					<h1> introductory <span>course</span></h1>
					<div class="cl_wrap hid">
						<div class="line"></div>
						<p>수강 정원 : 3명</p>
						<p>장소 : 서울 강남구 삼성동 테헤란로 77길 승광빌딩 2층</p>
						<p>수강시간 : 주 2회 4시간</p>
						<p>월 25만원 (가죽에 따라 가격 변동 있습니다.)</p>
						<ul>
							<li>폰케이스</li>
							<li>머니클립</li>
							<li>클러치</li>
							<li>파우치</li>
							<li>쇼퍼백</li>
						</ul>
						<div class="line"></div>
						<a href="class_intro.php" id="cl_go_intro">신청하기</a>
					</div>
				</div>
				
				<div id="cl_med" class="cl_div f_l" tabIndex="0">
					<h1> intermediate <span>course</span></h1>
					<div class="cl_wrap hid">
						<div class="line"></div>
						<p>수강 정원 : 6명</p>
						<p>장소 : 서울 강남구 삼성동 테헤란로 77길 승광빌딩 3층</p>
						<p>수강시간 : 주 2회 6시간</p>
						<p>월 45만원 (가죽에 따라 가격 변동 있습니다.)</p>
						<ul>
							<li>반지갑</li>
							<li>장지갑</li>
							<li>클러치</li>
							<li>쇼퍼백</li>
							<li>사첼백</li>
						</ul>
						<div class="line"></div>
						<a href="class_intro.php" id="cl_go_med">신청하기</a>
					</div>
				</div>
					<div id="cl_high" class="cl_div f_l" tabIndex="0">
						<h1> High-level <span>course</span></h1>
						<div class="cl_wrap hid">
							<div class="line"></div>
							<p>수강 정원 : 3명</p>
							<p>장소 : 서울 강남구 삼성동 테헤란로 77길 승광빌딩 2층</p>
							<p>수강시간 : 주 2회 4시간</p>
							<p>월 55만원 (가죽에 따라 가격 변동 있습니다.)</p>
							<ul>
								<li>앞판가방(패턴제공)</li>
								<li>앞판가방(변형, 디자인)</li>
								<li>밑판가방(패턴제공)</li>
								<li>밑판가방(변형, 디자인)</li>
								<li>옆판가방(패턴제공)</li>
								<li>옆판가방(변형, 디자인)</li>
							</ul>
							<div class="line"></div>
							<a href="class_intro.php" id="cl_go_high">신청하기</a>
					</div>
				</div>
			</div>
		</section>
		<?php include "footer.html"; ?>
	</body>
</html>
