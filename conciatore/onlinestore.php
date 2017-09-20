<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>온라인스토어 :  가죽공방 콘치아토레</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/sub.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="js/common.js"></script>
        <script type="text/javascript" src="js/sub.js"></script>

    </head>
    <body>
        <?php include 'skip.html';?>
        <?php
            include('config.php');
            session_start();
            if(session_is_registered('login_user')){
                $user_id = $_SESSION['login_user'];
            }else{
                $user_id='';
            }
            if($user_id =='') {
                include "header.html";
            }else {
                include "header_login.html";
            }
            $proCat = $_GET['category'];
        
            $conn = new mysqli('aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com', 'root', 'alruddl1', 'conciatore');
            if(mysqli_connect_errno()) {
                echo "mysql 연결 실패 : "+mysqli_connect_error();
            }
            $conn->set_charset("utf8");
            //총 데이터의 수
            if($proCat == 'all') {
                $data = mysqli_query($conn,'select pro_id from product order by pro_id desc ');
            }else {
                $data = mysqli_query($conn,"select pro_id from product where pro_category ='$proCat' order by pro_id desc");
            }
            
            $num = mysqli_num_rows($data);
            
            
            
            //페이지 당 데이터 수 / 블록 당 페이지 수
            $list = 6;
            $block = 3;
            
            $pageNum = ceil($num/$list); //총 페이지
            if($_GET['no'] > $pageNum){
                $page = $pageNum;
            }else if($_GET['no'] <= 0){
                $page = 1;
            }else {
                $page = $_GET['no'];
            }
            $blockNum = ceil($pageNum/$block);  //총 블록
            $nowBlock = ceil($page/$block); //현재 페이지가 위치한 블록
    
            //블록 당 시작 페이지
            $s_page = ($nowBlock*$block) - ($block -1);
            if($s_page <= 1) {
                $s_page = 1;
            }
            //블록 당 종료 페이지
            $e_page = $nowBlock*$block;
            if($pageNum <= $e_page) {
                $e_page = $pageNum;
            }            
            
            mysqli_close($conn);
        ?>
        <section id="content">
        <div id="s_promotion" class="p_r">
            <div class="s_head_wrap">
            <h2 class="header p_a">3414<br/>Breast Bag<br/>Double Bill Minerva</h2>
            <p class="content p_a">가죽 두께를 그대로 살려 내구성이 탁월하고<br/>천연 가죽 특유의 멋스러움과 따뜻한 느낌이 매력적인<br/>브레스트 백 더블빌 입니다.
            </p>
            <a href="#none" class="a p_a">Detail <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            </div>
        </div>
        
        <div id="s_nav">
            
            <a href="onlinestore_write.php" class="product_add">상품추가</a>
             
            <?php 
                if($user_id != '') {
                    $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
                    if(mysqli_connect_errno()) {
                        echo "mysql 연결 실패 : "+mysqli_connect_error();
                    }

                    //관리자인지 확인
                    $sql= "select * from member where m_id = '$user_id' and m_div = 'admin' ;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo "<script>$('a.product_add').css('display','block');</script>";
                    }else {
                         echo "<script>$('a.product_add').css('display','none');</script>";
                    }

                    mysqli_close($conn);
                }else {
                    echo "<script>$('a.product_add').css('display','none');</script>";
                }
            ?>
             
            
            <ul>
            <?php 
                if($_GET['category'] == 'all') {
                    ?>
                    <li><a href="onlinestore.php?category=all&no=<?php echo $page ?>"><img src="images/onlinestore/s_icon_all_on.gif" alt="모든카데고리" /><br><span>ALL</span></a></li>
                    <?php
                }else {
                   ?> 
                    <li><a href="onlinestore.php?category=all&no=<?php echo $page ?>"><img src="images/onlinestore/s_icon_all.gif" alt="모든카데고리" /><br><span>ALL</span></a></li>
                    <?php
                }
                if($_GET['category'] == 'bag') {
                    ?>
                    <li><a href="onlinestore.php?category=bag&no=<?php echo $page ?>"><img src="images/onlinestore/s_icon_bag_on.gif" alt="가방" /><br><span>BAG</span></a></li>
                    <?php
                }else {
                   ?> 
                    <li><a href="onlinestore.php?category=bag&no=<?php echo $page ?>"><img src="images/onlinestore/s_icon_bag.gif" alt="가방" /><br><span>BAG</span></a></li>
                    <?php
                }
                if($_GET['category'] == 'wallet') {
                    ?>
                    <li><a href="onlinestore.php?category=wallet&no=<?php echo $page ?>"><img src="images/onlinestore/s_icon_wallet_on.gif" alt="지갑" /><br><span>WALLET</span></a></li>
                    <?php
                }else {
                   ?> 
                    <li><a href="onlinestore.php?category=wallet&no=<?php echo $page ?>"><img src="images/onlinestore/s_icon_wallet.gif" alt="지갑" /><br><span>WALLET</span></a></li>
                    <?php
                }
                if($_GET['category'] == 'phone') {
                    ?>
                    <li><a href="onlinestore.php?category=phone&no=<?php echo $page ?>"><img src="images/onlinestore/s_icon_phone_on.gif" alt="폰케이스" /><br><span>PHONE</span></a></li>
                    <?php
                }else {
                   ?> 
                    <li><a href="onlinestore.php?category=phone&no=<?php echo $page ?>"><img src="images/onlinestore/s_icon_phone.gif" alt="폰케이스" /><br><span>PHONE</span></a></li>
                    <?php
                }
                if($_GET['category'] == 'acc') {
                    ?>
                    <li><a href="onlinestore.php?category=acc&no=<?php echo $page ?>"><img src="images/onlinestore/s_icon_accessory_on.gif" alt="악세사리" /><br><span>ACC</span></a></li>
                    <?php
                }else {
                   ?> 
                    <li><a href="onlinestore.php?category=acc&no=<?php echo $page ?>"><img src="images/onlinestore/s_icon_accessory.gif" alt="악세사리" /><br><span>ACC</span></a></li>
                    <?php
                }
                if($_GET['category'] == 'stationery') {
                    ?>
                    <li><a href="onlinestore.php?category=stationery&no=<?php echo $page ?>"><img src="images/onlinestore/s_icon_stationery_on.gif" alt="문구" /><br><span>STATIONERY</span></a></li>
                    <?php
                }else {
                   ?> 
                    <li><a href="onlinestore.php?category=stationery&no=<?php echo  $page ?>"><img src="images/onlinestore/s_icon_stationery.gif" alt="문구" /><br><span>STATIONERY</span></a></li>
                    <?php
                }   
                ?>
            </ul>
        </div>
        <?php
            $s_point = ($page-1) * $list;

            $conn = mysqli_connect("aaykgs1lzgdigw.ccwuifg1vllr.ap-northeast-2.rds.amazonaws.com","root","alruddl1","conciatore");
            if(mysqli_connect_errno()) {
                echo "mysql 연결 실패 : "+mysqli_connect_error();
            }
            $conn->set_charset("utf8");
            
            if($proCat == 'all') {
                $real_data = mysqli_query($conn, "select product.pro_id, pros_picture1, pro_name, pro_price, pro_category, sum(pros_stock) from product, product_stock where product_stock.pro_id = product.pro_id group by pro_name order by case when sum(pros_stock)=0 then -1 end, product.pro_id desc LIMIT $s_point,$list ;");
            }else {
               $real_data = mysqli_query($conn, "select product.pro_id, pros_picture1, pro_name, pro_price, pro_category, sum(pros_stock) from product, product_stock where product_stock.pro_id = product.pro_id and pro_category ='$proCat' group by pro_name ORDER BY case when sum(pros_stock)=0 then -1 end, pro_id desc limit $s_point,$list;"); 
            }
            
            mysqli_close($conn);
            ?>
            
            <div id="s_list">
                <ul>
                    <?php for ($i=1; $i<=$num; $i++) { 
                        $fetch = mysqli_fetch_array($real_data);
                        if ($fetch == false) {
                            break;
                        }
                    ?>
                    <li>
                        <a href="detail.php?id=<?php echo $fetch['pro_id'] ?>">
                            <img src="<?php echo $fetch['pros_picture1'] ?>" alt="">

                            <div class="s_list_t">
                                <?php echo $fetch['pro_name']?><br/>
                                <span><?php if($fetch['sum(pros_stock)'] != 0){?>
                                        ￦<?php echo $fetch['pro_price']?><?php
                                        } else {?>
                                            품절 <?php
                                        } ?>
                                </span>
                            </div>
                        </a>
                    </li>
                    <?php
                    }
                ?>
                </ul>
            </div>
            
            <ul id="s_listnum2">
                <li><a href="onlinestore.php?category=<?php echo $proCat?>&no=<?php echo 1 ?>">〈〈</a></li>
                <li><a href="onlinestore.php?category=<?php echo $proCat?>&no=<?php echo $page-5 ?>">〈</a></li>
                <?php 
                    for ($p=$s_page; $p<=$e_page; $p++) {?>
                    <li>
                        <a <?php if($p == $page) {?> style="color:black" <?php } ?> href="onlinestore.php?category=<?php echo $proCat?>&no=<?php echo $p ?>" ><?php echo $p ?></a>
                    </li><?php
                    }
                ?>
                <li><a href="onlinestore.php?category=<?php echo $proCat?>&no=<?php echo $page+5 ?>">〉</a></li>
                <li><a href="onlinestore.php?category=<?php echo $proCat?>&no=<?php echo $pageNum ?>">〉〉</a></li>
            </ul>
        </section>
        <?php include 'footer.html';?>
    </body>
</html>
