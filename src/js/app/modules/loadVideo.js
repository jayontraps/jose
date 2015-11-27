var videoRemoved = require('./videoRemoved');

module.exports = function loadVideo(mq) {

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

};  