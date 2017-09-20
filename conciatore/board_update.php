<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>홈 > QnA 글쓰기</title>
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
        <script type="text/javascript">
        <?php
            
            $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
            if(mysqli_connect_errno()) {
                echo "mysql 연결 실패 : "+mysqli_connect_error();
            }
            $conn->set_charset("utf8");
            $no_get = $_GET['no'];
            $type = $_GET['type'];
            
            $result = mysqli_query($conn, "select b_title, b_writer, b_date, b_content, b_picture from board where b_no = '$no_get' ;");
            
            $board_array = array();
            $no = 1;
            while($row = mysqli_fetch_array($result)) {
                array_push($board_array, array('title' => $row['b_title'],
                                                 'writer' => $row['b_writer'],
                                                 'date' => $row['b_date'],
                                                 'content' => $row['b_content'],
                                                 'picture' => $row['b_picture']));
                $no++;
            }
            mysqli_close($conn);

            
        ?>
            
            $(document).ready(function(){
                $(function() {
                    $("input#myfile").on('change', function(){
                        readURL(this);
                    });
                });

                function readURL(input) {
                    if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                            $('#blah').css('display','block');
                            $('#blah').attr('src', e.target.result);
                            resize($('#blah'));
                        }

                      reader.readAsDataURL(input.files[0]);
                      
                    }
                }
                
                function fitImageSize(obj, href, maxWidth, maxHeight) {
                    var image = new Image();

                    image.onload = function(){

                        var width = image.width;
                        var height = image.height;

                        var scalex = maxWidth / width;
                        var scaley = maxHeight / height;

                        var scale = (scalex < scaley) ? scalex : scaley;
                        if (scale > 1)
                            scale = 1;

                        obj.width = scale * width;
                        obj.height = scale * height;

                        obj.style.display = "";
                    }
                    image.src = href;
                }
                $('select#bTitle > option[value="<?php echo $board_array[0]['title'] ?>"]').attr('selected','selected');
            });
        </script>
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
		<section id="content">
            <div id="or_wrap" class="clear">
                <h2>QnA 수정</h2>
                <form action="board_update2.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name = "no" id="no" value="<?php echo $no_get?>">
                    <input type="hidden" name = "writer" id="writer" value="<?php echo $_SESSION['login_user']?>">
                    <table id="boardWrite">
                        <tbody>
                            <tr>
                            <?php if($type == 'qna'){ ?>
                                <th scope="row" class="QnA_tit"><label for="bTitle">제목</label></th>
                                <td class="title"><select name="bTitle" id="bTitle">
                                                      <option value="배송문의">배송문의</option>
                                                      <option value="상품문의">상품문의</option>
                                                      <option value="배송전변경/취소문의">배송전변경/취소문의</option>
                                                      <option value="교환/반품문의">교환/반품문의</option>
                                                    </select></td>
                                   <?php } else if($type == 'reply') { ?>
                                <th scope="row" class="QnA_tit"><label for="bTitle">제목</label></th>
                                <td class="title"><select name="bTitle" id="bTitle">
                                                      <option value="└답변입니다~">답변입니다~</option>
                                                    </select></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td colspan="2" class="content">
                                    <textarea name="bContent" id="bContent"><?php echo trim($board_array[0]['content']) ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="bContent">사진첨부</label></th>
                                <td>
                                    <input type="file" name="myfile" id="myfile">
                                    <img id="blah" src="#" alt="your image" onload="javascript:fitImageSize(this,,100,100)">
                                </td>
                            </tr>
<!--
                            <tr>
                                <th scope="row"><label for="bPassword">비밀번호</label></th>
                                <td class="password"><input type="text" name="bPassword" id="bPassword"></td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="bSetting">비밀글설정</label></th>
                                <td class="passwordsetting">
                                    <input type="radio" name="bSetting" value="공개글" checked>공개글
                                    <input type="radio" name="bSetting" value="비밀글">비밀글
                                </td>
                            </tr>
-->
                        </tbody>
                    </table>
                    <div class="btnSet clear">
                        <a href="QnA.php" class="left">목록</a>
                        <button type="cancel" class="" >취소</button>
                        <input type="submit" class="" value="등록">
                    </div>
                </form>
            </div><!-- // wrap -->
		</section>

		<?php include "footer.html"; ?>
    </body>
</html>
