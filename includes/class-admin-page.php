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
	
if( ! class_exists( 'Octagon_KC_Elements_Admin_Page' ) ) {

	class Octagon_KC_Elements_Admin_Page extends Octagon_Core_Admin_Page {

		public function __construct() {
			add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 99 );
			
		}

		public static function plugin_row_meta( $links, $file ) {

			if( OCTAGON_KC_ELEMENTS_BASENAME === $file ) {
				$links['video-tut'] = '<a href="//www.youtube.com/channel/UCZKSopOEW-ivQRpaMlz8uEQ">' . esc_html__( 'Video Tutorial', 'octagon-kc-elements' ) . '</a>';
				$links['knowledgebase'] = '<a href="//doc.octagonwebstudio.com/octagon-kc-elements/">' . esc_html__( 'Knowledgebase', 'octagon-kc-elements' ) . '</a>';
				$links['support']   = '<a href="mailto:octagonwebstudio@gmail.com">' . esc_html__( 'Premium Support', 'octagon-kc-elements' ) . '</a>';
			}

			return $links;
		}

		/**
		 * Admin Menu
		 * 
		 * @since  1.0
		 */
		public function admin_menu() {
			add_submenu_page( 'octagon-intro', esc_html_x( 'Modules', 'admin-menu', 'octagon-kc-elements' ), esc_html_x( 'Modules', 'admin-menu', 'octagon-kc-elements' ), 'administrator', 'octagon-modules', array( $this, 'modules' ) );
		}

		/**
		 * Modules
		 * 
		 * @version  1.0
		 * @since  1.0
		 */
		public function modules() {

			include_once OCTAGON_KC_ELEMENTS_PATH . '/views/html-modules.php';

		}

	}

	new Octagon_KC_Elements_Admin_Page;

}