<?php
session_start();
$mysqli = new mysqli('aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com', 'root', 'alruddl1', 'conciatore');
 
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

$pro_id = $_POST['pro_id'];
$pros_color = $_POST['pros_color'];

$sql = "delete from cart where pro_id = $pro_id and pros_color = '$pros_color'; ";

if($mysqli->query($sql)){
   echo $pros_color;
}else{
    echo 'false';
}

mysqli_close($mysqli);
?>