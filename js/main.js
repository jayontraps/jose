(function($) {
	$(document).ready(function() {
		// add slants to .nav-menu
		// $('<span class="slant"></span>').appendTo('#menu-primary li:not(:last-child)');
		$('<span class="slant"></span>').appendTo('#menu-primary li');
	});


	// position footer when on desktop with fullscreen image
		
	var breakpoint = 800;
	var targetHeight = $(document).height();
	var footerContainer = $('.site-footer');
	
    if($(document).width() >= breakpoint){ // above 800 - probably desktop    	
		footerContainer.css({
			position: "absolute",
			top: targetHeight,
			bottom: "auto"
		});
    }	else {
		footerContainer.css({
			top: "auto",
			bottom: "auto",
			position : "relative"
		});
    }	
	
    $(window).resize(function(){
        if($(document).width() >= breakpoint ){
			footerContainer.css({
				position: "absolute",
				top: targetHeight,
				bottom: "auto"
			});        	
        } else if($(document).width() < breakpoint) {
			footerContainer.css({
				top: "auto",
				bottom: "auto",
				position : "relative"
			});
        }
    });	

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

    var timer = 0;
    $(window).mousemove(function(e) {
      if (!timer) {
        timer = setTimeout(function() {
          checkMousePosition(e);
          timer = 0;
        }, 250);
      }
    }).trigger('mousemove');



    // $(".hero").on('click', function(e){
    // 	var clickPositionX = e.clientX;
    // 	var totalWidth = $(document).width();
    // 	var halfWayPoint = totalWidth / 2;
    // 	if (clickPositionX > halfWayPoint) {
    // 		alert('right');
    // 	} else {
    // 		alert('left');
    // 	}
    // 	console.log(clickPositionX, totalWidth, halfWayPoint);
    // });


 














})(jQuery);

