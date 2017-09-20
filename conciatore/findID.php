<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>홈 > 로그인 > 아이디 찾기</title>
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
		<?php include "header.html"; ?>
		<section id="content">
            <div id="id_wrap" class="clear">
                <h2>FIND ID</h2>
                <div id="fid_wrap">
                    <p>아이디 찾기</p>
                    <form method="post" action="">
                        <input type="radio" id="chkemail" name="group1" checked="checked">
                        <label for="chkemail">이메일</label>
                        <input type="radio" id="phone" name="group1">
                        <label for="phone">휴대폰번호</label>
                        
                        <div>
                            <label for="name" class="la">이름</label>
                            <input type="text" id="name"><br>
                            <label for="email" class="la">이메일</label>
                            <input type="email" id="email">
                        </div>
                        <input type="button" value="확인">
                    </form>
                </div>
            </div><!-- // wrap -->
		</section>

		<?php include "footer.html"; ?>
    </body>
</html>
