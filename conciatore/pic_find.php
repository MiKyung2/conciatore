<?php
$conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
if(mysqli_connect_errno()) {
    echo "mysql 연결 실패 : "+mysqli_connect_error();
}
$color = $_POST['color'];
$pro_id = $_POST['pro_id'];

$sql = "select pros_picture1, pros_picture2, pros_picture3 from product_stock where pros_color = '$color' and pro_id = '$pro_id' ;";

$result = mysqli_query($conn, $sql);

$no = 1;
while($row = mysqli_fetch_array($result)){
    echo "<img src = '".$row['pros_picture1']."' width='720' height='580' alt='앞면'>";
    echo "<ul>";
    echo "<li><a href='#none'><img src='".$row['pros_picture1']."' width='720' height='580' alt='제품1'></a></li>";
    echo "<li><a href='#none'><img src='".$row['pros_picture2']."' width='720' height='580' alt='제품2'></a></li>";
    echo "<li><a href='#none'><img src='".$row['pros_picture3']."' width='720' height='580' alt='제품3'></a></li>";
    echo "</ul>";
    $no++;
}


mysqli_close($conn);
?>