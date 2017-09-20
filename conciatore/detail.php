<!DOCTYPE html>
<html lang="ko">
	<head>
			<meta charset="utf-8">
			<title>제품 상세 페이지 > 콘치아토레</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
			<link rel="stylesheet" href="css/common.css">
			<link rel="stylesheet" href="css/sub.css">
            <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<!--[if lt IE 9]>
			<script type="text/javascript" src="js/html5.js"></script>
		<![endif]-->
		<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="js/common.js"></script>
		<script type="text/javascript" src="js/sub.js"></script>
        <?php 
            session_start(); 
            $user_id='';
            if(session_is_registered('login_user')){
                $user_id = $_SESSION['login_user'];
            }
            require 'JSON.php';
        ?>
        <?php 
            $proCnt = $_GET['id'];
            
            $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
            if(mysqli_connect_errno()) {
                echo "mysql 연결 실패 : "+mysqli_connect_error();
            }
            $conn->set_charset("utf8");
            $result = mysqli_query($conn, "select pro_name, pro_category, pro_price, pro_detail from product where pro_id = '$proCnt'");
            
            $product_array = array();
            $no = 1;
            while($row = mysqli_fetch_array($result)) {
                array_push($product_array, array('name' => $row['pro_name'],
                                                 'category' => $row['pro_category'],
                                                 'price' => $row['pro_price'],
                                                 'detail' => $row['pro_detail']));
                $no++;
            }
            mysqli_close($conn);
        ?>
        <?php 
            $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
            if(mysqli_connect_errno()) {
                echo "mysql 연결 실패 : "+mysqli_connect_error();
            }
        
            $result = mysqli_query($conn, "select pros_picture1, pros_picture2, pros_picture3, pros_color, pros_RGB, pros_stock from product_stock where pro_id = '$proCnt'");
            
            $product_stock_array = array();
            $no = 1;
            while($row = mysqli_fetch_array($result)) {
                array_push($product_stock_array, array('picture1' => $row['pros_picture1'],
                                                       'picture2' => $row['pros_picture2'],
                                                       'picture3' => $row['pros_picture3'],
                                                       'color' => $row['pros_color'],
                                                       'RGB' => $row['pros_RGB'],
                                                       'stock' => $row['pros_stock']));
                $no++;
            }
            mysqli_close($conn);
        ?>
        
        <script>
            $(document).ready(function() {
                //옵션이 추가되면 추가되는 값
                var optionArray = new Array();  
                var cntArray = new Array();
                
                //option color click -> picture change
                $('ul.dt_color li').click(function(){
                    var color = $(this).attr('title');
                    jQuery.ajax({
                               type:"POST",
                                url:"pic_find.php",
                                data:{
                                    color : color,
                                    pro_id : <?php echo $proCnt = $_GET['id'] ?>   
                                },
                                success:function(data){
                                    $('div#dt_view').html(data);
                                    $('#dt_view li a').on('click focus', function(){
                                            var imgSrc=$(this).find('img').attr('src');
                                            var imgAlt=$(this).find('img').attr('alt');
                                            $('#dt_view > img').attr('src', imgSrc).attr('alt', imgAlt);
                                    });
                                },
                                complete:function(data){
                                },
                                error:function(xhr, status, error){
                                    alert("에러발생");
                                }
                            }); 
                });
                    
                var modalLink = $(".modalLink");
                var modalLayer = $("#modalLayer");
                var modalCont = $(".modalContent");
                var marginLeft = modalCont.outerWidth()/2;
                var marginTop = modalCont.outerHeight()/2; 
                
                $cnt = 1;
                
                //option 추가
                $("#option").on('change', function() {
                    var select = $("#option option:selected").val();
                    var exist = false;
                    if(select == ''){
                       //아무것도 안한다
                    }else {
                        for (var i = 0 ; i < optionArray.length ; i++) {
                           if(optionArray[i] == select) {
                               alert('이미 선택되어 있는 옵션입니다.');
                               exist = true;
                           }
                        }
                        if(!exist) { //옵션에 같은 것이 없으면 추가
                            optionArray.push(select);
                            cntArray.push(1);
                            //input 추가
                            $('form#buy').prepend('<input type="hidden" value="'+cntArray[optionArray.length-1]+'" name="cnt[]">');
                            $('form#buy').prepend('<input type="hidden" value="'+optionArray[optionArray.length-1]+'" name="option[]">');
                            $('form#buy').prepend('<input type="hidden" value="<?php echo $proCnt ?>" name="pro_id[]">');
                            
                            
                            //ui 추가
                            $('ul#optionList li:nth-child(1)').clone().appendTo('ul#optionList');
                            $('ul#optionList li').eq($cnt).children('div.option_cnt').children('input').attr('value','1');
                            $('ul#optionList li').eq($cnt).children('div.option_cnt').children('input').attr('min','1');
                                
                            $('ul#optionList li').eq($cnt).children('div.option_name').children('span.addoption').append(select);
                            $cnt++;                            
                        }
                    }
                });
                            
                //max     
                $(document).on('change','#option', function(){
                    var len = $('ul#optionList li').length;
                    //max
                    jQuery.ajax({
                        type:"POST",
                        url:"cartproduct_stock_check.php",
                        data:{
                          //사용자 아이디, pros_id, cnt  
                            color: $('ul#optionList li').eq(len-1).children('div.option_name').children('span').text(),
                            pro_id: <?php echo $proCnt ?>    //int
                        },
                        success:function(data){
                            //data cnt 값
                            data *=1;
                            $('ul#optionList li').eq(len-1).children('div.option_cnt').children('input').attr('max',data);
                        }
                    });
                });
                    
                //수량 변경
                $(document).on('change','#optionList li div.option_cnt input', function() {
                    var index = $(this);
                    var changeCnt = $(this).val();
                    var color = $(this).parent().parent().children('div.option_name').children('span.addoption').text();
                    if(changeCnt == 0){ //수량이 0으로 입력되었을 때
                        alert('수량이 잘못 입력되었습니다.');
                        $(this).val(1);
                        return false;
                    }
                    //수량을 초과하여 입력하였을 경우
//                    jQuery.ajax({
//                        type:"POST",
//                        url:"cartproduct_stock_check.php",
//                        data:{
//                          //사용자 아이디, pros_id, cnt  
//                            color: color,
//                            pro_id: <?php echo $proCnt ?>    //int
//                        },
//                        success:function(data){
//                            //data cnt 값
//                            if(changeCnt > data) {
//                                alert('한정 수량을 초과하였습니다.');
//                                index.val(data);
//                            }
//                        }
//                    });
                    //제대로 된 값 입력
                    for (var i = 0 ; i < optionArray.length ; i++) {
                       if(optionArray[i] == color) {
                           cntArray[i] = changeCnt ;
                           
                           $("form#buy input").each(function(){
                               if($(this).attr('value') == color) {
                                   $(this).next().attr('value',changeCnt);
                               } 
                           });
                       }
                    }
                    
                    //ui 변경
                    var count = $(this).val(); 
                    var price = $("#optionList li:nth-child(1) div.option_price").text(); 
                    $(this).parent().parent().children("div.option_price").text(count*price);
                });
                    
                //엑스버튼
                $(document).on("click", "ul#optionList li div.close", function() {
                    $cnt--;
                    var color = $(this).parent().children('div.option_name').children('span.addoption').text();
                    for (var i = 0 ; i < optionArray.length ; i++) {
                       if(optionArray[i] == color) {
                           optionArray.splice(i, 1);
                           cntArray.splice(i, 1);
                       }
                    }
                    
                    $('form#buy input').each(function(){
                        if($(this).val() == color){
                            $(this).prev().remove();
                            $(this).next().remove();
                            $(this).remove();
                        }
                    });
                    
                    $(this).parent().remove();
                
                    //옵션값초기화
                    $("#option").val("").prop("selected", true);
                });

                modalLink.click(function(){
                    <?php if($user_id != ''){ ?>
                        jQuery.ajaxSettings.traditional = true;

                        jQuery.ajax({
                            type:"POST",
                            url:"cart_insert.php",
                            data:{
                              //사용자 아이디, pros_id, cnt  
                                color: JSON.stringify(optionArray),     //array
                                pro_id: <?php echo $proCnt ?>,    //int
                                cnt : JSON.stringify(cntArray)     //array
                            },
                            success:function(data){
                                if(data){
                                    modalLayer.fadeIn("slow");
                                    modalCont.css({"margin-top" : -marginTop, "margin-left" : -marginLeft});
                                    $(this).blur();
                                    $(".modalContent > a").focus(); 
                                    return false;
                                }else{
                                    alert('옵션을 선택하세요.');
                                }
                            }
                        });
                    <?php }else{ ?>
                        if(optionArray.length != 0){ //옵션o
                            var value = new Array();
                            var valueList = new Array();
                           
                            if(getCookie('cart_list') != ''){
                                //기존의 쿠키에 동일 제품있는 지 확인
                                valueList = JSON.parse(getCookie('cart_list'));
                                
                                var optionTemp = optionArray;
                                var cntTemp = cntArray;
                                for(var i = 0 ; i < valueList.length ; i++){
                                    for(var j = 0 ; j < optionArray.length ; j++){
                                        if(valueList[i]['color'] == optionArray[j] && valueList[i]['pro_id'] == <?php echo $proCnt ?> ){    // 동일 제품 있으면 업데이트
                                            valueList[i]['cnt'] = cntArray[j];
                                            optionTemp.splice(j,1);
                                            cntTemp.splice(j,1);
                                        }
                                    }
                                }
                            
                                for(var i = 0 ; i < optionTemp.length; i++){
                                    value = {
                                        pro_id : <?php echo $proCnt ?>,
                                        color : optionTemp[i],
                                        cnt : cntTemp[i]
                                    }
                                    valueList.push(value);
                                }
                                //cookie에 다시 저장
                                setCookie('cart_list',JSON.stringify(valueList),1);
                            }else{
                                //cookie가 없을 때 
                                for(var i = 0 ; i < optionArray.length; i++){
                                    value = {
                                        pro_id : <?php echo $proCnt ?>,
                                        color : optionArray[i],
                                        cnt : cntArray[i]
                                    }
                                    valueList.push(value);
                                }
                                setCookie('cart_list',JSON.stringify(valueList),1);
                            }
                            
                            modalLayer.fadeIn("slow");                       
                            modalCont.css({"margin-top" : -marginTop, "margin-left" : -marginLeft});                       $(this).blur();                        
                            $(".modalContent > a").focus();                         
                            return false;
                        }else { //옵션 x
                           alert('옵션을 선택해주세요.');
                        }
                        
                    <?php } ?> 
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
                
                $('p button.buy').click(function(){
                    <?php 
                        if($user_id == ''){?>
                            alert('회원만 주문가능합니다.');
                            location.href="login.php";
                            //옵션값초기화
                            $("#option").val("").prop("selected", true);
                        <?php }else {?>
                            if(optionArray.length != 0){   //옵션 선택o
                               $('#buy').submit();
                            }else { //옵션 선택x
                               alert('옵션을 선택하세요.');
                            }
                            
//                            location.href='orderpage.php';
                        <?php }
                    ?>
                });
            });
        </script>
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
				<h2 class="hid">제품 상세페이지</h2>
				<div class="dt_back">
				</div>
				<div id="dt_nav">		
					<ul id="dt_menu">
						<li><a href="index.php">Home</a></li>
						<li><a href="onlinestore.php?no=0&category=all">Online Store</a></li>
						<li><a href="onlinestore.php?no=0&category=<?php echo $product_array[0]['category'] ?>"><?php echo $product_array[0]['category'] ?></a></li>
					</ul>
				</div>
				<div id="dt_top_wrap" class="clear">
						<div id="dt_detail" class="clear">
							<h3><?php echo $product_array[0]['name'] ?></h3>
							<div class="line"></div>
							<p><?php echo $product_array[0]['detail'] ?></p>
							<p class="price">￦<?php echo $product_array[0]['price'] ?></p>
							<h4>SELECT OPTION</h4>
							<ul class="dt_color">
                                <?php for($cnt = 0 ; $cnt < count($product_stock_array) ; $cnt++){ ?>
                                    <li title="<?php echo $product_stock_array[$cnt]['color'] ?>"><a href="#none" style="background-color:<?php echo $product_stock_array[$cnt]['RGB'] ?>;"></a><span class="hid"><?php echo $product_stock_array[$cnt]['color'] ?></span></li>
                                <?php } ?>
							</ul>
                            
                            <select id="option" class="clear"  >
                                <option value="">[필수]옵션을 선택해 주세요</option>
                                <?php for($cnt = 0 ; $cnt < count($product_stock_array) ; $cnt++){ 
                                    if($product_stock_array[$cnt]['stock'] == 0){ ?>
                                    <option value="<?php echo $product_stock_array[$cnt]['color'] ?> "disabled="disabled"><?php echo $product_stock_array[$cnt]['color'] ?>-품절</option>
                                <?php }else { ?>
                                    <option value="<?php echo $product_stock_array[$cnt]['color'] ?>"> <?php echo $product_stock_array[$cnt]['color'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            
                            <ul id="optionList" class="clear">
                                <li class="clear">
                                    <div class="option_name"><?php echo $product_array[0]['name'] ?> <br>
                                         <span class="addoption"></span>
                                    </div>
                                    <div class="option_cnt"><input type="number"></div>
                                    <div class="option_price"><?php echo $product_array[0]['price'] ?></div>
                                    <div class="close"><img src="images/product/close_cursor_icon.png" width="10" height="10" alt="삭제"></div>
                                </li>
                            </ul>
                            <div id="modalLayer">
                              <div class="modalContent">
                                  <div class="top">
                                      장바구니에 담기
<!--                                      <button type="button">닫기</button>-->
                                  </div>
                                  <div class="content">
                                    <p>장바구니에 상품이 정상적으로 담겼습니다.</p>
                                    <button type="button" class="model_btn cart_btn" >장바구니로 이동</button>
                                    <button type="button" class="model_btn shop_btn">계속 쇼핑하기</button>
                                  </div>
                              </div>
                            </div>
                            <form method="post" action="orderpage.php?type=single" id="buy">
                                <p class="clear">
                                    <button type="button" class="buy">BUY</button>
                                    <a href="#modalLayer" class="modalLink">CART+</a>
                                </p>
                            </form>
							<p class="dt_share clear">Share this product<span class="f_r"><a href="#none"><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href="#none"><i class="fa fa-twitter" aria-hidden="true"></i></a> <a href="#none"><i class="fa fa-instagram" aria-hidden="true"></i></a></span></p>
							<ul id="dt_tab" class="p_r clear">
								<li><a href="#none">주의사항</a>
									<p class="p_a">가죽공방 콘치아토레는 <span>수작업 주문제작</span> 방식입니다.<br/>모든 상품은 주문 접수 후 바로 제작을 시작하기 때문에,<br/> 발송까지 <span>평균 일주일에서 길게는 4주정도</span> 소요됩니다.<br/>제품마다 제작 기간이 다르니 주문 전 반드시 확인해 주시기 바랍니다.</p>
								</li>
								<li><a href="#none">제작기간</a>
									<p class="p_a clear">
									지갑, 노트커버 등 소형제품은 제작에 <span>7일</span> 정도 걸리며,<br/>(몇몇 제외 제품은 상세페이지에 기재되어 있습니다)<br/>
									가방 제작은<span>3~4주</span> 정도 소요됩니다.<br/>
									※단, 각인 작업을 추가할 시, <span>1일</span>정도 더 걸립니다.
									</p>
								</li>
								<li><a href="#none">배송정보</a>
									<p class="p_a">우체국택배 상황에 따라 1~2일 정도 소요됩니다. (토,일,공휴일 휴무)<br/>주문 제작 방식이기 때문에 주문 후 제품을 받아 보실 때까지<br/> 시간이 다소 걸리는 점, 양해 부탁 드립니다.</p>
								</li>
								<li><a href="#none">교환 및 반품정보</a>
									<p class="p_a">배송일로부터 <span>7일 이내</span>에만 교환 및 환불이 가능합니다.<br/>단, 제품의 내용이 광고 내용과 다르거나 계약 내용이 다르게 이행된 경우,<br/> 배송일로부터 3개월 이내에 청약을 철회할 수 있습니다.<br/> 그러나, <span>소비자 책임으로 상품이 훼손된 경우</span> 혹은 <span><br/>시간이 너무 많이 지난 경우에는 교환 및 환불이 불가능합니다.</span>
									</p>
								</li>
							</ul>
						</div>
						<div id="dt_view">
							<img src="<?php echo $product_stock_array[0]['picture1'] ?>" width="720" height="580" alt="앞면">
							<ul>
								<li><a href="#none"><img src="<?php echo $product_stock_array[0]['picture1']?>" width="720" height="580" alt="제품1"></a></li>
								<li><a href="#none"><img src="<?php echo $product_stock_array[0]['picture2']?>" width="720" height="580" alt="제품2"></a></li>
								<li><a href="#none"><img src="<?php echo $product_stock_array[0]['picture3']?>" width="720" height="580" alt="제품3"></a></li>
							</ul>
						</div>
					</div>
					<hr class="clear"/>
				<div id="dt_back">
				</div>
				<div id="dt_rcm" >
				<h5>Recommend</h5>
					<ul>
						<li>
							<a href="#none"><img src="images/product/img1-1-10.jpg" width="720" height="580" alt=""></a>
							<h6><a href="#none">8 QUARTER BAG NO. I</a></h6>
							<p>￦450,000</p>
						</li>
						<li>
							<a href="#none"><img src="images/product/img1-1-4.jpg" width="720" height="580" alt=""></a>
							<h6><a href="#none">8 QUARTER BAG NO. III</a></h6>
							<p>￦650,000</p>
						</li>
						<li>
							<a href="#none"><img src="images/product/img1-1-29.jpg" width="720" height="580" alt=""></a><p></p>
							<h6><a href="#none">LEATHER SATCHEL NO. III</a></h6>
							<p>￦300,000</p>
						</li>
					</ul>
				</div>
			</section>
		<?php include "footer.html"; ?>
	</body>

</html>



