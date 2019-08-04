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

if( ! function_exists( 'is_plugin_active' ) && ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

if( ! is_plugin_active( 'kingcomposer/kingcomposer.php' ) && ! is_plugin_active_for_network( 'kingcomposer/kingcomposer.php' ) ) {
	return;	
}
	
if( ! class_exists( 'Octagon_KC_Elements_Builder' ) ) {

	class Octagon_KC_Elements_Builder {

		public function __construct(){			

			add_action( 'init', array( $this, 'init_builder' ), 99 );
			add_filter( 'kc_enqueue_styles', array( $this, 'kc_enqueue_styles' ), 10, 1 );
			add_filter( 'octagon-el-class', array( $this, 'octagon_el_class' ), 10, 1 );
		}

		/**
		 * Initialize builder functionality
		 * 
		 * @since  1.0
		 */
		public function init_builder() {
			$this->add_map_param();
			$this->import_icons();
		}

		/**
		 * Initialize builder functionality
		 * 
		 * @since  1.0
		 */
		public function octagon_el_class( $classes ) {

			$classes[] = 'oct-core-elements';

			return $classes;
		}

		/**
		 * Import custom icons
		 * 
		 * @since  1.0
		 */
		public function import_icons() {			

			$icon_set = Octagon_Core_Icon_Manager::get_icon_set();

			$chosen_set = get_option( 'octagon_icon_set', array() );

			foreach( $icon_set as $key => $icons ) {

				if( in_array( $key, $chosen_set ) ) {
					kc_add_icon( $icons['url'] );
				}
				
			}

		}

		/**
		 * Unset kc custom icon enqueue array
		 *
		 * @version 1.0
		 * @since  1.0
		 * @param  array  $styles Style
		 * @return array
		 */
		public function kc_enqueue_styles( $styles ) {	

			$icon_set = Octagon_Core_Icon_Manager::get_icon_set();

			foreach( $styles as $key => $value ) {
				if( in_array( $value['src'], array_column( $icon_set, 'url') ) ) {
					unset( $styles[$key] );
				}
			}

			return $styles;

		}

		/**
		 * Add additional map param in KC Defaults 
		 * 
		 * @since  1.0
		 */
		public function add_map_param() {

			global $kc;

			$kc->add_map_param( 
				'kc_row', 
				array(
					'name'        => 'content_style',
					'label'       => esc_html_x( 'Background Method', 'shortcode-map', 'octagon-kc-elements' ),
					'type'        => 'select',
					'admin_label' => true,
					'value'       => 'none',
					'description' => esc_html_x( 'Choose background method, whether it should be dark/light. ( Eg: If it chosen dark, all content inside the row will be lighten )', 'shortcode-map', 'octagon-kc-elements' ),
					'options'     => array(
						'none'  => esc_html_x( 'Not Set', 'shortcode-map', 'octagon-kc-elements' ),
						'light' => esc_html_x( 'Light', 'shortcode-map', 'octagon-kc-elements' ),
						'dark'  => esc_html_x( 'Dark', 'shortcode-map', 'octagon-kc-elements' )
					)
				),
				1
			);

			$kc->add_map_param( 
				'kc_row_inner', 
				array(
					'name'        => 'content_style',
					'label'       => esc_html_x( 'Background Method', 'shortcode-map', 'octagon-kc-elements' ),
					'type'        => 'select',
					'admin_label' => true,
					'value'       => 'none',
					'description' => esc_html_x( 'Choose background method, whether it should be dark/light. ( Eg: If it chosen dark, all content inside the direct child element will be lighten )', 'shortcode-map', 'octagon-kc-elements' ),
					'options'     => array(
						'none'  => esc_html_x( 'Not Set', 'shortcode-map', 'octagon-kc-elements' ),
						'light' => esc_html_x( 'Light', 'shortcode-map', 'octagon-kc-elements' ),
						'dark'  => esc_html_x( 'Dark', 'shortcode-map', 'octagon-kc-elements' )
					)
				),
				1
			);

			$kc->add_map_param( 
				'kc_column', 
				array(
					'name'        => 'content_style',
					'label'       => esc_html_x( 'Background Method', 'shortcode-map', 'octagon-kc-elements' ),
					'type'        => 'select',
					'admin_label' => true,
					'value'       => 'none',
					'description' => esc_html_x( 'Choose background method, whether it should be dark/light. ( Eg: If it chosen dark, all content inside the direct child element will be lighten )', 'shortcode-map', 'octagon-kc-elements' ),
					'options'     => array(						
						'none'  => esc_html_x( 'Not Set', 'shortcode-map', 'octagon-kc-elements' ),
						'light' => esc_html_x( 'Light', 'shortcode-map', 'octagon-kc-elements' ),
						'dark'  => esc_html_x( 'Dark', 'shortcode-map', 'octagon-kc-elements' )
					)
				),
				1
			);

			$kc->add_map_param( 
				'kc_column_inner', 
				array(
					'name'        => 'content_style',
					'label'       => esc_html_x( 'Background Method', 'shortcode-map', 'octagon-kc-elements' ),
					'type'        => 'select',
					'admin_label' => true,
					'value'       => 'none',
					'description' => esc_html_x( 'Choose background method, whether it should be dark/light. ( Eg: If it chosen dark, all content inside the direct child element will be lighten )', 'shortcode-map', 'octagon-kc-elements' ),
					'options'     => array(
						'none'  => esc_html_x( 'Not Set', 'shortcode-map', 'octagon-kc-elements' ),
						'light' => esc_html_x( 'Light', 'shortcode-map', 'octagon-kc-elements' ),
						'dark'  => esc_html_x( 'Dark', 'shortcode-map', 'octagon-kc-elements' )
					)
				),
				1
			);

			// Get column CSS and append screen sizes
			$column_css = kc_column_options( '.kc-col-container' );
			$column_css[0]['screens'] = octagon_kc_elements_responsive_breakpoints();

			$kc->update_map( 
				'kc_column', 
				'params',
				array(
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
	                        'options' => $column_css
						)
					)
				)
			);

			// Get column CSS and append screen sizes
			$column_inner_css = kc_column_options( '.kc-col-inner-container' );
			$column_inner_css[0]['screens'] = octagon_kc_elements_responsive_breakpoints();

			$kc->update_map( 
				'kc_column_inner', 
				'params',
				array(
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
	                        'options' => $column_inner_css
						)
					)
				)
			);

			// Get column CSS and append screen sizes
			$row_css = kc_column_options( '' );
			$row_css[0]['screens'] = octagon_kc_elements_responsive_breakpoints();
			unset( $row_css[0]['Inside'] );

			$kc->update_map( 
				'kc_row', 
				'params',
				array(
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => $row_css
						)
					)
				)
			);

			$kc->update_map( 
				'kc_row_inner', 
				'params',
				array(
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => $row_css
						)
					)
				)
			);

		}

	}

	new Octagon_KC_Elements_Builder;

}