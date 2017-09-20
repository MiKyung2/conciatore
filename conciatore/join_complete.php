<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>홈 > 회원가입완료</title>
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
            <div id="jo_wrap" class="clear">
                <h2>WELCOME</h2>
                <p>회원가입이 완료 되었습니다.</p>
                <div id="joinc_wrap" class="clear">
                    <dl>
                        <dt>아이디</dt>
                        <dd><?php echo $_GET['id'] ?></dd><br>
                        <dt>이름</dt>
                        <dd><?php echo $_GET['name'] ?></dd><br>
                        <dt>이메일</dt>
                        <dd><?php echo $_GET['email'] ?></dd><br>
                    </dl>
                </div>
               <div>
                   <form method="post" action="login.php">
                        <input type="submit" class="color" value="로그인"/>
                   </form>
                    <a href="index.php"><button class="index">메인페이지</button></a>
                </div>
            </div><!-- // wrap -->
		</section>

		<?php include "footer.html"; ?>
    </body>
</html>
