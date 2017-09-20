<?php
$servername = "aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com";
$username = "root";
$password = "alruddl1";
$dbname = "conciatore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$color = $_POST['color'];
$pro_id = $_POST['pro_id'];

$sql = "select pros_stock from product, product_stock where pros_color ='$color' and product.pro_id=$pro_id and product.pro_id = product_stock.pro_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["pros_stock"];
    }
} else {
    echo "0";
}
$conn->close();
?>

 