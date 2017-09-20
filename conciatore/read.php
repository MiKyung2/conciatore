<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>홈 > QnA</title>
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
        <?php 
            session_start();
            $no_get = $_GET['no'];
            $login_user = $_SESSION['login_user'];
        ?>
        <script type="text/javascript">
              function mySubmit(index) {
                if (index == 1) {
                  document.myForm.action='reply.php';
                }
                if (index == 2) {
                    if (confirm("정말 삭제하시겠습니까?") == true){    //확인
//                        $('#reply').submit;
                       document.myForm.action='board_delete.php';
                    }
                }
                document.myForm.submit();
              }


        </script>
        <!--[if lt IE 9]>
			<script type="text/javascript" src="js/html5.js"></script>
		<![endif]-->
        
    </head>
    <body>
        
    	<?php include "skip.html"; ?>
		<?php
            if(!isset($_SESSION['login_user'])) {
                echo "<script>alert(\"회원 전용 페이지 입니다.\");</script>";
                echo "<script> document.location.href='login.php'; </script>"; 
            }else {
                include "header_login.html";
            }
          ?>
        <?php
            
            $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
            if(mysqli_connect_errno()) {
                echo "mysql 연결 실패 : "+mysqli_connect_error();
            }
            $conn->set_charset("utf8");
            $result = mysqli_query($conn, "select b_no, b_title, b_writer, b_date, b_content, b_picture, b_family from board where b_no = '$no_get' ;");
            
            $board_array = array();
            $no = 1;
            while($row = mysqli_fetch_array($result)) {
                array_push($board_array, array('no' => $row['b_no'],
                                                'title' => $row['b_title'],
                                                'writer' => $row['b_writer'],
                                                'date' => $row['b_date'],
                                                'content' => $row['b_content'],
                                                'picture' => $row['b_picture'],
                                                'family' => $row['b_family']));
                $no++;
            }
            mysqli_close($conn);
        ?>
        <?php
            if(isset($_SESSION['login_user'])) {
                $m_id = $_SESSION['login_user'];
                $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
                if(mysqli_connect_errno()) {
                    echo "mysql 연결 실패 : "+mysqli_connect_error();
                }
                $conn->set_charset("utf8");
                $result = mysqli_query($conn, "select m_div from member where m_id = '$m_id' ;");

                $m_div = array();
                $no = 1;
                while($row = mysqli_fetch_array($result)) {
                    array_push($m_div, array('div' => $row['m_div']));
                    $no++;
                }
                mysqli_close($conn);
            }
        ?>
        <?php 
            $type="qna";
        
             $m_id = $_SESSION['login_user'];
                $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
                if(mysqli_connect_errno()) {
                    echo "mysql 연결 실패 : "+mysqli_connect_error();
                }
                $conn->set_charset("utf8");
                $family = $board_array[0]['family'];
                $sql = "select b_no from board where b_family = '$family' and b_no < $no_get ;";
                $result = $conn->query($sql);
        
                $type = 'qna';
                if ($result->num_rows > 0) {
                    $type = 'reply';
                } else {
                    $type = 'qna';
                }
                mysqli_close($conn);
        ?>
		<section id="content">
            <div id="or_wrap" class="clear">
                <h2><?php echo $board_array[0]['title'] ?></h2>
                <form name='myForm' method="post" id="reply">
                    <input type="hidden" id="b_no" name="b_no" value="<?php echo $no_get ?>">
                    <table id="boardWrite">
                        <tbody>
                            <tr>
                                <th scope="row" class="QnA_tit"><label for="bTitle">제목</label></th>
                                <td class="title"><?php echo $board_array[0]['title']?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="writer"><label for="writer">작성자</label></th>
                                <td class="writer"><?php echo $board_array[0]['writer']?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="write_date"><label for="write_date">작성일</label></th>
                                <td class="write_date"><?php echo $board_array[0]['date']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="content"><?php 
                                $content = $board_array[0]['content'];
                                $content = str_replace("\r\n","<br/>",$content); //줄바꿈 처리
                                $content = str_replace("\u0020","&nbsp;",$content); echo $content ?>
                                    <?php 
                                        if($board_array[0]['picture'] != './uploads/'){ ?>
                                        <br><br>
                                        <img src="<?php echo $board_array[0]['picture']?>">
                                    <?php }?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btnSet">
                        <input type="hidden" value="<?php echo $board_array[0]['no']?>" name="b_no">
                        <input type="hidden" value="<?php echo $board_array[0]['family']?>" name="b_family">
                        <input type="hidden" value="<?php echo $board_array[0]['content'] ?>" name="b_content">
                        <a href="QnA.php?page=1" class="left">목록</a>
                        <?php 
                        if($login_user == $board_array[0]['writer'] | $m_div[0]['div'] == 'admin'){ ?>
                            <button type="submit" class="reply" onclick='mySubmit(1)'>답변</button>
                        <?php } ?>
                        <?php 
                        if($login_user == $board_array[0]['writer'] | ($board_array[0]['writer'] == '관리자' && $m_div[0]['div'] == 'admin')){ ?>
                            <a href="board_update.php?no=<?php echo $no_get ?>&type=<?php echo $type ?>" >수정</a>
                            <button type="button" class="delete" onclick='mySubmit(2)'>삭제</button>
                        <?php } ?>
                        
                    </div>
                </form>
            </div><!-- // wrap -->
		</section>

		<?php include "footer.html"; ?>
    </body>
</html>

