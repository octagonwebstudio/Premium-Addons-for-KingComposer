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

if( ! class_exists( 'octagon_kc_elements_slide_all_module' ) ) {

	class octagon_kc_elements_slide_all_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_slide_all', array( $this, 'content' ) );
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
					'octagon_kc_elements_slide_all' => array(
						'name'          => esc_html_x( 'Slide All', 'shortcode-map', 'octagon-kc-elements' ),
						'title'         => esc_html_x( 'Slide All', 'shortcode-map', 'octagon-kc-elements' ),
						'icon'          => 'icon-slide-all',
						'nested'        => true,
						'except_child'  => 'octagon_kc_elements_slide_all',
						'except_parent' => 'octagon_kc_elements_slide_all',
						'category'      => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params'        => array(

							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'ex_class',
									'label'       => esc_html_x( 'Extra Class', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => '',
									'description' => esc_html_x( 'Enter the extra class', 'shortcode-map', 'octagon-kc-elements' )
								)

							),

							esc_html_x( 'Slider', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'accessibility',
									'label'       => esc_html_x( 'Accessibility', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Enables tabbing and arrow key navigation', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'true',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'adaptive_height',
									'label'       => esc_html_x( 'Adaptive Height', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Enables adaptive height for single slide horizontal carousels', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'false',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'autoplay',
									'label'       => esc_html_x( 'Autoplay', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Enables Autoplay', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'false',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'autoplay_speed',
									'label'       => esc_html_x( 'Autoplay Speed', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Autoplay Speed in milliseconds', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '3000'
								),

								array(
									'name'        => 'arrows',
									'label'       => esc_html_x( 'Arrows', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Prev/Next Arrows', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'true',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'center_mode',
									'label'       => esc_html_x( 'Center Mode', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Enables centered view with partial prev/next slides. Use with odd numbered slides to show counts.', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'false',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'center_padding',
									'label'       => esc_html_x( 'Center Padding', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Side padding when in center mode (px or %)', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '50px'
								),

								array(
									'name'        => 'css_ease',
									'label'       => esc_html_x( 'CSS Ease', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'CSS3 Animation Easing', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'ease',
									'options'     => array(
										'linear'      => esc_html_x( 'Linear', 'shortcode-map', 'octagon-kc-elements' ),
										'ease'        => esc_html_x( 'Ease', 'shortcode-map', 'octagon-kc-elements' ),
										'ease-in'     => esc_html_x( 'Ease In', 'shortcode-map', 'octagon-kc-elements' ),
										'ease-out'    => esc_html_x( 'Ease Out', 'shortcode-map', 'octagon-kc-elements' ),
										'ease-in-out' => esc_html_x( 'Ease In Out', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'dots',
									'label'       => esc_html_x( 'Dots', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Show dot indicators', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'false',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'draggable',
									'label'       => esc_html_x( 'Draggable', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Enable mouse dragging', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'true',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'fade',
									'label'       => esc_html_x( 'Fade', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Enable fade', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'false',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'easing',
									'label'       => esc_html_x( 'Easing', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Choose easing methods', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'linear',
									'options'     => array(
										'linear' => esc_html_x( 'Linear', 'shortcode-map', 'octagon-kc-elements' ),
										'swing'  => esc_html_x( 'Swing', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'edge_friction',
									'label'       => esc_html_x( 'Edge Friction', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Resistance when swiping edges of non-infinite carousels( integer )', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '0.15'
								),

								array(
									'name'        => 'infinite',
									'label'       => esc_html_x( 'Infinite', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Infinite loop sliding', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'true',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'initial_slide',
									'label'       => esc_html_x( 'Initial Slide', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Slide to start on( integer )', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '0'
								),

								array(
									'name'        => 'lazy_load',
									'label'       => esc_html_x( 'Lazy Load', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Set lazy loading technique. Accepts "ondemand" or "progressive"', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'ondemand',
									'options'     => array(
										'ondemand'    => esc_html_x( 'On Demand', 'shortcode-map', 'octagon-kc-elements' ),
										'progressive' => esc_html_x( 'Progressive', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'pause_on_hover',
									'label'       => esc_html_x( 'Pause On Hover', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Pause autoplay on hover', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'true',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'pause_on_dots_hover',
									'label'       => esc_html_x( 'Pause On Dots Hover', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Pause autoplay when a dot is hovered', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'false',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'rows',
									'label'       => esc_html_x( 'Rows', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Setting this to more than 1 initializes grid mode. Use "Slides Per Row" to set how many slides should be in each row.( integer )', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '1'
								),

								array(
									'name'        => 'slides_per_row',
									'label'       => esc_html_x( 'Slides Per Row', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'With grid mode intialized via the rows option, this sets how many slides are in each grid row( integer )', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '1'
								),

								array(
									'name'        => 'slides_to_show',
									'label'       => esc_html_x( 'Slides To Show', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( '# of slides to show', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '3'
								),

								array(
									'name'        => 'slides_to_scroll',
									'label'       => esc_html_x( 'Slides To Scroll', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( '# of slides to scroll', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '1'
								),

								array(
									'name'        => 'speed',
									'label'       => esc_html_x( 'Speed', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Slide/Fade animation speed in milliseconds', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '300'
								),

								array(
									'name'        => 'swipe',
									'label'       => esc_html_x( 'Swipe', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Enable swiping', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'true',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'touch_move',
									'label'       => esc_html_x( 'Touch Move', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Enable slide motion with touch', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'true',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'variable_width',
									'label'       => esc_html_x( 'Variable Width', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Variable width slides', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'false',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'vertical',
									'label'       => esc_html_x( 'Vertical', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Vertical slide mode', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'false',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'vertical_swiping',
									'label'       => esc_html_x( 'Vertical Swiping', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Vertical swipe mode', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'false',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'rtl',
									'label'       => esc_html_x( 'RTL', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'description' => esc_html_x( 'Change the sliders direction to become right to left', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'false',
									'options'     => array(
										'true'  => esc_html_x( 'True', 'shortcode-map', 'octagon-kc-elements' ),
										'false' => esc_html_x( 'False', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

							),

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
		public function content( $atts, $content, $code ) {
			extract( shortcode_atts( array(
				'ex_class'            => '',
				'accessibility'       => 'true', // true, false
				'adaptive_height'     => 'false', // true, false
				'autoplay'            => 'false', // true, false
				'autoplay_speed'      => '3000',
				'arrows'              => 'true', // true, false
				'center_mode'         => 'false', // true, false
				'center_padding'      => '50px',
				'css_ease'            => 'ease', // linear, ease, ease-in, ease-out, ease-in-out
				'dots'                => 'false', // true, false
				'draggable'           => 'true', // true, false
				'fade'                => 'false', // true, false
				'easing'              => 'linear', // linear, swing
				'edge_friction'       => '0.15',
				'infinite'            => 'true', // true, false
				'initial_slide'       => '0',
				'lazy_load'           => 'ondemand', // ondemand, progressive
				'pause_on_hover'      => 'true', // true, false
				'pause_on_dots_hover' => 'false', // true, false
				'rows'                => '1',
				'slides_per_row'      => '1',
				'slides_to_show'      => '3',
				'slides_to_scroll'    => '1',
				'speed'               => '300',
				'swipe'               => 'true', // true, false
				'touch_move'          => 'true', // true, false
				'variable_width'      => 'false', // true, false
				'vertical'            => 'false', // true, false
				'vertical_swiping'    => 'false', // true, false
				'rtl'                 => 'false', // true, false
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'slide-all', $atts, $content );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_slide_all_module();