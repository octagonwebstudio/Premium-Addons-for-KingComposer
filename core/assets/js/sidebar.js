/*!
 * Custom Sidebar v1.0
 *
 * 
 * Copyright (c) octagon web studio
 *
 */

(function($) {
	'use strict';

	var add_custom_sidebar = function ( $this ) {

		var $form = $this.closest( '.add-sidebar-form' ),
			sidebarName = $form.find( 'input.custom_sidebar' ).val();

		if( $this.hasClass( 'loading' ) ) {
			return;
		}

		$this.addClass( 'loading' );

		$.ajax({
			type: "POST",
			url: octagon_core_obj.ajaxurl,
			data: {
				'action' : 'add_custom_sidebar',
				'sidebar_name' : sidebarName
			},
		}).done(function( result ) {

			$this.removeClass( 'loading' );

			var $result = $( result ),
				$list = $result.find('ul').html();

			$( '.sidebar-lists .custom-sidebar ul' ).html( $list );
			$form.find( 'input.custom_sidebar' ).val( '' );
		});
	},

	remove_custom_sidebar = function ( $this ){

		var sidebarId = $this.data('sidebar-id');

		if( $this.hasClass( 'loading' ) ) {
			return;
		}

		$this.addClass( 'loading' );

		$.ajax({
			type: "POST",
			url: octagon_core_obj.ajaxurl,
			data: {
				'action' : 'remove_custom_sidebar',
				'sidebar_id' : sidebarId
			},
		}).done(function( result ) {

			$this.removeClass( 'loading' );
			
			var $result = $( result ),
				$list = $result.find('ul').html();

			$('.sidebar-lists .custom-sidebar ul').html( $list );

		});
	};
  
	$( window ).load(function() {
		
		$('.add-sidebar-form').on('click', '.add_custom_sidebar', function(e) {
			e.preventDefault();

			add_custom_sidebar( $(this) );
		});

		$('.sidebar-lists').on('click', '.remove_custom_sidebar', function(e) {
			e.preventDefault();

			remove_custom_sidebar( $(this) );
		});

	});

})(jQuery);