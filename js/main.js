(function($) {
	$(document).ready(function() {
		// add slants to .nav-menu
		$('<span class="slant"></span>').appendTo('#menu-primary li');


		// show and position footer 			
		var breakpoint = 800;
		var footerContainer = $('#colophon');

		function heroHeight() {
			targetHeight = $(document).height();
			console.log(targetHeight);

		    if($(document).width() >= breakpoint){ // above 800 - probably desktop    	
				footerContainer.css({
					position: "absolute",
					top: targetHeight,
					display: "block"
					});
		    }	else {
				footerContainer.css({
					top: "auto",
					position : "relative",
					display: "block"
					});
		    }			
		}

		setTimeout(heroHeight, 1000);
		
	    $(window).resize(function(){
	        if($(document).width() >= breakpoint ){
				footerContainer.css({
					position: "absolute",
					top: targetHeight,
					bottom: "auto",
					display: "block"
				});        	
	        } else if($(document).width() < breakpoint) {
				footerContainer.css({
					top: "auto",
					bottom: "auto",
					position : "relative",
					display: "block"
				});
	        }
	    });	






	    // previous / next links 
	    function checkMousePosition(e) {
	    	var mousePositionX = e.clientX;
	    	var totalWidth = $(document).width();
	    	var halfWayPoint = totalWidth / 2;
	    	if (mousePositionX > halfWayPoint) {
	    		$('.nav-next').addClass('on');
	    		$('.nav-previous').removeClass('on');
	    	} else {
	    		$('.nav-previous').addClass('on');
	    		$('.nav-next').removeClass('on');
	    	}
	    	console.log(mousePositionX, totalWidth, halfWayPoint);    	
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
		    }).trigger('mousemove');    	
	    };





 

 













	});

})(jQuery);

