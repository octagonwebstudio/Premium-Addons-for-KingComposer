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

if( ! class_exists( 'octagon_kc_elements_table_module' ) ) {

	class octagon_kc_elements_table_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_table', array( $this, 'content' ) );
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
					'octagon_kc_elements_table' => array(
						'name' => esc_html_x( 'Table', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-info-icons',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'style',
									'label'       => esc_html_x( 'Style', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the style', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'border',
									'options'     => array(
										'border'      => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ),
										'bottom-line' => esc_html_x( 'Bottom Line', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'columns',
									'label'       => esc_html_x( 'Columns', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the title tag.', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '4',
									'options'     => array(
										'2' => esc_html_x( '2 Column', 'shortcode-map', 'octagon-kc-elements' ),
										'3' => esc_html_x( '3 Column', 'shortcode-map', 'octagon-kc-elements' ),
										'4' => esc_html_x( '4 Column', 'shortcode-map', 'octagon-kc-elements' ),
										'5' => esc_html_x( '5 Column', 'shortcode-map', 'octagon-kc-elements' ),
										'6' => esc_html_x( '6 Column', 'shortcode-map', 'octagon-kc-elements' ),
										'7' => esc_html_x( '7 Column', 'shortcode-map', 'octagon-kc-elements' ),
										'8' => esc_html_x( '8 Column', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'alignment',
									'label'       => esc_html_x( 'Alignment', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the alignment', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'left',
									'options'     => array(
										'left'   => esc_html_x( 'Left', 'shortcode-map', 'octagon-kc-elements' ),
										'right'  => esc_html_x( 'Right', 'shortcode-map', 'octagon-kc-elements' ),
										'center' => esc_html_x( 'Center', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'td',
									'label'       => esc_html_x( 'Table', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'group',
									'description' => esc_html_x( 'Add the table data', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '',
									'options'     => array(
										'add_text'  => esc_html_x( 'Add Table Data', 'shortcode-map', 'octagon-kc-elements' )
									),
									'params' => array(

										array(
											'name'        => 'value',
											'label'       => esc_html_x( 'Text( td )', 'shortcode-map', 'octagon-kc-elements' ),
											'type'        => 'text',
											'value'       => esc_html__( 'Column 1', 'octagon-kc-elements' ),
											'description' => esc_html_x( 'Enter the td value', 'shortcode-map', 'octagon-kc-elements' )
										),

										array(
											'name'        => 'tag',
											'label'       => esc_html_x( 'Tag', 'shortcode-map', 'octagon-kc-elements' ),
											'type'        => 'select',
											'description' => esc_html_x( 'Choose table data tag', 'shortcode-map', 'octagon-kc-elements' ),
											'value'       => 'td',
											'options'     => array(
												'td'    => esc_html_x( 'TD', 'shortcode-map', 'octagon-kc-elements' ),
												'th' => esc_html_x( 'TH', 'shortcode-map', 'octagon-kc-elements' )
											)
										),

										array(
											'name'        => 'force_align',
											'label'       => esc_html_x( 'Force Align', 'shortcode-map', 'octagon-kc-elements' ),
											'type'        => 'select',
											'description' => esc_html_x( 'Force align the specific table data', 'shortcode-map', 'octagon-kc-elements' ),
											'value'       => 'default',
											'options'     => array(
												'default' => esc_html_x( 'Default', 'shortcode-map', 'octagon-kc-elements' ),
												'left'    => esc_html_x( 'Left', 'shortcode-map', 'octagon-kc-elements' ),
												'right'   => esc_html_x( 'Right', 'shortcode-map', 'octagon-kc-elements' ),
												'center'  => esc_html_x( 'Center', 'shortcode-map', 'octagon-kc-elements' )
											)
										),
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
											esc_html_x( 'TH Tag', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.table th' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.table th' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.table th' ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.table th' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.table th' ),
											),
											esc_html_x( 'TD Tag', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.table td' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.table td' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.table td' ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.table td' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.table td' ),
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
				'style'     => 'border', // border, bottom-line
				'columns'   => '4',
				'alignment' => 'left', // left, right, center
				'td'        => '', // td, th
				'ex_class'  => ''
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'table', $atts );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_table_module();