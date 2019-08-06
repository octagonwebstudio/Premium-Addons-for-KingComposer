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

if( ! class_exists( 'Octagon_Core_Icon_Manager' ) ) {

	class Octagon_Core_Icon_Manager {

		public $css_files = array();

		static public $icons = array();

		public function __construct() {

			add_action( 'init', array( $this, 'get_css_files' ) );
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 99 );

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			add_action( 'wp_ajax_icon_manager',  array( $this, 'print_icons' ) );
			add_action( 'wp_ajax_nopriv_icon_manager', array( $this, 'print_icons' ) );
			
		}

		/**
		 * Admin Menu
		 * 
		 * @since  1.0
		 */
		public function admin_menu() {
			add_submenu_page( 'octagon-intro', esc_html_x( 'Icon Manager', 'admin-menu', 'octagon-kc-elements' ), esc_html_x( 'Icon Manager', 'admin-menu', 'octagon-kc-elements' ), 'administrator', 'octagon-icon-manager', array( $this, 'icon_manager' ) );
		}

		/**
		 * Icon Manager
		 * 
		 * @version  1.0
		 * @since  1.0
		 */
		public function icon_manager() {

			include_once OCTAGON_CORE_PATH . '/views/html-icon-manager.php';

		}

		/**
		 * Return Icon Set
		 * 
		 * @since  1.0
		 */
		public static function get_icon_set() {

			self::$icons['basic']['path']  = OCTAGON_CORE_PATH .'/assets/css/icon-basic.css';
			self::$icons['basic']['url']   = OCTAGON_CORE_URL .'/assets/css/icon-basic.css';
			
			self::$icons['social']['path'] = OCTAGON_CORE_PATH .'/assets/css/icon-social.css';
			self::$icons['social']['url']  = OCTAGON_CORE_URL .'/assets/css/icon-social.css';

			self::$icons = apply_filters( 'octagon_icons_list', self::$icons );

			// It helps to retrieve icons globally
			return self::$icons;
		}

		/**
		 * Icon Manager
		 * 
		 * @since  1.0
		 */
		public function get_css_files() {

			$iconset = get_option( 'octagon_icon_set', array( 'basic', 'social' ) );

			foreach( $this->get_icon_set() as $key => $set ) {

				if( in_array( $key, $iconset ) ) {
					$this->css_files[$key] = $set;
				}
				
			}
			
		}			

		/**
		 * Print Icons
		 * 
		 * @since  1.0
		 */
		public function print_icons() {

			$value = isset( $_POST['value'] ) ? sanitize_html_class( $_POST['value'] ) : '';
			
			$icons = $this->initialize_icons( $this->css_files, $value );

			echo $icons;

			die();
		}

		/**
		 * Initialize Icons
		 * 
		 * @since  1.0
		 */
		public function initialize_icons( $css_files = array(), $value = '' ) {

			$tab_list = $tab_content = $icons_html = '';

			$tab_list_open = '<select>';
			$tab_list_close = '</select>';

			$i = 0; foreach( $css_files as $key => $file ) {

				$tab_list .= '<option value="'. esc_attr( $key ) .'">'. esc_html( ucwords( $key ) ) .'</option>';

				$tab_content .= $this->get_icons( $i, $key, $file['path'], $value );

			$i++; }

			if( count( $css_files ) > 1 ) {

				$icons_html .= $tab_list_open . $tab_list . $tab_list_close;
			}
			
			$icons_html .= $tab_content;

			return $icons_html;

		}

		/**
		 * Initialize Icons
		 * 
		 * @since  1.0
		 */
		public function get_icons( $i = 0, $key = '', $file = '', $active_value = '' ) {

			if( empty( $file ) ) {
				return;
			}

			WP_Filesystem();

			global $wp_filesystem;

			$data = $wp_filesystem->get_contents( $file );

			$data = explode( ':before', $data );

			$active = ( 0 == $i ) ? 'active' : '';

			$tab_content = '<div class="'. octagon_make_class( $key .' icon-content '. $active ) .'">';

			foreach( $data as $key => $value ) {

				if( 0 == $key ) {
					continue;
				}

				$value = explode( '.', $value );
				$value = isset( $value[1] ) ? $value[1] : '';

				$icon_class = preg_replace( '/[^a-z-0-9]/', '', $value );

				if( empty( $icon_class ) ) {
					continue;
				}

				$active_class = ( $icon_class == $active_value ) ? 'active' : '';

				$tab_content .= '<i class="'. octagon_make_class( $icon_class .' '. $active_class ) .'"></i>';
			}

			$tab_content .= '</div>';

			return $tab_content;

		}

		/**
		 * Initialize Icons
		 * 
		 * @since  1.0
		 */
		public function enqueue_scripts() {

			foreach( $this->css_files as $key => $value ) {
				wp_enqueue_style( $key, $value['url'], array() , OCTAGON_CORE_VERSION, 'all' );
			}

		}

	}

	new Octagon_Core_Icon_Manager;

}