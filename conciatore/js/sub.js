gMenuH = '1071px';
//------------------------온라인스토어
$(document).ready(function() {

});
// s_list li a:focus
//------------------------온라인스토어상세
$(document).ready(function(){
	$('#dt_tab li a').on('click focus',function(){
			$('#dt_tab li a').css('border','1px solid #000').css('color', '#333').css('background', 'none');
			$('#dt_tab li').find('p').css('visibility', 'hidden');
			$(this).css('border','1px solid #26df9f').css('background','#26df9f').css('color','#fff');
			$(this).parent().find('p').css('visibility', 'visible');
	});
	$('#dt_tab li a:first').click();
    
    //아래 사진 누르면 큰사진으로
	$('#dt_view li a').on('click focus', function(){
			var imgSrc=$(this).find('img').attr('src');
			var imgAlt=$(this).find('img').attr('alt');
			$('#dt_view > img').attr('src', imgSrc).attr('alt', imgAlt);
	});
    
    /* 모달 */
    var modalLayer = $("#modalLayer");
    var modalLink = $(".modalLink");
    var modalCont = $(".modalContent");
    var marginLeft = modalCont.outerWidth()/2;
    var marginTop = modalCont.outerHeight()/2; 

    $(".modalContent .top > button").click(function(){
        modalLayer.fadeOut("slow");
        modalLink.focus();
    });	
    
    //장바구니로 이동
    $(".modalContent .content > button.cart_btn").click(function(){
    location.href="cart.php";

  });	
    //계속 쇼핑하기
    $(".modalContent .content > button.shop_btn").click(function(){
    modalLayer.fadeOut("slow");
    modalLink.focus();
  });	
});
//------------------------공방소개
$(document).ready(function(){

	$(window).on("scroll", fadeInUp);

		function fadeInUp () {
		var $b_brandImg=$("#b_brandImg li img");
		var scrollPos=$(window).scrollTop();

		$b_brandImg.each(function  () {
			if (scrollPos > $(this).offset().top-180) 
				$(this).next().css('opacity', '1.0').css('right','0px');	
		});
		}
		$('#b_brandImg li').on('focus',function(){
				$(this).find('p').css('opacity', '1.0').css('right','0px');
		});
});
//------------------------가죽소개
//------------------------클래스
$(document).ready(function(){

	$('.cl_div').on('mouseover focus', function(){
			$('h1').css('top', '50%').css('color','#fff');
			$('.cl_div').not(this).css('width', '25%');
			$('div.cl_wrap').addClass('hid');
			$(this).css('width','50%');
			$(this).find('h1').css('top', '25%').css('color','#21df9f');
			$(this).find('div.cl_wrap').removeClass('hid');
	});
	
});
//------------------------클래스상세
$(document).ready(function(){

	$(window).on("scroll", fadeInUp);

	function fadeInUp () {
		var $cls_brand=$("#cls_brand");
		var $cls_notice=$("#cls_notice");
		var scrollPos=$(window).scrollTop();

		$cls_brand.each(function  () {
			if (scrollPos > $(this).offset().top-400) $(this).mouseover();
		});
		$cls_notice.each(function  () {
			if (scrollPos > $(this).offset().top-600) $(this).mouseover();
		});
	}

	$('#cls_brand').one('mouseover focus',function(){
			$('div.cls_br_l').css('top','-200px');
			$('div.cls_br_r').css('bottom','-200px');
	});

	$('#cls_gallery a').on('click',function(){
				var imgSrc=$(this).find('img').attr('src');
				var imgAlt=$(this).find('img').attr('alt');
				var newSrc=imgSrc.split('.');
				var $origin=$(this);
				$('#cls_gallery #cls_gall_wrap').after('<div id="cl_modal"><div id="cl_layerMask"><img class="cl_bigImg" src="'+newSrc[0]+'-.jpg" alt="'+imgAlt+'확대"/><a href="#none" id="close">X</a>'+'</div></div>');
				centerPosition();
				$(window).on("resize",centerPosition);
				$('#cl_modal').show('fast');
                $('#close').css('position','absolute').css('left','50%').css('margin-left','330px');
                $('#cl_modal, #cl_modal img').attr('tabIndex', 0);
				$('#cl_modal img').focus();

				$('#cl_modal #close').after('<a href="#" id="last"></a>');
				$('#cl_modal').find('#last').on('focus',function(){
						$('#cl_modal img').focus();
				});
				$('#cl_modal, #cl_layerMask').on('focus',function(){
						$('#cl_modal #close').focus();
				});

				$('#cl_modal , #cl_modal img').on('click keypress',function(){
					$('#cl_modal').hide('fast', function(){
						$(this).remove();
					});
					$origin.focus();
					return false;
				});
				
				function centerPosition () {
					var leftPos=($(window).width()-$('#cl_modal img').outerWidth())/2;
					var topPos=($(window).height()-$('#cl_modal img').outerHeight())/2;
					$('#cl_modal img.cl_bigImg').css({left:leftPos, top:topPos});
					$('#cl_modal #close').css({top:topPos});
				}
				
	});

	$('#cls_notice').one('mouseover focus',function(){
			$('#cls_not_wrap').css('left','50%').css('opacity','1.0').css('filter','Alpha(opacity=100)');
	});
});
//------------------------매거진
$(document).ready(function() {
    function setLayerPopup(selector, layerId, closeBtn) {
        $(selector).on('click', function() {         
            $(layerId).before('<div class="m_layerMask"></div>');
            $('.m_layerMask').fadeIn("slow");
            $(layerId).fadeIn("slow");

            var winH = $(this).height();                            
            $('.m_layerMask').css({'height' : winH});
            //화면이 조정됬을 때
            hSize('.m_layerMask');

            //포커스
            $('.m_layerMask').attr('tabIndex',0);
            $(layerId).attr('tabIndex',0);
            $(layerId).focus();

            //포커스 순환
            $(layerId).append('<a href="" id="lastFocus"></a>').find('#lastFocus').on('focus',function() {
                setTimeout(function() {
                    $(layerId).focus();
                }, 10);
            });

            //shift+tab
            $('.m_layerMask').on('focus',function() {
               setTimeout(function() {
                  $(closeBtn).focus(); 
               }, 10);
            });

            return false;
        });
        //아이콘 hover
        $('.m_layerPopup1 .m_target').on('mouseover focus', function() {
            $('.m_layerPopup1').css('backgroundImage','url("images/magazine/m_d_on.jpg")');
            $('.m_layerPopup1 .m_ani').animate({width:'270px', opacity:1});
        });

        $('.m_layerPopup1 .m_target').on('mouseout focusout', function() {
            $('.m_layerPopup1').css('backgroundImage','url("images/magazine/m_d.jpg")');
            $('.m_layerPopup1 .m_ani').animate({width:'0', opacity:0},'fast');
        });

        //아이콘 클릭시
        $('.m_layerPopup1').on('click','.m_target', function() {
            $('.m_layerMask').remove();
            $('#lastFocus').remove();
            $(layerId).removeAttr('tabIndex');
            
            $(layerId).hide();
            
            
        });

        //닫기
        $(closeBtn).on('click', function() {
            $('.m_layerMask').remove();
            $(layerId).fadeOut(function() {
                $('#lastFocus').remove();
                $(layerId).removeAttr('tabIndex');
            });
            
            //$(layerId+", #lastFocus, .m_layerMask").off('focus');
            $(window).off('resize');
            $(selector).focus();
        });
    }
    function setLayerPopup2(selector, layerId, closeBtn) {
       var winH = $(this).height();                            
         $('.m_layerMask2').css({'height' : winH});
         //화면이 조정됬을 때
         hSize('.m_layerMask2');
         
       $(selector).on('click', function() {
           $('.m_layerPopup2_2').css('display','block');
            $('.m_layerPopup2').css('display','block');
            $(window).scrollTop(0,0);
         
            $(layerId).before('<div class="m_layerMask3"></div>');
            $(layerId).fadeIn();
         
         
            $('.m_layerPopup2').animate({left:'100px'},'slow');
            $('.m_layerPopup2_2').animate({right:'40px'},'slow');

            //포커스
            $('.m_layerMask3').attr('tabIndex',0);
            $(layerId).attr('tabIndex',0);
            $(layerId).focus();

            //포커스 순환
            $(layerId).append('<a href="" id="lastFocus2"></a>').find('#lastFocus2').on('focus',function() {
                setTimeout(function() {
                    $(layerId).focus();
                }, 10);
            });

            //shift+tab
            $('.m_layerMask3').on('focus',function() {
               setTimeout(function() {
                  $(closeBtn).focus(); 
               }, 10);
            });
            return false;   
      });
        
        //2번째꺼에서 m_close 닫기
        $('.m_layerMask2').on('click','.m_close', function() {
           
           $('.m_layerMask3').remove();
           $('#lastFocus2').remove();
            $(layerId).removeAttr('tabIndex');
         
            $(layerId).fadeOut();
            $('.m_layerPopup2').animate({left:'-53.4%'},'slow');
            $('.m_layerPopup2_2').animate({right:'-29.6875%'},'slow', function() {
               $('.m_layerPopup2_2').css('display','none');
               $('.m_layerPopup2').css('display','none');
            });
        });
    }
    function hSize(layermask) {
       //화면이 조정됬을 때
        $(window).on('resize',function() {
           winH = $(window).height();  
            $(layermask).css({'height' : winH});
        });
    }
    setLayerPopup($('.m_content1 > a:nth-of-type(1)'), $('.m_layerPopup1'), $('.m_close'));
    setLayerPopup2($('.m_target'),$('.m_layerMask2'),$('.m_layerMask2 > .m_close'));
});

