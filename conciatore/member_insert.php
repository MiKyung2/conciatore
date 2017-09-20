<?php


    $mysqli = new mysqli('aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com', 'root', 'alruddl1', 'conciatore');
 
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
 $mysqli->set_charset("utf8");
extract($_POST);

$address = $sample4_postcode.', '.$sample4_roadAddress.', '.$sample4_jibunAddress;

    if($phone == '' && $sample4_postcode){
        $sql = "insert into member (m_div, m_id, m_pw, m_name, m_email)";
    $sql = $sql. "values('member','$id','$excludeHangul','$name','$email')";
    }else if($phone == ''){
        $sql = "insert into member (m_div, m_id, m_pw, m_name, m_email, m_postcode, m_address1, m_address2)";
        $sql = $sql. "values('member','$id','$excludeHangul','$name','$email','$sample4_postcode','$sample4_roadAddress','$sample4_jibunAddress')";
    }else if($sample4_postcode == ''){
        $sql = "insert into member (m_div, m_id, m_pw, m_name, m_email, m_phone)";
        $sql = $sql. "values('member','$id','$excludeHangul','$name','$email','$phone')";
    }else {
        $sql = "insert into member (m_div, m_id, m_pw, m_name, m_email, m_phone, m_postcode, m_address1, m_address2)";
        $sql = $sql. "values('member','$id','$excludeHangul','$name','$email','$phone','$sample4_postcode','$sample4_roadAddress','$sample4_jibunAddress')";
    }
    
    if($mysqli->query($sql)){
       echo("<meta http-equiv='Refresh' content='1; URL=join_complete.php?id=$id&name=$name&email=$email'>");
    }else{
        echo("<meta http-equiv='Refresh' content='1; URL=join.php'>");
    }

    mysqli_close($mysqli);
?>