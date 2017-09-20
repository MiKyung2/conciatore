<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>홈 > 나의 페이지 > 나의 정보</title>
        <meta name="description" content="">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/sub.css"> 
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
      
        <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
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
            if(!isset($_SESSION['login_user'])) {
                include "header.html";
            }else {
                include "header_login.html";
            }
        
            $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
            if(mysqli_connect_errno()) {
                echo "mysql 연결 실패 : "+mysqli_connect_error();
            }
            $conn->set_charset("utf8");
            $login_user = $_SESSION['login_user'];
            $result = mysqli_query($conn, "select m_id, m_name, m_email, m_phone, m_postcode, m_address1, m_address2 from member where m_id = '$login_user' ;");
            
            $product_array = array();
            $no = 1;
            while($row = mysqli_fetch_array($result)) {
                array_push($product_array, array('id' => $row['m_id'],
                                                 'name' => $row['m_name'],
                                                 'email' => $row['m_email'],
                                                 'phone' => $row['m_phone'],
                                                 'postcode' =>$row['m_postcode'],
                                                 'address1' => $row['m_address1'],
                                                 'address2' => $row['m_address2']));
                $no++;
            }
            mysqli_close($conn);
          ?>
		<section id="content">
            <div id="jo_wrap" class="clear">
                <h2>MYINFO</h2>
                <div id="join_wrap">
                    <form method="post" action="member_update.php">
                        <dl>
                            <dt><label for="id">아이디</label></dt>
                            <dd><input type="text" id="id" name="id" placeholder="5~20자의 영문 소문자, 숫자와 특수기호(_),(-)만 사용 가능합니다." maxlength="20" value="<?php echo $product_array[0]['id'] ?>" readonly><br><p class="detail"></p></dd><br>
                            
                            <dt><label for="password">패스워드</label></dt>
                            <dd><input type="password" id="password" name="excludeHangul" placeholder="6~16자 영문 대 소문자, 숫자, 특수문자를 사용하세요." maxlength="30"><br><p class="detail"></p></dd><br>
                            <dt><label for="passwordCheck">패스워드 확인</label></dt>
                            <dd><input type="password" id="passwordCheck" data-rule-required="true" placeholder="패스워드 확인" maxlength="30"><br><p class="detail"></p></dd><br>
                            <dt><label for="name">이름</label></dt>
                            <dd><input type="text" class="onlyHangul" id="name" name="name" placeholder="한글만 입력 가능합니다." maxlength="15" value="<?php echo $product_array[0]['name'] ?>"><br><p class="detail"></p></dd><br>
                            <dt><label for="email" class="control-label">이메일</label></dt>
                            <dd><input type="email" id="email" name="email" placeholder="이메일" maxlength="40" value="<?php echo $product_array[0]['email'] ?>">
<!--                                <button>인증번호 받기<i class="fa fa-edit spaceLeft"></i></button><br>-->
                                <p class="detail"></p></dd><br>
<!--
                            <dt><label for="phonecerti">인증번호 입력</label></dt>
                            <dd><input type="text"id="emailcerti" placeholder="인증번호"><button>인증번호 확인<i class="fa fa-edit spaceLeft"></i></button><br><p class="detail"></p>
                            </dd><br>
-->
                            <dt><label for="phone">휴대폰번호</label></dt>
                            <dd><input type="tel" id="phone"  name="phone" placeholder="- 없이 입력해 주세요" value="<?php echo $product_array[0]['phone'] ?>"><br><p class="detail"></p></dd><br>
                            <dt><label for="sample4_postcode" >주소</label></dt>
                            <dd><input type="text" id="sample4_postcode" name="sample4_postcode" value="<?php echo $product_array[0]['postcode'] ?>" placeholder="우편번호">
                                <input type="button" id="btnzipcode" onclick="sample4_execDaumPostcode()" value="우편번호 찾기"><br>
                                <input type="text" id="sample4_roadAddress" name ="sample4_roadAddress" value="<?php echo $product_array[0]['address1'] ?>" placeholder="도로명주소">
                                <input type="text" id="sample4_jibunAddress" name="sample4_jibunAddress" value="<?php echo $product_array[0]['address2'] ?>" placeholder="상세주소"><br><p class="detail"></p>
                                <span id="guide" style="color:#999"></span></dd>
                            <br>
                        </dl>
                        
                        <div>
                            <input type="button" id="member_update" class="color" value="회원정보수정" >
                            <input type="reset" value="취소" class="cancel">
                            <input type="button" id="member_delete" class="color" value="탈퇴" >
                        </div>
                    </form>
                </div>
            </div><!-- // wrap -->
		</section>

		<?php include "footer.html"; ?>
    </body>
</html>