//------------------------로그인
$(document).ready(function() {
    $('#lo_wrap #login_wrap form input[type=submit]').on('click',function(){
        if( $('#lo_wrap #login_wrap form #id').val() == '' || $('#lo_wrap #login_wrap form #id').val() == null ){
            alert( '아이디를 입력해주세요'+$('#lo_wrap #login_wrap form #id').val() );
            return false;
        }else {
            if( $('#lo_wrap #login_wrap form input#pw').val() == '' || $('#lo_wrap #login_wrap form input#pw').val() == null ){
                alert( '비밀번호를 입력해주세요' );
                return false;
            }else {
                //로그인
//                alert( '로그인 성공 : ' + $('#lo_wrap #login_wrap form #id').val() );
            }
        }
    });
});

//------------------------회원가입
$(document).ready(function() {
    $('input#join').on('click',function(){
        if(!$("input:checkbox[id='agree']").is(":checked")) {
            alert('이용 약관에 동의하지 않으시면 가입할 수 없습니다.');
            $("input:checkbox[id='agree']").focus();
            return false;
        }else if(!$("input:checkbox[id='agree2']").is(":checked")){
            alert('개인정보 수집 및 이용약관에 동의하지 않으시면 가입할 수 없습니다.');
            $("input:checkbox[id='agree2']").focus();
            return false;
        }
        
        var regExp = /^[a-z0-9_-]\w{5,20}$/;
        var str = $('form dl dd input#id').val();
        if(str == ''){
            $('form dl dd input#id').siblings('p.detail').text('필수로 작성해야 하는 항목입니다.').css('color','#F15F5F');
            $("input[id='id']").focus();
            return false;
        }else if(str.length < 5 || str.length > 20) {
            $('form dl dd input#id').siblings('p').text('5~20자로 입력해주세요').css('color','#F15F5F');
            $("input[id='id']").focus();
            return false;
        }else if(!str.match(regExp)) {
            $('form dl dd input#id').siblings('p.detail').text('영문 소문자, 숫자와 특수기호(_)만 사용 가능합니다.').css('color','#F15F5F');
            $("input[id='id']").focus();
            return false;
        }else {
            jQuery.ajax({
               type:"POST",
                url:"id_check2.php",
                data:{
                    id : $('form dl dd input#id').val()
                },
                success:function(data){
                    if(data == 'false'){
                        $('form dl dd input#id').siblings('p').text("이미 사용 중인 아이디입니다.").css('color','#F15F5F');
                        $("input[id='id']").focus();
                        return false;
                    }else {
                        $('form dl dd input#id').siblings('p').text("");
                    }
                },
                complete:function(data){
                },
                error:function(xhr, status, error){
                    $("input[id='id']").focus();
                    return false;
                }
            });     
        }
        
       str = $('form dl dd input#password').val();

        var num = str.search(/[0-9]/g);
        var eng = str.search(/[a-z]/ig);
        var spe = str.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

        if(str == ''){
            $('form dl dd input#password').siblings('p.detail').text('필수로 작성해야 하는 항목입니다.').css('color','#F15F5F');
            $("input[id='password']").focus();
            return false;
        }if(str.length < 8 || str.length > 20){
            $('form dl dd input#password').siblings('p.detail').text('8~20자로 입력해주세요').css('color','#F15F5F');
            $("input[id='password']").focus();
            return false;
        }else if(num < 0 || eng < 0 || spe < 0 ){
            $('form dl dd input#password').siblings('p.detail').text('영문,숫자, 특수문자를 혼합하여 입력해주세요.').css('color','#F15F5F');
            $("input[id='password']").focus();
            return false;
        }else{
            $('form dl dd input#passwordCheck').siblings('p.detail').text('');
        }
        
        str = $('form dl dd input#passwordCheck').val();
         
        if(str == ''){
            $('form dl dd input#passwordCheck').siblings('p.detail').text('필수로 작성해야 하는 항목입니다.').css('color','#F15F5F');
            $("form dl dd input#passwordCheck").focus();
            return false;
        }else if( $('#jo_wrap #join_wrap form #passwordCheck').val() !=  $('#jo_wrap #join_wrap form #password').val()){
            $('#jo_wrap #join_wrap form #passwordCheck').siblings('p.detail').text('비밀번호와 확인비밀번호가 일치하지 않습니다.').css('color','#F15F5F');
            $("form dl dd input#passwordCheck").focus();
            return false;
        }else {
            $('#jo_wrap #join_wrap form #passwordCheck').siblings('p.detail').text('');
        }
        
        str = $('form dl dd input#name').val();
        var regExp = /([^가-힣ㄱ-ㅎㅏ-ㅣ\x20])/i;
        
        if(str == ''){
            $('form dl dd input#name').siblings('p.detail').text('필수로 작성해야 하는 항목입니다.').css('color','#F15F5F');
            $("input[id='name']").focus();
            return false;
        }else if(str.match(regExp)){
            $('form dl dd input#name').siblings('p.detail').text('한글만 입력가능합니다.').css('color','#F15F5F');
            $("input[id='name']").focus();
            return false;
        }else {
            $('form dl dd input#name').siblings('p.detail').text('');
        }
        
        
        var str = $('form dl dd input#email').val();
        
        var regExp = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.(com)|(net){3}$/i;

        if(str == ''){
           $('form dl dd input#email').siblings('p.detail').text('필수로 작성해야 하는 항목입니다.').css('color','#F15F5F');
            $("form dl dd input#email").focus();
            return false;
        }else if (!str.match(regExp)){
            $('form dl dd input#email').siblings('p.detail').text('이메일 형식이 아닙니다.').css('color','#F15F5F');
            $("input[id='email']").focus();
            return false;
        }else {
            $('form dl dd input#email').siblings('p.detail').text('');
        }
        
        if($('form dl dd input#phone') != ''){
            var str = $('form dl dd input#phone').val();
            var regExp = /^01([0|1|6|7|8|9]?)([0-9]{3,4})([0-9]{4})$/;

            if (!str.match(regExp)){
                $(this).siblings('p.detail').text('핸드폰 형식에 맞지 않습니다.').css('color','#F15F5F');
                $("input[id='phone']").focus();
                return false;
            }else {
                $(this).siblings('p.detail').text('');
            }
        }
        
        $('#joinform').submit();
    });
    
    //아이디 중복확인
    $('form dl dd input#id').on('change, focusout',function() {
        str = $(this).val();
        var regExp = /^[a-z0-9_-]\w{5,20}$/;
        if(str == '') {
            $('form dl dd input#id').siblings('p').text('필수로 작성해야 하는 항목입니다.').css('color','#F15F5F');
        }else {
            if(str.length < 5 || str.length > 20) {
                $('form dl dd input#id').siblings('p').text('5~20자로 입력해주세요').css('color','#F15F5F');
            }else if(!str.match(regExp)) {
                $(this).siblings('p.detail').text('영문 소문자, 숫자와 특수기호(_)만 사용 가능합니다.').css('color','#F15F5F');
            }else {
                jQuery.ajax({
                   type:"POST",
                    url:"id_check.php",
                    data:{
                        id : $('#id').val()
                    },
                    success:function(data){
                        if(data == '사용가능한 아이디입니다.'){
                            $('form dl dd input#id').siblings('p').text(data).css('color','black');
                        }else{
                            $('form dl dd input#id').siblings('p').text(data).css('color','#F15F5F');
                        }
                       
                    },
                    complete:function(data){
                    },
                    error:function(xhr, status, error){
                        alert("에러발생");
                    }
                });     
            }
        }
    });
    
    $('form dl dd input#password').on('change, focusout',function() {
        str = $(this).val();

        var num = str.search(/[0-9]/g);
        var eng = str.search(/[a-z]/ig);
        var spe = str.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

        if(str.length < 8 || str.length > 20){
            $(this).siblings('p.detail').text('8~20자로 입력해주세요').css('color','#F15F5F');
        }else if(str == ''){
            $(this).siblings('p.detail').text('필수로 작성해야 하는 항목입니다.').css('color','#F15F5F');
        }else if(num < 0 || eng < 0 || spe < 0 ){
            $(this).siblings('p.detail').text('영문,숫자, 특수문자를 혼합하여 입력해주세요.').css('color','#F15F5F');
        }else {
            $(this).siblings('p.detail').text('');
        }
    });
    
    $('form dl dd input#passwordCheck').on('change, focusout',function() {
        str = $(this).val();
        if(str == '') {
            $(this).siblings('p.detail').text('필수로 작성해야 하는 항목입니다.').css('color','#F15F5F');
        }else {
            if( $('#jo_wrap #join_wrap form #passwordCheck').val() !=  $('#jo_wrap #join_wrap form #password').val()){
                $(this).siblings('p.detail').text('비밀번호와 확인비밀번호가 일치하지 않습니다.').css('color','#F15F5F');
            }else {
                $(this).siblings('p.detail').text('');
            }
        }
        
    });
    $('form dl dd input#name').on('change, focusout',function() {
        var str = $(this).val();
        var regExp = /([^가-힣ㄱ-ㅎㅏ-ㅣ\x20])/i;
        
        if(str == '') {
            $(this).siblings('p.detail').text('필수로 작성해야 하는 항목입니다.').css('color','#F15F5F');
        }else {
            if(str.match(regExp)){
                $(this).siblings('p.detail').text('한글만 입력가능합니다.').css('color','#F15F5F');
            }else {
                $(this).siblings('p.detail').text('');
            }
        }
    });
    $('form dl dd input#email').on('change, focusout',function() {
        var str = $(this).val();
        var regExp = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.(com)|(net){3}$/i;
        
        if(str == '') {
            $(this).siblings('p.detail').text('필수로 작성해야 하는 항목입니다.').css('color','#F15F5F');
        }else {
            if (!str.match(regExp)){
                $(this).siblings('p.detail').text('이메일 형식이 아닙니다.').css('color','#F15F5F');
            }else {
                $(this).siblings('p.detail').text('');
            }
        }
        
    });
    $('form dl dd input#emailcerti').on('change, focusout',function(){
        if($(this).val() == '') {
            $(this).siblings('p.detail').text('필수로 작성해야 하는 항목입니다.').css('color','#F15F5F');
        }
    });
    
    $('form dl dd input#phone').on('change focusout',function() {
        var str = $(this).val();
        var regExp = /^01([0|1|6|7|8|9]?)([0-9]{3,4})([0-9]{4})$/;

        if(str == ''){
            $(this).siblings('p.detail').text('');
        }else if (!str.match(regExp)){
            $(this).siblings('p.detail').text('핸드폰 형식에 맞지 않습니다.').css('color','#F15F5F');
        }else {
            $(this).siblings('p.detail').text('');
        }
    });
});
//------------------------나의 정보
$(document).ready(function(){
    $('input#member_update').on('click',function() {
        var str = $('form dl dd input#password').val();
        var str2 = $('form dl dd input#passwordCheck').val();
        if(str == '') {
            alert("비밀번호를 입력하세요");
            $('form dl dd input#password').focus();
        }else if(str != str2){
            alert("비밀번호와 확인비밀번호가 다릅니다.");
            $('form dl dd input#password').focus();
        }else{
            jQuery.ajax({
                type:"POST",
                url:"password_check.php",
                data:{
                    id : $('form dl dd input#id').val(),
                    pw : $('form dl dd input#password').val()
                },
                success:function(data){
                    if(data == 'true') {
                        var result = confirm('회원 정보를 수정하시겠습니까? ');
                        if(result) { 
                            location.href="member_update.php?"+
                                "name="+$('form dl dd input#name').val()+
                                "&email="+$('form dl dd input#email').val()+
                                "&phone="+$('form dl dd input#phone').val()+
                                "&address1="+$('form dl dd input#sample4_postcode').val()+
                                "&address2="+$('form dl dd input#sample4_roadAddress').val()+
                                "&address3="+$('form dl dd input#sample4_jibunAddress').val();
                        }
                    }else {
                         alert("비밀번호가 틀립니다.");
//                        alert(data);
                    }
                },
                complete:function(data){
                },
                error:function(xhr, status, error){
                   alert("에러");
                }
            });  
        }
    });
    
    $('form div input#member_delete').on('click',function() {
        var str = $('form dl dd input#password').val();
        if(str == '') {
            alert("비밀번호를 입력하세요");
            $('form dl dd input#password').focus();
        }else{
            jQuery.ajax({
                type:"POST",
                url:"password_check.php",
                data:{
                    id : $('form dl dd input#id').val(),
                    pw : $('form dl dd input#password').val()
                },
                success:function(data){
                    if(data == 'true') {
                        var result = confirm('정말 탈퇴하시겠습니까? ');
                        if(result) { 
                            location.href="member_delete.php?id="+$('form dl dd input#id').val()+"&pw="+$('form dl dd input#password').val();
                        }
                    }else {
                         alert("비밀번호가 틀립니다.");
                    }
                },
                complete:function(data){
                },
                error:function(xhr, status, error){
                   alert("에러");
                }
            });  
        }
    });
});
//------------------------장바구니
$(document).ready(function(){
    //table 금액 표시
    $trCnt = $('table.product tbody tr').length;
    $tdCnt = $('table.product tbody tr td').length;
    
    $('table.product tbody tr').children("td:nth-child(4)").children('input').click(function() {
        $num1 = parseInt($(this).val());
        $num2 = parseInt($(this).parent().parent().children("td:nth-child(5)").text());
        $sum = $num1*$num2;
        
//        $(this).parent().parent().children("td:nth-child(6)").text($sum*0.005);
        $(this).parent().parent().children("td:nth-child(6)").text($sum);
        
        $allsum=0;
        $('table.product tbody tr').each(function() {
            $allsum+=parseInt($(this).children("td:nth-child(6)").text());
        });

        $('table.sum tbody tr td:nth-child(1)').text($allsum+"원");

        if($allsum >= 150000){
           $('table.sum tbody tr td:nth-child(2)').text("0원");   
        }else {
            $('table.sum tbody tr td:nth-child(2)').text("2500원");   
        }

        $ressum = parseInt($('table.sum tbody tr td:nth-child(1)').text())+parseInt($('table.sum tbody tr td:nth-child(2)').text());
        $('table.sum tbody tr td:nth-child(3)').text($ressum+"원");
    });
    
    $('table.product tbody tr').each(function() {
        $num1 = parseInt($('table.product tbody tr').children("td:nth-child(4)").children('input').val());
        $num2 = parseInt($(this).children("td:nth-child(5)").text());
        $sum = $num1*$num2;
        
//        $(this).children("td:nth-child(6)").text($sum*0.005);
        $(this).children("td:nth-child(6)").text($sum);
        
    });

    $allsum=0;
    $('table.product tbody tr').each(function() {
        $allsum+=parseInt($(this).children("td:nth-child(6)").text());
    });
    
    $('table.sum tbody tr td:nth-child(1)').text($allsum+"원");
    
    if($allsum >= 150000){
       $('table.sum tbody tr td:nth-child(2)').text("0원");   
    }else {
        $('table.sum tbody tr td:nth-child(2)').text("2500원");   
    }
    
    $ressum = parseInt($('table.sum tbody tr td:nth-child(1)').text())+parseInt($('table.sum tbody tr td:nth-child(2)').text());
    $('table.sum tbody tr td:nth-child(3)').text($ressum+"원");  
    
    //최상단 체크박스 클릭
    $("#ct_all").click(function(){
        //클릭되었으면
        if($("#ct_all").prop("checked")){
            //input태그의 name이 chk인 태그들을 찾아서 checked옵션을 true로 정의
            $("#sod_bsk table.product input[type=checkbox]").prop("checked",true);
            //클릭이 안되있으면
        }else{
            //input태그의 name이 chk인 태그들을 찾아서 checked옵션을 false로 정의
            $("#sod_bsk table.product input[type=checkbox]").prop("checked",false);
        }
    });
    
    //전체상품주문
    $("div.endbtn #allbuy").click(function() {
        
    });
    
    //선택상품주문
    $("div.endbtn button#checkedbuy").click(function() {
        
    });
    
    
    
    //쇼핑 계속하기
    $("div.endbtn button.shopping").click(function() {
      
    });
});
//------------------------아이디 찾기
$(document).ready(function(){
    $checked = 'email';
    
    $("#id_wrap #fid_wrap form input[type=radio]").click(function(){
        if($("#id_wrap #fid_wrap form input[id=chkemail]").is(":checked") == true){
            $("#id_wrap #fid_wrap form div label[for=email]").text("이메일");
            $checked='email';
        }else{
            $("#id_wrap #fid_wrap form div label[for=email]").text("휴대폰번호");
            $checked='phone';
        }
    });
    
    $('#id_wrap #fid_wrap form input[type=button]').click(function() {
        if( $('#id_wrap #fid_wrap form div input#name').val() == '' || $('#id_wrap #fid_wrap form div input#name').val() == null){
            alert( '이름을 입력해주세요' );
            return false;
        }else {
            if($checked == 'email') {
                if( $('#id_wrap #fid_wrap form div input#email').val() == '' || $('#id_wrap #fid_wrap form div input#email').val() == null){
                    alert( '이메일을 입력해주세요' );
                    return false;
                }else {
                    alert( '"'+$('#id_wrap #fid_wrap form div input#email').val()+' "로 아이디가 전송되었습니다.' );
                } 
            }else if($checked == 'phone'){
                if( $('#id_wrap #fid_wrap form div input#email').val() == '' || $('#id_wrap #fid_wrap form div input#email').val() == null){
                    alert( '휴대폰번호를 입력해주세요' );
                    return false;
                }else {
                    alert( '"'+$('#id_wrap #fid_wrap form div input#email').val()+' "로 아이디가 전송되었습니다.' );
                } 
            }
            
        }
    });
});

