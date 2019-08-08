/*!
 * Octagon JQuery Helpers v1.0
 *
 * 
 * Copyright (c) octagon web studio
 *
 */

(function($){

    "use strict";

    if( typeof( octagon ) == 'undefined' ) {
		window.octagon = {};
	}


	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * Global Fuctions
	 *
	 * --------------------------------------------------------------------------------------------------------- */

	window.octagon.tools = $.extend( {

		/* ---------------------------------------------------------------------------------------------------------
		 * Check User Agent
		------------------------------------------------------------------------------------------------------------ */

		userAgent : function() {

			if( navigator.userAgent.match( /Tablet|iPad/i ) ) {
			    return 'tablet';
			}
			else if( navigator.userAgent.match( /Mobile|Windows Phone|Lumia|Android|webOS|iPhone|iPod|Blackberry|PlayBook|BB10|Opera Mini|\bCrMo\/|Opera Mobi/i ) ) {
			    return 'mobile';
			}
			else {
			    return 'desktop';
			}

		},


		/* ---------------------------------------------------------------------------------------------------------
		 * Random String
		------------------------------------------------------------------------------------------------------------ */

		random : function( n ) {
			var text = "";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

			for( var i = 0; i < n; i++ ) {
				text += possible.charAt( Math.floor( Math.random() * possible.length ) );
			}

			return text;
		},


		/* ---------------------------------------------------------------------------------------------------------
		 * Add Query Arguement | Pass the key and value with current URL to get the proper URL format
		------------------------------------------------------------------------------------------------------------ */

		addQueryArg : function( key, value, url ) {

			var re = new RegExp( "([?&])" + key + "=.*?(&|$)", "i" ),
				separator = url.indexOf( '?' ) !== -1 ? '&' : '?';

			if( url.match( re ) ) {
				return url.replace( re, '$1' + key + "=" + value + '$2' );
			}
			else {
				return url + separator + key + "=" + value;
			}

		},


		/* ---------------------------------------------------------------------------------------------------------
		 * Disable Scroll
		------------------------------------------------------------------------------------------------------------ */

		disableScroll : function() {

			$( 'body' ).css({
				overflow: 'hidden',
				width: '100%',
				height: '100vh'
			});

		},


		/* ---------------------------------------------------------------------------------------------------------
		 * Reset Scroll
		------------------------------------------------------------------------------------------------------------ */

		resetScroll : function() {

			$( 'body' ).css({
				overflow: 'auto',
				width: 'auto',
				height: 'auto'
			});
			
		},


		/* -----------------------------------------------------------------------------------------------------
		 * Slick Slider
		 * ----------------------------------------------------------------------------------------------------- */

		carousel : function( $slider ) {

			$( $slider ).each( function( index, el ) {

				var $this = $( this );

				var obj = {
					'accessibility'    : $this.data( 'accessibility' ),
					'adaptiveHeight'   : $this.data( 'adaptive-height' ),
					'autoplay'         : $this.data( 'autoplay' ),
					'autoplaySpeed'    : $this.data( 'autoplay-speed' ),
					'arrows'           : $this.data( 'arrows' ),
					'asNavFor'         : $this.data( 'as-nav-for' ),
					'appendArrows'     : $this.data( 'append-arrows' ),
					'appendDots'       : $this.data( 'append-dots' ),
					'prevArrow'        : $this.data( 'prev-arrow' ),
					'nextArrow'        : $this.data( 'next-arrow' ),
					'centerMode'       : $this.data( 'center-mode' ),
					'centerPadding'    : $this.data( 'center-padding' ),
					'cssEase'          : $this.data( 'css-ease' ),
					'customPaging'     : $this.data( 'custom-paging' ),
					'dots'             : $this.data( 'dots' ),
					'dotsClass'        : $this.data( 'dots-class' ),
					'draggable'        : $this.data( 'draggable' ),
					'fade'             : $this.data( 'fade' ),
					'focusOnSelect'    : $this.data( 'focus-on-select' ),
					'easing'           : $this.data( 'easing' ),
					'edgeFriction'     : $this.data( 'edge-friction' ),
					'infinite'         : $this.data( 'infinite' ),
					'initialSlide'     : $this.data( 'initial-slide' ),
					'lazyLoad'         : $this.data( 'lazy-load' ),
					'mobileFirst'      : $this.data( 'mobile-first' ),
					'pauseOnFocus'     : $this.data( 'pause-on-focus' ),
					'pauseOnHover'     : $this.data( 'pause-on-hover' ),
					'pauseOnDotsHover' : $this.data( 'pause-on-dots-hover' ),
					'respondTo'        : $this.data( 'respond-to' ),
					'responsive'       : $this.data( 'responsive' ),
					'rows'             : $this.data( 'rows' ),
					'slide'            : $this.data( 'slide' ),
					'slidesPerRow'     : $this.data( 'slides-per-row' ),
					'slidesToShow'     : $this.data( 'slides-to-show' ),
					'slidesToScroll'   : $this.data( 'slides-to-scroll' ),
					'speed'            : $this.data( 'speed' ),
					'swipe'            : $this.data( 'swipe' ),
					'swipeToSlide'     : $this.data( 'swipe-to-slide' ),
					'touchMove'        : $this.data( 'touch-move' ),
					'touchThreshold'   : $this.data( 'touch-threshold' ),
					'useCSS'           : $this.data( 'use-css' ),
					'useTransform'     : $this.data( 'use-transform' ),
					'variableWidth'    : $this.data( 'variable-width' ),
					'vertical'         : $this.data( 'vertical' ),
					'verticalSwiping'  : $this.data( 'vertical-swiping' ),
					'rtl'              : $this.data( 'rtl' ),
					'waitForAnimate'   : $this.data( 'wait-for-animate' ),
					'zIndex'           : $this.data( 'z-index' )
				};

				$this.slick( obj );
			});

		},


		/* -----------------------------------------------------------------------------------------------------
		 * Magnific Popup | Image
		 * ----------------------------------------------------------------------------------------------------- */

		magnifyImage : function() {

			if( typeof(magnificPopup) != 'undefined') {

				$( '.magnify-image' ).magnificPopup({
				    type: 'image',
				    autoFocusLast: false,
					image: {
						titleSrc: function( item ) {
							return item.el.data( 'caption' );
						}
					}
				});
			}
			
		},

		
		/* -----------------------------------------------------------------------------------------------------
		 * Magnific Popup | Gallery
		 * ----------------------------------------------------------------------------------------------------- */

		magnifyGallery : function() {

			if( typeof( magnificPopup ) != 'undefined' ) {
				$( '.magnify-gallery' ).magnificPopup({
					delegate: 'a',
				    type: 'image',
				    gallery: {
			            enabled: true,
			            navigateByImgClick: true
			    	}
				});
			}

		},

		/* -----------------------------------------------------------------------------------------------------
		 * Magnific Popup | Video
		 * ----------------------------------------------------------------------------------------------------- */

		magnifyVideo : function() {

			if( typeof( magnificPopup ) != 'undefined' ) {

				$( '.magnify-video' ).magnificPopup({
					disableOn: 700,
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false
				});

			}
		},


		/* ---------------------------------------------------------------------------------------------------------
		 * Loadmore | It loads loop content via php function
		------------------------------------------------------------------------------------------------------------ */

		queryLoadMore : function( $this ) {

			var $con         = $this.closest( '.loop-container' ),
				$selector    = $con.find( '.ajax-content-pull' ),
				itemSelector = '.isotope-item',
				columnWidth  = '.isotope-item-sizer',
				$btn         = $this.closest( '.btn-loadmore' ),
				uid          = $btn.data( 'uid' ),
				obj          = octagon_localize[uid],
				paged        = $btn.data( 'paged' ),
				isotope      = obj.isotope,
				slider       = obj.slider,
				paged        = parseInt( paged ) + 1;

			$btn.find( 'a' ).addClass( 'loading' );

	    	$.ajax({
				type: 'post',
				url: octagon_localize.ajax_url,
				data: {
					'action'  : obj.ajax,
					'options' : obj['options'],
					'args'    : obj['args'],
					'max'     : obj['max'],
					'paged'   : paged
				},
			}).done(function( result ) {

				$btn.find( 'a' ).removeClass( 'loading' );

				var $result   = $( result ),
					$html     = $( $result.find( '.html-content' ).html() ),
					$items    = $html.find( '.element' ),
					obj       = $result.find( '.json' ).data( 'value' ),
					paged     = obj.paged,
					last_page = obj.last_page;

				if( isotope ) {
					$selector.isotope({
						itemSelector: itemSelector,
						percentPosition: true,
						masonry: {
							columnWidth: columnWidth,
						}
					}).append( $items )
					  .isotope( 'appended', $items );

					$selector.imagesLoaded().progress( function() {
						$selector.isotope('layout');
					});
				}
				else {
					$selector.append( $items );
				}			

				if( ! last_page ) {
					$btn.data( 'paged', paged );
				}
				else {
					$btn.remove();
				}
				
			});
		},


		/* -----------------------------------------------------------------------------------------------------
		 * Loadmore | It loads all the page content and pick the required content and replace it
		 * ----------------------------------------------------------------------------------------------------- */

		pageLoadMore : function( $this ) {

			var $con         = $this.closest( '.loop-container' ),
				$selector    = $con.find( '.post-loop' ),
				itemSelector = '.isotope-item',
				columnWidth  = '.isotope-item-sizer',
				$btn         = $this.closest( '.btn-loadmore' ),
				uid          = $btn.data( 'uid' ),
				obj          = octagon_localize[uid],
				href         = $this.attr( 'href' ),
				isotope      = obj.isotope,
				slider       = obj.slider;

			$btn.find( 'a' ).addClass( 'loading' );

	    	$.get( href, function( data ) {

	    		$btn.find( 'a' ).removeClass( 'loading' );

	    		var $content = $( '.post-loop', data ).html(),
					$newBtn  = $( '.btn-loadmore a', data ),
					href     = $( '.btn-loadmore a', data ).attr( 'href' );

	    		if( isotope ) {

	    			$content = $( $content ).not( '.isotope-item-sizer' );

					$selector.isotope({
						itemSelector: itemSelector,
						percentPosition: true,
						masonry: {
							columnWidth: columnWidth,
						}
					}).append( $content )
					  .isotope( 'appended', $content );

					$selector.imagesLoaded().progress( function() {
						$selector.isotope('layout');
					});
				}
				else {
					$selector.append( $content );
				}
	    		
	    		if( href ) {
					$btn.find( 'a' ).remove();
					$btn.append( $newBtn );
					$btn.show();
				}
				else {
					$btn.find( 'a' ).remove();
				}

	    	});
		}


	});

})(jQuery);
