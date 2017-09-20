<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>홈 > 로그인</title>
        <meta name="description" content="">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/sub.css"> 
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="js/common.js"></script>
        <script type="text/javascript" src="js/sub.js"></script>
        <script type="text/javascript">
            <?php 
            
            session_start();
            ?>
            function confirmSave(checkbox){
                var isRemember;

                if(checkbox.checked){
                    isRemember = confirm("이 PC에 로그인 정보를 저장하시겠습니까? PC방등의 공공장소에서는 개인정보가 유출될 수 있으니 주의해주십시오.");
                    if(!isRemember)
                        checkbox.checked = false;
                }
            }
            $(document).ready(function(){
            // 저장된 쿠키값을 가져와서 ID 칸에 넣어준다. 없으면 공백으로 들어감.
                var userInputId = getCookie("userInputId");
                $("input[name='id']").val(userInputId); 

                if($("input[name='id']").val() != ""){ // 그 전에 ID를 저장해서 처음 페이지 로딩 시, 입력 칸에 저장된 ID가 표시된 상태라면,
                    $("#idSaveCheck").attr("checked", true); // ID 저장하기를 체크 상태로 두기.
                }

                $("#idSaveCheck").change(function(){ // 체크박스에 변화가 있다면,
                    if($("#idSaveCheck").is(":checked")){ // ID 저장하기 체크했을 때,
                        var userInputId = $("input[name='id']").val();
                        setCookie("userInputId", userInputId, 7); // 7일 동안 쿠키 보관
                    }else{ // ID 저장하기 체크 해제 시,
                        deleteCookie("userInputId");
                    }
                });

                // ID 저장하기를 체크한 상태에서 ID를 입력하는 경우, 이럴 때도 쿠키 저장.
                $("input[name='id']").keyup(function(){ // ID 입력 칸에 ID를 입력할 때,
                    if($("#idSaveCheck").is(":checked")){ // ID 저장하기를 체크한 상태라면,
                        var userInputId = $("input[name='id']").val();
                        setCookie("userInputId", userInputId, 7); // 7일 동안 쿠키 보관
                    }
                });
                
                $('input[value=LOGIN]').click(function(){
                    jQuery.ajax({
                       type:"POST",
                        url:"login_ok.php",
                        data:{
                            id : $('input#id').val(),
                            pw : $('input#pw').val()
                        },
                        success:function(data){
                            if(data == 'true'){
                                if(getCookie('cart_list') != ''){  
                                    //cart insert
                                    var valueList = JSON.parse(getCookie('cart_list'));
                                    var optionArray = Array();
                                    var idArray = Array();
                                    var cntArray = Array();
                                    
                                    for(var i = 0 ; i < valueList.length ; i++){
                                        optionArray.push(valueList[i]['color']);
                                        idArray.push(valueList[i]['pro_id']);
                                        cntArray.push(valueList[i]['cnt']);
                                    }
                                    
                                    jQuery.ajaxSettings.traditional = true;

                                    jQuery.ajax({
                                       type:"POST",
                                        url:"cart_insert.php",
                                        data:{
                                            color : JSON.stringify(optionArray),
                                            pro_id : JSON.stringify(idArray),
                                            cnt: JSON.stringify(cntArray)
                                        },
                                        success:function(data1){
//                                            alert(data);
                                        }
                                    });
                                    //cookie delete
                                    deleteCookie('cart_list','10.211.55.14');
                                }
                                location.href = "index.php";
                            }else{
                                alert('아이디 또는 비밀번호를 다시 확인하세요');
                            }
                        },
                        complete:function(data){
                        },
                        error:function(xhr, status, error){
                            alert("에러발생");
                        }
                    });
                });
            });

            function setCookie(cookieName, value, exdays){
                var exdate = new Date();
                exdate.setDate(exdate.getDate() + exdays);
                var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
                document.cookie = cookieName + "=" + cookieValue;
            }

            function deleteCookie( name, domain ){
                var todayDate = new Date();
                todayDate.setDate( todayDate.getDate() - 1 );
                document.cookie = name + "=; domain=" + domain + "; path=/; expires=" + todayDate.toGMTString() + ";";
            }

            function getCookie(cookieName) {
                cookieName = cookieName + '=';
                var cookieData = document.cookie;
                var start = cookieData.indexOf(cookieName);
                var cookieValue = '';
                if(start != -1){
                    start += cookieName.length;
                    var end = cookieData.indexOf(';', start);
                    if(end == -1)end = cookieData.length;
                    cookieValue = cookieData.substring(start, end);
                }
                return unescape(cookieValue);
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
                include "header.html";
            }else {
                 echo "<script> document.location.href='index.php'; </script>"; 
                include "header_login.html";
            }
        ?>
		<section id="content">
            <div id="lo_wrap" class="clear">
                <h2>MEMBER LOGIN</h2>
                <div id="login_wrap">
                    <form action="" method="post" >
                        <input type="text" name="id" id="id" class="form" placeholder="아이디">
                        <br>
                        <input type="password" name="pw" id="pw" class="form" placeholder="비밀번호">
                        <input type="submit" value="LOGIN"/>
                        <br>
                        <label><input type="checkbox" name="idcheck" id = "idSaveCheck" value="idsave" onClick="confirmSave(this)"> 
                        아이디 저장</label>
                    </form>
                </div>
                <div id="login_etc">
                    <ul>
                        <li class="join"><a href="join.php">NEW MEMBER REGISTATION &nbsp;&nbsp;&nbsp;<span>회원가입</span></a></li>
                        <li><a href="findID.php">DID YOU FORGOT YOUR ID? &nbsp;&nbsp;&nbsp;<span>아이디 찾기</span></a></li>
                        <li><a href="findPw.php">DID YOU FORGET YOUR PASSWROD? &nbsp;&nbsp;&nbsp;<span>비빌번호 찾기</span></a></li>
                    </ul>
                </div>
            </div><!-- // wrap -->
		</section>

		<?php include "footer.html"; ?>
    </body>
</html>
