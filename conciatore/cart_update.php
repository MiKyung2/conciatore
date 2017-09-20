<?php
    session_start();

    $mysqli = new mysqli('aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com', 'root', 'alruddl1', 'conciatore');
 
    $mysqli->set_charset("utf8");

    $m_id = $_POST['m_id'];
    $pro_id = $_POST['pro_id'];
    $color = $_POST['color'];
    $cnt = $_POST['cnt'];

    if(!isset($name)){
        $sql = "update cart set c_count = '$cnt' where m_id='$m_id' and pro_id = '$pro_id' and pros_color = '$color' ";
    }

    if($mysqli->query($sql)){
        echo 'true';
    }else{
        echo 'false';
    }
    mysqli_close($mysqli);
?>
