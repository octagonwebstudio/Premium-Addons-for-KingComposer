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

if( ! class_exists( 'octagon_kc_elements_content_type_module' ) ) {

	class octagon_kc_elements_content_type_module {

		public $paged = '';

		public $args = array();

		public $taxonomy_list = array();

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_content_type', array( $this, 'content' ) );

			add_action( 'wp_ajax_octagon_kc_elements_content_type_loadmore',  array( $this, 'loadmore' ) );
			add_action( 'wp_ajax_nopriv_octagon_kc_elements_content_type_loadmore', array( $this, 'loadmore' ) );
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
					'octagon_kc_elements_content_type' => array(
						'name' => esc_html_x( 'Content Type', 'shortcode-map', 'octagon-kc-elements' ),
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
										'masonry'     => esc_html_x( 'Masonry', 'shortcode-map', 'octagon-kc-elements' ),
										'split-round' => esc_html_x( 'Split Round Image', 'shortcode-map', 'octagon-kc-elements' )
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
									'name'        => 'columns',
									'label'       => esc_html_x( 'Columns', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the column.', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'col-md-4',
									'options'     => array(
										'col-md-6' => esc_html_x( '2 Column', 'shortcode-map', 'octagon-kc-elements' ),
										'col-md-4' => esc_html_x( '3 Column', 'shortcode-map', 'octagon-kc-elements' ),
										'col-md-3' => esc_html_x( '4 Column', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'meta',
									'label'       => esc_html_x( 'Meta', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose a meta', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'category',
									'options'     => array(
										'none'     => esc_html_x( 'None', 'shortcode-map', 'octagon-kc-elements' ),
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
									'name'        => 'custom_width',
									'label'       => esc_html_x( 'Custom Image Width', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => '700',
									'description' => esc_html_x( 'Enter the image width in integer.', 'shortcode-map', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'custom_height',
									'label'       => esc_html_x( 'Custom Image Height', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => '500',
									'description' => esc_html_x( 'Enter the image height in integer.', 'shortcode-map', 'octagon-kc-elements' )
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
										'btn-size-small'  => esc_html_x( 'Small', 'shortcode-map', 'octagon-kc-elements' )
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
										'btn-type-half-line'       => esc_html_x( 'Half Line', 'shortcode-map', 'octagon-kc-elements' ),
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
										'btn-color-primary'  => esc_html_x( 'Primary', 'shortcode-map', 'octagon-kc-elements' ),
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
											esc_html_x( 'Button Style', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'text-align', 'label' => esc_html_x( 'Align', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'width', 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'height', 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'display', 'label' => esc_html_x( 'Display', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'border-radius', 'label' => esc_html_x( 'Border Radius', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Icon Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.content-type .post-content .btn span' )
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
		 * Output shortcode content
		 * 
		 * @since  1.0
		 * @return mixed
		 */
		public function content( $atts ) {
			extract( shortcode_atts( array(
				'style'         => 'masonry', // masonry, split-round
				'title_tag'     => 'h3', // h1, h2, h3, h4, h5, h6, p
				'columns'       => 'col-md-4', // col-md-3, col-md-4, col-md-6
				'meta'          => 'category', // none, category, date
				'excerpt'       => 'show', // show, hide
				'excerpt_limit' => '100',
				'custom_width'  => '700',
				'custom_height' => '500',
				'pagination'    => 'loadmore',  // none, loadmore, infinite-scroll, number, next-prev
				'ex_class'      => '', // show, hide
				'content_type'  => 'post',
				'taxonomy'      => 'category',
				'method'        => 'default', // default, id, terms, author
				'order'         => 'desc', // asc, desc
				'orderby'       => 'date', // date, ID, modified, title, rand, post__in, post_name__in
				'items'         => '6',
				'post_in'       => '',
				'terms_in'      => '',
				'author_in'     => '',
				'post_not_in'   => '',
				'terms_not_in'  => '',
				'author_not_in' => '',
				'offset'        => '',
				'show_btn'      => 'show', // show, hide
				'btn_text'      => esc_html__( 'Read More', 'octagon-kc-elements' ),
				'btn_size'      => 'btn-size-mini', // btn-size-mini, btn-size-small
				'btn_type'      => 'btn-type-no-bg',
				'btn_color'     => 'btn-color-black'
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			// WP Query arguements passed as options
			$atts['args']  = $this->get_query( $atts );
			$atts['paged'] = $this->paged;

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'content-type-'. $style, $atts );
			$output .= '</div>';

			return $output;

		}

		public function loadmore() {
			
			$max     = isset( $_POST['max'] ) ? absint( $_POST['max'] ) : '';
			$paged   = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : '';
			$options = isset( $_POST['options'] ) && is_array( $_POST['options'] ) ? (array) $_POST['options'] : '';

			if( ! octagon_is_number( $max ) || ! octagon_is_number( $paged ) || ! is_array( $options ) ) {
				die();
			}

			$last_page = ( $paged == $max ) ? true : false;

			echo '<div class="ajax-content">';

				echo '<div class="html-content">';

					echo octagon_kc_elements_get_shortcode_template( 'content-type-'. $options['style'], $options );

				echo '</div>';

				echo '<div class="json-values">';
					echo "<div class='json' data-value='". json_encode( array( 'paged' => $paged, 'last_page' => $last_page ) ) ."'></div>";
				echo '</div>';

			echo '</div>';

			die();
		}
				
	}
}

new octagon_kc_elements_content_type_module;