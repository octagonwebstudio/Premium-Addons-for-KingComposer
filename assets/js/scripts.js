(function($){

    "use strict";

    /* ---------------------------------------------------------------------------------------------------------
	 * Global Variables
	------------------------------------------------------------------------------------------------------------ */

	var ScrollPos = 0;
	var userAgent = false;



	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * Global Fuctions
	 *
	 * --------------------------------------------------------------------------------------------------------- */


	/* -----------------------------------------------------------------------------------------------------
	 * Post Likes
	 * ----------------------------------------------------------------------------------------------------- */

	var postLikes = function( $this ) {

		var id = $this.data( 'id' );

		if( $this.hasClass( 'loading' ) || $this.hasClass( 'in-the-like' )) {
			return;
		}

		$this.addClass( 'loading' );

		$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : 'octagon_post_likes_ajax',
				'id' : id
			},
		}).done(function( result ) {

			var obj = JSON.parse( result );

			if( 'liked' == obj.like ) {
				$this.addClass( 'in-the-like' );
				$this.find( 'span' ).addClass( 'oct-basic-heart-fill' ).removeClass( 'oct-basic-heart' );
			}
			else {
				$this.removeClass( 'in-the-like' );
				$this.find( 'span' ).addClass( 'oct-basic-heart' ).removeClass( 'oct-basic-heart-fill' );
			}

			$this.removeClass( 'loading' );
			
		});
	},

	/* -----------------------------------------------------------------------------------------------------
	 * Compare Products
	 * ----------------------------------------------------------------------------------------------------- */

	compareProducts = function( $this ) {

		var $con = $this.closest( '.product-icons' ),
			id = $con.data( 'id' );

		$this.addClass( 'loading' );

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : 'octagon_add_compare_products_ajax',
				'id' : id
			},
		}).done(function( result ) {

			var obj = JSON.parse( result );

			$this.removeClass( 'loading' );
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Remove Compare Products
	 * ----------------------------------------------------------------------------------------------------- */

	removeCompareProducts = function( $this ) {

		var $table = $this.closest( '.compare-products-table' ),
			$count = $( '.table-header .count' ),
			$slider = $this.closest( '.compare-product-slide' ),
			total = $slider.data( 'count' ),
			$slide = $this.closest( '.slick-slide' ),
			slideIndex = $slide.data( 'slick-index' ),
			slidesToShow,
			id = $this.data( 'id' );

		$this.addClass( 'loading' );

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action'  : 'octagon_remove_compare_products_ajax',
				'id' : id
			},
		}).done(function( result ) {

			var $result = $( result ),
				notice = $result.html(),
				newCount = $result.data( 'count' );

			if( $count.length ) {
				$count.html( newCount );
			}

			$this.removeClass( 'loading' );

			if( newCount ) {

				slidesToShow = ( 5 < total ) ? 5 : total - 1;
				$slider.data( 'slides-to-show', slidesToShow );

				$( '.compare-product-slide' ).slick( 'slickRemove', slideIndex );
				$( '.compare-product-slide' ).slick( 'unslick' );
				octagon.tools.carousel( '.slick-slider' );

				$slider.data( 'count', total - 1 );

			}
			else {
				$table.html( notice );
			}
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Wishlist
	 * ----------------------------------------------------------------------------------------------------- */

	wishlist = function( $this ) {

		var $con = $this.closest( '.product-icons' ),
			id = $con.data( 'id' );

		$this.addClass( 'loading' );

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action' : 'octagon_wishlist_ajax',
				'id' : id
			},
		}).done(function( result ) {

			var obj = JSON.parse( result );

			if( $this.hasClass( 'in-the-wishlist' ) ) {
				$this.removeClass( 'in-the-wishlist' );
				$this.find( '.oct-basic-heart-fill' ).addClass( 'oct-basic-heart' ).removeClass( 'oct-basic-heart-fill' );
			}
			else {
				$this.addClass( 'in-the-wishlist' );
				$this.find( '.oct-basic-heart' ).addClass( 'oct-basic-heart-fill' ).removeClass( 'oct-basic-heart' );
			}

			$this.removeClass( 'loading' );
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Remove Wishlist
	 * ----------------------------------------------------------------------------------------------------- */

	removeWishlist = function( $this ) {

		var $table = $this.closest( '.wishlist-table' ),
			$tableHead = $table.find( '.table-header' ),
			id = $this.data( 'id' );

		$this.addClass( 'loading' );

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action' : 'octagon_remove_wishlist_ajax',
				'id' : id
			},
		}).done(function( result ) {

			var $result = $( result ),
				notice = $result.html(),
				count = $result.data( 'count' );

			$this.removeClass( 'loading' );

			$this.closest( '.table-content' ).remove();

			if( ! $( '.table-content' ).length ) {
				$table.html( notice );
			}

			if( $tableHead.length ) {
				$tableHead.find( '.count' ).html( count );
			}
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Quick View
	 * ----------------------------------------------------------------------------------------------------- */

	quickView = function( $this ) {

		var $con = $this.closest( '.product-icons' ),
			id = $con.data( 'id' );

		$this.addClass( 'btn-loading' );

    	$.ajax({
			type: 'post',
			url: octagon_localize.ajax_url,
			data: {
				'action' : 'octagon_quick_view_ajax',
				'id' : id
			},
		}).done(function( result ) {

			$this.removeClass( 'btn-loading' );

			appendInDialog( result );			
			
		});

	},

	/* -----------------------------------------------------------------------------------------------------
	 * Append Content in Dialog Box
	 * ----------------------------------------------------------------------------------------------------- */

	appendInDialog = function( content ) {

		if( $( '#dialog-popup' ).length ) { 

			$( '#dialog-content' ).html( content );
			$( '#dialog-popup' ).addClass( 'active' );

			centerDialogPopup();
			octagon.tools.disableScroll();
		}

	},


	/* -----------------------------------------------------------------------------------------------------
	 * Center Dialog Box
	 * ----------------------------------------------------------------------------------------------------- */

	centerDialogPopup = function( $this ) {

		if( $( '#dialog-popup' ).length ) { 

			var windowHeight = $(window).height(),
				centerPosition = ( ( windowHeight/2 ) - 290 ).toFixed(),
				centerPosition = ( centerPosition < 0 ) ? 0 : centerPosition;

			$( '#dialog-content' ).css( 'top', centerPosition + 'px' );

		}

	},


	/* -----------------------------------------------------------------------------------------------------
	 * Reset Dialog Box
	 * ----------------------------------------------------------------------------------------------------- */

	resetDialog = function( $this ) {

		$( '#dialog-content' ).empty();
		$( '#dialog-popup' ).removeClass( 'active' );

		octagon.tools.resetScroll();

	};


	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * $( document ).ready()
	 *
	 * --------------------------------------------------------------------------------------------------------- */

	$( document ).ready( function(){

		/* -----------------------------------------------------------------------------------------------------
		 * General
		 * ----------------------------------------------------------------------------------------------------- */

		$( 'html' ).removeClass( 'no-js' );

		/* -----------------------------------------------------------------------------------------------------
		 * SVG Icon | If img tag contains svg src, it changes the img tag to svg tag
		 * ----------------------------------------------------------------------------------------------------- */

		$( 'img[src$=".svg"]' ).each( function() {

			var $img = $(this),
				imgURL = $img.attr( 'src' );

			$.get( imgURL, function( data ) {

				// Get the SVG tag, ignore the rest
				var $svg = $( data ).find( 'svg' );

				// Remove any invalid XML tags as per http://validator.w3.org
				$svg = $svg.removeAttr( 'xmlns:a' );

				// Check if the viewport is set, if the viewport is not set the SVG wont't scale.
				if( ! $svg.attr( 'viewBox' ) && $svg.attr( 'height' ) && $svg.attr( 'width' ) ) {
					$svg.attr( 'viewBox', '0 0 ' + $svg.attr( 'height' ) + ' ' + $svg.attr( 'width' ) );
				}

				// Replace image with new SVG
				$img.replaceWith( $svg );

			}, 'xml');

		});


		/* -----------------------------------------------------------------------------------------------------
		 * Counter
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.counter' ).length ) {
			$( '.counter .number' ).countimator();
		}


		/* -----------------------------------------------------------------------------------------------------
		 * Post Likes
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.post-loop' ).on('click', '.js-octagon-like', function (e) {

			e.preventDefault();

			postLikes( $( this ) );

		});


		/* -----------------------------------------------------------------------------------------------------
		 * Isotope
		 * ----------------------------------------------------------------------------------------------------- */

		var $selector = $( '.masonry .post-loop:not(.no-isotope), .grid-block .grid-isotope, .js-portfolio-isotope .post-loop' ),
			itemSelector = '.isotope-item',
			columnWidth  = '.isotope-item-sizer';

		if( $selector.length ) {
			$selector.isotope({
				itemSelector: itemSelector,
				percentPosition: true,
				masonry: {
					columnWidth: columnWidth,
				}
			});

			$selector.imagesLoaded().progress( function() {
				$selector.isotope('layout');
			});
		}


		/* -----------------------------------------------------------------------------------------------------
		 * Isotope Filter
		 * ----------------------------------------------------------------------------------------------------- */

		var $con = $( '.js-portfolio-isotope' ),
			$filter = $con.find( '.filter' );

		$filter.find( 'li' ).on('click', function(e) {
			e.preventDefault();

			var $this = $(this),
				$selector = $this.closest( '.js-portfolio-isotope' ).find( '.post-loop' ),
				itemSelector = '.isotope-item',
				columnWidth = '.isotope-item-sizer',
				filter = $this.data( 'filter' );

			$this.addClass( 'active' ).siblings().removeClass( 'active' );
				
			$selector.isotope({
				itemSelector: itemSelector,
				percentPosition: true,
				filter: filter,
				masonry: {
					columnWidth: columnWidth,
				}
			});

			$selector.imagesLoaded().progress( function() {
				$selector.isotope( 'layout' );
			});

		});


		/* -----------------------------------------------------------------------------------------------------
		 * Slick Slider
		 * ----------------------------------------------------------------------------------------------------- */

		octagon.tools.carousel( '.slick-slider' );
		

		/* -----------------------------------------------------------------------------------------------------
		 * Magnific Popup
		 * ----------------------------------------------------------------------------------------------------- */

		octagon.tools.magnifyImage();
		octagon.tools.magnifyGallery();		
		octagon.tools.magnifyVideo();


		/* -----------------------------------------------------------------------------------------------------
		 * Compare Products
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.octagon-compare-product' ).length ) {

			$( '.post-wrapper, .product-quick-view, .recent-products' ).on( 'click', '.octagon-compare-product', function (e) {

				e.preventDefault();

				compareProducts( $( this ) );

			});

		}

		/* -----------------------------------------------------------------------------------------------------
		 * Remove Compare Products
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.remove-compare-list' ).length ) {

			$( '.compare-products-table' ).on( 'click', '.remove-compare-list', function (e) {

				e.preventDefault();

				removeCompareProducts( $( this ) );

			});

		}



		/* -----------------------------------------------------------------------------------------------------
		 * Wishlist
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.octagon-wishlist' ).length ) {

			$( '.post-wrapper, .product-quick-view, .recent-products, .products-grid' ).on( 'click', '.octagon-wishlist', function (e) {

				e.preventDefault();

				wishlist( $( this ) );

			});

		}

		/* -----------------------------------------------------------------------------------------------------
		 * Wishlist
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.remove-wishlist' ).length ) {

			$( '.remove-wishlist' ).on( 'click', function (e) {

				e.preventDefault();

				removeWishlist( $( this ) );

			});

		}


		/* -----------------------------------------------------------------------------------------------------
		 * Quick View
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.octagon-quick-view' ).length ) {

			$( '.post-wrapper, .recent-products' ).on('click', '.octagon-quick-view', function (e) {

				e.preventDefault();

				quickView( $( this ) );

			});

		}


		/* -----------------------------------------------------------------------------------------------------
		 * Remove Quick View
		 * ----------------------------------------------------------------------------------------------------- */

		$( 'body' ).on( 'click', '.quick-view-close', function (e) {

			e.preventDefault();

			resetDialog();

		});
		

	});



	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * $( window ).load()
	 *
	 * --------------------------------------------------------------------------------------------------------- */

	$( window ).on( 'load', function(){
		

		/* -----------------------------------------------------------------------------------------------------
		 * Loadmore
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.btn-loadmore' ).on('click', 'a', function(e) {
    		e.preventDefault();

    		var $this = $( this ),
    			$btn = $this.closest( '.btn-loadmore' ),
    			type = $btn.data( 'type' );

    		if( ! $btn.find( 'a' ).hasClass( 'loading' ) ) {
    			if( 'query' == type ) {
	    			octagon.tools.queryLoadMore( $this );
	    		}
	    		else {
	    			octagon.tools.pageLoadMore( $this );
	    		}
    		}    		
    		
    	});

	});



	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * $( window ).on( 'scroll' )
	 *
	 * --------------------------------------------------------------------------------------------------------- */

	var timer;

	$( window ).on( 'scroll', function(){

		var currentScrollPos = $( this ).height() + $( this ).scrollTop();

		/* -----------------------------------------------------------------------------------------------------
		 * Infinite Scroll
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.infinite-scroll' ).length ) {

			var $this = $( '.infinite-scroll a' ),
    			$btn = $this.closest( '.infinite-scroll' ),
    			type = $btn.data( 'type' ),
    			targetOffset = $btn.offset().top;

			if( currentScrollPos > targetOffset ) {	    

	    		if( ! $btn.find( 'a' ).hasClass( 'loading' ) ) {
	    			if( 'query' == type ) {
		    			octagon.tools.queryLoadMore( $this );
		    		}
		    		else {
		    			octagon.tools.pageLoadMore( $this );
		    		}
	    		}

			}
		}

		/* -----------------------------------------------------------------------------------------------------
		 * Triggers on scroll stops
		 * ----------------------------------------------------------------------------------------------------- */

		clearTimeout( timer );

		timer = setTimeout(function() {
			$(window).trigger( 'scrollStop' );
		}, 60 );
		

	});

})(jQuery);
