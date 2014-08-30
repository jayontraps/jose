(function($) {
	$(document).ready(function() {


		// addClass sm or lg on width detection
		var breakpoint = 1025;
		
	    if($(document).width() >= breakpoint){
			$('body').addClass("lg-screen");
	    }	else {
	    	$('body').addClass("sm-screen");
	    }	
		
	    $(window).resize(function(){
	        if($(document).width() >= breakpoint ){
	        	$('body').removeClass("sm-screen").addClass('lg-screen');
	        } else if($(document).width() < breakpoint) {
	        	$('body').addClass("sm-screen").removeClass('lg-screen');
	        }
	    });
	

		// add slants to .nav-menu
		// $('<span class="slant"></span>').appendTo('#menu-primary li');


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
					display: 'block'
					}).parent().animate({ // reveal content
						opacity: 1
					}, 200);
		    }	else {
				footerContainer.css({
					top: 'auto',
					position : 'relative',
					display: 'block'
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

	    	



 

 







		function videoRemoved() {
			$('header').removeClass('playVideo');
			$('.hero').fadeIn('slow');			
		}



        function autoLoadVideo(mq) {

            if (mq.matches) {

            	$('.content').load('vid.html', function(){

					var v = document.getElementById("introVideo");	
					var videoWrapper = $('.videoWrapper');
					// fade in and out h1 and play video
					$('#overLayH1')
						.animate({
							'opacity': 1
						}, 1500)
						.delay(800)
						.animate({
							'opacity': 0
						}, 1000, function() {
							$(this).remove();
							$(videoWrapper).addClass('fadein');
							v.play();	
							// fade in controls	
						});		



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
						v.pause();
						videoWrapper.remove();
						videoRemoved();
						$('.content').show();
					});


					v.addEventListener("ended", function() { 
						videoWrapper.removeClass('fadein');
						v.pause();
						videoRemoved();
						$('.content').show();
					});

            	});
            }

            else {
            	videoRemoved();
            }
        }  	



		


		if ($('body').hasClass('home')) {

			if ($.cookie('return_visit')) {
				videoRemoved();
			} else{

				 $.cookie('return_visit', '1');
		        // media query change
				 
		        // media query event handler
		        if (matchMedia) {
		            var mq = window.matchMedia("(min-width: 1025px)");
		            mq.addListener(autoLoadVideo);
		            autoLoadVideo(mq);
		        }
		        else {
		        	videoRemoved();
		        }			 
			}
		} 










    //slide out gallery deatils
    if ($('body').hasClass('lg-screen')) {
	    $('body').on('click', '#readMore', function(e) {
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

