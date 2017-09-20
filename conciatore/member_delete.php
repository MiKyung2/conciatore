<?php
session_start();
$mysqli = new mysqli('aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com', 'root', 'alruddl1', 'conciatore');
 
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
 
$id = $_GET['id'];
$pw = $_GET['pw'];

$login_user = $_SESSION['login_user'];
$sql = "delete from member where m_id = '$id' and m_pw = '$pw'; ";

if($mysqli->query($sql)){
   echo("<meta http-equiv='Refresh' content='1; URL=logout.php'>");
    echo "<script>alert(\"탈퇴되었습니다.\");</script>";
}else{
    echo 'fail to delete sql';
}

mysqli_close($mysqli);
?>