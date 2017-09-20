<?php
            
    $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
    if(mysqli_connect_errno()){
        echo "mysql 연결 실패 : "+mysqli_connect_error();
    }

    $id=$_POST['id']; 
    $pw=$_POST['pw']; 

    $sql="select m_id from member where m_id='$id' and m_pw='$pw'";
    $result=mysqli_query($conn,$sql);

    $count=mysqli_fetch_array($result);

    if(count($count) != 0){
        session_register("id");
        $_SESSION['login_user']=$id;
        echo 'true'; 
    }else{
        echo 'false';
    }
    mysqli_free_result($result);
    
?>