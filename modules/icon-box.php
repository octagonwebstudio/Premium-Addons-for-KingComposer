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

if( ! class_exists( 'octagon_kc_elements_icon_box_module' ) ) {

	class octagon_kc_elements_icon_box_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_icon_box', array( $this, 'content' ) );
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
					'octagon_kc_elements_icon_box' => array(
						'name' => esc_html_x( 'Icon Box', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-icon-box',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'style',
									'label'       => esc_html_x( 'Style', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the style', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'style1',
									'options'     => array(
										'style1' => esc_html_x( 'Style 1', 'shortcode-map', 'octagon-kc-elements' ),
										'style2' => esc_html_x( 'Style 2', 'shortcode-map', 'octagon-kc-elements' )
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
									'name'        => 'type',
									'label'       => esc_html_x( 'Type', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose type', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'icon',
									'options'     => array(
										'icon'  => esc_html_x( 'Icon', 'shortcode-map', 'octagon-kc-elements' ),
										'image' => esc_html_x( 'Image', 'shortcode-map', 'octagon-kc-elements' ),
										'svg'   => esc_html_x( 'SVG Icon', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'icon',
									'label'       => esc_html_x( 'Icon', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'icon_picker',
									'description' => esc_html_x( 'Choose the icon', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'sl-lock',
									'relation'    => array(
										'parent'    => 'type',
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
										'parent'    => 'type',
										'show_when' => 'image'
									)
								),

								array(
									'name'        => 'svg',
									'label'       => esc_html_x( 'SVG Icon', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'attach_image',
									'value'       => '',
									'description' => esc_html_x( 'Choose the svg icon', 'shortcode-map', 'octagon-kc-elements' ),
									'relation'    => array(
										'parent'    => 'type',
										'show_when' => 'svg'
									)
								),

								array(
									'name'        => 'title',
									'label'       => esc_html_x( 'Title', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Enter the title', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => esc_html__( 'Default Title', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'desc',
									'label'       => esc_html_x( 'Description', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'textarea',
									'description' => esc_html_x( 'Enter the description', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => ''
								),

								array(
									'name'        => 'ex_class',
									'label'       => esc_html_x( 'Extra Class', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => '',
									'description' => esc_html_x( 'Enter the extra class', 'shortcode-map', 'octagon-kc-elements' )
								)

							),

							esc_html_x( 'Button', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'show_btn',
									'label'       => esc_html_x( 'Show Button?', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'value'       => 'hide',
									'options'     => array(
										'show' => esc_html_x( 'Show', 'shortcode-map', 'octagon-kc-elements' ),
										'hide' => esc_html_x( 'Hide', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

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
										'btn-color-black'    => esc_html_x( 'Black', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-white'    => esc_html_x( 'White', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-base'     => esc_html_x( 'Base', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-gradient' => esc_html_x( 'Gradient', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'show_icon',
									'label'       => esc_html_x( 'Show Icon?', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'toggle',
									'value'       => 'no'
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
									'name'        => 'btn_icon',
									'label'       => esc_html_x( 'Button Icon', 'shortcode-map', 'octagon-kc-elements' ),
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
									'name'        => 'btn_ex_class',
									'label'       => esc_html_x( 'Button Extra Class', 'shortcode-map', 'octagon-kc-elements' ),
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
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-wrap span' ),
												array( 'property' => 'fill', 'label' => esc_html_x( 'Fill Color( SVG )', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-wrap svg' ),
												array( 'property' => 'max-width', 'label' => esc_html_x( 'Width( SVG )', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-wrap svg' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-wrap span' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-wrap span' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-wrap span' ),
												array( 'property' => 'width', 'selector' => '.icon-box .icon-wrap span, .icon-box .icon-wrap img' ),
												array( 'property' => 'height', 'selector' => '.icon-box .icon-wrap span, .icon-box .icon-wrap img' ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-wrap span, .icon-box .icon-wrap img' ),
												array( 'property' => 'border-radius', 'label' => esc_html_x( 'Border Radius', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-wrap span, .icon-box .icon-wrap img' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-wrap span, .icon-box .icon-wrap img' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-wrap' )
											),
											esc_html_x( 'Title', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-box-title' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-box-title' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-box-title' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-box-title' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-box-title' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-box-title' ),
												array( 'property' => 'text-align', 'label' => esc_html_x( 'Align', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-box-title' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-box-title' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .icon-box-title' )
											),
											esc_html_x( 'Description', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .description' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .description' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .description' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .description' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .description' ),
												array( 'property' => 'text-align', 'label' => esc_html_x( 'Align', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .description' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .description' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .description' )
											),
											esc_html_x( 'Button Style', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'text-align', 'label' => esc_html_x( 'Align', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'width', 'selector' => '.icon-box .btn' ),
												array( 'property' => 'height', 'selector' => '.icon-box .btn' ),
												array( 'property' => 'display', 'label' => esc_html_x( 'Display', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'border-radius', 'label' => esc_html_x( 'Border Radius', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Icon Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn span' )
											),
											esc_html_x( 'Mouse Hover', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn:hover' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn:hover' ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box .btn:hover' )
											),

											esc_html_x( 'Box', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'background', 'label' => esc_html_x( 'Background', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box' ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box' ),
												array( 'property' => 'border-radius', 'label' => esc_html_x( 'Border Radius', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box' ),
												array( 'property' => 'box-shadow', 'label' => esc_html_x( 'Box Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box' ),
												array( 'property' => 'min-height', 'label' => esc_html_x( 'Min Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.icon-box' )
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
				'style'         => 'style1',
				'title_tag'     => 'h3', // h1, h2, h3, h4, h5, h6, p
				'alignment'     => 'center',
				'type'          => 'icon',
				'icon'          => 'sl-lock',
				'image'         => '',
				'title'         => esc_html__( 'Default Title', 'octagon-kc-elements' ),
				'desc'          => '',
				'ex_class'      => '',
				'show_btn'      => 'hide',
				'text_title'    => esc_html__( 'Text Button', 'octagon-kc-elements' ),
				'link'          => '',
				'btn_size'      => 'btn-size-small',
				'btn_type'      => 'btn-type-solid-ellipse',
				'btn_color'     => 'btn-color-black',
				'show_icon'     => 'no',
				'only_icon'     => 'no',
				'btn_icon'      => 'sl-lock',
				'icon_position' => 'left',
				'onclick'       => '',
				'btn_ex_class'  => ''
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'icon-box-'. $style, $atts );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_icon_box_module();