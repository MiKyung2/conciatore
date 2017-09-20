<?php
    session_start();
    $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
 
    $name = $_GET['name'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    $address1 = $_GET['address1'];
    $address2 = $_GET['address2'];
    $address3 = $_GET['address3'];

    $login_user = $_SESSION['login_user'];

    $address = $address1.', '.$address2.', '.$address3;

    if($phone == '' && $address1){
        $sql = "update member set m_name = '$name', m_email = '$email' where m_id='$login_user' ";
    }else if($phone == ''){
        $sql = "update member set m_name = '$name', m_email = '$email', m_address = '$address' where m_id='$login_user' ";
    }else if($address1 == ''){
        $sql = "update member set m_name = '$name', m_email = '$email', m_phone = '$phone' where m_id='$login_user' ";
    }else {
        $sql = "update member set m_name = '$name', m_email = '$email', m_phone = '$phone', m_address = '$address' where m_id='$login_user'";
    }
    
    if($conn->query($sql)){
       echo("<meta http-equiv='Refresh' content='1; URL=myinfo.php'>");
    }else{
        echo 'fail to insert sql';
    }
    mysqli_close($conn);
?>