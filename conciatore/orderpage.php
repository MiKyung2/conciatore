<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>홈 > 주문 / 결제</title>
        <meta name="description" content="">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/sub.css"> 
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="js/common.js"></script>
        <script type="text/javascript" src="js/sub.js"></script>
        <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
        <?php 
            session_start();
            if(session_is_registered('login_user')){
                $user_id = $_SESSION['login_user'];
            }else{
                echo "<script>alert(\"잘못된 접근입니다.\");</script>";
                echo "<script>document.location.href='index.php'; </script>";
                $user_id='';
            }

            $type = $_GET['type'];
            $no = '';
            if(!isset($_GET['no'])){
                $no = '';
            }else {
                $no = $_GET['no'];
            }
            
            
            $cart_array = array();
            $member_array = array();
        
            if($user_id != ''){
                $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
                if(mysqli_connect_errno()) {
                    echo "mysql 연결 실패 : "+mysqli_connect_error();
                }
                $conn->set_charset("utf8");
                
                if($type == 'single'){
                    if(!isset($_POST['option']) | !isset($_POST['pro_id']) | !isset($_POST['cnt'])){
                        echo "<script>alert(\"잘못된 접근입니다.\");</script>";
                        echo "<script>document.location.href='index.php'; </script>";
                    }else {
                        $option = $_POST['option'];
                        $pro_id = $_POST['pro_id'];
                        $cnt = $_POST['cnt'];
                    }
                    
                    for($i = 0 ; $i < count($option) ; $i++){
                        $result = mysqli_query($conn, "select product.pro_id, product_stock.pros_color, pros_picture1,  pro_name, pro_price from product_stock, product  where product_stock.pro_id = product.pro_id and product.pro_id = $pro_id[0] and product_stock.pros_color = '$option[$i]' ;"); 
                        
                        $no1 = 1;
                        while($row = mysqli_fetch_array($result)) {
                            array_push($cart_array, array('pro_id' => $row['pro_id'],
                                                          'picture' => $row['pros_picture1'],
                                                          'name' => $row['pro_name'],
                                                          'option' => $row['pros_color'],
                                                          'count' => $cnt[$i],
                                                          'price' => $row['pro_price']));
                            $no1++;
                        }
                    }
                }else if($type == 'all'){
                    $result = mysqli_query($conn, "select @ROWNUM := @ROWNUM + 1 AS ROWNUM,product.pro_id, product_stock.pros_color, pros_picture1, c_count, pro_name, pro_price  from cart, product_stock, product,(select @ROWNUM := 0) ROWNUM  where cart.pro_id = product_stock.pro_id and cart.pros_color = product_stock.pros_color and product_stock.pro_id = product.pro_id and m_id  = '$user_id';"); 
                    
                    if($no == ''){
                        $no = 1;
                        while($row = mysqli_fetch_array($result)) {
                            array_push($cart_array, array('pro_id' => $row['pro_id'],
                                                          'picture' => $row['pros_picture1'],
                                                          'name' => $row['pro_name'],
                                                          'option' => $row['pros_color'],
                                                          'count' => $row['c_count'],
                                                          'price' => $row['pro_price']));
                            $no++;
                        }
                    }else {
                        $noresult = substr($no,1,strlen($no)-2);
                        $nolist = explode(',', $noresult);
                        
                        $no = 1; $j = 0;
                        while($row = mysqli_fetch_array($result)) {
                            if($nolist[$j] == $no){
                                array_push($cart_array, array('pro_id' => $row['pro_id'],
                                                          'picture' => $row['pros_picture1'],
                                                          'name' => $row['pro_name'],
                                                          'option' => $row['pros_color'],
                                                          'count' => $row['c_count'],
                                                          'price' => $row['pro_price']));
                                
                                $j++;
                            }
                            $no++;
                        }
                    }
                    
                }

                $result = mysqli_query($conn, "select m_name, m_phone, m_postcode, m_address1, m_address2 from member where m_id  = '$user_id';"); 

                $no = 1;
                while($row = mysqli_fetch_array($result)) {
                    array_push($member_array, array('name' => $row['m_name'],
                                                    'phone' => $row['m_phone'],
                                                    'postcode' => $row['m_postcode'],
                                                    'address1' => $row['m_address1'],
                                                    'address2' => $row['m_address2']));
                    $no++;
                }
                
                mysqli_close($conn);
            }
        ?>
        <script>
            //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
            function sample4_execDaumPostcode() {
                new daum.Postcode({
                    oncomplete: function(data) {
                        // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                        // 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
                        // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                        var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
                        var extraRoadAddr = ''; // 도로명 조합형 주소 변수

                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                            extraRoadAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if(data.buildingName !== '' && data.apartment === 'Y'){
                           extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if(extraRoadAddr !== ''){
                            extraRoadAddr = ' (' + extraRoadAddr + ')';
                        }
                        // 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
                        if(fullRoadAddr !== ''){
                            fullRoadAddr += extraRoadAddr;
                        }

                        // 우편번호와 주소 정보를 해당 필드에 넣는다.
                        document.getElementById('sample4_postcode').value = data.zonecode; //5자리 새우편번호 사용
                        document.getElementById('sample4_roadAddress').value = fullRoadAddr;
//                        document.getElementById('sample4_jibunAddress').value = data.jibunAddress;

                        // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                        if(data.autoRoadAddress) {
                            //예상되는 도로명 주소에 조합형 주소를 추가한다.
                            var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                            document.getElementById('guide').innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';

                        } else if(data.autoJibunAddress) {
                            var expJibunAddr = data.autoJibunAddress;
                            document.getElementById('guide').innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';

                        } else {
                            document.getElementById('guide').innerHTML = '';
                        }
                    }
                }).open();
            }
            
            $(document).ready(function(){
                $('table.product tbody tr').each(function() {
                    $num1 = parseInt($(this).children("td:nth-child(3)").text());
                    $num2 = parseInt($(this).children("td:nth-child(4)").text());
                    $sum = $num1*$num2;

//                    $(this).children("td:nth-child(5)").text($sum*0.005);
                    $(this).children("td:nth-child(5)").text($sum);

                });
                //bottom sum layout
                $allsum=0;
                $('table.product tbody tr').each(function() {
                    $allsum+=parseInt($(this).children("td:nth-child(5)").text());
                });

                $('table.sum tbody tr td:nth-child(1)').text($allsum+"원");

                if($allsum >= 150000){
                   $('table.sum tbody tr td:nth-child(2)').text("0원");   
                }else {
                    $('table.sum tbody tr td:nth-child(2)').text("2500원");   
                }

                $ressum = parseInt($('table.sum tbody tr td:nth-child(1)').text())+parseInt($('table.sum tbody tr td:nth-child(2)').text());
                $('table.sum tbody tr td:nth-child(3)').text($ressum+"원");
                var html = "<input type='hidden' name='ressum' value='"+$ressum+"'>";
                $('form').append(html);
                $('input[type=radio]').click(function() {
                    var radioVal = $(this).val();
                    if(radioVal == 'member') {
                        $('input#receiver').val("<?php echo $member_array[0]['name'] ?>");
                        $('input#phone').val("<?php echo $member_array[0]['phone'] ?>");
                        $('input#sample4_postcode').val(<?php echo $member_array[0]['postcode'] ?>);
                        $('input#sample4_roadAddress').val("<?php echo $member_array[0]['address1'] ?>");
                        $('input#sample4_jibunAddress').val("<?php echo $member_array[0]['address2'] ?>");
                    }else if(radioVal == 'new'){
                        $('input#receiver').val("");
                        $('input#phone').val("");
                        $('input#sample4_postcode').val("");
                        $('input#sample4_roadAddress').val("");
                        $('input#sample4_jibunAddress').val("");
                    }
                });
                
                $('button[type=button]').click(function(){
                    var str = $('input#receiver').val();
                    if(str == ''){
                        $('input#receiver').focus();
                        alert('보내시는 분을 입력해주세요.');
                        return false;
                    }
                    
                    var regExp = /^[0-9]*$/;
                    var str = $('input#sample4_postcode').val();
                    if(str == ''){
                        $('input#sample4_postcode').focus();
                        alert('우편번호를 입력해주세요.');
                        
                        return false;
                    }else if(!str.match(regExp)){
                        $('input#sample4_postcode').focus();
                        alert('숫자만 입력하세요');
                        return false;
                    }
                    
                    var str = $('input#sample4_roadAddress').val();
                    if(str == ''){
                        $('input#sample4_roadAddress').focus();
                        alert('도로명주소를 입력해주세요.');
                        return false;
                    }
                    
                    var str = $('input#sample4_jibunAddress').val();
                    if(str == ''){
                        $('input#sample4_jibunAddress').focus();
                        alert('상세주소를 입력해주세요.');
                        return false;
                    }
                    
                    var str = $('input#phone').val();
                    var regExp = /^01([0|1|6|7|8|9]?)([0-9]{3,4})([0-9]{4})$/;

                    if(str == '') {
                        $('input#phone').focus();
                        alert('휴대전화 입력은 필수입니다.');
                        return false;
                    }else if (!str.match(regExp)){
                        $('input#phone').focus();
                        alert('휴대전화 형식에 맞지 않습니다.');
                        return false;
                    }
                    $('#payment').submit();
                });
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
        
        if($user_id == '') {
            echo "<script>alert(\"유효하지 않은 페이지입니다.\");</script>";
             echo("<script>location.href='index.php';</script>"); 
        }else {
            include "header_login.html";
        }
        
      ?>
        
		<section id="content">
            <div id="car_wrap" class="clear">
                <h2>주문 / 결제</h2>
                <?php 
                    if(sizeof($cart_array) == 0){?>
                       <div id="sod_bsk">
                            <form method="post" action="" class="clear empty" >
                                <ul class="sod_list">
                                    <li class="empty_list">장바구니에 담긴 상품이 없습니다.</li>    
                                </ul>
                            </form>
                           <br>
                            <button class="shopping" onclick="location.href='index.php' ">쇼핑 계속하기</button>
                        </div> 
                    <?php }else {?>
                        <div id="sod_bsk">
                            <form id="payment" method="post" action="orderlist_insert.php">
                                <table class="product" >
                                    <thead>
                                    <tr>
                                        <th class="th2" scope="col">상품이미지</th>
                                        <th scope="col">상품정보</th>
                                        <th class="th1" scope="col">수량</th>
                                        <th class="th2" scope="col">판매가</th>
<!--                                        <th class="th2" scope="col">적립금</th>-->
                                        <th class="th2" scope="col">합계</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                            for($i = 0 ; $i < sizeof($cart_array) ; $i++){
                                        ?>
                                                <tr>
                                                    <td class="sod_img">
                                                        <img src="<?php echo $cart_array[$i]['picture'] ?>" width="70" height="70" alt="">
                                                    </td>
                                                    <td class="sod_title">
                                                        <a href="detail.php?id=<?php echo $cart_array[$i]['pro_id']?>"><?php echo $cart_array[$i]['name']?><br>[옵션 : <span><?php echo $cart_array[$i]['option']?></span>]</a>
                                                    </td>
                                                    <td class="td_num"><?php echo $cart_array[$i]['count'] ?></td>
                                                    <td class="td_price"><?php echo $cart_array[$i]['price'] ?></td>
<!--                                                    <td class="td_point">0</td>-->
                                                    <td class="td_sum">
                                                        <span id="sell_price_0">40000</span>
                                                    </td>
                                                </tr>
                                                <input type="hidden" name="pro_id[]" value="<?php echo $cart_array[$i]['pro_id'] ?>">
                                                <input type="hidden" name="color[]" value="<?php echo $cart_array[$i]['option'] ?>">
                                                <input type="hidden" name="cnt[]" value="<?php echo $cart_array[$i]['count'] ?>">
                                            <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <h3 class="deliveryinfo">배송지 정보</h3>
                                <table class="delivery">
                                    <tr>
                                        <th><label for="delivery1">배송지 선택</label></th>
                                        <td class="sp">
                                            <input type="radio" name="delivery" id="delivery1" value="member" checked><label for="delivery1">주문자 정보와 동일</label>
                                            <input type="radio" name="delivery" id="delivery2" value="new" >
                                            <label for="delivery2">새로운 배송지</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="receiver">* 받으시는 분</label></th>
                                        <td><input type="input" id="receiver" name="receiver" value="<?php echo $member_array[0]['name'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <th><label for="sample4_postcode" >* 주소</label></th>
                                        <td>
                                            <input type="text" class="clear" id="sample4_postcode" name="sample4_postcode" placeholder="우편번호" value="<?php echo $member_array[0]['postcode'] ?>"><input type="button" id="btnzipcode" onclick="sample4_execDaumPostcode()" value="우편번호 찾기"><br><br>
                                            <input type="text" id="sample4_roadAddress" name ="sample4_roadAddress" placeholder="도로명주소" value="<?php echo $member_array[0]['address1'] ?>"><br><br>
                                            <input type="text" id="sample4_jibunAddress" name="sample4_jibunAddress" placeholder="상세주소" value="<?php echo $member_array[0]['address2'] ?>">
                                            <span id="guide" style="color:#999"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="phone">* 휴대전화</label></th>
                                        <td><input type="input" name="phone" id="phone" value="<?php echo $member_array[0]['phone'] ?>" placeholder="- 없이 입력해 주세요"></td>
                                    </tr>
                                    <tr>
                                        <th><label for="message">배송메시지</label></th>
                                        <td><textarea name="message" id="message"></textarea></td>
                                    </tr>
                                </table>
                                <table class="sum">
                                    <thead>
                                        <tr>
                                            <th>총 상품 금액</th>
                                            <th>배송비</th>
                                            <th>결제 예정 금액</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button">결제하기</button>
                            </form>
                        </div>
                    <?php }
                ?>
            </div>
		</section>
		<?php include "footer.html"; ?>
    </body>
</html>
