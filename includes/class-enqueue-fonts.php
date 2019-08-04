<?php
/**
 *
 * @package Octagon KC Elements
 * @author Octagon
 * @version 1.0
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! class_exists( 'Octagon_KC_Elements_Enqueue_Fonts' ) ) {

	class Octagon_KC_Elements_Enqueue_Fonts extends Octagon_Core_Enqueue_Fonts {

		public function __construct() {
			add_filter( 'octagon_enqueue_fonts_list', array( $this, 'fonts_list' ), 10, 1 );			
		}

		/**
		 * Returns fonts set array
		 * 
		 * @since  1.0
		 * @param  array $fonts    Fonts array set
		 * @return string
		 */
		public function fonts_list( $fonts ) {

			// Advance Typography
			$fonts[] = get_theme_mod( 'content_type_title', array() );

			$fonts = array_filter( $fonts );

			return $fonts;

		}

	}

	new Octagon_KC_Elements_Enqueue_Fonts;

}