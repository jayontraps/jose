/* requires:
scripts.js
jquery.fitvids.js
js.cookie.js
*/

/* https://github.com/mkleehammer/gulp-deporder */


(function($) {

	$(document).ready(function() {


		setTimeout(function(){ 
			$( "#logo-layer" ).fadeOut( "slow", function() {
				$(this).css('z-index', '0');
			});				
		 }, 3000);
			


		var $wrapper = $('.wrapper');

		// addClass sm or lg on width detection
		var bp = 1025;
		
	    if($(document).width() >= bp){
			$('body').addClass("lg-screen");
	    }	else {
	    	$('body').addClass("sm-screen");
	    }	
		
	    $(window).resize(function(){
	        if($(document).width() >= bp ){
	        	$('body').removeClass("sm-screen").addClass('lg-screen');
	        } else if($(document).width() < bp) {
	        	$('body').addClass("sm-screen").removeClass('lg-screen');
	        }
	    });
	







		// position footer  			
		var breakpoint = 800;
		var footerContainer = $('#colophon');

		function heroHeight() {
			targetHeight = $(document).height();
			// console.log(targetHeight);

		    if($(document).width() >= breakpoint){ // above 800 - probably desktop    	
				footerContainer.css({
					position: 'absolute',
					top: targetHeight,
					display: 'block'			// hide as requested
					}).parent().animate({ // reveal content
						opacity: 1
					}, 200);
		    }	else {
				footerContainer.css({
					top: 'auto',
					position : 'relative',
					display: 'block'			// hide as requested
					}).parent().animate({ // reveal content
						opacity: 1
					}, 200);
		    }			
		}

		setTimeout(heroHeight, 200);
		
	    $(window).resize(function(){
	        if($(document).width() >= breakpoint ){
				footerContainer.css({
					position: 'absolute',
					top: targetHeight,
					bottom: 'auto',
					display: 'block'
				});        	
	        } else if($(document).width() < breakpoint) {
				footerContainer.css({
					top: 'auto',
					bottom: 'auto',
					position : 'relative',
					display: 'block'
				});
	        }
	    });	









	    // previous / next links 
	    function checkMousePosition(e) {
	    	var mousePositionX = e.clientX;
	    	var totalWidth = $(document).width();
	    	var halfWayPoint = totalWidth / 2;
	    	if (mousePositionX > halfWayPoint) {
	    		$('.nav-next').addClass('on').prev().removeClass('on');
	    	} else {
	    		$('.nav-previous').addClass('on').next().removeClass('on');
	    	}
	    	// console.log(mousePositionX, totalWidth, halfWayPoint);    	
	    }

	    if (!Modernizr.touch && $('body').hasClass('single-portfolio')) {
		    var timer = 0;
		    $(window).mousemove(function(e) {
		      if (!timer) {
		        timer = setTimeout(function() {
		          checkMousePosition(e);
		          timer = 0;
		        }, 250);
		      }
		    });    	
	    }

	    	








		var tab_land = window.matchMedia("(min-width: 1025px)");
		tab_land.addListener(wrapperOverflow);
		wrapperOverflow(tab_land);

		function wrapperOverflow(tab_land) {
			if (tab_land.matches) {
				$wrapper.css('overflow', 'hidden');
				slideOutDetails();
			} else {
				$wrapper.css('overflow', 'visible');      
			}
		}    



		function slideOutDetails() {

			$('body').on('click', '#readMore', function(e) {

				console.log('hello');
			    $('body').toggleClass('more-info-state');


			    if ($(this).hasClass('opened')) {
			        $('.secondaryWrap').toggleClass('on');
			        $(this).removeClass('opened');
			        $('#secondary-post').animate({
			            left: "-100%",
			            opacity: 0
			          }, 400);
			        $(this).html('More info &raquo;');

			    } else {

			        $(this).addClass('opened');
			        $('.secondaryWrap').toggleClass('on');
			        $('#secondary-post').animate({
			            left: 0,
			            opacity: 1
			          }, 400); 
			          $(this).html('&laquo; Less info') ;			        
			    }            	     
			});	
    	}



	});

})(jQuery);