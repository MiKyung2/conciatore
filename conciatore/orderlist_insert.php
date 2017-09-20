<?php 
session_start();
$conn = new mysqli('aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com', 'root', 'alruddl1', 'conciatore');

if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
$conn->set_charset("utf8");

$m_id = $_SESSION['login_user'];

//칼럼 수 구하기
$sql = "select count(*)  as allcnt from orderlist ";
$result = mysqli_query($conn,$sql);
$no = 0;
if($row = mysqli_fetch_array($result)) {
   $no = $row['allcnt'];
}

$o_date = date("Y-m-d H:i:s");
$o_no = date("Ymd")."-".($no+1);

$color = $_POST['color'];
$pro_id = $_POST['pro_id'];
$cnt = $_POST['cnt'];

$sumprice = $_POST['ressum'];
$receiver = $_POST['receiver'];
$postcode = $_POST['sample4_postcode'];
$address1 = $_POST['sample4_roadAddress'];
$address2 = $_POST['sample4_jibunAddress'];

$sql = "insert into orderlist (o_no, o_date, m_id) values ('$o_no', '$o_date', '$m_id')";

if($conn->query($sql)){
    for($i = 0 ; $i < count($color) ; $i++){
        $sql = "insert into order_detail (o_no, pros_color, pro_id, od_count) values ('$o_no', '$color[$i]', '$pro_id[$i]','$cnt[$i]')";
        
        if($conn->query($sql)){
            //결제 완료 확인 창으로 이동
             $sql = "update product_stock set pros_stock = pros_stock-'$cnt[$i]' where pro_id =$pro_id[$i] and pros_color = '$color[$i]' ";
             
             if($conn->query($sql)){
                 echo("<meta http-equiv='Refresh' content='1; URL=order_complete.php?no=$o_no&name=$receiver&price=$sumprice&post=$postcode&add=$address1&add2=$address2'>");
             }else {
                 echo 'product_stock false';
             }
        }else{
            echo 'order_detail false';
        }
    }
}else {
    echo 'orderlist false';
}

mysqli_close($conn);
?>