//------------------------비밀번호 찾기
$(document).ready(function(){
    $checked = 'email';
    
    $("#pw_wrap #fpw_wrap form input[type=radio]").click(function(){
        if($("#pw_wrap #fpw_wrap form input[id=chkemail]").is(":checked") == true){
            $("#pw_wrap #fpw_wrap form div label[for=email]").text("이메일");
            $checked='email';
        }else{
            $("#pw_wrap #fpw_wrap form div label[for=email]").text("휴대폰번호");
            $checked='phone';
        }
    });
    
    $('#pw_wrap #fpw_wrap form input[type=button]').click(function() {
        if( $('#pw_wrap #fpw_wrap form div input#id').val() == '' || $('#pw_wrap #fpw_wrap form div input#id').val() == null){
            alert( '아이디를 입력해주세요' );
            return false;
        }else {
            if( $('#pw_wrap #fpw_wrap form div input#name').val() == '' || $('#pw_wrap #fpw_wrap form div input#name').val() == null){
                alert( '이름을 입력해주세요' );
                return false;
            }else {
                if($checked == 'email') {
                    if( $('#pw_wrap #fpw_wrap form div input#email').val() == '' || $('#pw_wrap #fpw_wrap form div input#email').val() == null){
                        alert( '이메일을 입력해주세요' );
                        return false;
                    }else {
                        alert( '"'+$('#pw_wrap #fpw_wrap form div input#email').val()+' "로 아이디가 전송되었습니다.' );
                    } 
                }else if($checked == 'phone'){
                    if( $('#pw_wrap #fpw_wrap form div input#email').val() == '' || $('#pw_wrap #fpw_wrap form div input#email').val() == null){
                        alert( '휴대폰번호를 입력해주세요' );
                        return false;yyy
                    }else {
                        alert( '"'+$('#pw_wrap #fpw_wrap form div input#email').val()+' "로 비밀번호가 전송되었습니다.' );
                    } 
                }
            }
        } 
    });
});

//------------------------ 글읽기
