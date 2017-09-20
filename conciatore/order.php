<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>홈 > 주문 조회</title>
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
        <script>
//            $( function() {
//                $( "#datepicker" ).datepicker({
//                    showOn: "button",
//                    buttonImage: "images/order/calendar.gif",
//                    buttonImageOnly: true
//                });
//                $("#format").change(function() {
//	               $("#datepicker").datepicker( "option", "dateFormat", "ISO 8601 - yy-mm-dd");
//	           $( function() {
//    $( "#datepicker" ).datepicker();
//    $( "#format" ).on( "change", function() {
//      $( "#datepicker" ).datepicker( "option", "dateFormat", "ISO 8601 - yy-mm-dd" );
//    });
//  });
//            });
//});
//            });
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
                echo "<script>document.location.href='login.php';</script>"; 
            }else {
                include "header_login.html";
                $id = $_SESSION['login_user'];
            }
        
            $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
            if(mysqli_connect_errno()) {
                echo "mysql 연결 실패 : "+mysqli_connect_error();
            }
            $conn->set_charset("utf8");
        
            $result = mysqli_query($conn, "select product.pro_id as id, orderlist.o_no as no, o_date, pros_picture1, pro_name, product_stock.pros_color as color, od_count, od_count*pro_price as sumprice  from orderlist, order_detail, product, product_stock where orderlist.o_no = order_detail.o_no and product.pro_id = product_stock.pro_id and order_detail.pros_color = product_stock.pros_color and order_detail.pro_id = product_stock.pro_id and  orderlist.m_id ='$id' order by no desc");
            
            $product_order_array = array();
            $no = 1;
            while($row = mysqli_fetch_array($result)) {
                array_push($product_order_array, array('pro_id' => $row['id'],
                                                 'order_no' => $row['no'],
                                                 'order_date' => $row['o_date'],
                                                 'img' => $row['pros_picture1'],
                                                 'title' => $row['pro_name'],
                                                 'option' => $row['color'],
                                                 'order_cnt' => $row['od_count'],
                                                 'order_price' => $row['sumprice'],));
                $no++;
            }
        
            $result = mysqli_query($conn, "select count(*) as cnt from product, product_stock, orderlist, order_detail where product.pro_id = product_stock.pro_id and orderlist.o_no = order_detail.o_no and order_detail.pros_color = product_stock.pros_color and order_detail.pro_id = product_stock.pro_id and orderlist.m_id ='$id' group by orderlist.o_no desc;");
        
            $listcnt = array();
            $no = 1;
            while($row = mysqli_fetch_array($result)) {
                array_push($listcnt, array('cnt' => $row['cnt']));
                $no++;
            }
            mysqli_close($conn);
          ?>
		<section id="content">
            <div id="or_wrap" class="clear">
                <h2>ORDER</h2>
                
<!--
                <input type="text" id="datepicker">
                 ~ <input type="text" id="datepicker">
-->
                
                <h3>주문 상품 정보</h3>
                <p>기본적으로 최근 3개월간의 자료가 조회되며, 기간 검색시 지난 주문내역을 조회하실 수 있습니다.<br>주문번호를 클릭하시면 해당 주문에 대한 상세내역을 확인하실 수 있습니다.</p>
                
                <table>
                    <thead>
                        <tr>
                            <th class="date">주문일자<br>[주문번호]</th>
                            <th class="image">상품이미지</th>
                            <th class="product">상품정보</th>
                            <th class="cnt">수량</th>
                            <th class="price">상품구매금액</th>
                            <th class="state">주문처리상태</th>
                            <th class="cancel">취소/교환/반품</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($i = 0, $j = 0, $z = 0 ; $i < count($product_order_array); $i++ ) { ?>
                        <tr><?php 
                            if($j == 0){ ?> 
                                <td rowspan ="<?php echo $listcnt[$z]['cnt'] ?>"><?php echo $product_order_array[$i]['order_date'] ?><br>[<?php echo $product_order_array[$i]['order_no'] ?>]</td>
                                <?php
                             }
                            $j++;
                            if($j == $listcnt[$z]['cnt']){
                                $z++;
                                $j=0;
                            } ?>
                            <td><a href="detail.php?id=<?php echo $product_order_array[$i]['pro_id'] ?>"><img src= "<?php echo $product_order_array[$i]['img'] ?>" width="72"></a></td>
                            <td><a href="detail.php?id=<?php echo $product_order_array[$i]['pro_id'] ?>"><?php echo $product_order_array[$i]['title'] ?><br>[옵션 : <?php echo $product_order_array[$i]['option'] ?>]</a></td>
                            <td><?php echo $product_order_array[$i]['order_cnt'] ?></td>
                            <td><?php echo $product_order_array[$i]['order_price'] ?></td>
                            <td>배송완료</td>
                            <td>-</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!-- // wrap -->
		</section>

		<?php include "footer.html"; ?>
    </body>
</html>
