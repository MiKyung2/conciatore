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
                            $('#blah').attr('width', 200);
//                            resize($('#blah'));
                            fitImageSize($('#blah'),'',100,100);
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
                <h2>QnA 글쓰기</h2>
                <form action="board_insert.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name = "writer" id="writer" value="<?php echo $_SESSION['login_user']?>">
                    <table id="boardWrite">
                        <tbody>
                            <tr>
                                <th scope="row" class="QnA_tit"><label for="bTitle">제목</label></th>
                                <td class="title"><select name="bTitle" id="bTitle">
                                                      <option value="배송문의">배송문의</option>
                                                      <option value="상품문의">상품문의</option>
                                                      <option value="배송전변경/취소문의">배송전변경/취소문의</option>
                                                      <option value="교환/반품문의">교환/반품문의</option>
                                                    </select></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="content"><textarea name="bContent" id="bContent"></textarea></td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="bContent">사진첨부</label></th>
                                <td>
                                    <input type="file" name="myfile" id="myfile">
                                    <img id="blah" src="#" alt="your image">
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
                        <a href="QnA.php?page=1" class="left">목록</a>
                        <button type="cancel" class="" >취소</button>
                        <input type="submit" class="" value="등록">
                    </div>
                </form>
            </div><!-- // wrap -->
		</section>

		<?php include "footer.html"; ?>
    </body>
</html>
