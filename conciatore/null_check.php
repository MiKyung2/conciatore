<?php
$id = $_POST['id'];

if(empty($id)) {
    echo "필수로 작성해야 하는 항목입니다.";
    exit;
}
if(preg_match("/[^a-z0-9-_]/i", $id)) {
    echo "아이디는 영문, 숫자, -, _ 만 사용할 수 있습니다.";
    exit;
}else {
    echo "사용가능한 아이디입니다.";
}



?>