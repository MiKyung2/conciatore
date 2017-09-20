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
                include "header.html";
            }else {
                include "header_login.html";
            }
          ?>
		<section id="content">
            <div id="or_wrap" class="clear">
                <h2>QnA 글쓰기</h2>
                <form action="board_insert.php" method="post" enctype="multipart/form-data">
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
                                </td>
                            </tr>
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
