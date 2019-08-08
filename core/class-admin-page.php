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
	
if( ! class_exists( 'Octagon_Core_Admin_Page' ) ) {

	class Octagon_Core_Admin_Page {

		public $data = array();

		public $error = array();

		public $active_plugins = array();

		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 99 );
			
		}

		/**
		 * Set variables
		 * 
		 * @version  1.4
		 * @since  1.0
		 */
		public function set_variable() {

			global $wpdb;

			$this->data['status']['homeurl']        = esc_url( home_url() );
			$this->data['status']['siteurl']        = esc_url( get_option( 'siteurl' ) );
			$this->data['status']['wp_version']     = get_bloginfo( 'version' );
			$this->data['status']['multisite']      = is_multisite() ? esc_html__( 'Yes', 'octagon-kc-elements' ) : esc_html__( 'No', 'octagon-kc-elements' );
			$this->data['status']['memory_limit']   = wp_convert_hr_to_bytes( @ini_get( 'memory_limit' ) );
			$this->data['status']['debug']          = ( WP_DEBUG === true ) ? esc_html__( 'Active', 'octagon-kc-elements' ) : esc_html__( 'Not Active', 'octagon-kc-elements' );
			$this->data['status']['language']       = get_locale();
			$this->data['status']['text_direction'] = is_rtl() ? 'RTL' : 'LTR';
			$this->data['status']['child_theme']    = is_child_theme() ? esc_html__( 'Active', 'octagon-kc-elements' ) : esc_html__( 'Not Active', 'octagon-kc-elements' );			
			$this->data['status']['server']         = function_exists( 'octagon_get_server_info' ) ? octagon_get_server_info() : '';
			$this->data['status']['mysql']          = $wpdb->db_version();
			$this->data['status']['php_version']    = phpversion();
			$this->data['status']['post_max_size']  = wp_convert_hr_to_bytes( ini_get( 'post_max_size' ) );
			$this->data['status']['time_limit']     = ini_get( 'max_execution_time' );
			$this->data['status']['max_input_vars'] = ini_get( 'max_input_vars' );
			$this->data['status']['upload_size']    = size_format( wp_max_upload_size() );
			$this->data['status']['curl']           = extension_loaded( 'curl' ) ? esc_html__( 'Active', 'octagon-kc-elements' ) : esc_html__( 'Not Active', 'octagon-kc-elements' );
			$this->data['status']['dom']            = class_exists( 'DOMDocument' ) ? esc_html__( 'Active', 'octagon-kc-elements' ) : esc_html__( 'Not Active', 'octagon-kc-elements' );

		}

		/**
		 * Set status notice
		 * 
		 * @since  1.0
		 */
		public function set_notice() {

			/* Memory Limit */
			if( 134217728 <= $this->data['status']['memory_limit'] && 268435456 >= $this->data['status']['memory_limit'] ) {
				$this->data['notice']['memory_limit'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-orange">Good</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => ''
				);
			}
			elseif( 536870900 < $this->data['status']['memory_limit'] ) {
				$this->data['notice']['memory_limit'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-green">Better</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => ''
				);
			}
			if( 134217727 > $this->data['status']['memory_limit'] ) {
				$this->data['notice']['memory_limit'] = array(
					'title' => esc_html__( 'Memory Limit:', 'octagon-kc-elements' ),
					'value' => size_format( $this->data['status']['memory_limit'] ),
					'batch' => wp_kses( __( '<span class="batch batch-red">Critical</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => wp_kses( __( 'Minimum <strong>128 MB</strong> is required, <strong>256 MB</strong> is recommended.', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ), 'strong' => array() ) )
				);

				$this->add_error_notice( 'status', $this->data['notice']['memory_limit'] );

			}

			/* PHP Version */
			if( version_compare( $this->data['status']['php_version'], '7.0', '<' ) ) {
				$this->data['notice']['php_version'] = array(
					'title' => esc_html__( 'PHP Version:', 'octagon-kc-elements' ),
					'value' => $this->data['status']['php_version'],
					'batch' => wp_kses( __( '<span class="batch batch-red">Critical</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => wp_kses( sprintf( __( '<span class="list-info">%s - We recommend using PHP version 7.0 or above for greater performance and security.</span>', 'octagon-kc-elements' ), esc_html( $this->data['status']['php_version'] ) ), array( 'span' => array( 'class' => array() ) ) ),
				);

				$this->add_error_notice( 'status', $this->data['notice']['php_version'] );

			}
			else {
				$this->data['notice']['php_version'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-green">Better</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => ''
				);
			}

			/* Post Max Size */
			if( 134217728 > $this->data['status']['post_max_size'] ) {
				$this->data['notice']['post_max_size'] = array(
					'title' => esc_html__( 'Post Max Size:', 'octagon-kc-elements' ),
					'value' => size_format( $this->data['status']['post_max_size'] ),
					'batch' => wp_kses( __( '<span class="batch batch-red">Critical</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => wp_kses( __( 'Minimum <strong>128 MB</strong> is required, <strong>256 MB</strong> is recommended.', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ), 'strong' => array() ) )
				);

				$this->add_error_notice( 'status', $this->data['notice']['post_max_size'] );

			}
			elseif( 134217728 < $this->data['status']['post_max_size'] && 268435456 >= $this->data['status']['post_max_size'] ) {
				$this->data['notice']['post_max_size'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-orange">Good</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => ''
				);
			}
			elseif( 536870900 < $this->data['status']['post_max_size'] ) {
				$this->data['notice']['post_max_size'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-green">Better</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => ''
				);
			}

			/* Time Limit */
			if( 120 > $this->data['status']['time_limit'] ) {
				$this->data['notice']['time_limit'] = array(
					'title' => esc_html__( 'Time Limit:', 'octagon-kc-elements' ),
					'value' => $this->data['status']['time_limit'],
					'batch' => wp_kses( __( '<span class="batch batch-red">Critical</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => wp_kses( sprintf( __( '<span class="list-info">%s - is not enough to run this theme properly.', 'octagon-kc-elements' ), esc_html( $this->data['status']['time_limit'] ) ), array( 'span' => array( 'class' => array() ) ) )
				);

				$this->add_error_notice( 'status', $this->data['notice']['time_limit'] );

			}
			elseif( 120 <= $this->data['status']['time_limit'] && 180 > $this->data['status']['time_limit'] ) {
				$this->data['notice']['time_limit'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-orange">Good</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => wp_kses( sprintf( __( '<span class="list-info">%s - is OK, But <strong>180</strong> is recommended.', 'octagon-kc-elements' ), esc_html( $this->data['status']['time_limit'] ) ), array( 'span' => array( 'class' => array() ), 'strong' => array() ) )
				);
			}
			elseif( 180 <= $this->data['status']['time_limit'] ) {
				$this->data['notice']['time_limit'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-green">Better</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => ''
				);
			}

			/* Max Input Vars */
			if( 2500 > $this->data['status']['max_input_vars'] ) {
				$this->data['notice']['max_input_vars'] = array(
					'title' => esc_html__( 'Max Input Vars:', 'octagon-kc-elements' ),
					'value' => $this->data['status']['max_input_vars'],
					'batch' => wp_kses( __( '<span class="batch batch-red">Critical</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => wp_kses( sprintf( __( '<span class="list-info">%s - is not enough to run this theme properly.', 'octagon-kc-elements' ), esc_html( $this->data['status']['max_input_vars'] ) ), array( 'span' => array( 'class' => array() ) ) )
				);

				$this->add_error_notice( 'status', $this->data['notice']['max_input_vars'] );

			}
			elseif( 2500 <= $this->data['status']['max_input_vars'] && 5000 > $this->data['status']['max_input_vars'] ) {
				$this->data['notice']['max_input_vars'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-orange">Good</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => wp_kses( sprintf( __( '<span class="list-info">%s - is OK, But <strong>10000</strong> is recommended.', 'octagon-kc-elements' ), esc_html( $this->data['status']['max_input_vars'] ) ), array( 'span' => array( 'class' => array() ), 'strong' => array() ) )
				);
			}
			elseif( 10000 <= $this->data['status']['max_input_vars'] ) {
				$this->data['notice']['max_input_vars'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-green">Better</span>', 'octagon-kc-elements' ), array( 'span' => array( 'class' => array() ) ) ),
					'info'  => ''
				);
			}

		}

		/**
		 * Set error notice
		 * 
		 * @since  1.0
		 */
		public function add_error_notice( $key, $notice ) {

			$this->error[$key][] = $notice;

			return $this->error;

		}

		/**
		 * Admin Menu
		 * 
		 * @since  1.0
		 */
		public function admin_menu() {

			$this->set_variable();
			$this->set_notice();

			add_menu_page( esc_html_x( 'Octagon', 'admin-menu', 'octagon-kc-elements' ), esc_html_x( 'Octagon', 'admin-menu', 'octagon-kc-elements' ), 'administrator', 'octagon-intro', array( $this, 'welcome' ), 'dashicons-admin-generic', 70 );
			
			add_submenu_page( 'octagon-intro', esc_html_x( 'Welcome', 'admin-menu', 'octagon-kc-elements' ), esc_html_x( 'Welcome', 'admin-menu', 'octagon-kc-elements' ), 'administrator', 'octagon-intro', array( $this, 'welcome' ) );
			add_submenu_page( 'octagon-intro', esc_html_x( 'Status', 'admin-menu', 'octagon-kc-elements' ), esc_html_x( 'Status', 'admin-menu', 'octagon-kc-elements' ), 'administrator', 'octagon-status', array( $this, 'status' ) );
			add_submenu_page( 'octagon-intro', esc_html_x( 'Sidebar', 'admin-menu', 'octagon-kc-elements' ), esc_html_x( 'Sidebar', 'admin-menu', 'octagon-kc-elements' ), 'administrator', 'octagon-sidebar', array( $this, 'sidebar' ) );
		}

		/**
		 * Welcome
		 * 
		 * @version  1.0
		 * @since  1.0
		 */
		public function welcome() {

			include_once OCTAGON_CORE_PATH . '/views/html-welcome.php';

		}

		/**
		 * Status
		 * 
		 * @version  1.0
		 * @since  1.0
		 */
		public function status() {

			include_once OCTAGON_CORE_PATH . '/views/html-system-status.php';

		}

		/**
		 * Custom Sidebar
		 * 
		 * @since  1.0
		 */
		public function sidebar() {

			include_once OCTAGON_CORE_PATH . '/views/html-sidebar.php';

		}

	}

	new Octagon_Core_Admin_Page;

}