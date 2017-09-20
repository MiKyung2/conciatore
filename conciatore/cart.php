<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>홈 > 장바구니</title>
        <meta name="description" content="">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/sub.css"> 
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="js/common.js"></script>
        <script type="text/javascript" src="js/sub.js"></script>
        <?php 
            session_start();
            if(session_is_registered('login_user')){
                $user_id = $_SESSION['login_user'];
            }else{
                $user_id='';
            }

            $cart_array = array();
            if($user_id != ''){
                $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
                if(mysqli_connect_errno()) {
                    echo "mysql 연결 실패 : "+mysqli_connect_error();
                }

               $result = mysqli_query($conn, "select product.pro_id, product_stock.pros_color, pros_picture1, c_count, pro_name, pro_price, pros_stock  from cart, product_stock, product  where cart.pro_id = product_stock.pro_id and cart.pros_color = product_stock.pros_color and product_stock.pro_id = product.pro_id and m_id  = '$user_id';"); 

                $no = 1;
                while($row = mysqli_fetch_array($result)) {
                    array_push($cart_array, array('pro_id' => $row['pro_id'],
                                                  'picture' => $row['pros_picture1'],
                                                  'name' => $row['pro_name'],
                                                  'option' => $row['pros_color'],
                                                  'count' => $row['c_count'],
                                                  'price' => $row['pro_price'],
                                                  'stock' => $row['pros_stock']));
                    $no++;
                }

                mysqli_close($conn);
            }else{  //쿠키
                require 'JSON.php';

                // Services_JSON 인스턴스 생성
                $json = new Services_JSON();
                if(isset($_COOKIE['cart_list'])){
                    $valueList = $json->decode($_COOKIE['cart_list']);

                    $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
                    if(mysqli_connect_errno()) {
                        echo "mysql 연결 실패 : "+mysqli_connect_error();
                    }

                    for($i = 0 ; $i < count($valueList) ; $i++){
                        $pro_id = $valueList[$i] -> pro_id ;
                        $color = $valueList[$i] -> color;

                        $result = mysqli_query($conn, "select product.pro_id, product_stock.pros_color, pros_picture1, pro_name, pro_price, pros_stock from product_stock, product  where product_stock.pro_id = product.pro_id and product.pro_id = '$pro_id' and product_stock.pros_color = '$color';"); 

                        $no = 1;
                        while($row = mysqli_fetch_array($result)) {
                            array_push($cart_array, array('pro_id' => $row['pro_id'],
                                                          'picture' => $row['pros_picture1'],
                                                          'name' => $row['pro_name'],
                                                          'option' => $row['pros_color'],
                                                          'price' => $row['pro_price'],
                                                          'stock' => $row['pros_stock']));
                            $no++;
                        }
                    }
                }
            }
        ?>
        <script>
            $(document).ready(function() {
                //선택삭제
                $("div.endbtn button#checkeddelete").click(function() {
                    $con_test = confirm("제품을 장바구니에서 삭제하시겠습니까?");
                    if($con_test == true) {
                        $("#sod_bsk table.product tbody input[type=checkbox]:checked").each(function() {
                            var pro_id = $(this).val();
                            var color = $(this).parent().parent().children('td.sod_title').children('a').children('span').text();
                            //cart db delete
                            if(getCookie('cart_list') != ''){
                                
                                //기존의 쿠키에 update-delete
                                var valueList = JSON.parse(getCookie('cart_list'));
                               
                                for(var i = 0 ; i < valueList.length ; i++) {
                                    if(valueList[i]['pro_id'] == pro_id && valueList[i]['color'] == color){
                                        valueList.splice(i,1);
                                    }
                                }
                                //쿠키 다시 저장
                                setCookie('cart_list',JSON.stringify(valueList),1);
                            }else{
                                jQuery.ajax({
                                   type:"POST",
                                    url:"cart_delete.php",
                                    data:{
                                        pro_id : pro_id,
                                        pros_color : color,
                                    },
                                    success:function(data){
                                        if(data){
                                            
                                        }else{
                                            alert('false');
                                        }
                                    },
                                    complete:function(data){
                                    },
                                    error:function(xhr, status, error){
                                        alert("에러발생");
                                    }
                                }); 
                            }
                            
                            //layout remove
                            $(this).parent().parent().remove();

                            //bottom sum layout
                            $allsum=0;
                            $('table.product tbody tr').each(function() {
                                $allsum+=parseInt($(this).children("td:nth-child(6)").text());
                            });

                            $('table.sum tbody tr td:nth-child(1)').text($allsum+"원");

                            if($allsum >= 150000){
                               $('table.sum tbody tr td:nth-child(2)').text("0원");   
                            }else {
                                $('table.sum tbody tr td:nth-child(2)').text("2500원");   
                            }

                            $ressum = parseInt($('table.sum tbody tr td:nth-child(1)').text())+parseInt($('table.sum tbody tr td:nth-child(2)').text());
                            $('table.sum tbody tr td:nth-child(3)').text($ressum+"원");  
                        });
                    }
                    if($('table.product tbody tr').length == 0){
                        window.location.reload();
                    }
                });
                
                //수량 변경
                $('table.product tbody td.td_num').change(function(){
                    var pro_id = $(this).parent().children('td.td_chk').children('input').val();
                    var color = $(this).parent().children('td.sod_title').children('a').children('span').text();
                    var cnt = $(this).children('input').val();
                    
                    if(getCookie('cart_list') != ''){   
                        //기존의 쿠키에 update-delete
                         valueList = JSON.parse(getCookie('cart_list'));
                        
                        for(var i = 0 ; i < valueList.length ; i++){
                            if(valueList[i]['color'] == color && valueList[i]['pro_id'] == pro_id ){    // 동일 제품 있으면 업데이트
                                valueList[i]['cnt'] = cnt;
                            }
                        }
                        //쿠키 다시 저장
                        setCookie('cart_list',JSON.stringify(valueList),1);
                    }else{
                        jQuery.ajax({
                           type:"POST",
                            url:"cart_update.php",
                            data:{
                                m_id : '<?php echo $user_id ?>',
                                color :color,
                                pro_id : pro_id,
                                cnt : cnt
                            },
                            success:function(data){
                                if(data){

                                }else{
                                    alert('false');
                                }
                            },
                            complete:function(data){
                            },
                            error:function(xhr, status, error){
                                alert("에러발생");
                            }
                        }); 
                    }
                });
                
                $('div.endbtn button#allbuy').click(function(){
                    <?php 
                        if($user_id == ''){?>
                            alert('회원만 주문가능합니다.');
                            location.href="login.php";
                        <?php }else {?>
                            location.href='orderpage.php?type=all';
                        <?php }
                    ?>
                });
                
                $('div.endbtn button#checkedbuy').click(function(){
                    var index="";
                    $("tbody input:checked").each(function(){
                        index +=($(this).parent().parent().index()+1+",");
                    });
                    index = index.substring(0,index.length-1);
                    
                    <?php 
                        if($user_id == ''){?>
                            alert('회원만 주문가능합니다.');
                            location.href="login.php";
                        <?php }else {?>
                            location.href='orderpage.php?type=all&no="'+index+'"';
                        <?php }
                    ?>
                });
                function setCookie(cName, cValue, cDay){
                  var expire = new Date();
                  expire.setDate(expire.getDate() + cDay);
                  cookies = cName + '=' + escape(cValue) + '; path=/ '; 
                  if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
                  document.cookie = cookies;
                }
                function getCookie(cName) {
                    cName = cName + '=';
                    var cookieData = document.cookie;
                    var start = cookieData.indexOf(cName);
                    var cValue = '';
                    if(start != -1){
                        start += cName.length;
                        var end = cookieData.indexOf(';', start);
                        if(end == -1)end = cookieData.length;
                        cValue = cookieData.substring(start, end);
                    }
                    return unescape(cValue);
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
        
        if($user_id == '') {
            include "header.html";
        }else {
            include "header_login.html";
        }
      ?>
		<section id="content">
            <div id="car_wrap" class="clear">
                <h2>장바구니</h2>
                <?php 
                    if(sizeof($cart_array) == 0){?>
                       <div id="sod_bsk">
                            <ul class="sod_list">
                                <li class="empty_list">장바구니에 담긴 상품이 없습니다.</li>    
                            </ul>
                           <br>
                            <button class="shopping" onclick="location.href='index.php' ">쇼핑 계속하기</button>
                        </div> 
                    <?php }else {?>
                        <div id="sod_bsk">
                            <form method="post" action="orderpage.php">
                                <table class="product" >
                                    <thead>
                                    <tr>
                                        <th class="th1" scope="col">
                                            <label for="ct_all" class="sound_only">상품 전체</label>
                                            <input type="checkbox" name="ct_all" value="top" id="ct_all" checked="checked">
                                        </th>
                                        <th class="th2" scope="col">상품이미지</th>
                                        <th scope="col">상품정보</th>
                                        <th class="th1" scope="col">수량</th>
                                        <th class="th2" scope="col">판매가</th>
<!--                                        <th class="th2" scope="col">적립금</th>-->
                                        <th class="th2" scope="col">합계</th>
                                    </tr>
                                    </thead>
                                    <tbody class="cart">

                                        <?php 
                                            for($i = 0 ; $i < sizeof($cart_array) ; $i++){?>
                                                <tr>
                                                    <td class="td_chk">
                                                        <label for="ct_chk_0" class="sound_only"><?php echo $cart_array[$i]['name'] ?></label>
                                                        <input type="checkbox" name="ct_chk[1]" value="<?php echo $cart_array[$i]['pro_id']?>" id="ct_chk_1" checked="checked">
                                                    </td>
                                                    <td class="sod_img">
                                                        <img src="<?php echo $cart_array[$i]['picture'] ?>" width="70" height="70" alt="">
                                                    </td>
                                                    <td class="sod_title">
                                                        <a href="detail.php?id=<?php echo $cart_array[$i]['pro_id']?>"><?php echo $cart_array[$i]['name']?><br>[옵션 : <span><?php echo $cart_array[$i]['option']?></span>]</a>
                                                    </td>
                                                    <td class="td_num"><input type="number" value="<?php 
                                                            if($user_id != ''){
                                                                echo $cart_array[$i]['count'];
                                                            }else {
                                                                echo $valueList[$i] -> cnt;
                                                            }
                                                        ?>" min="1" max="<?php $stock = $cart_array[$i]['stock']*1; echo $stock; ?>"require()></td>
                                                    <td class="td_price"><?php echo $cart_array[$i]['price'] ?></td>
<!--                                                    <td class="td_point">0</td>-->
                                                    <td class="td_sum">
                                                        <span id="sell_price_0">40000</span>
                                                    </td>
                                                </tr><?php
                                            }
                                        ?>
                                    </tbody>
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
                                            <td>4,000원</td>
                                            <td>4,000원</td>
                                        <td>8,000원</td>
                                    </tr>
                                </tbody>
                            </table>
                   
                    <div class="endbtn">
                        <button type="button" class="color" id="allbuy">전체상품주문</button>
                        <button type="button" class="color" id="checkedbuy">선택상품주문</button>
                        <button type="button" id="checkeddelete">선택삭제</button>
                    </div>
                                
                    </form>
                    <button class="shopping" onclick="location.href='index.php' ">쇼핑 계속하기</button>
                            <?php } ?>
                </div>
            </div>
		</section>
		<?php include "footer.html"; ?>
    </body>
</html>