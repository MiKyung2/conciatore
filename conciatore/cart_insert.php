<?php 
session_start();
$conn = new mysqli('aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com', 'root', 'alruddl1', 'conciatore');

if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

require 'JSON.php';

// Services_JSON 인스턴스 생성
$json = new Services_JSON();

$user_id = $_SESSION['login_user'];
$color = $json->decode($_POST['color']);
$pro_id = $json->decode($_POST['pro_id']);
$cnt = $json->decode($_POST['cnt']);


//있나 없나 확인 cart_check.php
for( $i = 0 ; $i < sizeof($color) ; $i++){
    $sql = "select * from cart where m_id ='$user_id' and pros_color = '$color[$i]' and pro_id = '$pro_id';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //있어서 update
        $sql = "update cart set c_count = $cnt[$i] where m_id='$user_id' and pro_id = $pro_id and pros_color = '$color[$i]' ";
        
        if($conn->query($sql)){
           echo 'true';
        }else{
            echo 'false';
        }
    } else {
        //없어서 insert
        $sql =  "insert into cart (m_id, pros_color, pro_id, c_count) values ('$user_id','$color[$i]', $pro_id, $cnt[$i])";
        
        if($conn->query($sql)){
           echo 'true';
        }else{
            echo 'false';
        }
    }
}

mysqli_close($conn);
?>