<?php
//session_start();

$conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
if(mysqli_connect_errno()) {
    echo "mysql 연결 실패 : "+mysqli_connect_error();
}

$user_id = $_SESSION['login_user'];
$color = $_POST['color'];
$pro_id = $_POST['pro_id'];

$sql = "select * from cart where m_id ='$user_id' and pros_color = '$color' and pro_id = '$pro_id';";

$result = mysqli_query($conn, $sql);

$count = mysqli_num_rows($result);

if($user_id == ''){
    echo = "로그인해주세요";
}else{
    if($count == 0 ){
        echo 'false';
    }else {
        echo 'true';
    }
}



mysqli_close($conn);
?>