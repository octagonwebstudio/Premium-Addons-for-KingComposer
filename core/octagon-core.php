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

if( ! class_exists( 'Octagon_Core' ) ) {

	class Octagon_Core {

		/**
		 * Core Version.
		 *
		 */
		public $version = '1.0';

		/**
		 * The single instance of the class.
		 *
		 * @since 1.0
		 */
		protected static $_instance = null;

		/**
		 * Plugin Core Instance.
		 *
		 * Ensures only one instance of Core is loaded or can be loaded.
		 *
		 * @since 1.0
		 * @static
		 * @return Core - Main instance.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Constructor.
		 */
		public function __construct() {

			$this->define_constants();
			$this->includes();
			$this->load_dynamic_css();

			do_action( 'octagon_core_loaded' );
			
		}

		/**
		 * Define Constants.
		 */
		private function define_constants() {
			$this->define( 'OCTAGON_CORE_VERSION', $this->version );
			$this->define( 'OCTAGON_CORE_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'OCTAGON_CORE_URL', plugin_dir_url( __FILE__ ) );
		}

		/**
		 * Include required files
		 * 
		 * @since  1.0
		 */
		public function includes() {

			include_once OCTAGON_CORE_PATH . 'class-admin-page.php';
			include_once OCTAGON_CORE_PATH . 'class-custom-css.php';
			include_once OCTAGON_CORE_PATH . 'class-image-crop.php';
			include_once OCTAGON_CORE_PATH . 'helper-functions.php';
			include_once OCTAGON_CORE_PATH . 'theme-functions.php';
			include_once OCTAGON_CORE_PATH . 'theme-hooks.php';
			include_once OCTAGON_CORE_PATH . 'class-enqueue-fonts.php';
			include_once OCTAGON_CORE_PATH . 'class-enqueue-scripts.php';
			include_once OCTAGON_CORE_PATH . 'customize-options.php';
			include_once OCTAGON_CORE_PATH . 'class-sidebar.php';
			include_once OCTAGON_CORE_PATH . 'class-post-type.php';
			include_once OCTAGON_CORE_PATH . 'class-post-columns.php';
			include_once OCTAGON_CORE_PATH . 'class-duplicate-post.php';
			include_once OCTAGON_CORE_PATH . 'class-taxonomy-image.php';
			include_once OCTAGON_CORE_PATH . 'class-metabox.php';
			include_once OCTAGON_CORE_PATH . 'class-icon-manager.php';
			include_once OCTAGON_CORE_PATH . 'class-custom-css.php';
			
		}

		/**
		 * Load Dynamic CSS
		 * 
		 * @since  1.0
		 */
		public function load_dynamic_css() {

			$core = new Octagon_Core_Custom_CSS(
				array(
					'cache-name' => 'octagon-core',
					'file-path'  => OCTAGON_CORE_PATH . '/custom-styles.php'
				)
			);
			
		}

		/**
		 * Define constant if not set.
		 *
		 * @param string      $name  Constant name.
		 * @param string|bool $value Constant value.
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}
	}
}

/**
 * Main instance.
 *
 * Returns the main instance of Core.
 *
 * @since  1.0
 * @return Octagon_Core
 */
function OWS() {
	return Octagon_Core::instance();
}

// Global for backwards compatibility.
$GLOBALS['OWS'] = OWS();