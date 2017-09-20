<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>홈 > 나의 페이지 > QnA 게시판</title>
        <meta name="description" content="">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/sub.css"> 
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                echo "<script>alert(\"회원 전용 페이지 입니다.\");</script>";
                echo "<script> document.location.href='login.php'; </script>"; 
            }else {
                include "header_login.html";
            }
          ?>
        <?php
            $conn = new mysqli("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
        
            if(mysqli_connect_errno()) {
                echo "mysql 연결 실패 : "+mysqli_connect_error();
            }
            $conn->set_charset("utf8");
        
            //총 데이터의 수
            $data = mysqli_query($conn,'select b_no from board order by b_no desc');
            $num = mysqli_num_rows($data);
        
            //페이지 당 데이터 수 / 블록 당 페이지 수
            $list = 10;
            $block = 5;
            
            $pageNum = ceil($num/$list); //총 페이지
            if($_GET['page'] > $pageNum){
                $page = $pageNum;
            }else if($_GET['page'] <= 0){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $blockNum = ceil($pageNum/$block);  //총 블록
            $nowBlock = ceil($page/$block); //현재 페이지가 위치한 블록
    
            //블록 당 시작 페이지
            $s_page = ($nowBlock*$block) - ($block -1);
            if($s_page <= 1) {
                $s_page = 1;
            }
            //블록 당 종료 페이지
            $e_page = $nowBlock*$block;
            if($pageNum <= $e_page) {
                $e_page = $pageNum;
            }            
            
            mysqli_close($conn);
        ?>
		<section id="content">
            <div id="or_wrap" class="clear">
                <h2>QnA</h2>
                <table class="QnA">
                    <thead>
                        <tr>
                            <th class="qna_no">번호</th>
                            <th class="qna_title">제목</th>
                            <th class="qna_writer">작성자</th>
                            <th class="qna_date">작성일</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                            $s_point = ($page-1) * $list;

                            $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
                            if(mysqli_connect_errno()) {
                                echo "mysql 연결 실패 : "+mysqli_connect_error();
                            }
                            $conn->set_charset("utf8");
                            $real_data = mysqli_query($conn, "select b_no, b_title, b_writer, b_date from board order by b_family desc,  b_orderby, b_no desc LIMIT $s_point,$list;");
                            mysqli_close($conn);
                             
                            for ($i=1; $i<=$num; $i++){
                                $fetch = mysqli_fetch_array($real_data);
                                if ($fetch == false) {
                                    break;
                                }
                        ?>
                                <tr>
                                    <td><?php echo $fetch['b_no']?></td>
                                    <td class='qna_title2'><a href="read.php?no=<?php echo $fetch['b_no']?>"><?php echo $fetch['b_title']?></a></td>
                                    <td><?php echo $fetch['b_writer']?></td>
                                    <td><?php echo $fetch['b_date']?></td>
                                </tr> 
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <a href="write.php" class="write_btn">글쓰기</a>
                
                <ul id="s_listnum">
                    <li><a href="QnA.php?page=<?php echo 1?>">〈〈</a></li>
                    <li><a class="inside" href="QnA.php?page=<?php echo $page-5?>">〈</a></li>
                    <?php 
                        for ($p=$s_page; $p<=$e_page; $p++) {?>
                        <li>
                            <a <?php if($p == $page) {?> style="color:black" <?php } ?> href="QnA.php?page=<?php echo $p ?>" ><?php echo $p ?></a>
                        </li><?php
                        }
                    ?>
                    <li><a class="inside2" href="QnA.php?page=<?php echo $page+5?>">〉</a></li>
                    <li><a href="QnA.php?page=<?php echo $pageNum?>">〉〉</a></li>
                </ul>
            </div><!-- // wrap -->
		</section>

		<?php include "footer.html"; ?>
    </body>
</html>
