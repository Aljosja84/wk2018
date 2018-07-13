/***********************************************************************************************************************
DOCUMENT: includes/javascript.js
DEVELOPED BY: Ryan Stemkoski
COMPANY: Zipline Interactive
EMAIL: ryan@gozipline.com
PHONE: 509-321-2849
DATE: 3/26/2009
UPDATED: 3/25/2010
DESCRIPTION: This is the JavaScript required to create the accordion style menu.  Requires jQuery library
NOTE: Because of a bug in jQuery with IE8 we had to add an IE stylesheet hack to get the system to work in all browsers. 
I hate hacks but had no choice :(.
************************************************************************************************************************/
$(document).ready(function() {
	 
	//ACCORDION BUTTON ACTION (ON CLICK DO THE FOLLOWING)
	$('.accordionButton').click(function() {

		//REMOVE THE ON CLASS FROM ALL BUTTONS
		$('.accordionButton').removeClass('on');
		  
		//NO MATTER WHAT WE CLOSE ALL OPEN SLIDES
	 	$('.accordionContent').slideUp(200, 'easeInBack');
   
		//IF THE NEXT SLIDE WASN'T OPEN THEN OPEN IT
		if($(this).next().is(':hidden') == true) {
			
			//ADD THE ON CLASS TO THE BUTTON
			$(this).addClass('on');
			  
			//OPEN THE SLIDE
			$(this).next().slideDown(300, 'easeOutBack');
		 } 
		  
	 });
	  
	
	/*** REMOVE IF MOUSEOVER IS NOT REQUIRED ***/
	
	//ADDS THE .OVER CLASS FROM THE STYLESHEET ON MOUSEOVER 
	$('.accordionButton').mouseover(function() {
		$(this).addClass('over');
		$(this).stop().animate({paddingLeft:"10px", width: "240px"},100);
		
	//ON MOUSEOUT REMOVE THE OVER CLASS
	}).mouseout(function() {
		$(this).removeClass('over');
		$(this).stop().animate({paddingLeft:"5px", width: "245px"},100);										
	});
	
	//ADDS THE .OVER CLASS FROM THE STYLESHEET ON MOUSEOVER 
	$('.accCntBtn').mouseover(function() {
		$(this).addClass('overCntBtn');
		
	//ON MOUSEOUT REMOVE THE OVER CLASS
	}).mouseout(function() {
		$(this).removeClass('overCntBtn');										
	});
	
	//CLICK FUNCTION FOR FINAL BUTTONS
	$('.accCntBtn').click(function() {
		//TOGGLE LEFT MENU*********************************************************************************************
		$('#TitelTop').stop().animate({height: "0px"}, 700, "easeOutBack", function() {$('#TitelTop').hide()});
		
		$('#menu').stop().animate({height: "0px"}, 500, "easeOutBack", function() {$('#menu').hide()});
	});
	
	
	/*** END REMOVE IF MOUSEOVER IS NOT REQUIRED ***/
	
	
	/********************************************************************************************************************
	CLOSES ALL S ON PAGE LOAD
	********************************************************************************************************************/	
	$('.accordionContent').hide();

});

/***********************************************************************************************************************
	THUMBNAIL MENU
***********************************************************************************************************************/

$(document).ready(function() {
	
	//HIDE THUMBNAILS AT BOTTOM
	
	//ARROW BUTTON CLICK ACTION
	$('#disclaimer').on('click', function() {
		var newPos = "0px";
		if($('#thumb1').css('bottom') == '-45px') {
			//TOGGLE LEFT MENU*********************************************************************************************
			$('#TitelTop').stop().animate({height: "toggle"}, 700, "easeOutBack");
			
			$('#menu').stop().animate({height: "toggle"}, 500, "easeOutBack");
			
			//SOCIAL*******************************************************************************************************
			$('#social').delay(200).animate({height : "toggle"}, 300);
			//THUMBNAIS****************************************************************************************************
			
			$('#thumb1').delay(700).animate({bottom : newPos}, 200, "easeOutBack");
			$('#thumb2').delay(800).animate({bottom : newPos}, 200, "easeOutBack");
			$('#thumb3').delay(900).animate({bottom : newPos}, 200, "easeOutBack");
			$('#thumb4').delay(1000).animate({bottom : newPos}, 200, "easeOutBack");
			$('#thumb5').delay(1100).animate({bottom : newPos}, 200, "easeOutBack");
			$('#thumb6').delay(1200).animate({bottom : newPos}, 200, "easeOutBack");
			
		}
		else {
			var newPos = "-45px";
			//THUMBNAIS****************************************************************************************************
			$('#thumb1').animate({bottom : newPos}, 200, "easeOutBack");
			$('#thumb2').delay(100).animate({bottom : newPos}, 200, "easeOutBack");
			$('#thumb3').delay(200).animate({bottom : newPos}, 200, "easeOutBack");
			$('#thumb4').delay(300).animate({bottom : newPos}, 200, "easeOutBack");
			$('#thumb5').delay(400).animate({bottom : newPos}, 200, "easeOutBack");
			$('#thumb6').delay(500).animate({bottom : newPos}, 200, "easeOutBack");
			//TOGGLE LEFT MENU*********************************************************************************************
			$('#TitelTop').stop().delay(700).animate({height: "toggle"}, 700, "easeOutBack");
			
			$('#menu').stop().delay(1200).animate({height: "toggle"}, 500, "easeOutBack");
			
			//SOCIAL*******************************************************************************************************
			$('#social').delay(600).animate({height : "toggle"}, 300);
			
		}

	});
	
		
});

/***********************************************************************************************************************
	THUMBNAIL HOVERS
***********************************************************************************************************************/
$(document).ready(function() {
	//THUMBNAIL #1******************************************************************************************************
    $('.thumb').hoverIntent(
	function()
	{
		var xPos = $(this).css('right');
		//TITEL VAN DE THUMBNAIL****************************************************************************************
		var titel = $(this).children(this).attr('data');
		//**************************************************************************************************************
		$('#thumbTool').css({right: xPos});
		$('#thumbTool').css({right: "-=19px"});
		
		$('#thumbTool').stop().animate({bottom: '55px', opacity: '1'}, 100).html(titel+"<div class=chat-bubble-arrow></div>");
	}, function() {
		$('#thumbTool').stop().animate({bottom: '45px', opacity: '0'}, 100).html(titel+"<div class=chat-bubble-arrow></div>");
	}
);

});

/***********************************************************************************************************************
	THUMBNAIL CLICK EVENTS
***********************************************************************************************************************/
$('#thumb1').click(function(e) {
    e.preventDefault();
    $.backstretch('img/bg/1.jpg');
});
$('#thumb2').on('click',function(e) {
    e.preventDefault();
    $.backstretch("img/bg/2.jpg");
});
$("#thumb3").click(function(e) {
    e.preventDefault();
    $.backstretch('img/bg/3.jpg');
});
$("#thumb4").click(function(e) {
    e.preventDefault();
    $.backstretch('img/bg/4.jpg');
});
$("#thumb5").click(function(e) {
    e.preventDefault();
    $.backstretch('img/bg/5.jpg');
});
$("#thumb6").click(function(e) {
    e.preventDefault();
    $.backstretch('img/bg/6.jpg');
});
