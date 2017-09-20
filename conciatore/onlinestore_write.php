<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>상품 등록 : 온라인스토어 : 가죽공방 콘치아토레</title>
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
                include "header.html";
            }else {
                include "header_login.html";
            }
          ?>
		<section id="content">
            <div id="or_wrap" class="clear">
                <h2>상품 추가하기</h2>
                <form action="product_insert.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name = "writer" id="writer" value="<?php echo $_SESSION['login_user']?>">
                    <table id="onlinestore_Write">
                        <tbody>
                            <tr>
                                <th>상품이름</th>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="QnA_tit"><label for="bTitle">카테고리</label></th>
                                <td class="title"><select name="bTitle" id="bTitle">
                                                      <option value="가방">가방</option>
                                                      <option value="지갑">지갑</option>
                                                      <option value="핸드폰">핸드폰</option>
                                                      <option value="악세사리">악세사리</option>
                                                      <option value="문구">문구</option>
                                                    </select></td>
                            </tr>
                            <tr>
                                <th>상품설명</th>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <th>가격</th>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="bContent">색상 / RGB / 사진</label></th>
                                <td>
                                    <ul>
                                        <li><input type="text" placeholder="색상">
                                            <input type="text" placeholder="RGB">
                                        
                                            <input type="file" name="myfile" id="myfile">
                                            <img id="blah" src="#" alt="your image" onload="javascript:fitImageSize(this,,100,100)">
                                        </li><br>
                                        <li><input type="text" placeholder="색상">
                                            <input type="text" placeholder="RGB">
                                        
                                            <input type="file" name="myfile" id="myfile">
                                            <img id="blah" src="#" alt="your image" onload="javascript:fitImageSize(this,,100,100)">
                                        </li><br>
                                        <li><input type="text" placeholder="색상">
                                            <input type="text" placeholder="RGB">
                                        
                                            <input type="file" name="myfile" id="myfile">
                                            <img id="blah" src="#" alt="your image" onload="javascript:fitImageSize(this,,100,100)">
                                        </li>
                                    </ul>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btnSet clear">
                        <a href="onlinestore.php?category=all&no=0" class="left">목록</a>
                        <button type="cancel" class="" >취소</button>
                        <input type="submit" class="" value="등록">
                    </div>
                </form>
            </div><!-- // wrap -->
		</section>

		<?php include "footer.html"; ?>
    </body>
</html>
