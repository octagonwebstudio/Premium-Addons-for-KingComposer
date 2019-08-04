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

if( ! class_exists( 'octagon_kc_elements_image_mask_module' ) ) {

	class octagon_kc_elements_image_mask_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_image_mask', array( $this, 'content' ) );
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
					'octagon_kc_elements_image_mask' => array(
						'name' => esc_html_x( 'Image Mask', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-image-mask',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'shape',
									'label'       => esc_html_x( 'Shape', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the shape.', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'shape1',
									'options'     => array(
										'shape1'  => esc_html_x( 'Shape 1', 'shortcode-map', 'octagon-kc-elements' ),
										'shape2'  => esc_html_x( 'Shape 2', 'shortcode-map', 'octagon-kc-elements' ),
										'shape3'  => esc_html_x( 'Shape 3', 'shortcode-map', 'octagon-kc-elements' ),
										'shape4'  => esc_html_x( 'Shape 4', 'shortcode-map', 'octagon-kc-elements' ),
										'shape5'  => esc_html_x( 'Shape 5', 'shortcode-map', 'octagon-kc-elements' ),
										'shape6'  => esc_html_x( 'Shape 6', 'shortcode-map', 'octagon-kc-elements' ),
										'shape7'  => esc_html_x( 'Shape 7', 'shortcode-map', 'octagon-kc-elements' ),
										'shape8'  => esc_html_x( 'Shape 8', 'shortcode-map', 'octagon-kc-elements' ),
										'shape9'  => esc_html_x( 'Shape 9', 'shortcode-map', 'octagon-kc-elements' ),
										'shape10' => esc_html_x( 'Shape 10', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'image',
									'label'       => esc_html_x( 'Image', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'attach_image',
									'value'       => '',
									'description' => esc_html_x( 'Choose the image', 'shortcode-map', 'octagon-kc-elements' )
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
				'shape'    => 'shape1',
				'image'    => '',
				'ex_class' => ''
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'image-mask', $atts );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_image_mask_module();