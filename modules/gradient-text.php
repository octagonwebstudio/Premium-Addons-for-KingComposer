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

if( ! class_exists( 'octagon_kc_elements_gradient_text_module' ) ) {

	class octagon_kc_elements_gradient_text_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_gradient_text', array( $this, 'content' ) );
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
					'octagon_kc_elements_gradient_text' => array(
						'name' => esc_html_x( 'Gradient Text', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-line-text',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'title',
									'label'       => esc_html_x( 'Title', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => esc_html__( 'Default Title', 'octagon-kc-elements' ),
									'description' => esc_html_x( 'Enter the title', 'shortcode-map', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'title_tag',
									'label'       => esc_html_x( 'Title Tag', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the title tag.', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'p',
									'options'     => array(
										'h1' => 'H1',
										'h2' => 'H2',
										'h3' => 'H3',
										'h4' => 'H4',
										'h5' => 'H5',
										'h6' => 'H6',
										'p'  => 'P'
									)
								),

								array(
									'name'        => 'gradient',
									'label'       => esc_html_x( 'Gradient Colors', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'group',
									'description' => esc_html_x( 'Add the color', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '',
									'options'     => array(
										'add_text'  => esc_html_x( 'Add colors', 'shortcode-map', 'octagon-kc-elements' )
									),
									'params' => array(

										array(
											'name'        => 'color',
											'label'       => esc_html_x( 'Color', 'shortcode-map', 'octagon-kc-elements' ),
											'type'        => 'color_picker',
											'value'       => ''
										)
									)
								),

								array(
									'name'        => 'custom_degrees',
									'label'       => esc_html_x( 'Custom Gradient Degree', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'number_slider',
									'value'       => '90deg',
									'options'     => array(
										'min'        => -90,
										'max'        => 90,
										'unit'       => 'deg',
										'show_input' => true
									)
								),

								array(
									'name'        => 'ex_class',
									'label'       => esc_html_x( 'Extra Class', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => '',
									'description' => esc_html_x( 'Enter the extra class', 'shortcode-map', 'octagon-kc-elements' )
								)

							),
							
							esc_html_x( 'Styling', 'shortcode-map', 'octagon-kc-elements' ) => array(
								array(
									'type'    => 'css',
									'label'   => esc_html_x( 'CSS', 'shortcode-map', 'octagon-kc-elements' ),
									'name'    => 'custom_css',
									'options' => array(
										array(
											'screens' => octagon_kc_elements_responsive_breakpoints(),
											esc_html_x( 'Title', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.gradient-text .sub-title' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.gradient-text .sub-title' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.gradient-text .sub-title' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.gradient-text .sub-title' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.gradient-text .sub-title' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.gradient-text .sub-title' ),
												array( 'property' => 'text-align', 'label' => esc_html_x( 'Text Align', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.gradient-text' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.gradient-text .sub-title' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.gradient-text .sub-title' )
											),
										)
									)
								),
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
				'title'          => esc_html__( 'Default Title', 'octagon-kc-elements' ),
				'title_tag'      => 'p',
				'gradient'       => '',
				'custom_degrees' => '90deg',
				'ex_class'       => ''
			), $atts ) );			

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'gradient-text', $atts );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_gradient_text_module();