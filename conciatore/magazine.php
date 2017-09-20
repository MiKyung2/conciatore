<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title>매거진 > 콘치아토레</title>
        <meta name="description" content="">
        <!--[if lt IE 9]>
         <script type="text/javascript" src="js/html5.js"></script>
         <script type="text/javascript" src="js/respond.min.js"></script>
      <![endif]-->
        <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="js/common.js"></script>
        <script type="text/javascript" src="js/sub.js"></script>
        <link rel="stylesheet" href="css/common.css" />
        <link rel="stylesheet" href="css/sub.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        
        
    </head>
    
    <body id="mOver">
       <?php include "skip.html"; ?>
       <?php
            include('config.php');
            session_start();
            if(!isset($_SESSION['login_user'])) {
                include "header.html";
            }else {
                include "header_login.html";
            }
          ?>
        <section id="content">
        <div id="container" class="clear">
            <div id="m_main" class="p_r">
                <img class="m_img" src="images/magazine/m_m.jpg" width="1920" height="716" alt="">
                <h2 class="m_minner p_a">magazine</h2>
            </div>
            <div class="m_content1">
                <!-- 모달 페이지 -->
                <div class="m_layerPopup1">
                    
                    <a class="m_target" href="#">
                        <img class="m_img" src="images/magazine/m_d_icon.png" width="36" height="36" alt="가방 상세 바로가기">
                    </a>
                    <a class="m_close" href="#">
                        <img class="m_img" src="images/magazine/close_icon.png" width="36" alt="닫기">
                    </a>
                    <div class="m_ani">
                        <div class="m_line"></div>
                        <p class="m_bag">bag</p>
                    </div>
                </div>
                <!-- //모달 페이지 끝 -->
                
                <!--  모달 페이지2  -->
                <div class="m_layerMask2">
                   <a class="m_close" href="#"><img src="images/magazine/close_icon.png" width="36" alt="닫기"></a>
                </div>
                <div class="m_layerPopup2">
                    <img class="m_img" src="images/magazine/m_d_c1.jpg" width="1213" height="941" alt="가방 상세 첫번째"> 
                </div>
                <div class="m_layerPopup2_2 clear">
                    <img class="m_img" src="images/magazine/m_d_c2.jpg" width="513" height="342" alt="가방 상세 두번째">
                    <img class="m_img" src="images/magazine/m_d_c3.jpg" width="513" height="342" alt="가방 상세 세번째">
                    
                </div>
                <!-- //모달 페이지2 끝 -->
                
                
                
                <a href="#" class="m_img_s1 f_l"><img class="m_img" src="images/magazine/m_p/m_02_img_1.JPG" width="640" height="545" alt=""><span class="hid">다재다능한 바이커스 백</span></a>
                <a href="#" class="m_img_s2 f_l"><img class="m_img" src="images/magazine/m_c_02.jpg" width="1280" height="545" alt=""><span class="hid">펜 좀 쓰는 사람들을 위한 펜 파우치</span></a>
            </div>
            <div class="m_content2">
                <div class="m_img_s2 clear f_l">
                    <a href="#" class="m_img_100 f_l"><img class="m_img" src="images/magazine/m_c_03.jpg" width="1280" height="545" alt="" /><span class="hid">미네르바 만다린 에이징</span></a>
                    <a href="#" class="m_img_50 f_l"><img class="m_img" src="images/magazine/m_c_05.jpg" width="640" height="545" alt=""><span class="hid">표지를 가려주는 프라이빗 북커버</span></a>
                    <a href="#" class="m_img_50 f_l"><img class="m_img" src="images/magazine/m_c_06.jpg" width="640" height="545" alt=""><span class="hid">게으름 예찬</span></a>
                    
                </div>
                 <a href="#" class="m_img_s1 f_l"><img class="m_img" src="images/magazine/m_c_04.jpg" width="640" height="1090" alt=""><span class="hid">어른이 되면</span></a>
            </div>
            <div class="m_content2 f_l">
                <a href="#" class="m_img_s1 f_l"><img class="m_img" src="images/magazine/m_c_07.jpg" width="640" height="1090" alt=""><span class="hid">송곳 같은 젠틀맨을 위한 브리프케이스</span></a>
                <div>
                    <a href="#" class="m_img_s2 f_l"><img class="m_img" src="images/magazine/m_c_08.jpg" width="1280" height="545" alt=""><span class="hid">벤티사이즈급 배려심, 데일리토트백</span></a>
                    <a href="#" class="m_img_s2 f_l"><img class="m_img" src="images/magazine/m_c_09.jpg" width="1280" height="545" alt=""><span class="hid">저 바다에 편지를 띄워보아요</span></a>
                </div>
            </div>
        </div>
        </section>
        <?php include "footer.html"; ?>
    </body>
</html>