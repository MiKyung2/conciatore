<?php
    session_start();

    // 설정
    $uploads_dir = './uploads';
    $allowed_ext = array('jpg','jpeg','png','gif');


    // 변수 정리
    $error = $_FILES['myfile']['error'];
    $name = $_FILES['myfile']['name'];
    $ext = array_pop(explode('.', $name));

    if($name == ''){

    }else {
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
    }
    $mysqli = new mysqli('aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com', 'root', 'alruddl1', 'conciatore');
 
    $mysqli->set_charset("utf8");

    $no = $_POST['no'];
    $title = $_POST['bTitle'];
    $content = htmlspecialchars($_POST['bContent']);
    $date = date("Y-m-d H:m:s");
    $id = $_POST['writer'];
    $login_user = $_SESSION['login_user'];

    if($id == '관리자'){
        $sql = "select m_id from member where m_div ='admin' ";
        $result = mysqli_query($mysqli, $sql);
        $admin = array();
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $admin.push($row["m_id"]);
            }
        }
        
        for($i = 0 ; $i < sizeof($admin); $i++){
            if($admin[$i] == $login_user){
                if(!isset($name)){
                    $sql = "update board set b_title = '$title', b_content = '$content', b_date = '$date', b_writer = '관리자' where b_no='$no' ";
                    return true;
                }else{
                    $sql = "update board set b_title = '$title', b_content = '$content', b_picture = '$uploads_dir/$name', b_date = '$date', b_writer = '관리자' where b_no='$no' ";
                    // 파일 이동
                    move_uploaded_file( $_FILES['myfile']['tmp_name'], "$uploads_dir/$name");
                    return true;
                }
            }
        }
    }else {
        if(!isset($name)){
            $sql = "update board set b_title = '$title', b_content = '$content', b_date = '$date', b_writer = '$id' where b_no='$no' and b_writer = '$login_user' ";
        }else{
            $sql = "update board set b_title = '$title', b_content = '$content', b_picture = '$uploads_dir/$name', b_date = '$date', b_writer = '$id' where b_no='$no' and b_writer = '$login_user' ";
            // 파일 이동
            move_uploaded_file( $_FILES['myfile']['tmp_name'], "$uploads_dir/$name");
        }
    }
    

    

    if($mysqli->query($sql)){
       echo "<script>alert(\"게시글이 수정되었습니다.\");</script>";
       echo("<meta http-equiv='Refresh' content='1; URL=read.php?no=$no'>");
    }else{
        echo "<script>alert(\"접근 불가능한 페이지입니다.\");</script>";
        echo("<meta http-equiv='Refresh' content='1; URL=QnA.php?page=1'>");
    }
    mysqli_close($mysqli);
?>
