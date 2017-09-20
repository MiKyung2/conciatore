gMenuH = '1071px';
	
$(document).ready(function(){    
	var nav = $('.fixed');
    var navoffset = $('.fixed').offset();  
    /* offset을 이용하여 .menu(메뉴영역)의 위치값을 알아내어 navoffset에 넣어둔다 */

    $(window).scroll(function () {
        if ($(this).scrollTop() >= navoffset.top) {  /* 화면 스크롤 값이 메뉴영역의 top보다 값이 커지면 */
            nav.css('position','fixed').css('top',0); /* 화면 위쪽에 고정시킨다. */
        }else {
            nav.css('position','absolute').css('top', gMenuH); /* 처음 메뉴영역의 top 값으로 돌리기 */
           nav.css('position','absolute').css('left', 0); /* 처음 메뉴영역의 top 값으로 돌리기 */
        }
    });
    
    $('#search_li .search_2').hide(); 
    $('#search_li .search_1').on('click', function(){
        $('#search_li input').toggleClass('on');
        $('#search_li .search_1').hide();
        $('#search_li input').focus();
        $('#search_li .search_2').fadeIn();
    });
    $('#search_li .search_2').on('click', function(){
    	var search_v=$('#search').val();
    	if(search_v=="")
    			{
    				alert("검색어를 입력해주세요!");
    				$('#search_li input').focus();
    			}
    		else{
	    			$('#search_li input').toggleClass('on');
			        $('#search_li .search_2').hide(); 
			        $('#search_li .search_1').fadeIn();
			        $('#search_li .search_1').focus();
    			};
        
    });
        
    
});


