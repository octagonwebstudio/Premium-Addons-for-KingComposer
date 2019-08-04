<?php
/**
 *
 * @package Octagon Core
 * @author Octagon
 * @version 1.0
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! class_exists( 'Octagon_Core_Enqueue_Fonts' ) ) {

	class Octagon_Core_Enqueue_Fonts {

		public function __construct() {

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			
		}

		/**
		 * Enqueue Scripts
		 * 
		 * @since  1.0
		 */
		public function enqueue_scripts() {

			wp_enqueue_style( 'octagon-fonts', $this->fonts_enqueue_url(), array(), OCTAGON_CORE_VERSION, 'all' );

		}

		/**
		 * Build Google fonts url
		 * 
		 * @since  1.0
		 * @return string
		 */
		public function fonts_enqueue_url() {

			$fonts = array();

			// Default
			$default_collection[] = get_theme_mod( 'heading_font', 'inherit' );
			$default_collection[] = get_theme_mod( 'content_font', 'inherit' );

			$font_weight  = get_theme_mod( 'font_weight', array( 'regular', '100', '500', '600', '700' ) );
			$font_subsets = get_theme_mod( 'font_subsets', array( 'latin' ) );

			// Build up the default font array set
			foreach( $default_collection as $key => $collection ) {

				if( 'inherit' != $collection ) {
					$font_key = trim( strtolower( str_replace( ' ', '-', $collection ) ) );

					if( ! array_key_exists( $font_key, $fonts ) ) {
						$fonts[$font_key]['font-family'] = $collection;
						$fonts[$font_key]['font-weight'] = array_unique( array_merge( $font_weight, array( 'regular', '100', '500', '600', '700' ) ) );
					}
				}
								
			}


			// Advance Typography
			$fonts_collection = apply_filters( 'octagon_enqueue_fonts_list', array() );
			$fonts_collection = array_filter( $fonts_collection );

			// Build up the advance typography font array set
			if( ! empty( $fonts_collection ) ) {
				foreach( $fonts_collection as $key => $collection ) {

					if( isset( $collection['font-family'] ) && 'inherit' != $collection['font-family'] ) {

						$font_key = trim( strtolower( str_replace( ' ', '-', $collection['font-family'] ) ) );

						$font_family = isset( $collection['font-family'] ) ? $collection['font-family'] : '';
						$font_weight = isset( $collection['font-weight'] ) ? $collection['font-weight'] : '';

						if( ! array_key_exists( $font_key, $fonts ) ) {
							$fonts[$font_key]['font-family'] = $font_family;
							$fonts[$font_key]['font-weight'][] = $font_weight;
						}
						else {
							if( ! in_array( $font_weight, $fonts[$font_key]['font-weight'] ) ) {
								$fonts[$font_key]['font-weight'][] = $font_weight;
							}
						}
					}					
				}
			}

			// Combine the font family and varaint to make font enqueue url as array
			if( ! empty( $fonts ) ) {
				foreach( $fonts as $key => $font ) {
					$font_set[] = $font['font-family'] . ':' . implode( ',', $font['font-weight'] );				
				}
			}

			if( ! empty( $font_set ) ) {
				$fonts_url = add_query_arg( array(
					'family' => urlencode( implode( '|', $font_set ) ),
					'subset' => implode( ',', $font_subsets )
				), '//fonts.googleapis.com/css' );

				return $fonts_url;

			}

		}

	}

	new Octagon_Core_Enqueue_Fonts;

}