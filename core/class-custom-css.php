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
	
if( ! class_exists( 'Octagon_Core_Custom_CSS' ) ) {

	class Octagon_Core_Custom_CSS {

		public $args = array();

		public $theme = '';

		public $upload_dir = array();

		public $cache_name = '';

		public $cache_dir = '';

		public $cache_url = '';

		public function __construct( $args ) {

			$this->set( $args );

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_custom_css' ), 99 );
			add_action( 'customize_save_after', array( $this, 'custom_css_reset_cache' ) );
			
		}

		/**
		 * Define Constants.
		 */
		private function set( $args ) {

			$this->theme      = get_template();
			$this->upload_dir = wp_upload_dir();

			$this->cache_name = $args['cache-name'];
			$this->file_path  = $args['file-path'];

			$this->cache_dir  = trailingslashit( $this->upload_dir['basedir'] ) . $this->theme;
			$this->cache_url  = trailingslashit( $this->upload_dir['baseurl'] ) . $this->theme;

		}

		/**
		 * Enqueue Custom CSS
		 * 
		 * @since  1.0
		 */
		public function enqueue_custom_css() {

		    // Check and create cachedir
		    if( ! is_dir( $this->cache_dir ) ) {

		        if( ! function_exists( 'WP_Filesystem' ) ) {
		        	require_once( ABSPATH . 'wp-admin/includes/file.php' );
		        }

				WP_Filesystem();

				wp_mkdir_p( $this->cache_dir );

		    }

		    /*
			 * Checking is cache folder writable
			 * If user in customizer passed custom.css for avoid conflicts
		    */

		    if( is_writable( $this->cache_dir ) && ! isset( $_POST['wp_customize'] ) ) {

				$has_cached = get_option( $this->cache_name .'-has-cached' );

				if( ! $has_cached ) {
					$this->prefix_cache_css_file();
				}

			    /*
				 * If it's multi site activated append blog id
			    */

				global $blog_id;
				$is_multisite = is_multisite() ? '-'. $blog_id : '';

				$file = $this->cache_dir .'/'. $this->cache_name . $is_multisite .'.css';

				if( file_exists( $file ) ) {
					wp_enqueue_style( $this->cache_name, $this->cache_url .'/'. $this->cache_name . $is_multisite .'.css', array(), null, 'all' );
				}				

			}
			else {

				// echo generated css directly if cache folder is not writable and in customizer
				add_action( 'wp_head', function(){  echo '<style>'. octagon_minify( $this->generate_custom_css() ) .'</style>'; }, 99 );

			}

		}


		/**
		 * Put the custom css to the dynamic css file
		 * 
		 * @since  1.0
		 */
		public function prefix_cache_css_file() {

			if( is_multisite() ) {
				global $blog_id;
				$css_file = $this->cache_dir . '/'. $this->cache_name . $blog_id .'.css';
			}
			else {
				$css_file = $this->cache_dir . '/'. $this->cache_name .'.css';
			}

			$css  = "/**\n";
			$css .= " * Do not touch this file! This file created by PHP\n";
			$css .= " * Last modified time: ". date( 'M d Y, h:s:i' ) ."\n";
			$css .= " */\n\n\n";
			$css .= octagon_minify( $this->generate_custom_css() );

			if( ! function_exists( 'WP_Filesystem' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}

			// Print the generated custom css

			WP_Filesystem();

			global $wp_filesystem;

			if( ! $wp_filesystem->put_contents( $css_file, $css, FS_CHMOD_FILE ) ) {
				update_option( $this->cache_name .'-has-cached', false );
			}
			else {
				update_option( $this->cache_name .'-has-cached', true );
			}

		}

		/**
		 * Generate custom css
		 * 
		 * @since  1.0
		 */
		public function generate_custom_css() {

			$css = '';

			ob_start();
			include_once $this->file_path;
			$css .= ob_get_clean();

			return $css;

		}

		/**
		 * Reset the cache on the customizer save
		 * 
		 * @since  1.0
		 */
		public function custom_css_reset_cache() {
		    update_option( $this->cache_name .'-has-cached', false );
		}

	}

}