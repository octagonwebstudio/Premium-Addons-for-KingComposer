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

if( ! class_exists( 'octagon_kc_elements_video_popup_module' ) ) {

	class octagon_kc_elements_video_popup_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_video_popup', array( $this, 'content' ) );
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
					'octagon_kc_elements_video_popup' => array(
						'name' => esc_html_x( 'Video Popup', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-video-popup',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'video_link',
									'label'       => esc_html_x( 'Youtube/Vimeo Link', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => '',
									'description' => esc_html_x( 'Enter the youtube/vimeo video link', 'shortcode-map', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'trigger',
									'label'       => esc_html_x( 'Trigger', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Select trigger type', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'icon',
									'options'     => array(
										'icon'  => esc_html_x( 'Icon', 'shortcode-map', 'octagon-kc-elements' ),
										'text'  => esc_html_x( 'Text', 'shortcode-map', 'octagon-kc-elements' ),
										'image' => esc_html_x( 'Image', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'trigger_icon',
									'label'       => esc_html_x( 'Trigger Icon', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'icon_picker',
									'description' => esc_html_x( 'Choose the trigger icon', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'oct-basic-caret-circle-right',
									'relation'    => array(
										'parent'    => 'trigger',
										'show_when' => 'icon'
									)
								),

								array(
									'name'        => 'trigger_text',
									'label'       => esc_html_x( 'Trigger Text', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => '',
									'description' => esc_html_x( 'Enter the trigger text', 'shortcode-map', 'octagon-kc-elements' ),
									'relation'    => array(
										'parent'    => 'trigger',
										'show_when' => 'text'
									)
								),

								array(
									'name'        => 'trigger_image',
									'label'       => esc_html_x( 'Trigger Image', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'attach_image',
									'value'       => '',
									'description' => esc_html_x( 'Choose the trigger image', 'shortcode-map', 'octagon-kc-elements' ),
									'relation'    => array(
										'parent'    => 'trigger',
										'show_when' => 'image'
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
											esc_html_x( 'Trigger', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.magnify-video, .magnify-video span' ),
												array( 'property' => 'background', 'label' => esc_html_x( 'Background', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.magnify-video, .magnify-video span' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.magnify-video, .magnify-video span' ),
												array( 'property' => 'border-radius', 'label' => esc_html_x( 'Border Radius', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.magnify-video, .magnify-video span' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.magnify-video, .magnify-video span' ),
												array( 'property' => 'text-align', 'label' => esc_html_x( 'Text Align', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.video-popup' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.magnify-video, .magnify-video span' )
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
				'video_link'    => '',
				'trigger'       => 'icon',
				'trigger_icon'  => 'oct-circle-thick-arrow-right',
				'trigger_text'  => '',
				'trigger_image' => '',
				'ex_class'      => ''
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'video-popup', $atts );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_video_popup_module;