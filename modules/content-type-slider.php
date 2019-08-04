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

if( ! class_exists( 'octagon_kc_elements_content_type_slider_module' ) ) {

	class octagon_kc_elements_content_type_slider_module {

		public $paged = '';

		public $args = array();

		public $taxonomy_list = array();

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_content_type_slider', array( $this, 'content' ) );
		}
		
		/**
		 * KingComposer page builder shortcode map
		 * 
		 * @since  1.0
		 * @return mixed
		 */
		public function map() {

			$taxonomy_list = array();
			$taxonomies = get_taxonomies( array(
					'public'       => true,
					'_builtin'     => false,
					'hierarchical' => true
				),
				'names'
			);

			// '_builtin' true removes default category, so add it manually
			$taxonomies = array_merge( array( 'category' => 'category' ), $taxonomies );

			foreach( $taxonomies as $key => $taxonomy ) {

				$obj = get_taxonomy( $key );
				$this->taxonomy_list[$key] = $obj->label;
			}
			
			kc_add_map(
				array(
					'octagon_kc_elements_content_type_slider' => array(
						'name' => esc_html_x( 'Content Type Slider', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-content-type',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'style',
									'label'       => esc_html_x( 'Style', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the style.', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'masonry',
									'options'     => array(
										'masonry' => esc_html_x( 'Masonry', 'shortcode-map', 'octagon-kc-elements' )
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
									'name'        => 'meta',
									'label'       => esc_html_x( 'Meta', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose a meta', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'date',
									'options'     => array(
										'date'     => esc_html_x( 'Date', 'shortcode-map', 'octagon-kc-elements' ),
										'category' => esc_html_x( 'Category', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'excerpt',
									'label'       => esc_html_x( 'Excerpt', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Show excerpt?', 'shortcode-map', 'octagon-kc-elements' ),
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
									'value'       => '100',
									'description' => esc_html_x( 'Enter the excerpt limit in integer.( Eg: 100 )', 'shortcode-map', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'pagination',
									'label'       => esc_html_x( 'Pagination', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose pagination style', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'loadmore',
									'options'     => array(
										'none'            => esc_html_x( 'None', 'shortcode-map', 'octagon-kc-elements' ),
										'loadmore'        => esc_html_x( 'Loadmore', 'shortcode-map', 'octagon-kc-elements' ),
										'infinite-scroll' => esc_html_x( 'Infinite Scroll', 'shortcode-map', 'octagon-kc-elements' ),
										'number'          => esc_html_x( 'Number', 'shortcode-map', 'octagon-kc-elements' ),
										'next-prev'       => esc_html_x( 'Next Previous', 'shortcode-map', 'octagon-kc-elements' )
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

							esc_html_x( 'Query', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'type'        => 'select',
									'label'       => esc_html_x( 'Content Type', 'shortcode-map', 'octagon-kc-elements' ),
									'name'        => 'content_type',
									'value'       => 'post',
									'description' => esc_html_x( 'Choose the content type', 'shortcode-map', 'octagon-kc-elements' ),
									'options'     => octagon_post_type_list()
								),

								array(
									'type'        => 'select',
									'label'       => esc_html_x( 'Taxonomy', 'shortcode-map', 'octagon-kc-elements' ),
									'name'        => 'taxonomy',
									'value'       => 'category',
									'description' => esc_html_x( 'Choose the taxonomy', 'shortcode-map', 'octagon-kc-elements' ),
									'options'     => $this->taxonomy_list
								),

								array(
									'name'        => 'method',
									'label'       => esc_html_x( 'Choose method', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'admin_label' => true,
									'description' => esc_html_x( 'Choose how you want to show items', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'default',
									'options'     => array(
										'default'  => esc_html_x( 'Default', 'shortcode-map', 'octagon-kc-elements' ),
										'id'       => esc_html_x( 'ID', 'shortcode-map', 'octagon-kc-elements' ),
										'terms'    => esc_html_x( 'Terms', 'shortcode-map', 'octagon-kc-elements' ),
										'author'   => esc_html_x( 'Author', 'shortcode-map', 'octagon-kc-elements' ),
										'popular'  => esc_html_x( 'Popular', 'shortcode-map', 'octagon-kc-elements' ),
										'featured' => esc_html_x( 'Featured', 'shortcode-map', 'octagon-kc-elements' )
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
									'value'       => '6',
									'description' => esc_html_x( 'Type the post count (integer).', 'shortcode-map', 'octagon-kc-elements' ),
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
									'label'       => esc_html_x( 'Terms', 'shortcode-map', 'octagon-kc-elements' ),
									'name'        => 'terms_in',
									'value'       => '',
									'description' => esc_html_x( 'Type the terms slug, Explode it with commas.', 'shortcode-map', 'octagon-kc-elements' ),
									'relation'    => array(
										'parent'	=> 'method',
										'show_when' => 'terms'
									)
								),

								array(
									'type'        => 'text',
									'label'       => esc_html_x( 'Author', 'shortcode-map', 'octagon-kc-elements' ),
									'name'        => 'author_in',
									'value'       => '',
									'description' => esc_html_x( 'Type the author username, Explode it with commas.', 'shortcode-map', 'octagon-kc-elements' ),
									'relation'    => array(
										'parent'	=> 'method',
										'show_when' => 'author'
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
									'label'       => esc_html_x( 'Exclude Terms', 'shortcode-map', 'octagon-kc-elements' ),
									'name'        => 'terms_not_in',
									'value'       => '',
									'description' => esc_html_x( 'Type the terms slug, Explode it with commas.', 'shortcode-map', 'octagon-kc-elements' ),
									'relation'    => array(
										'parent'	=> 'method',
										'hide_when' => 'terms'
									)
								),

								array(
									'type'        => 'text',
									'label'       => esc_html_x( 'Exclude Author', 'shortcode-map', 'octagon-kc-elements' ),
									'name'        => 'author_not_in',
									'value'       => '',
									'description' => esc_html_x( 'Type the author username, Explode it with commas.', 'shortcode-map', 'octagon-kc-elements' ),
									'relation'    => array(
										'parent'	=> 'method',
										'hide_when' => 'author'
									)
								),

								array(
									'type'        => 'text',
									'label'       => esc_html_x( 'Offset Count', 'shortcode-map', 'octagon-kc-elements' ),
									'name'        => 'offset',
									'value'       => '',
									'description' => esc_html_x( 'Type the integer, How many posts you want to pass over.', 'shortcode-map', 'octagon-kc-elements' )
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
									'name'        => 'center_padding',
									'label'       => esc_html_x( 'Center Padding', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Side padding when in center mode (px or %)', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => '50px'
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
									'value'       => '3'
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

							esc_html_x( 'Button', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'show_btn',
									'label'       => esc_html_x( 'Show Button', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Show button below the excerpt?', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'show',
									'options'     => array(
										'show' => esc_html_x( 'Show', 'shortcode-map', 'octagon-kc-elements' ),
										'hide' => esc_html_x( 'Hide', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'btn_text',
									'label'       => esc_html_x( 'Button Text', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'description' => esc_html_x( 'Enter the button text', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => esc_html__( 'Read More', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'btn_size',
									'label'       => esc_html_x( 'Button Size', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'value'       => 'btn-size-mini',
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
									'value'       => 'btn-type-no-bg',
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
											esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'width', 'label' => esc_html_x( 'Width', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post' ),
											),
											esc_html_x( 'Meta', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .meta-group p, .content-type .meta-group p a' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .meta-group p, .content-type .meta-group p a' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .meta-group p, .content-type .meta-group p a' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .meta-group p, .content-type .meta-group p a' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .meta-group p, .content-type .meta-group p a' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .meta-group p, .content-type .meta-group p a' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .meta-group p, .content-type .meta-group p a' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .meta-group p, .content-type .meta-group p a' ),
												array( 'property' => 'border-radius', 'label' => esc_html_x( 'Border Radius', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .meta-group p, .content-type .meta-group p a' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .meta-group p, .content-type .meta-group p a' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .meta-group p, .content-type .meta-group p a' ),
											),
											esc_html_x( 'Title', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .title a' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .title a' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .title a' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .title a' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .title a' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .title a' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .title a' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .title a' ),
											),
											esc_html_x( 'Excerpt', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .number' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .number' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .number' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .title a' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .number' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .number' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .number' ),
											),

											esc_html_x( 'Number', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .excerpt' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .excerpt' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .excerpt' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .excerpt' ),
											),
											esc_html_x( 'Button Style', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'text-align', 'label' => esc_html_x( 'Align', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'width', 'selector' => '.content-type .btn' ),
												array( 'property' => 'height', 'selector' => '.content-type .btn' ),
												array( 'property' => 'display', 'label' => esc_html_x( 'Display', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'border-radius', 'label' => esc_html_x( 'Border Radius', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Icon Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn span' )
											),
											esc_html_x( 'Mouse Hover', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn:hover' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn:hover' ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .btn:hover' )
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

			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

			$args = array(
				'post_type'           => $content_type,
				'ignore_sticky_posts' => true,
				'posts_per_page'      => $items,
				'paged'               => $paged,
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

			if( '' != $terms_not_in ) {
				$terms_not_in_array = explode( ',', $terms_not_in );

				$args['tax_query'][] = array(
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $terms_not_in_array,
					'operator' => 'NOT IN'
				);
			}

			if( '' != $author_not_in ) {
				$author_not_in_array = explode( ',', $author_not_in );

				foreach( $author_not_in_array as $key => $username ) {
					if ( username_exists( $username ) ) {
						$user_obj = get_user_by( 'login', $username );
						$user_not_in[] = $user_obj->ID;
					}
				}

				$args['author__not_in'] = $user_not_in;
			}

			if( '' != $post_in && 'id' == $method ) {
				$post_in_array = explode( ',', $post_in );

				$args['post__in'] = $post_in_array;
			}
			elseif( '' != $terms_in && 'terms' == $method ) {
				$terms_in_array = explode( ',', $terms_in );

				$args['tax_query'][] = array(
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $terms_in_array,
					'operator' => 'IN'
				);
			}
			elseif( '' != $author_in && 'author' == $method ) {
				$author_in_array = explode( ',', $author_in );

				foreach( $author_in_array as $key => $username ) {
					if ( username_exists( $username ) ) {
						$user_obj = get_user_by( 'login', $username );
						$user_in[] = $user_obj->ID;
					}					
				}

				$args['author__in'] = isset( $user_in ) ? $user_in : '';
			}
			elseif( 'popular' == $method ) {
				$args['orderby'] = 'comment_count';
			}
			elseif( 'featured' == $method ) {
				$args['meta_query'][] = array(
					'key'   => 'featured_post',
					'value' => 'featured'
				);
			}

			$this->args  = $args;
			$this->paged = $paged;

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

			$responsive = array(
				array(
					'breakpoint' => 1480,
					'settings' => array(
						'slidesToShow' => 3
					)
				),
				array(
					'breakpoint' => 1024,
					'settings' => array(
						'slidesToShow' => 2
					)
				),
				array(
					'breakpoint' => 767,
					'settings' => array(
						'slidesToShow' => 1,
						'slidesToScroll' => 1
					)
				)
			);

			$slide_data['accessibility']    = isset( $accessibility ) ? 'data-accessibility='. esc_attr( $accessibility ) : '';
			$slide_data['adaptive_height']  = isset( $adaptive_height ) ? 'data-adaptive-height='. esc_attr( $adaptive_height ) : '';
			$slide_data['autoplay']         = isset( $autoplay ) ? 'data-autoplay='. esc_attr( $autoplay ) : '';
			$slide_data['autoplay_speed']   = isset( $autoplay_speed ) ? 'data-autoplay-speed='. esc_attr( $autoplay_speed ) : '';
			$slide_data['arrows']           = isset( $arrows ) ? 'data-arrows='. esc_attr( $arrows ) : '';
			$slide_data['center_mode']      = isset( $center_mode ) ? 'data-center-mode='. esc_attr( $center_mode ) : '';
			$slide_data['center_padding']   = isset( $center_padding ) ? 'data-center-padding='. esc_attr( $center_padding ) : '';
			$slide_data['dots']             = isset( $dots ) ? 'data-dots='. esc_attr( $dots ) : '';
			$slide_data['draggable']        = isset( $draggable ) ? 'data-draggable='. esc_attr( $draggable ) : '';
			$slide_data['fade']             = isset( $fade ) ? 'data-fade='. esc_attr( $fade ) : '';
			$slide_data['easing']           = isset( $easing ) ? 'data-easing='. esc_attr( $easing ) : '';
			$slide_data['infinite']         = isset( $infinite ) ? 'data-infinite='. esc_attr( $infinite ) : '';
			$slide_data['initial_slide']    = isset( $initial_slide ) ? 'data-initial-slide='. esc_attr( $initial_slide ) : '';
			$slide_data['pause_on_hover']   = isset( $pause_on_hover ) ? 'data-pause-on-hover='. esc_attr( $pause_on_hover ) : '';
			$slide_data['slides_per_row']   = isset( $slides_per_row ) ? 'data-slides-per-row='. esc_attr( $slides_per_row ) : '';
			$slide_data['slides_to_show']   = isset( $slides_to_show ) ? 'data-slides-to-show='. esc_attr( $slides_to_show ) : '';
			$slide_data['slides_to_scroll'] = isset( $slides_to_scroll ) ? 'data-slides-to-scroll='. esc_attr( $slides_to_scroll ) : '';
			$slide_data['speed']            = isset( $speed ) ? 'data-speed='. esc_attr( $speed ) : '';
			$slide_data['swipe']            = isset( $swipe ) ? 'data-swipe='. esc_attr( $swipe ) : '';
			$slide_data['touch_move']       = isset( $touch_move ) ? 'data-touch-move='. esc_attr( $touch_move ) : '';
			$slide_data['rtl']              = isset( $rtl ) ? 'data-rtl='. esc_attr( $rtl ) : '';			
			$slide_data['responsive']       = 'data-responsive='. json_encode( $responsive );

			$slide_data = apply_filters( 'octagon_content_type_slider_data', $slide_data );

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
				'style'            => 'masonry', // masonry
				'title_tag'        => 'h3', // h1, h2, h3, h4, h5, h6, p
				'show_meta'        => 'show', // show, hide
				'meta'             => 'date', // category, date
				'excerpt'          => 'show', // show, hide
				'excerpt_limit'    => '100',
				'pagination'       => 'loadmore',  // none, loadmore, infinite-scroll, number, next-prev
				'ex_class'         => '', // show, hide
				'content_type'     => 'post',
				'taxonomy'         => 'category',
				'method'           => 'default', // default, id, terms, author
				'order'            => 'desc', // asc, desc
				'orderby'          => 'date', // date, ID, modified, title, rand, post__in, post_name__in
				'items'            => '6',
				'post_in'          => '',
				'terms_in'         => '',
				'author_in'        => '',
				'post_not_in'      => '',
				'terms_not_in'     => '',
				'author_not_in'    => '',
				'offset'           => '',
				'accessibility'    => 'true', // true, false
				'adaptive_height'  => 'false', // true, false
				'autoplay'         => 'false', // true, false
				'autoplay_speed'   => '3000',
				'arrows'           => 'true', // true, false
				'center_mode'      => 'false', // true, false
				'center_padding'   => '50px',
				'dots'             => 'false', // true, false
				'draggable'        => 'true', // true, false
				'fade'             => 'false', // true, false
				'easing'           => 'linear', // linear, swing
				'infinite'         => 'true', // true, false
				'initial_slide'    => '0',
				'pause_on_hover'   => 'true', // true, false
				'slides_per_row'   => '1',
				'slides_to_show'   => '3',
				'slides_to_scroll' => '3',
				'speed'            => '300',
				'swipe'            => 'true', // true, false
				'touch_move'       => 'true', // true, false
				'rtl'              => 'false', // true, false
				'show_btn'         => 'show', // show, hide
				'btn_text'         => esc_html__( 'Read More', 'octagon-kc-elements' ),
				'btn_size'         => 'btn-size-mini',
				'btn_type'         => 'btn-type-no-bg',
				'btn_color'        => 'btn-color-black'
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			// WP Query arguements passed as options
			$atts['args']       = $this->get_query( $atts );
			$atts['paged']      = $this->paged;
			$atts['slide_data'] = $this->get_slider_data( $atts );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'content-type-slider-'. $style, $atts );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_content_type_slider_module;