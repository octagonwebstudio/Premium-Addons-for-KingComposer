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

if( ! class_exists( 'octagon_kc_elements_testimonial_slider_module' ) ) {

	class octagon_kc_elements_testimonial_slider_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_testimonial_slider', array( $this, 'content' ) );
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
					'octagon_kc_elements_testimonial_slider' => array(
						'name' => esc_html_x( 'Testimonial Slider', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-testimonial-slider',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'style',
									'label'       => esc_html_x( 'Style', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the style.', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'style1',
									'options'     => array(
										'style' => esc_html_x( 'Style 1', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'show_thumb',
									'label'       => esc_html_x( 'Thumbnail', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Show thumbnail?', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'show',
									'options'     => array(
										'show' => esc_html_x( 'Show', 'shortcode-map', 'octagon-kc-elements' ),
										'hide' => esc_html_x( 'Hide', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'show_name',
									'label'       => esc_html_x( 'Client Name', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Show client name?', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'show',
									'options'     => array(
										'show' => esc_html_x( 'Show', 'shortcode-map', 'octagon-kc-elements' ),
										'hide' => esc_html_x( 'Hide', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'show_job',
									'label'       => esc_html_x( 'Client Job', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Show client job?', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'show',
									'options'     => array(
										'show' => esc_html_x( 'Show', 'shortcode-map', 'octagon-kc-elements' ),
										'hide' => esc_html_x( 'Hide', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'show_rating',
									'label'       => esc_html_x( 'Rating', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Show rating?', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'show',
									'options'     => array(
										'show' => esc_html_x( 'Show', 'shortcode-map', 'octagon-kc-elements' ),
										'hide' => esc_html_x( 'Hide', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'excerpt_limit',
									'label'       => esc_html_x( 'Excerpt Limit', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => '200',
									'description' => esc_html_x( 'Enter the excerpt limit in integer.( Eg: 200 )', 'shortcode-map', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'ex_class',
									'label'       => esc_html_x( 'Extra Class', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => '',
									'description' => esc_html_x( 'Enter the extra class', 'shortcode-map', 'octagon-kc-elements' )
								)

							),

							esc_html_x( 'Query', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'method',
									'label'       => esc_html_x( 'Choose method', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'admin_label' => true,
									'description' => esc_html_x( 'Choose how you want to show items', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'default',
									'options'     => array(
										'default' => esc_html_x( 'Default', 'shortcode-map', 'octagon-kc-elements' ),
										'id'      => esc_html_x( 'ID', 'shortcode-map', 'octagon-kc-elements' ),
										'rating'  => esc_html_x( 'Rating', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'order',
									'label'       => esc_html_x( 'Order', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'value'       => 'desc',
									'description' => esc_html_x( 'Sorting method', 'shortcode-map', 'octagon-kc-elements' ),
									'options'     => array(
										'desc' => esc_html_x( 'Descending Order', 'shortcode-map', 'octagon-kc-elements' ),
										'asc'  => esc_html_x( 'Ascending Order', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'orderby',
									'label'       => esc_html_x( 'Orderby', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'value'       => 'date',
									'description' => esc_html_x( 'Ordering method', 'shortcode-map', 'octagon-kc-elements' ),
									'options'     => array(
										'date'          => esc_html_x( 'Date', 'shortcode-map', 'octagon-kc-elements' ),
										'ID'            => esc_html_x( 'ID', 'shortcode-map', 'octagon-kc-elements' ),
										'modified'      => esc_html_x( 'Last Modified Date', 'shortcode-map', 'octagon-kc-elements' ),
										'title'         => esc_html_x( 'Title', 'shortcode-map', 'octagon-kc-elements' ),
										'rand'          => esc_html_x( 'Random Order', 'shortcode-map', 'octagon-kc-elements' ),
										'post__in'      => esc_html_x( 'Preserve ID Order', 'shortcode-map', 'octagon-kc-elements' ),
										'post_name__in' => esc_html_x( 'Preserve slug Order', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'type'        => 'text',
									'label'       => esc_html_x( 'Limit', 'shortcode-map', 'octagon-kc-elements' ),
									'name'        => 'items',
									'value'       => '3',
									'description' => esc_html_x( 'Type the post count.', 'shortcode-map', 'octagon-kc-elements' ),
									'relation'    => array(
										'parent'	=> 'method',
										'hide_when' => 'id'
									)
								),

								array(
									'type'        => 'text',
									'label'       => esc_html_x( 'ID', 'shortcode-map', 'octagon-kc-elements' ),
									'name'        => 'post_in',
									'value'       => '',
									'description' => esc_html_x( 'Type the id (integer), Explode it with commas.', 'shortcode-map', 'octagon-kc-elements' ),
									'relation'    => array(
										'parent'	=> 'method',
										'show_when' => 'id'
									)
								),

								array(
									'type'        => 'text',
									'label'       => esc_html_x( 'Exclude ID', 'shortcode-map', 'octagon-kc-elements' ),
									'name'        => 'post_not_in',
									'value'       => '',
									'description' => esc_html_x( 'Type the id (integer), Explode it with commas.', 'shortcode-map', 'octagon-kc-elements' ),
									'relation'    => array(
										'parent'	=> 'method',
										'hide_when' => 'id'
									)
								),

								array(
									'type'        => 'text',
									'label'       => esc_html_x( 'Offset Count', 'shortcode-map', 'octagon-kc-elements' ),
									'name'        => 'offset',
									'value'       => '',
									'description' => esc_html_x( 'Type the integer, How many posts you want to pass over.', 'shortcode-map', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'rating',
									'label'       => esc_html_x( 'Rating', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'value'       => 'date',
									'description' => esc_html_x( 'Rating posts.', 'shortcode-map', 'octagon-kc-elements' ),
									'options'     => array(
										'3' => esc_html_x( '3+', 'shortcode-map', 'octagon-kc-elements' ),
										'4' => esc_html_x( '4+', 'shortcode-map', 'octagon-kc-elements' ),
										'5' => esc_html_x( '5', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

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
							
							esc_html_x( 'Styling', 'shortcode-map', 'octagon-kc-elements' ) => array(
								array(
									'type'    => 'css',
									'label'   => esc_html_x( 'CSS', 'shortcode-map', 'octagon-kc-elements' ),
									'name'    => 'custom_css',
									'options' => array(
										array(
											'screens' => octagon_kc_elements_responsive_breakpoints(),
											esc_html_x( 'Excerpt', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .excerpt' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .excerpt' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .excerpt' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .excerpt' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .excerpt' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .excerpt' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .excerpt' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .excerpt' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .excerpt' ),
											),
											esc_html_x( 'Client Thumb', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .avatar' ),
											),
											esc_html_x( 'Client Name', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .client-name' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .client-name' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .client-name' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .title a' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .client-name' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .client-name' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .client-name' ),
											),
											esc_html_x( 'Client Job', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .client-job' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .client-job' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .client-job' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .title a' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .client-job' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .client-job' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .client-job' ),
											),
											esc_html_x( 'Rating', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.testimonial-slider .rating span' )
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
		 * Returns WP Query arguemnts
		 * 
 		 * @version 1.0
		 * @since  1.0
		 * @return array
		 */
		public function get_query( $atts ) {

			if( ! empty( $atts ) ) {
				extract( $atts );
			}

			$args = array(
				'post_type'           => 'octagon_testimonial',
				'ignore_sticky_posts' => true,
				'posts_per_page'      => $items,
				'order'               => $order,
				'orderby'             => $orderby
			);

			if( '' != $post_not_in ) {
				$post_not_in_array = explode( ',', $post_not_in );

				$args['post__not_in'] = $post_not_in_array;
			}

			if( '' != $offset ) {
				$args['offset'] = $offset;
			}

			if( '' != $post_in && 'id' == $method ) {
				$post_in_array = explode( ',', $post_in );

				$args['post__in'] = $post_in_array;
			}
			elseif( 'rating' == $method ) {
				$args['meta_query'][] = array(
					'key'   => 'client_rating',
					'value' => $rating,
					'compare' => '>='
				);
			}

			$this->args  = $args;

			return $this->args;

		}

		/**
		 * Returns Slider data attributes
		 * 
 		 * @version 1.0
		 * @since  1.0
		 * @return array
		 */
		public function get_slider_data( $atts ) {

			if( ! empty( $atts ) ) {
				extract( $atts );
			}

			$slide_data['accessibility']    = isset( $accessibility ) ? 'data-accessibility='. esc_attr( $accessibility ) : '';
			$slide_data['adaptive_height']  = isset( $adaptive_height ) ? 'data-adaptive-height='. esc_attr( $adaptive_height ) : '';
			$slide_data['autoplay']         = isset( $autoplay ) ? 'data-autoplay='. esc_attr( $autoplay ) : '';
			$slide_data['autoplay_speed']   = isset( $autoplay_speed ) ? 'data-autoplay-speed='. esc_attr( $autoplay_speed ) : '';
			$slide_data['arrows']           = isset( $arrows ) ? 'data-arrows='. esc_attr( $arrows ) : '';
			$slide_data['center_mode']      = isset( $center_mode ) ? 'data-center-mode='. esc_attr( $center_mode ) : '';
			$slide_data['center_padding']   = isset( $center_padding ) ? 'data-center-padding='. esc_attr( $center_padding ) : '';
			$slide_data['dots']             = isset( $dots ) ? 'data-dots='. esc_attr( $dots ) : '';
			$slide_data['draggable']        = isset( $draggable ) ? 'data-draggable='. esc_attr( $draggable ) : '';
			$slide_data['infinite']         = isset( $infinite ) ? 'data-infinite='. esc_attr( $infinite ) : '';
			$slide_data['initial_slide']    = isset( $initial_slide ) ? 'data-initial-slide='. esc_attr( $initial_slide ) : '';
			$slide_data['pause_on_hover']   = isset( $pause_on_hover ) ? 'data-pause-on-hover='. esc_attr( $pause_on_hover ) : '';
			$slide_data['slides_per_row']   = 'data-slides-per-row=1';
			$slide_data['slides_to_show']   = 'data-slides-to-show=1';
			$slide_data['slides_to_scroll'] = 'data-slides-to-scroll=1';
			$slide_data['speed']            = isset( $speed ) ? 'data-speed='. esc_attr( $speed ) : '';
			$slide_data['swipe']            = isset( $swipe ) ? 'data-swipe='. esc_attr( $swipe ) : '';
			$slide_data['touch_move']       = isset( $touch_move ) ? 'data-touch-move='. esc_attr( $touch_move ) : '';
			$slide_data['rtl']              = isset( $rtl ) ? 'data-rtl='. esc_attr( $rtl ) : '';

			$slide_data = array_filter( $slide_data );

			$slide_data = apply_filters( 'octagon_testimonial_slider_data', $slide_data );

			$this->slide_data = array_filter( $slide_data );

			return $this->slide_data;

		}

		/**
		 * Output shortcode content
		 * 
		 * @since  1.0
		 * @return mixed
		 */
		public function content( $atts ) {
			extract( shortcode_atts( array(
				'style'           => 'style1', // style1
				'show_thumb'      => 'show', // show, hide
				'show_name'       => 'show', // show, hide
				'show_job'        => 'show', // show, hide
				'show_rating'     => 'show', // show, hide
				'excerpt_limit'   => '200',
				'ex_class'        => '', // show, hide
				'method'          => 'default', // default, id, rating
				'order'           => 'desc', // asc, desc
				'orderby'         => 'date', // date, ID, modified, title, rand, post__in, post_name__in
				'items'           => '3',
				'post_in'         => '',
				'post_not_in'     => '',
				'offset'          => '',
				'rating'          => 'average',
				'accessibility'   => 'true', // true, false
				'adaptive_height' => 'false', // true, false
				'autoplay'        => 'false', // true, false
				'autoplay_speed'  => '3000',
				'arrows'          => 'true', // true, false
				'center_mode'     => 'false', // true, false
				'dots'            => 'false', // true, false
				'draggable'       => 'true', // true, false
				'infinite'        => 'true', // true, false
				'initial_slide'   => '0',
				'pause_on_hover'  => 'true', // true, false
				'speed'           => '300',
				'swipe'           => 'true', // true, false
				'touch_move'      => 'true', // true, false
				'rtl'             => 'false', // true, false
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			// WP Query arguements passed as options
			$atts['args']       = $this->get_query( $atts );
			$atts['slide_data'] = $this->get_slider_data( $atts );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'testimonial-slider', $atts );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_testimonial_slider_module;