<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>홈 > 나의 페이지</title>
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
            $m_id ='';
            if(!isset($_SESSION['login_user'])) {
                echo "<script>alert(\"회원 전용 페이지 입니다.\");</script>";
                echo "<script> document.location.href='login.php'; </script>"; 
            }else { 
                include "header_login.html";
                $m_id = $_SESSION['login_user'];
            }
          ?>
        <?php
        $servername = "aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com";
        $username = "root";
        $password = "alruddl1";
        $dbname = "conciatore";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "select count(*) as cnt from orderlist where m_id = '$m_id'";
        $result = $conn->query($sql);
        $cnt = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $cnt = $row["cnt"];
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
		<section id="content">
            <div id="mypage_wrap" class="clear">
                <h2>MY PAGE</h2>
                <div id="my_wrap">
                   <h3 class="ing">나의 주문처리 현황<span>(최근 3개월 기준)</span></h3>
                    <ul class="clear">
                        <li><a href="order.php">임금전<br>0</a></li>
                        <li><a href="order.php">배송준비중<br>0</a></li>
                        <li><a href="order.php">배송중<br>0</a></li>
                        <li><a href="order.php">배송완료<br><?php echo $cnt[0]?></a></li>
                        <li><a href="order.php">취소 : 0<br>교환 : 0 <br>반품 : 0<br></a></li>
                    </ul>
                    
                    <div class="form">
                        <a href="order.php">
                            <h3>ORDER &nbsp;&nbsp;주문내역 조회</h3><br>
                            <p>고객님께서 주문하신 상품의 주문내역을 확인하실 수 있습니다.<br>비회원의 경우, 주문서의 주문번호와 비밀번호로 주문조회가 가능합니다.</p>
                        </a>
                    </div>
                    <div class="form">
                        <a href="my_class.php">
                            <h3>CLASS &nbsp;&nbsp;클래스신청 조회</h3><br>
                            <p></p>
                        </a>
                    </div>
                    <div class="form">
                        <a href="myinfo.php">
                            <h3>MY INFO &nbsp;&nbsp;나의 정보</h3><br>
                            <p>회원이신 고객님의 개인정보를 관리하는 공간입니다.<br>개인정보를 최신 정보로 유지하시면 보다 간편히 쇼핑을 즐기실 수 있습니다.</p>
                        </a>
                    </div>
                    <div class="form">
                        <a href="QnA.php">
                            <h3>QnA borad&nbsp;&nbsp; 질문 게시판</h3><br>
                            <p>conciatore의 궁금한 점을 질문할 수 있는 공간입니다.<br>고객님께서 글을 남기시면 빠른 시일 내에 답변을 드리겠습니다.</p>
                        </a>
                    </div>
                </div>
            </div><!-- // wrap -->
		</section>

		<?php include "footer.html"; ?>
    </body>
</html>
