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

if( ! class_exists( 'Octagon_KC_Elements_Enqueue_scripts' ) ) {

	class Octagon_KC_Elements_Enqueue_scripts {

		public function __construct() {

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			
		}

		/**
		 * Enqueue Scripts
		 * 
		 * @since  1.0
		 */
		public function enqueue_scripts() {

			/* ---------------------------------------------------------------------------
			 * CSS
			------------------------------------------------------------------------------ */

			wp_register_style( 'octagon-kc-element-advance-button', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/advance-button.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-advance-counter', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/advance-counter.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-content-type', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/content-type.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-content-type-list', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/content-type-list.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-content-type-slider', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/content-type-slider.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-gradient-text', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/gradient-text.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-image-box', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/image-box.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-icon-box', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/icon-box.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-image-mask', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/image-mask.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-info-icons', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/info-icons.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-timeline', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/timeline.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-slick-gallery', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/slick-gallery.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-portfolio', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/portfolio.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-portfolio-slider', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/portfolio-slider.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-portfolio-extend-slider', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/portfolio-extend-slider.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-team', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/team.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-team-slider', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/team-slider.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-testimonial-slider', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/testimonial-slider.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-video-popup', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/video-popup.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );

			wp_register_style( 'octagon-kc-element-products', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/products.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-products-list', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/products-list.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-products-slider', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/products-slider.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-compare-product', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/compare-product.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );
			wp_register_style( 'octagon-kc-element-wishlist', OCTAGON_KC_ELEMENTS_URL . 'assets/css/shortcodes/wishlist.css', array() , OCTAGON_KC_ELEMENTS_VERSION, 'all' );

			/* ---------------------------------------------------------------------------
			 * JQuery
			------------------------------------------------------------------------------ */

			wp_enqueue_script( 'octagon-kc-elements-scripts', OCTAGON_KC_ELEMENTS_URL . 'assets/js/scripts.js', array( 'jquery' ), '1.0', true );

			// Localize scripts
			$object = array( 
				'ajax_url'          => esc_url( admin_url( 'admin-ajax.php' ) ),
				'root_url'          => esc_url( home_url( '/' ) )
			);

			octagon_concatenate_localize_scripts( 'octagon-kc-elements-scripts', 'octagon_localize', $object );
		}

	}

	new Octagon_KC_Elements_Enqueue_scripts;

}