$(document).ready(function (){
	var $menu=$("#l_snb ul li");
	var $cnt=$("#l_container > section")
	var cntTop=0;

	//1) resize : section이 하나씩만 보여질수 있도록
	$(window).on("resize",function  () {
		var winHei=$(window).height();
		$cnt.css("height",winHei-cntTop);

		//창사이즈를 조절할 경우 현재 section의 상단이 header 바로 아래 위치하게 함
		var onIdx=$("#l_snb ul li.on").index();
		//console.log(onIdx);

		$(window).off("scroll");
		var mov=$cnt.eq(onIdx).offset().top-cntTop;
		$("html, body").stop().animate({scrollTop:mov}, 500, "easeOutBack", function  () {
			$(window).on("scroll", scrollMove);
		})
	});
	$(window).trigger("resize");

	//2) #l_snb ul li a 클릭
	$menu.children().on("click",function  () {
		//on 클래스명 제어
		$menu.removeClass("on");
		$(this).parent().addClass("on");
		// animate
		var goEle=$(this).attr("href");

		$(window).off("scroll");
		var position=$(goEle).offset().top-cntTop;
		$("html, body").stop().animate({scrollTop:position}, function  () {
			$(window).on("scroll", scrollMove);
		})
		return false;
	});

	//3) 윈도창을 스크롤하는 경우
	$(window).on("scroll", scrollMove);

	function scrollMove () {
		var scrollT=$(window).scrollTop();

		$cnt.each(function  (idx) {
			if (scrollT >= $(this).offset().top-cntTop) {
				$menu.removeClass("on");
				$menu.eq(idx).addClass("on").children().focus();
			}
		})
	}
	
	var tgIdx=0;
	//4) section에서 마우스휠 동작
	$cnt.on("mousewheel DOMMouseScroll",function  (e) {
		//alert(e.type);
		var evt=e.originalEvent.wheelDelta || e.originalEvent.detail*-1;
		var scrollT=$(window).scrollTop();
		var maxIdx=$menu.size()-1;

		$cnt.each(function  (idx) {	//idx: 0~~~6
			if (scrollT >= $(this).offset().top-cntTop && !$("html, body").is(":animated")) {
				//먼저 섹션을 선택한 다음 --> 마우스휠의 up / down 체크
				if (idx<maxIdx && evt<0) { //음수-down
					tgIdx= idx+1;
				}else if (idx>0 && evt>=0) { //양수 - up
					tgIdx= idx-1;
				}	
			}
		})

		var tgTop=$cnt.eq(tgIdx).offset().top-cntTop;
		$("html, body").stop().animate({scrollTop:tgTop})

	});
});



















