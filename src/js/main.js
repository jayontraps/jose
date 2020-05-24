/* requires:
scripts.js
jquery.fitvids.js
js.cookie.js
jquery.lazyloadxt.extra.js
*/

/* https://github.com/mkleehammer/gulp-deporder */

;(function ($) {
  $(document).ready(function () {    

    // $('body').fitVids();
        
    $.extend($.lazyLoadXT, {
      onload: function(domEl) {
        console.log(this)
        $(this).parent().fitVids();
        $(this).addClass('loaded')
      }
    });
  
    // $('.Media_video')
    //   .on('lazyshow', function () {
    //    $(this).addClass('loaded')
    //   })
    //   .lazyLoadXT({
    //     onload: function(domEl) {          
    //       $(this).parent().fitVids();
    //       $(this).addClass('show')
    //     }
    // });

    setTimeout(function () {
      $('#logo-layer').fadeOut(2000, function () {
        $(this).css('z-index', '0')
      })
    }, 2500)

    var $wrapper = $('.wrapper')

    // addClass sm or lg on width detection
    var bp = 769 // 1025;

    if ($(document).width() >= bp) {
      $('body').addClass('lg-screen')
    } else {
      $('body').addClass('sm-screen')
    }

    $(window).resize(function () {
      if ($(document).width() >= bp) {
        $('body').removeClass('sm-screen').addClass('lg-screen')
      } else if ($(document).width() < bp) {
        $('body').addClass('sm-screen').removeClass('lg-screen')
      }
    })

    // position footer
    var breakpoint = 800
    var footerContainer = $('#colophon')
    var targetHeight = $(document).height()
    var hero = document.getElementById('hero')
    var heroImage = document.getElementById('fullscreen-image')
    var contentDiv = document.getElementById('content')

    

    if (heroImage) {
      var heroImageHeight = heroImage.offsetHeight
      // console.log('heroImage: ', heroImage) 
      // console.log('heroImageHeight: ', heroImageHeight)
      // console.log('contentDiv: ', contentDiv)
    }
    
    function heroHeight() {
      if ($(document).width() >= breakpoint) {
        // above 800 - probably desktop
        $(contentDiv)
          // .css({
          //   minHeight: heroImageHeight + 'px'            
          // })
          .parent()
          .animate(
            {
              // reveal content
              opacity: 1
            },
            200
          )
      } else {
        $(contentDiv)
          // .css({
          //   top: 'auto',
          //   position: 'relative',
          //   display: 'block' // hide as requested
          // })
          .parent()
          .animate(
            {
              // reveal content
              opacity: 1
            },
            200
          )
      }
    }

    setTimeout(heroHeight, 200)


    // previous / next links
    // function checkMousePosition(e) {
    //   var mousePositionX = e.clientX
    //   var totalWidth = $(document).width()
    //   var halfWayPoint = totalWidth / 2
    //   if (mousePositionX > halfWayPoint) {
    //     $('.nav-next').addClass('on').prev().removeClass('on')
    //   } else {
    //     $('.nav-previous').addClass('on').next().removeClass('on')
    //   }      
    // }

    // if (!Modernizr.touch && $('body').hasClass('single-portfolio')) {
    //   var timer = 0
    //   $(window).mousemove(function (e) {
    //     if (!timer) {
    //       timer = setTimeout(function () {
    //         checkMousePosition(e)
    //         timer = 0
    //       }, 250)
    //     }
    //   })
    // }

    var tab_land = window.matchMedia('(min-width: 769px)') // prev 1024px
    tab_land.addListener(wrapperOverflow)
    wrapperOverflow(tab_land)

    function wrapperOverflow(tab_land) {
      if (tab_land.matches) {
        // $wrapper.css('overflow', 'hidden')
        slideOutDetails()
      } else {
        // $wrapper.css('overflow', 'visible')
      }
    }

    function slideOutDetails() {
      $('body').on('click', '#readMore', function (e) {    
        console.log('spaghetti')    

        $('body').toggleClass('more-info-state')

        if ($(this).hasClass('opened')) {
          $('.secondaryWrap').toggleClass('on')
          $(this).removeClass('opened')
          $(this).html('Read more &raquo;')
        } else {
          $(this).addClass('opened')
          $('.secondaryWrap').toggleClass('on')
          $(this).html('Read less &raquo; ')
        }
      })
    }
  })

})(jQuery)
