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

if( ! class_exists( 'octagon_kc_elements_slider_revolution_module' ) ) {

	class octagon_kc_elements_slider_revolution_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_slider_revolution', array( $this, 'content' ) );
		}
		
		/**
		 * KingComposer page builder shortcode map
		 * 
		 * @since  1.0
		 * @return mixed
		 */
		public function map() {

			$slider_list = array();
			
			$rev_slider = new RevSlider();
			$all_sliders = $rev_slider->getAllSliderAliases();

			foreach( $all_sliders as $key => $slider_alias ) {
				$slider_list[$slider_alias] = octagon_make_word( $slider_alias );
			}

			kc_add_map(
				array(
					'rev_slider' => array(
						'name' => esc_html_x( 'Slider Revolution', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-slider-revolution',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'alias',
									'label'       => esc_html_x( 'Sliders', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Select Slider', 'shortcode-map', 'octagon-kc-elements' ),
									'options'     => $slider_list
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

new octagon_kc_elements_slider_revolution_module;