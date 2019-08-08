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

if( ! class_exists( 'Octagon_Core_Enqueue_scripts' ) ) {

	class Octagon_Core_Enqueue_scripts {

		public function __construct() {

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 99 );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			
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

			wp_enqueue_style( 'bootstrap', OCTAGON_CORE_URL . 'library/css/bootstrap.min.css', array(), '3.3.7', 'all' );
			wp_enqueue_style( 'icon-basic', OCTAGON_CORE_URL . 'assets/css/icon-basic.css', array(), '1.0', 'all' );
			wp_enqueue_style( 'icon-social', OCTAGON_CORE_URL . 'assets/css/icon-social.css', array(), '1.0', 'all' );
			wp_enqueue_style( 'octagon', OCTAGON_CORE_URL . 'assets/css/octagon.css', array(), '1.0', 'all' );
			
			wp_register_style( 'magnific-popup', OCTAGON_CORE_URL . 'library/css/magnific-popup.min.css', array(), '1.1.0', 'all' );
			wp_register_style( 'slick', OCTAGON_CORE_URL . 'library/css/slick.min.css', array(), '1.9.0', 'all' );


			/* ---------------------------------------------------------------------------
			 * JQuery
			------------------------------------------------------------------------------ */

			wp_enqueue_script( 'octagon-core-tools', OCTAGON_CORE_URL . 'assets/js/tools.js', array( 'jquery' ), '1.0', true );

			wp_register_script( 'waypoints', OCTAGON_CORE_URL . 'library/js/waypoints.min.js', array( 'jquery' ), '4.0.1' , false );
			wp_register_script( 'magnific-popup', OCTAGON_CORE_URL . 'library/js/magnific-popup.min.js', array( 'jquery' ), '1.1.0' , false );
			wp_register_script( 'slick', OCTAGON_CORE_URL . 'library/js/slick.min.js', array( 'jquery' ), '1.9.0', false );
			wp_register_script( 'imageloaded', OCTAGON_CORE_URL . 'library/js/imagesloaded.min.js', array( 'jquery' ), '4.1.4', false );
			wp_register_script( 'isotope', OCTAGON_CORE_URL . 'library/js/isotope.min.js', array( 'jquery' ), '3.0.6', false );
			wp_register_script( 'slide-nav', OCTAGON_CORE_URL . 'library/js/slide-nav.min.js', array( 'jquery' ), '1.0.1', false );
			wp_register_script( 'countimator', OCTAGON_CORE_URL . 'library/js/countimator.min.js', array( 'jquery' ), '1.0', false );

			// Localize scripts
			$object = array( 
				'ajax_url' => esc_url( admin_url( 'admin-ajax.php' ) ),
				'root_url' => esc_url( home_url( '/' ) )
			);

			octagon_concatenate_localize_scripts( 'octagon-core-tools', 'octagon_localize', $object );
		}

		/**
		 * Admin Enqueue Scripts
		 * 
		 * @since  1.0
		 */
		public function admin_enqueue_scripts( $hook ) {

			/* ---------------------------------------------------------------------------
			 * CSS
			------------------------------------------------------------------------------ */

			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'octagon-core-admin', OCTAGON_CORE_URL . 'assets/css/admin.css', array() , '1.0', 'all' );
			wp_enqueue_style( 'octagon-icon', OCTAGON_CORE_URL . 'assets/css/octagon-icon.css', array() , '1.0', 'all' );

			/* ---------------------------------------------------------------------------
			 * JQuery
			------------------------------------------------------------------------------ */

			wp_enqueue_script( 'wp-color-picker-alpha', OCTAGON_CORE_URL . 'library/js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), '2.1.3', true );
			wp_enqueue_script( 'octagon-core-icon-picker', OCTAGON_CORE_URL . 'assets/js/icon-picker.js', array(), '1.0', true );
			wp_enqueue_script( 'octagon-core-sidebar', OCTAGON_CORE_URL . 'assets/js/sidebar.js', array(), '1.0', true );

			wp_enqueue_media();
			wp_enqueue_script( 'octagon-core-media-upload', OCTAGON_CORE_URL . 'assets/js/custom-media-upload.js', array(), '1.0', true );
			
			wp_enqueue_script( 'octagon-core-admin', OCTAGON_CORE_URL . 'assets/js/admin.js' , array( 'jquery' ), '1.0' );

			wp_localize_script( 'jquery', 'octagon_core_obj',
				array( 
					'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) )
				)
			);

		}

	}

	new Octagon_Core_Enqueue_scripts;

}