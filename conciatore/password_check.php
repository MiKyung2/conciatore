<?php
session_start();
$conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
if(mysqli_connect_errno()) {
    echo "mysql 연결 실패 : "+mysqli_connect_error();
}

$login_user = $_SESSION['login_user'];
$pwch = mysqli_real_escape_string($conn, $_POST['pw']);

$sql = "select * from member where m_id = '$login_user' and m_pw = '$pwch' ;";

$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

if($count == 0 ){
    echo 'false';
}else {
    echo 'true';
}

mysqli_close($conn);
?>