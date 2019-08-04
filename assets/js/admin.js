(function($){

    "use strict";

    /* ---------------------------------------------------------------------------------------------------------
	 * Global Variables
	------------------------------------------------------------------------------------------------------------ */

	var ScrollPos = 0;


	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * Global Fuctions
	 *
	 * --------------------------------------------------------------------------------------------------------- */


	/* ---------------------------------------------------------------------------------------------------------
	 * Random String
	------------------------------------------------------------------------------------------------------------ */

	var random = function() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for( var i = 0; i < 5; i++ ) {
			text += possible.charAt( Math.floor( Math.random() * possible.length ) );
		}

		return text;
	},


	/* ---------------------------------------------------------------------------------------------------------
	 * Price Range Fields
	------------------------------------------------------------------------------------------------------------ */

	appendPriceRangeFields = function( $this ) {

		var $wrap     = $this.closest( '.price-range-fields-wrapper' ),
			$fields   = $wrap.find( '.price-range-fields' ),
			$view     = $wrap.find( '.price-range-fields-view' ),
			baseKey   = $view.data( 'key' ),
			$viewHtml = $view.html(),
			count     = $fields.find( '.fields' ).length;

		$view.find( 'input' ).each(function( index, element ) {
			if( 0 == index ) {
				$( element ).attr( 'name', baseKey+'['+count+'][min]' );
			}
			if( 1 == index ) {
				$( element ).attr( 'name', baseKey+'['+count+'][max]' );
			}
		});

		$fields.append( $wrap.find( '.price-range-fields-view' ).html() );

	},

	/* ---------------------------------------------------------------------------------------------------------
	 * Remove Price Range Fields
	------------------------------------------------------------------------------------------------------------ */

	removePriceRangeFields = function( $this ) {

		var $widget = $this.closest( '.widget' ),
			$wrap   = $this.closest( '.price-range-fields-wrapper' ),
			$priceRangeFields   = $wrap.find( '.price-range-fields' ),
			$view   = $wrap.find( '.price-range-fields-view' ),
			baseKey = $view.data( 'key' ),
			count;

		$this.closest( '.fields' ).remove();

		count = $wrap.find( '.price-range-fields .fields' ).length;

		$priceRangeFields.find( '.fields' ).each(function( fieldIndex, fields ) {
			$( fields ).find( 'input' ).each(function( index, element ) {
				if( 0 == index ) {
					$( element ).attr( 'name', baseKey+'['+fieldIndex+'][min]' );
				}
				if( 1 == index ) {
					$( element ).attr( 'name', baseKey+'['+fieldIndex+'][max]' );
				}
			});
			
		});

		$widget.find( '.widget-control-save' ).removeAttr( 'disabled' );

	},

	/* ---------------------------------------------------------------------------------------------------------
	 * Min / Max Price
	------------------------------------------------------------------------------------------------------------ */

	setMinMaxPrice = function( $this ) {

		var $con = $this.closest( '.fields' ),
			$minField = $con.find( '.min-price' ),
			$maxField = $con.find( '.max-price' ),
			min = $minField.val(),
			max = $maxField.val();

		$maxField.attr( 'min', parseInt( min ) + 1 );
		$minField.attr( 'max', parseInt( max ) - 1 );

	};
	

	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * $( document ).ready()
	 *
	 * --------------------------------------------------------------------------------------------------------- */

	$( document ).ready( function(){

		/* -----------------------------------------------------------------------------------------------------
		 * Toggle / Switch
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.toggle' ).on( 'click', 'span', function() {
					
			var $con = $(this).closest( '.toggle' ),
				value = $(this).data( 'value' );

			$(this).addClass('active').siblings().removeClass( 'in-active active' );
			$con.find('input').val(value);

		});

		/* -----------------------------------------------------------------------------------------------------
		 * Radio Image
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.radio-image' ).on( 'click', 'span', function() {
					
			var $con = $(this).closest( '.radio-image' ),
				value = $(this).data( 'value' );

			$(this).addClass('active').siblings().removeClass( 'in-active active' );
			$con.find('input').val(value);

		});

		/* -----------------------------------------------------------------------------------------------------
		 * Repeatable Fields
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.repeatable-fields' ).on( 'click', '.add-repeatable-field', function( e ) {

			e.preventDefault();
					
			var $con = $(this).closest( '.repeatable-fields' ),
				$template = $con.find( '.repeatable-field-template' ),
				template = $template.html(),
				baseKey = $(this).data( 'index' ),
				$fieldSet = $con.find( '.field-set' ),
				closeText = octagon_core_obj.close_text,
				$toggle = $con.find( '.toggle-repeatable-field' ),
				key = random();

			$fieldSet.slideDown( 400 );
			$toggle.text( closeText );

			$template.find('.field-group .field').each( function( index, el ) {
				var $el = $(el),
					type = $el.data('type'),
					fieldName = $el.data('id');

				if( 'text' == type ) {
					$el.find( 'input' ).attr( 'name', baseKey + '['+key+']' + '['+fieldName+']' );
				}
				
			});

			$fieldSet.append( $con.find( '.repeatable-field-template' ).html() );

		});

		$( '.repeatable-fields' ).on( 'click', '.toggle-repeatable-field', function( e ) {

			e.preventDefault();
					
			var $con = $(this).closest( '.repeatable-fields' ),
				$fieldSet = $con.find( '.field-set' ),
				closeText = octagon_core_obj.close_text,
				expandText = octagon_core_obj.expand_text;

			if( $fieldSet.is( ':visible' ) ) {
				$fieldSet.slideUp( 400 );
				$(this).text( expandText );
			}
			else {
				$fieldSet.slideDown( 400 );
				$(this).text( closeText );
			}			

		});

		/* -----------------------------------------------------------------------------------------------------
		 * Repeatable Fields Sort
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.field-set' ).length ) {
			$( '.field-set' ).sortable();			
		}


		/* -----------------------------------------------------------------------------------------------------
		 * Repeatable Field Delete
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.field-set' ).on( 'click', '.remove-repeatable-field', function( e ) {
			e.preventDefault();

			var $this = $(this);

			$this.closest( '.field-group' ).remove();
		});


		/* -----------------------------------------------------------------------------------------------------
		 * Metabox Tabbed Panel
		 * ----------------------------------------------------------------------------------------------------- */

		$( '.metabox-nav' ).on( 'click', 'li', function() {
			
			var $con = $(this).closest( '.metabox-cover' ),
				value = $(this).data( 'tab' );

			$(this).addClass('active').siblings().removeClass( 'active' );
			$con.find( '.metabox-groups .'+value ).addClass( 'active' ).siblings().removeClass( 'active' );

		});

		/* -----------------------------------------------------------------------------------------------------
		 * On Menu Ajax Stops
		 * ----------------------------------------------------------------------------------------------------- */

		$( '#side-sortables' ).on( 'click', '.submit-add-to-menu', function(e) {
			
			$( document ).ajaxStop(function(e) {

				e.stopPropagation();
				
				$('.custom-media-upload').octagonMediaUploader();
				$('.color-field').wpColorPicker();
				$( '.field-icon_picker' ).octagonIconPicker();	

			});

		});

		/* -----------------------------------------------------------------------------------------------------
		 * Append Price Range Fields
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.add-price-range-field' ).length ) {

			$( '.widgets-holder-wrap' ).on('click', '.add-price-range-field', function (e) {

				e.preventDefault();

				appendPriceRangeFields( $( this ) );

			});

		}

		/* -----------------------------------------------------------------------------------------------------
		 * Remove Price Range Fields
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.remove-price-range-field' ).length ) {

			$( '.widgets-holder-wrap' ).on('click', '.remove-price-range-field', function (e) {

				e.preventDefault();

				removePriceRangeFields( $( this ) );

			});

		}

		/* -----------------------------------------------------------------------------------------------------
		 * Remove Price Range Fields
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.price-range-fields' ).length ) {

			$( '.widgets-holder-wrap' ).on( 'change', '.price-range-fields input', function (e) {

				e.preventDefault();

				setMinMaxPrice( $( this ) );

			});

		}

	});


	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * $( window ).load()
	 *
	 * --------------------------------------------------------------------------------------------------------- */

	$( window ).load( function(){

		/* -----------------------------------------------------------------------------------------------------
		 * Color Picker
		 * ----------------------------------------------------------------------------------------------------- */

		if( $( '.color-field' ).length ) {

			$('.color-field').wpColorPicker();
			
		}

		/* -----------------------------------------------------------------------------------------------------
		 * Additional Kc CSS params
		 * ----------------------------------------------------------------------------------------------------- */

		if( 'undefined' != typeof( window.kc ) ) {

			window.kc.params.fields.css.fields.fill = {
				type: 'color_picker'
			};

			window.kc.params.fields.css.fields.height = {
				type: 'number',
				options: {
					units: ['px','em','%','vh']
				}
			};

			window.kc.params.fields.css.fields['min-height'] = {
				type: 'number',
				options: {
					units: ['px','em','%']
				}
			};

			window.kc.params.fields.css.fields['max-height'] = {
				type: 'number',
				options: {
					units: ['px','em','%']
				}
			};

			window.kc.params.fields.css.fields.top = {
				type: 'number',
				options: {
					units: ['px','%']
				}
			};

			window.kc.params.fields.css.fields.right = {
				type: 'number',
				options: {
					units: ['px','%']
				}
			};

			window.kc.params.fields.css.fields.bottom = {
				type: 'number',
				options: {
					units: ['px','%']
				}
			};

			window.kc.params.fields.css.fields.left = {
				type: 'number',
				options: {
					units: ['px','%']
				}
			};
		}			

	});


	/* ---------------------------------------------------------------------------------------------------------
	 *
	 * $( window ).on( 'scroll' )
	 *
	 * --------------------------------------------------------------------------------------------------------- */

	$( window ).on( 'scroll', function(){

		var currentScrollPos = $(this).height() + $(this).scrollTop();

		/* -----------------------------------------------------------------------------------------------------
		 * General
		 * ----------------------------------------------------------------------------------------------------- */
		

	});	


})( jQuery );