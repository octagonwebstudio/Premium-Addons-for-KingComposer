/*!
 * IconPicker v1.0
 *
 * 
 * Copyright (c) octagon web studio
 *
 */

(function($) {

	$.octagonIconPicker = function( con, options ){

		// Store variables in parent class object
		this.$con = $(con);

		this._build();
	};

	$.octagonIconPicker.prototype = {

		_build: function() {

			this.bindEvent();
		},

		bindEvent: function() {

        	var parentClass = this;

        	parentClass.$con.on('click', '.js-icon-picker-btn', function(e) {
        		e.preventDefault();
        		parentClass.iconSelectWindow( this );
        	});

        	parentClass.$con.on('click', 'i', function(e) {

        		e.preventDefault();

        		var $this = $(this),
        			className = $this.attr( 'class' ),
        			$field = $this.closest( '.icon-picker-field' ),
					$iconList = $field.find( '.icons-lists' ),
					$input = $field.find( '.icon-picker-textfield' );

        		$iconList.find( 'i' ).removeClass( 'active' );
        		$this.addClass( 'active' );

        		$field.find( '.current-icon' ).addClass( className );
        		$input.val( className );
        	});

        	parentClass.$con.on('click', '.js-icon-picker-close-window', function(e) {

        		e.preventDefault();

        		var $this = $(this),
        			$field = $this.closest( '.icon-picker-field' ),
					$iconList = $field.find( '.icons-lists' ),
					$closeIcon = $field.find( '.js-icon-picker-close-window' );

        		$iconList.fadeOut( 400 );
				$closeIcon.fadeOut( 0 );

        	});

        	parentClass.$con.on('change', 'select', function(e) {
        		e.preventDefault();
        		
        		var $this = $(this),
        			iconSet = $this.val(),
        			$field = $this.closest( '.icon-picker-field' );

        		$field.find( '.'+iconSet ).fadeIn( 400 ).siblings( 'div' ).fadeOut( 0 );

        	});
        },

		iconSelectWindow: function( btn ) {

			var $field = $(btn).closest( '.icon-picker-field' ),
				$iconList = $field.find( '.icons-lists' ),
				$input = $field.find( '.icon-picker-textfield' ),
				$closeIcon = $field.find( '.js-icon-picker-close-window' ),
				currentVal = $input.val();

			if( $field.find( '.icon-content' ).length ) {
				$closeIcon.fadeIn( 0 );
				$iconList.fadeIn( 400 );
			}
			else {

				$.ajax({
					type: 'post',
					url: octagon_core_obj.ajaxurl,
					data: {
						'action' : 'icon_manager',
						'value' : currentVal
					},
				}).done(function( result ) {
					$closeIcon.fadeIn( 0 );
					$iconList.html( result );
					$iconList.fadeIn( 400 );
				});

			}
		}

	};

	$.fn.octagonIconPicker = function( options ) {

		// Initialize
		return this.each(function() {
			if( ! $( this ).data( 'init-icon-picker' ) ) {
				$( this ).data( 'init-icon-picker', new $.octagonIconPicker( this, options ) );
			}
		});
	
	};

	$( '.field-icon_picker' ).octagonIconPicker();	

}(jQuery));