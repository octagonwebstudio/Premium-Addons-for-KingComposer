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

if( ! class_exists( 'octagon_kc_elements_advance_button_module' ) ) {

	class octagon_kc_elements_advance_button_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_advance_button', array( $this, 'content' ) );
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
					'octagon_kc_elements_advance_button' => array(
						'name' => esc_html_x( 'Advance Button', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-advance-button',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'text_title',
									'label'       => esc_html_x( 'Title', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => esc_html__( 'Text Button', 'octagon-kc-elements' ),
									'description' => esc_html_x( 'Add the text that appears on the button.', 'shortcode-map', 'octagon-kc-elements' ),
									'admin_label' => true
								),

								array(
									'name'        => 'link',
									'label'       => esc_html_x( 'Link', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'link',
									'value'       => '',
									'description' => esc_html_x( 'Add your relative URL. Each URL contains link, anchor text and target attributes.', 'shortcode-map', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'btn_size',
									'label'       => esc_html_x( 'Button Size', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'value'       => 'btn-size-small',
									'options'     => array(
										'btn-size-mini'   => esc_html_x( 'Mini', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-size-small'  => esc_html_x( 'Small', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-size-medium' => esc_html_x( 'Medium', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-size-large'  => esc_html_x( 'Large', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-size-full'   => esc_html_x( 'Full', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'btn_type',
									'label'       => esc_html_x( 'Button Type', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'value'       => 'btn-type-solid-ellipse',
									'options'     => array(
										'btn-type-solid-rect'      => esc_html_x( 'Solid Rectangle', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-solid-round'     => esc_html_x( 'Solid Round', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-solid-ellipse'   => esc_html_x( 'Solid Ellipse', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-outline-rect'    => esc_html_x( 'Outline Rectangle', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-outline-round'   => esc_html_x( 'Outline Round', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-outline-ellipse' => esc_html_x( 'Outline Ellipse', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-no-bg'           => esc_html_x( 'No Background', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-simple'          => esc_html_x( 'Simple', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-half-line'       => esc_html_x( 'Half Line', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-collapse'   => esc_html_x( 'Line Collapse', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-tr'         => esc_html_x( 'Line Top Right', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-tl'         => esc_html_x( 'Line Top Left', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-br'         => esc_html_x( 'Line Bottom Right', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-bl'         => esc_html_x( 'Line Bottom Left', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'btn_color',
									'label'       => esc_html_x( 'Button Type', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'value'       => 'btn-color-black',
									'options'     => array(
										'btn-color-black'            => esc_html_x( 'Black', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-white'            => esc_html_x( 'White', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-primary'          => esc_html_x( 'Primary', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-gradient'         => esc_html_x( 'Default Gradient', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-gradient-palette' => esc_html_x( 'From Gradient Palette', 'shortcode-map', 'octagon-kc-elements' )
									)
								),
								
								array(
									'name'        => 'gradient_palette',
									'label'       => esc_html_x( 'Gradient Palette', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'value'       => 'orange-pulp',
									'options'     => octagon_get_gradient_palette(),
									'relation'    => array(
										'parent'    => 'btn_color',
										'show_when' => 'btn-color-gradient-palette'
									)
								),

								array(
									'name'  => 'show_icon',
									'label' => esc_html_x( 'Show Icon?', 'shortcode-map', 'octagon-kc-elements' ),
									'type'  => 'toggle'
								),

								array(
									'name'  => 'only_icon',
									'label' => esc_html_x( 'Only Icon?', 'shortcode-map', 'octagon-kc-elements' ),
									'type'  => 'toggle',
									'relation'    => array(
										'parent'    => 'show_icon',
										'show_when' => 'yes'
									)
								),

								array(
									'name'        => 'icon',
									'label'       => esc_html_x( 'Icon', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'icon_picker',
									'value'       => 'sl-lock',
									'description' => esc_html_x( 'Select icon for button', 'shortcode-map', 'octagon-kc-elements' ),
									'relation'    => array(
										'parent'    => 'show_icon',
										'show_when' => 'yes'
									)
								),

								array(
									'name'        => 'icon_position',
									'label'       => esc_html_x( 'Icon Position', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'value'       => 'left',
									'options'     => array(
										'left'  => esc_html_x( 'Left', 'shortcode-map', 'octagon-kc-elements' ),
										'right' => esc_html_x( 'Right', 'shortcode-map', 'octagon-kc-elements' )
									),
									'relation'    => array(
										'parent'    => 'show_icon',
										'show_when' => 'yes'
									)
								),

								array(
									'name'        => 'onclick',
									'label'       => esc_html_x( 'On Click', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => '',
									'description' => esc_html_x( 'Content of on click attribute for element.', 'shortcode-map', 'octagon-kc-elements' )
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
											esc_html_x( 'Button Style', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn, .btn span' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'text-align', 'label' => esc_html_x( 'Align', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'width', 'selector' => '.btn' ),
												array( 'property' => 'height', 'selector' => '.btn' ),
												array( 'property' => 'display', 'label' => esc_html_x( 'Display', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'border-radius', 'label' => esc_html_x( 'Border Radius', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Icon Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn span' ),
												array( 'property' => 'position', 'label' => esc_html_x( 'Position', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'top', 'label' => esc_html_x( 'Top', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'right', 'label' => esc_html_x( 'Right', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'bottom', 'label' => esc_html_x( 'Bottom', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' ),
												array( 'property' => 'left', 'label' => esc_html_x( 'Left', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn' )
											),
											esc_html_x( 'Mouse Hover', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn:hover' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn:hover' ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.btn:hover' )
											)
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
				'text_title'    => esc_html__( 'Text Button', 'octagon-kc-elements' ),
				'link'          => '',
				'btn_size'      => 'btn-size-small',
				'btn_type'      => 'btn-type-solid-ellipse',
				'btn_color'     => 'btn-color-black',
				'show_icon'     => 'no',
				'only_icon'     => 'no',
				'icon'          => 'sl-lock',
				'icon_position' => 'left',
				'onclick'       => '',
				'ex_class'      => ''
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'advance-button', $atts );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_advance_button_module();