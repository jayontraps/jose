(function($) {

	$(document).ready(function() {

		$wrapper = $('.wrapper');


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

	    	






    	// override video function by forcing the cookie
    	// $.cookie('return_visit', '1');

		function videoRemoved() {
			$('header').removeClass('playVideo');
			$('.hero').fadeIn('slow');			
		}




        function loadVideo(mq) {

        	// $('#playBtn').show();

        	$('.content').load('vid.html', function(){

				var v = document.getElementById("introVideo");	
				var videoWrapper = $('.videoWrapper'),
					vidControls = $('.vidControls');


				$(videoWrapper).addClass('fadein');
				$(vidControls).animate({
					'opacity' : '1'
				}, 1000);
				// console.log(videoWrapper);
				v.play();	
						

				$("#pause").on('click', function() {
					if (v.paused) {
					  v.play();
					  $(this).text('||');

					} else {
					  v.pause();
					  $(this).text('>'); 
					}			
				});


				$('#close').on('click', function() {							
					videoWrapper.removeClass('fadein');
					$(vidControls).animate({
						'opacity' : '1'
					}, 1000);
					v.pause();
					// videoWrapper.remove();
					videoRemoved();
					$('.content').show();
				});


				v.addEventListener("ended", function() { 
					videoWrapper.removeClass('fadein');
					$(vidControls).animate({
						'opacity' : '1'
					}, 1000);
					v.pause();
					videoRemoved();
					$('.content').show();
				});

        	});

        }  	





	// media query event handler
	// if (matchMedia) {
	//     var mq = window.matchMedia("(min-width: 1025px)");
	//     mq.addListener(loadVideo);
	//     loadVideo(mq);
	// }
	// else {
	// 	videoRemoved();
	// }	


    

    var mq = window.matchMedia("(min-width: 1025px)");
    mq.addListener(prepVideo);
    prepVideo(mq);

    function prepVideo(mq) {
      if (mq.matches) {
        $('#playBtn').show().on('click', loadVideo);
      } else {
        $('#playBtn').hide();     
      }
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






 //    //slide out gallery deatils
 //    if ($('body').hasClass('lg-screen')) {

 //    	slideOutDetails();


	// }	









	});

})(jQuery);

