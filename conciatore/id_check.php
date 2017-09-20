<?php
$conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
if(mysqli_connect_errno()) {
    echo "mysql 연결 실패 : "+mysqli_connect_error();
}
$idch = mysqli_real_escape_string($conn, $_POST['id']);

$sql = "select m_id from member where m_id = '$idch';";

$result = mysqli_query($conn, $sql);

$count = mysqli_num_rows($result);

if($idch == '') {
    echo '필수로 작성해야 하는 항목입니다.';
}else {
    if($count == 0 ){
        echo '사용가능한 아이디입니다.';
    }else {
        echo '아이디가 존재합니다.';
    }
}

mysqli_close($conn);
?>