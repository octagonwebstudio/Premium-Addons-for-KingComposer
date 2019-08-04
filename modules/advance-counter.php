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

if( ! class_exists( 'octagon_kc_elements_advance_counter_module' ) ) {

	class octagon_kc_elements_advance_counter_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_advance_counter', array( $this, 'content' ) );
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
					'octagon_kc_elements_advance_counter' => array(
						'name' => esc_html_x( 'Advance Counter', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-advance-counter',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'number',
									'label'       => esc_html_x( 'Targeted Number', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'The targeted number to count up to (From zero).', 'shortcode-map', 'octagon-kc-elements' ),
									'admin_label' => true,
									'value'       => '100'
								),

								array(
									'name'        => 'label',
									'label'       => esc_html_x( 'Label', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'The text description of the counter.', 'shortcode-map', 'octagon-kc-elements' ),
									'admin_label' => true,
									'value'       => esc_html__( 'Percent Number', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'prefix',
									'label'       => esc_html_x( 'Prefix', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Enter the prefix.', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => ''
								),

								array(
									'name'        => 'suffix',
									'label'       => esc_html_x( 'Suffix', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Enter the suffix.', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => ''
								),

								array(
									'name'        => 'alignment',
									'label'       => esc_html_x( 'Alignment', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the alignment', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'center',
									'options'     => array(
										'left'   => esc_html_x( 'Left', 'shortcode-map', 'octagon-kc-elements' ),
										'right'  => esc_html_x( 'Right', 'shortcode-map', 'octagon-kc-elements' ),
										'center' => esc_html_x( 'Center', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'show_icon',
									'label'       => esc_html_x( 'Display Icon', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Want to show icon?', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'no',
									'options'     => array(
										'yes' => esc_html_x( 'Yes', 'shortcode-map', 'octagon-kc-elements' ),
										'no'  => esc_html_x( 'No', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'icon',
									'label'       => esc_html_x( 'Icon', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'icon_picker',
									'value'       => 'sl-lock',
									'description' => esc_html_x( 'Choose the icon', 'shortcode-map', 'octagon-kc-elements' ),
									'relation'    => array(
										'parent'	=> 'show_icon',
										'show_when' => 'yes'
									)
								),

								array(
									'name'        => 'decimals',
									'label'       => esc_html_x( 'Decimals', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Enter decimals count', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '0'
								),

								array(
									'name'        => 'decimal_delimiter',
									'label'       => esc_html_x( 'Decimal Delimiter', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Enter decimal delimiter', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '.'
								),

								array(
									'name'        => 'thousand_delimiter',
									'label'       => esc_html_x( 'Thousand Delimiter', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Enter thousand delimiter', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => ','
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
											esc_html_x( 'Icon', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-icon' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-icon' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-icon' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-icon' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-icon' )
											),
											esc_html_x( 'Number', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter' ),
												array( 'property' => 'text-align', 'label' => esc_html_x( 'Align', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter' )
											),
											esc_html_x( 'Label', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-label' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-label' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-label' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-label' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-label' ),
												array( 'property' => 'text-align', 'label' => esc_html_x( 'Align', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-label' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-label' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-label' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-label' )
											),
											esc_html_x( 'Box', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'background', 'label' => esc_html_x( 'Background', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-wrap' ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-wrap' ),
												array( 'property' => 'border-radius', 'label' => esc_html_x( 'Border Radius', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-wrap' ),
												array( 'property' => 'box-shadow', 'label' => esc_html_x( 'Box Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-wrap' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-wrap' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.advance-counter .counter-wrap' )
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
				'number'             => '100',
				'label'              => esc_html__( 'Percent Number', 'octagon-kc-elements' ),
				'prefix'             => '',
				'suffix'             => '',
				'alignment'          => 'center', // left, right, center
				'show_icon'          => 'no',
				'icon'               => 'sl-lock',
				'decimals'           => '0',
				'decimal_delimiter'  => '.',
				'thousand_delimiter' => ',',
				'ex_class'           => ''
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'advance-counter', $atts );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_advance_counter_module();