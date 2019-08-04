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

if( ! class_exists( 'octagon_kc_elements_info_icons_module' ) ) {

	class octagon_kc_elements_info_icons_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_info_icons', array( $this, 'content' ) );
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
					'octagon_kc_elements_info_icons' => array(
						'name' => esc_html_x( 'Info Icons', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-info-icons',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'columns',
									'label'       => esc_html_x( 'Columns', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the title tag.', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'columns-4',
									'options'     => array(
										'columns-2' => esc_html_x( '2 Column', 'shortcode-map', 'octagon-kc-elements' ),
										'columns-3' => esc_html_x( '3 Column', 'shortcode-map', 'octagon-kc-elements' ),
										'columns-4' => esc_html_x( '4 Column', 'shortcode-map', 'octagon-kc-elements' ),
										'columns-5' => esc_html_x( '5 Column', 'shortcode-map', 'octagon-kc-elements' ),
										'columns-6' => esc_html_x( '6 Column', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'title_tag',
									'label'       => esc_html_x( 'Title Tag', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the title tag.', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'h3',
									'options'     => array(
										'h1' => 'H1',
										'h2' => 'H2',
										'h3' => 'H3',
										'h4' => 'H4',
										'h5' => 'H5',
										'h6' => 'H6',
										'p'  => 'p'
									)
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
									'name'        => 'with_border',
									'label'       => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Cover with border?', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'without-border',
									'options'     => array(
										'with-border'    => esc_html_x( 'With Border', 'shortcode-map', 'octagon-kc-elements' ),
										'without-border' => esc_html_x( 'Without Border', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'icon_set',
									'label'       => esc_html_x( 'Icon Set', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'group',
									'description' => esc_html_x( 'Add the icon set', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'icon',
									'options'     => array(
										'add_text'  => esc_html_x( 'Add Icon Set', 'shortcode-map', 'octagon-kc-elements' )
									),
									'params' => array(

										array(
											'name'        => 'title',
											'label'       => esc_html_x( 'Title', 'shortcode-map', 'octagon-kc-elements' ),
											'type'        => 'text',
											'value'       => esc_html__( 'Default Title', 'octagon-kc-elements' ),
											'description' => esc_html_x( 'Enter the title', 'shortcode-map', 'octagon-kc-elements' )
										),

										array(
											'name'        => 'type',
											'label'       => esc_html_x( 'Icon/Image', 'shortcode-map', 'octagon-kc-elements' ),
											'type'        => 'select',
											'description' => esc_html_x( 'Choose the type, wheather its icon or image.', 'shortcode-map', 'octagon-kc-elements' ),
											'value'       => 'icon',
											'options'     => array(
												'icon'  => esc_html_x( 'Icon', 'shortcode-map', 'octagon-kc-elements' ),
												'image' => esc_html_x( 'Image', 'shortcode-map', 'octagon-kc-elements' )
											)
										),

										array(
											'name'        => 'icon',
											'label'       => esc_html_x( 'Icon', 'shortcode-map', 'octagon-kc-elements' ),
											'type'        => 'icon_picker',
											'value'       => '',
											'description' => esc_html_x( 'Choose the icon', 'shortcode-map', 'octagon-kc-elements' ),
											'relation'    => array(
												'parent'	=> 'icon_set-type',
												'show_when' => 'icon'
											)
										),

										array(
											'name'        => 'image',
											'label'       => esc_html_x( 'Image', 'shortcode-map', 'octagon-kc-elements' ),
											'type'        => 'attach_image',
											'value'       => '',
											'description' => esc_html_x( 'Choose the image', 'shortcode-map', 'octagon-kc-elements' ),
											'relation'    => array(
												'parent'	=> 'icon_set-type',
												'show_when' => 'image'
											)
										),

										array(
											'name'        => 'method',
											'label'       => esc_html_x( 'Method', 'shortcode-map', 'octagon-kc-elements' ),
											'type'        => 'select',
											'description' => esc_html_x( 'Choose the method, wheather its square or round.', 'shortcode-map', 'octagon-kc-elements' ),
											'value'       => 'square',
											'options'     => array(
												'square' => esc_html_x( 'Square', 'shortcode-map', 'octagon-kc-elements' ),
												'round'  => esc_html_x( 'Round', 'shortcode-map', 'octagon-kc-elements' )
											)
										),

										array(
											'name'        => 'link',
											'label'       => esc_html_x( 'Link', 'shortcode-map', 'octagon-kc-elements' ),
											'type'        => 'link',
											'value'       => '',
											'description' => esc_html_x( 'Add your relative URL. Each URL contains link, anchor text and target attributes.', 'shortcode-map', 'octagon-kc-elements' )
										)
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
											esc_html_x( 'Icon', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .icon-wrap span' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .icon-wrap' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .icon-wrap span' ),
												array( 'property' => 'width', 'selector' => '.info-icons .icon-wrap' ),
												array( 'property' => 'height', 'selector' => '.info-icons .icon-wrap' ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .icon-wrap' ),
												array( 'property' => 'border-radius', 'label' => esc_html_x( 'Border Radius', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .icon-wrap' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .icon-wrap' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .icon-wrap' ),
											),
											esc_html_x( 'Title', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .info-icon-title, .info-icons .info-icon-title a' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .info-icon-title, .info-icons .info-icon-title a' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .info-icon-title, .info-icons .info-icon-title a' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .info-icon-title, .info-icons .info-icon-title a' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .info-icon-title, .info-icons .info-icon-title a' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .info-icon-title, .info-icons .info-icon-title a' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .info-icon-title, .info-icons .info-icon-title a' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.info-icons .info-icon-title, .info-icons .info-icon-title a' )
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
				'columns'   => 'columns-4',
				'title_tag' => 'h3',
				'icon_set'  => '',
				'ex_class'  => ''
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'info-icons', $atts );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_info_icons_module();