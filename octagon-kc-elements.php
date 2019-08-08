<?php
/**
 * Plugin Name: Premium Addons for KingComposer
 * Plugin URI: https://octagonwebstudio.com
 * Description: Tons of unique shortcodes elements with toggle feature.
 * Version: 1.1.1
 * Author: octagonwebstudio
 * Text Domain: octagon-kc-elements
 * Requires WP:   4.7
 * Requires PHP:  5.6
 * Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! function_exists( 'required_plugin_admin_notice' ) ) {
    /**
	 * Print an admin notice if KingComposer is deactivated
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @return mixed
	 */
    function required_plugin_admin_notice() {
    	?>
        <div class="error">
            <p><?php esc_html_e( 'Premium Addons for KingComposer is enabled but not effective. It requires KingComposer in order to work.', 'octagon-kc-elements' ); ?></p>
        </div>
        <?php
    }
}
	
if( ! class_exists( 'Octagon_KC_Elements' ) ) {

	class Octagon_KC_Elements {

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
			$this->hooks();
			$this->init_core();
			$this->includes();
			$this->load_dynamic_css();

			do_action( 'octagon_kc_elements_loaded' );
			
		}

		/**
		 * Define Constants.
		 */
		private function define_constants() {

			$this->define( 'OCTAGON_KC_ELEMENTS_VERSION', $this->version );
			$this->define( 'OCTAGON_KC_ELEMENTS_BASENAME', plugin_basename( __FILE__ ) );
			$this->define( 'OCTAGON_KC_ELEMENTS_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'OCTAGON_KC_ELEMENTS_URL', plugin_dir_url( __FILE__ ) );
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

		/**
		 * Include core
		 * 
		 * @since  1.0
		 */
		public function init_core() {
			include_once plugin_dir_path( __FILE__ ) . '/core/octagon-core.php';
		}

		/**
		 * Include required files
		 * 
		 * @since  1.0
		 */
		public function includes() {

			include_once OCTAGON_KC_ELEMENTS_PATH . '/includes/helper-functions.php';
			include_once OCTAGON_KC_ELEMENTS_PATH . '/includes/class-woo-hooks.php';
			include_once OCTAGON_KC_ELEMENTS_PATH . '/includes/init-content-types.php';
			include_once OCTAGON_KC_ELEMENTS_PATH . '/includes/init-meta-fields.php';
			include_once OCTAGON_KC_ELEMENTS_PATH . '/includes/customize-options.php';
			include_once OCTAGON_KC_ELEMENTS_PATH . '/includes/class-enqueue-fonts.php';
			include_once OCTAGON_KC_ELEMENTS_PATH . '/includes/class-enqueue-scripts.php';
			include_once OCTAGON_KC_ELEMENTS_PATH . '/includes/class-admin-page.php';
			include_once OCTAGON_KC_ELEMENTS_PATH . '/builder/class-builder.php';
			include_once OCTAGON_KC_ELEMENTS_PATH . '/modules/init-shortcodes.php';
			
		}

		/**
		 * Load Dynamic CSS
		 * 
		 * @since  1.0
		 */
		public function load_dynamic_css() {

			if( class_exists( 'Octagon_Core_Custom_CSS' ) ) {

				$octagon_elements = new Octagon_Core_Custom_CSS(
					array(
						'cache-name' => 'octagon-elements',
						'file-path'  => OCTAGON_KC_ELEMENTS_PATH . '/includes/custom-styles.php'
					)
				);

			}			
			
		}

		/**
		 * Hook into actions and filters.
		 *
		 * @since 1.0
		 */
		private function hooks() {
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
		}

		/**
		 * Plugin localisation
		 * 
		 * @since  1.0
		 */
		public function load_plugin_textdomain() {
		    load_plugin_textdomain( 'octagon-kc-elements', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}	
				
	}
}

/**
 * Main instance.
 *
 * Returns the main instance of Core.
 *
 * @version 1.0
 * @since  1.0
 * @return Octagon_KC_Elements
 */
if( ! function_exists( 'octagon_kc_elements' ) ) {
	function octagon_kc_elements() {
		return Octagon_KC_Elements::instance();
	}
}

if( ! function_exists( 'octagon_kc_elements_free_install' ) ){
    function octagon_kc_elements_free_install() {

        if( ! class_exists( 'KingComposer' ) ) {
            add_action( 'admin_notices', 'required_plugin_admin_notice' );
        }
        else {
            // Global for backwards compatibility.
			$GLOBALS['octagon_kc_elements'] = octagon_kc_elements();
        }
    }
}

add_action( 'plugins_loaded', 'octagon_kc_elements_free_install', 11 );