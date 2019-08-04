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

if( ! class_exists( 'octagon_kc_elements_google_map_module' ) ) {

	class octagon_kc_elements_google_map_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_google_map', array( $this, 'content' ) );
		}
		
		/**
		 * KingComposer page builder shortcode map
		 * 
		 * @since  1.0
		 * @return mixed
		 */
		public function map() {
			kc_add_map(
				array(
					'octagon_kc_elements_google_map' => array(
						'name' => esc_html_x( 'Google Map', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-google-map',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'  => 'random_id',
									'label' => '',
									'type'  => 'random'
								),
								array(
									'name'  => 'map_location',
									'label' => esc_html_x( 'Map Location', 'shortcode-map', 'octagon-kc-elements' ),
									'type'  => 'textarea',
									'value' => base64_encode( '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29793.99697352976!2d105.81945407598418!3d21.02269575409132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!3m2!1sen!2s!4v1453961383169" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>' )
								),
								array(
									'name'  => 'map_height',
									'label' => esc_html_x( 'Map Height (px)', 'shortcode-map', 'octagon-kc-elements' ),
									'type'  => 'text',
									'value' => 350
								),

								array(
									'name'        => 'style',
									'label'       => esc_html_x( 'Style', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Choose the map mode', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'greyscale',
									'options'     => array(
										'greyscale' => esc_html_x( 'Greyscale', 'shortcode-map', 'octagon-kc-elements' ),
										'normal'    => esc_html_x( 'Normal', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'ex_class',
									'label'       => esc_html_x( 'Extra Class', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => '',
									'description' => esc_html_x( 'Enter the extra class', 'shortcode-map', 'octagon-kc-elements' )
								)

							)

						)
					)

				)

			);

		}

		/**
		 * Output shortcode content
		 * 
		 * @since  1.0
		 * @return mixed
		 */
		public function content( $atts ) {
			extract( shortcode_atts( array(
				'random_id'    => '',
				'map_location' => '',
				'map_height'   => '350',
				'style'        => 'greyscale',
				'ex_class'     => ''
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'google-map', $atts );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_google_map_module;