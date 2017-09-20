<?php
session_start();
$conn = new mysqli('aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com', 'root', 'alruddl1', 'conciatore');
 
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
 
$no = $_POST['b_no'];
$family = $_POST['b_family'];
$login_user = $_SESSION['login_user'];

$sql = " select b_no from board where b_orderby = 0 and b_no=$no ";
   
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //qna
    $sql = "delete from board where b_family = '$family' and b_writer = '$login_user' ";
    
    if($conn->query($sql)){
        echo "<script>alert(\"답변과 함께 게시글이 삭제되었습니다.\");</script>";
        echo("<meta http-equiv='Refresh' content='1; URL=QnA.php?page=1'>");
    }else{
        echo "<script>alert(\"접근 불가능한 페이지입니다.\");</script>";
        echo("<meta http-equiv='Refresh' content='1; URL=QnA.php?page=1'>");
    }
    
} else {
    //reply
    $sql = "delete from board where b_no = '$no' and b_writer = '$login_user' ";
    
    if($conn->query($sql)){
        echo "<script>alert(\"게시글이 삭제되었습니다.\");</script>";
        echo("<meta http-equiv='Refresh' content='1; URL=QnA.php?page=1'>");
    }else{
        echo "<script>alert(\"접근 불가능한 페이지입니다.\");</script>";
        echo("<meta http-equiv='Refresh' content='1; URL=QnA.php?page=1'>");
    }
}

mysqli_close($conn);
?>