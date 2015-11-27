/*global jQuery */
/*jshint browser:true */
/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/

(function( $ ){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null,
      ignore: null
    };

    if(!document.getElementById('fit-vids-style')) {
      // appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
      var head = document.head || document.getElementsByTagName('head')[0];
      var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      var div = document.createElement('div');
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var ignoreList = '.fitvidsignore';

      if(settings.ignore) {
        ignoreList = ignoreList + ', ' + settings.ignore;
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not("object object"); // SwfObj conflict patch
      $allVideos = $allVideos.not(ignoreList); // Disable FitVids on this video.

      $allVideos.each(function(){
        var $this = $(this);
        if($this.parents(ignoreList).length > 0) {
          return; // Disable FitVids on this video.
        }
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width'))))
        {
          $this.attr('height', 9);
          $this.attr('width', 16);
        }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );

/*! Lazy Load XT v1.0.6 2014-11-19
 * http://ressio.github.io/lazy-load-xt
 * (C) 2014 RESS.io
 * Licensed under MIT */

(function ($, window, document, undefined) {
    // options
    var lazyLoadXT = 'lazyLoadXT',
        dataLazied = 'lazied',
        load_error = 'load error',
        classLazyHidden = 'lazy-hidden',
        docElement = document.documentElement || document.body,
    //  force load all images in Opera Mini and some mobile browsers without scroll event or getBoundingClientRect()
        forceLoad = (window.onscroll === undefined || !!window.operamini || !docElement.getBoundingClientRect),
        options = {
            autoInit: true, // auto initialize in $.ready
            selector: 'img[data-src]', // selector for lazyloading elements
            blankImage: 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7',
            throttle: 99, // interval (ms) for changes check
            forceLoad: forceLoad, // force auto load all images

            loadEvent: 'pageshow', // check AJAX-loaded content in jQueryMobile
            updateEvent: 'load orientationchange resize scroll touchmove focus', // page-modified events
            forceEvent: '', // force loading of all elements

            //onstart: null,
            oninit: {removeClass: 'lazy'}, // init handler
            onshow: {addClass: classLazyHidden}, // start loading handler
            onload: {removeClass: classLazyHidden, addClass: 'lazy-loaded'}, // load success handler
            onerror: {removeClass: classLazyHidden}, // error handler
            //oncomplete: null, // complete handler

            //scrollContainer: undefined,
            checkDuplicates: true
        },
        elementOptions = {
            srcAttr: 'data-src',
            edgeX: 0,
            edgeY: 0,
            visibleOnly: true
        },
        $window = $(window),
        $isFunction = $.isFunction,
        $extend = $.extend,
        $data = $.data || function (el, name) {
            return $(el).data(name);
        },
    // $.contains is not included into DOMtastic, so implement it there
        $contains = $.contains || function (parent, el) {
            while (el = el.parentNode) {
                if (el === parent) {
                    return true;
                }
            }
            return false;
        },
        elements = [],
        topLazy = 0,
    /*
     waitingMode=0 : no setTimeout
     waitingMode=1 : setTimeout, no deferred events
     waitingMode=2 : setTimeout, deferred events
     */
        waitingMode = 0;

    $[lazyLoadXT] = $extend(options, elementOptions, $[lazyLoadXT]);

    /**
     * Return options.prop if obj.prop is undefined, otherwise return obj.prop
     * @param {*} obj
     * @param {*} prop
     * @returns *
     */
    function getOrDef(obj, prop) {
        return obj[prop] === undefined ? options[prop] : obj[prop];
    }

    /**
     * @returns {number}
     */
    function scrollTop() {
        var scroll = window.pageYOffset;
        return (scroll === undefined) ? docElement.scrollTop : scroll;
    }

    /**
     * Add new elements to lazy-load list:
     * $(elements).lazyLoadXT() or $(window).lazyLoadXT()
     *
     * @param {object} [overrides] override global options
     */
    $.fn[lazyLoadXT] = function (overrides) {
        overrides = overrides || {};

        var blankImage = getOrDef(overrides, 'blankImage'),
            checkDuplicates = getOrDef(overrides, 'checkDuplicates'),
            scrollContainer = getOrDef(overrides, 'scrollContainer'),
            elementOptionsOverrides = {},
            prop;

        // empty overrides.scrollContainer is supported by both jQuery and Zepto
        $(scrollContainer).on('scroll', queueCheckLazyElements);

        for (prop in elementOptions) {
            elementOptionsOverrides[prop] = getOrDef(overrides, prop);
        }

        return this.each(function (index, el) {
            if (el === window) {
                $(options.selector).lazyLoadXT(overrides);
            } else {
                // prevent duplicates
                if (checkDuplicates && $data(el, dataLazied)) {
                    return;
                }

                var $el = $(el).data(dataLazied, 1);

                if (blankImage && el.tagName === 'IMG' && !el.src) {
                    el.src = blankImage;
                }

                // clone elementOptionsOverrides object
                $el[lazyLoadXT] = $extend({}, elementOptionsOverrides);

                triggerEvent('init', $el);

                elements.push($el);
            }
        });
    };


    /**
     * Process function/object event handler
     * @param {string} event suffix
     * @param {jQuery} $el
     */
    function triggerEvent(event, $el) {
        var handler = options['on' + event];
        if (handler) {
            if ($isFunction(handler)) {
                handler.call($el[0]);
            } else {
                if (handler.addClass) {
                    $el.addClass(handler.addClass);
                }
                if (handler.removeClass) {
                    $el.removeClass(handler.removeClass);
                }
            }
        }

        $el.trigger('lazy' + event, [$el]);

        // queue next check as images may be resized after loading of actual file
        queueCheckLazyElements();
    }


    /**
     * Trigger onload/onerror handler
     * @param {Event} e
     */
    function triggerLoadOrError(e) {
        triggerEvent(e.type, $(this).off(load_error, triggerLoadOrError));
    }


    /**
     * Load visible elements
     * @param {bool} [force] loading of all elements
     */
    function checkLazyElements(force) {
        if (!elements.length) {
            return;
        }

        force = force || options.forceLoad;

        topLazy = Infinity;

        var viewportTop = scrollTop(),
            viewportHeight = window.innerHeight || docElement.clientHeight,
            viewportWidth = window.innerWidth || docElement.clientWidth,
            i,
            length;

        for (i = 0, length = elements.length; i < length; i++) {
            var $el = elements[i],
                el = $el[0],
                objData = $el[lazyLoadXT],
                removeNode = false,
                visible = force,
                topEdge;

            // remove items that are not in DOM
            if (!$contains(docElement, el)) {
                removeNode = true;
            } else if (force || !objData.visibleOnly || el.offsetWidth || el.offsetHeight) {

                if (!visible) {
                    var elPos = el.getBoundingClientRect(),
                        edgeX = objData.edgeX,
                        edgeY = objData.edgeY;

                    topEdge = (elPos.top + viewportTop - edgeY) - viewportHeight;

                    visible = (topEdge <= viewportTop && elPos.bottom > -edgeY &&
                        elPos.left <= viewportWidth + edgeX && elPos.right > -edgeX);
                }

                if (visible) {
                    triggerEvent('show', $el);

                    var srcAttr = objData.srcAttr,
                        src = $isFunction(srcAttr) ? srcAttr($el) : el.getAttribute(srcAttr);
                    if (src) {
                        $el.on(load_error, triggerLoadOrError);
                        el.src = src;
                    }

                    removeNode = true;
                } else {
                    if (topEdge < topLazy) {
                        topLazy = topEdge;
                    }
                }
            }

            if (removeNode) {
                elements.splice(i--, 1);
                length--;
            }
        }

        if (!length) {
            triggerEvent('complete', $(docElement));
        }
    }


    /**
     * Run check of lazy elements after timeout
     */
    function timeoutLazyElements() {
        if (waitingMode > 1) {
            waitingMode = 1;
            checkLazyElements();
            setTimeout(timeoutLazyElements, options.throttle);
        } else {
            waitingMode = 0;
        }
    }


    /**
     * Queue check of lazy elements because of event e
     * @param {Event} [e]
     */
    function queueCheckLazyElements(e) {
        if (!elements.length) {
            return;
        }

        // fast check for scroll event without new visible elements
        if (e && e.type === 'scroll' && e.currentTarget === window) {
            if (topLazy >= scrollTop()) {
                return;
            }
        }

        if (!waitingMode) {
            setTimeout(timeoutLazyElements, 0);
        }
        waitingMode = 2;
    }


    /**
     * Initialize list of hidden elements
     */
    function initLazyElements() {
        $window.lazyLoadXT();
    }


    /**
     * Loading of all elements
     */
    function forceLoadAll() {
        checkLazyElements(true);
    }


    /**
     * Initialization
     */
    $(document).ready(function () {
        triggerEvent('start', $window);

        $window
            .on(options.loadEvent, initLazyElements)
            .on(options.updateEvent, queueCheckLazyElements)
            .on(options.forceEvent, forceLoadAll);

        $(document).on(options.updateEvent, queueCheckLazyElements);

        if (options.autoInit) {
            initLazyElements(); // standard initialization
        }
    });

})(window.jQuery || window.Zepto || window.$, window, document);

(function ($) {
    var options = $.lazyLoadXT;

    options.selector += ',video,iframe[data-src]';
    options.videoPoster = 'data-poster';

    $(document).on('lazyshow', 'video', function (e, $el) {
        var srcAttr = $el.lazyLoadXT.srcAttr,
            isFuncSrcAttr = $.isFunction(srcAttr);

        $el
            .attr('poster', $el.attr(options.videoPoster))
            .children('source,track')
            .each(function (index, el) {
                var $child = $(el);
                $child.attr('src', isFuncSrcAttr ? srcAttr($child) : $child.attr(srcAttr));
            });

        // reload video
        this.load();
    });

})(window.jQuery || window.Zepto || window.$);

/*!
 * JavaScript Cookie v2.0.4
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
 * Released under the MIT license
 */
(function (factory) {
	if (typeof define === 'function' && define.amd) {
		define(factory);
	} else if (typeof exports === 'object') {
		module.exports = factory();
	} else {
		var _OldCookies = window.Cookies;
		var api = window.Cookies = factory();
		api.noConflict = function () {
			window.Cookies = _OldCookies;
			return api;
		};
	}
}(function () {
	function extend () {
		var i = 0;
		var result = {};
		for (; i < arguments.length; i++) {
			var attributes = arguments[ i ];
			for (var key in attributes) {
				result[key] = attributes[key];
			}
		}
		return result;
	}

	function init (converter) {
		function api (key, value, attributes) {
			var result;

			// Write

			if (arguments.length > 1) {
				attributes = extend({
					path: '/'
				}, api.defaults, attributes);

				if (typeof attributes.expires === 'number') {
					var expires = new Date();
					expires.setMilliseconds(expires.getMilliseconds() + attributes.expires * 864e+5);
					attributes.expires = expires;
				}

				try {
					result = JSON.stringify(value);
					if (/^[\{\[]/.test(result)) {
						value = result;
					}
				} catch (e) {}

				if (!converter.write) {
					value = encodeURIComponent(String(value))
						.replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);
				} else {
					value = converter.write(value, key);
				}

				key = encodeURIComponent(String(key));
				key = key.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent);
				key = key.replace(/[\(\)]/g, escape);

				return (document.cookie = [
					key, '=', value,
					attributes.expires && '; expires=' + attributes.expires.toUTCString(), // use expires attribute, max-age is not supported by IE
					attributes.path    && '; path=' + attributes.path,
					attributes.domain  && '; domain=' + attributes.domain,
					attributes.secure ? '; secure' : ''
				].join(''));
			}

			// Read

			if (!key) {
				result = {};
			}

			// To prevent the for loop in the first place assign an empty array
			// in case there are no cookies at all. Also prevents odd result when
			// calling "get()"
			var cookies = document.cookie ? document.cookie.split('; ') : [];
			var rdecode = /(%[0-9A-Z]{2})+/g;
			var i = 0;

			for (; i < cookies.length; i++) {
				var parts = cookies[i].split('=');
				var name = parts[0].replace(rdecode, decodeURIComponent);
				var cookie = parts.slice(1).join('=');

				if (cookie.charAt(0) === '"') {
					cookie = cookie.slice(1, -1);
				}

				try {
					cookie = converter.read ?
						converter.read(cookie, name) : converter(cookie, name) ||
						cookie.replace(rdecode, decodeURIComponent);

					if (this.json) {
						try {
							cookie = JSON.parse(cookie);
						} catch (e) {}
					}

					if (key === name) {
						result = cookie;
						break;
					}

					if (!key) {
						result[name] = cookie;
					}
				} catch (e) {}
			}

			return result;
		}

		api.get = api.set = api;
		api.getJSON = function () {
			return api.apply({
				json: true
			}, [].slice.call(arguments));
		};
		api.defaults = {};

		api.remove = function (key, attributes) {
			api(key, '', extend(attributes, {
				expires: -1
			}));
		};

		api.withConverter = init;

		return api;
	}

	return init(function () {});
}));

/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container )
		return;

	button = document.getElementById( 'navicon' );
	if ( 'undefined' === typeof button )
		return;

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( -1 === menu.className.indexOf( 'nav-menu' ) )
		menu.className += ' nav-menu';

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) )
			container.className = container.className.replace( ' toggled', '' );
		else
			container.className += ' toggled';
	};
} )();

( function() {
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var element = document.getElementById( location.hash.substring( 1 ) );

			if ( element ) {
				if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
					element.tabIndex = -1;

				element.focus();
			}
		}, false );
	}
})();


/* requires:
scripts.js
jquery.fitvids.js
js.cookie.js
jquery.lazyloadxt.extra.js
*/

/* https://github.com/mkleehammer/gulp-deporder */


(function($) {

	$(document).ready(function() {


		setTimeout(function(){ 
			$( "#logo-layer" ).fadeOut( 2000, function() {
				$(this).css('z-index', '0');
			});				
		 }, 2500);
			


		var $wrapper = $('.wrapper');

		// addClass sm or lg on width detection
		var bp =  769;// 1025;
		
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

	    	








		var tab_land = window.matchMedia("(min-width: 769px)"); // prev 1024px
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

				console.log('wtf');
			
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