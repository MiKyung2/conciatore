<?
session_start();
<?php
 
// 설정
$uploads_dir = './uploads';
$allowed_ext = array('jpg','jpeg','png','gif');
 
// 변수 정리
$error = $_FILES['myfile']['error'];
$name = $_FILES['myfile']['name'];
$ext = array_pop(explode('.', $name));
 
// 오류 확인
if( $error != UPLOAD_ERR_OK ) {
	switch( $error ) {
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			echo "파일이 너무 큽니다. ($error)";
			break;
		case UPLOAD_ERR_NO_FILE:
			echo "파일이 첨부되지 않았습니다. ($error)";
			break;
		default:
			echo "파일이 제대로 업로드되지 않았습니다. ($error)";
	}
	exit;
}
 
// 확장자 확인
if( !in_array($ext, $allowed_ext) ) {
	echo "허용되지 않는 확장자입니다.";
	exit;
}
 
// 파일 이동
move_uploaded_file( $_FILES['myfile']['tmp_name'], "$uploads_dir/$name");

// 파일 정보 출력
//echo "<h2>파일 정보</h2>
//	<ul>
//		<li>파일명: $name</li>
//		<li>확장자: $ext</li>
//		<li>파일형식: {$_FILES['myfile']['type']}</li>
//		<li>파일크기: {$_FILES['myfile']['size']} 바이트</li>
//	</ul>";

/* DB저장 */
    $mysqli = new mysqli('aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com', 'root', 'alruddl1', 'conciatore');

    if (mysqli_connect_error()) {
        exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    }
    $mysqli->set_charset("utf8");

    $title = $_POST['bTitle'];
    $content = htmlspecialchars($_POST['bContent']);
    $date = date("Y-m-d H:i:s");
    $writer = $_SESSION['login_user'];

    if(!isset($name)){
        $sql = "insert into board (b_title, b_content, b_date, b_writer)";
        $sql = $sql. "values('$title','$content','$date','$writer')";
    }else{
        $sql = "insert into board (b_title, b_content, b_picture, b_date, b_writer)";
        $sql = $sql. "values('$title','$content','$uploads_dir/$name','$date','$writer')";
    }

    if($mysqli->query($sql)){
       echo "<meta http-equiv='Refresh' content='1; URL=QnA.php'>";
    }else{
        echo "<meta http-equiv='Refresh' content='1; URL=write.php'>";
    }
    mysqli_close($mysqli);
?>