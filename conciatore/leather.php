<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>가죽소개 > 콘치아토레</title>
        <meta name="description" content="">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/sub.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        
        <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.min.js"></script>
        <script type="text/javascript" src="js/onepage.js"></script>
        <script type="text/javascript" src="js/common.js"></script>

		
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
        <div id="content">
	   	<nav id="l_snb">
	   	            <ul>
	   	                <li class="on"><a href="#l_leather1"><span class="hid">이탈카프 사피아노</span></a></li>
	   	                <li><a href="#l_leather2"><span class="hid">키프 레더</span></a></li>
	   	                <li><a href="#l_leather3"><span class="hid">앨리게이터 본디드</span></a></li>
	   	                <li><a href="#l_leather4"><span class="hid">비벨라</span></a></li>
	   	                <li><a href="#l_leather5"><span class="hid">사피아노 뉴 리저드</span></a></li>
	   	            </ul>
	   	        </nav>
	   	        <div id="l_container">
	   	            <section id="l_leather1" >
	   	                <h2>Saffiano Leather
	   	                    <span>이탈카프 사피아노</span>
	   	                </h2>
	   	                
	   	                <p>
	   	                    프라다 원단가죽과 원피나 가공, 가죽의 색감 등 <br>
	   	                    퀄리티에서 손색이 없는 이태리 최고급 가죽입니다. <br>
	   	                    가죽 표면에서 사피아노(철망)무늬로 엠보싱한 송아지 가죽으로서,<br>
	   	                    스크래치나 오염방지를 위해 마감처리로 특수코팅 처리 된<br>
	   	                    내구성과 견고성이 강화된 천연가죽 입니다.
	   	                </p>
	   	            </section>
	   	            <section id="l_leather2">
	   	                <h2>Kip Leather
	   	                    <br>
	   	                    <span>키프 레더</span>
	   	                </h2>
	   	                
	   	                <p>
	   	                    콘치아토레에서 사용하는 Kip Genuine Leather는 소와 송아지의 중간 사이즈를 말하지만<br>
	   	                    유럽에서는 side-calf로 분류하기도 합니다.<br>
	   	                    가죽의 자연스런 묘미를 만들기 위해 테고속에 넣고 돌려서<br>
	   	                    무두질을 처리하는 과정에서 소의 모공, 주름, 땀구멍 등의 표피 무늬가 그대로 살아있어<br>
	   	                    자연스러우면서도 고급스러운 느낌을 유지시켜서 만든 이태리 최고급 가죽소재입니다.<br>
	   	                </p> 
	   	            </section>
	   	
	   	            <section id="l_leather3">
	   	                <h2>Alligator bonded leather
	   	                    <br>
	   	                    <span>앨리게이터 본디드</span>
	   	                </h2>
	   	                
	   	                <p>
	   	                    신소재로서, 프린팅이나 그라인딩이 되어있지 않고 내츄럴한 가죽패턴의 미세한 모공,<br>
	   	                    주름등을 그대로 살아있도록 만들어진 특수소재로서 100% 방수원단으로<br>
	   	                    Outdoor나 Wear에 많이 사용되어 내구성과 견고성이 탁월합니다.<br>
	   	                    만질 때의 촉감이 매우 부드러운 스웨이드 느낌의 이태리 최고급 소재입니다.<br>
	   	                </p>
	   	            </section>
	   	
	   	            <section id="l_leather4">
	   	                <h2>Vivella
	   	                    <br>
	   	                    <span>비벨라</span>
	   	                </h2>
	   	                
	   	                <p>
	   	                    직, 편물에 천연피혁의 외관을 갖는 고분자막을 붙인 특수 가공 원단으로<br>
	   	                    다양한 패턴과 칼라를 실린더로 엠보싱을 주어 아크릴코팅으로 마감처리한 원단입니다.<br>
	   	                    인장력이 좋고 방수력, 내구성 모두 뛰어난 원단으로,<br>
	   	                    까다롭고 엄격하기로 유명한 유럽의 'Centro Tessile Contonero 3 abbigliamento'에서<br>
	   	                    친환경 인증을 획득한 재질입니다.<br>
	   	                </p> 
	   	            </section>
	   	
	   	            <section id="l_leather5">
	   	                <h2>Saffiano New Lizare
	   	                    <br>
	   	                    <span>사피아노 뉴 리저드</span>
	   	                </h2>
	   	                
	   	                <p>
	   	                    콘치아토레에서 사용하는 프라다 원단 가죽과 원피나 가공, 가죽의 색감 등<br>
	   	                    퀄리티에서 손색이 없는 이태리 최고급 가죽입니다.<br>
	   	                    가죽표면에 사피아노 무늬로 엠보싱한 송아지 가죽으로서,<br>
	   	                    스크래치나 오염방지를 위해 마감처리로 특수코딩처리된<br>
	   	                    내구성과 견고성이 강화된 천연송아지 가죽입니다.
	   	                </p>
	   	            </section>
	   	</div>
	   </div><!-- // l_container -->
		<?php include "footer.html"; ?>
    </body>
</html>
