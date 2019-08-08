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

add_filter( 'use_block_editor_for_post_type', '__return_false' );



if( ! function_exists( 'octagon_core_get_template' ) ) {

	/**
	 * Get other templates passing attributes and including the file.
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  string $template_name    Template name
	 * @param  array $args 				Arguments
	 * @param  string $template_path  	Template path
	 * @param  string $default_path 	Default path
	 */
	function octagon_core_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args );
		}

		if( file_exists( get_template_directory() . $template_name ) ) {
			$located = get_template_directory() . $template_name;
		}
		elseif( file_exists( get_stylesheet_directory() . $template_name ) ) {
			$located = get_stylesheet_directory() . $template_name;
		}

		ob_start();
		include $located;
		return ob_get_clean();

	}
}

if( ! function_exists( 'octagon_kc_elements_get_shortcode_template' ) ) {

	/**
	 * Get other templates passing attributes and including the file
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  string 	$name 	Template File
	 * @param  array 	$atts 	Arguements
	 */
	function octagon_kc_elements_get_shortcode_template( $name = '', $atts = array(), $content = '', $code = '' ) {

		if ( ! empty( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		$template_name = "/template/shortcodes/{$name}.php";

		if( file_exists( get_template_directory() . $template_name ) ) {
			$located = get_template_directory() . $template_name;
		}
		elseif( file_exists( get_stylesheet_directory() . $template_name ) ) {
			$located = get_stylesheet_directory() . $template_name;
		}
		else {
			$located = OCTAGON_KC_ELEMENTS_PATH . "/shortcodes/{$name}.php";
		}

		ob_start();
		include $located;
		return ob_get_clean();

	}

}

if( ! function_exists( 'octagon_kc_elements_responsive_breakpoints' ) ) {

	/**
	 * Get breakpoints for KC CSS styling
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @return  string
	 */
	function octagon_kc_elements_responsive_breakpoints() {

		$breakpoints = apply_filters( 'octagon_kc_elements_responsive_breakpoints', array(
			'0'    => 'any',
			'1480' => '1480',
			'1200' => '1200',
			'1024' => '1024',
			'999'  => '999',
			'767'  => '767',
			'640'  => '640',
			'479'  => '479'
		) );

		$breakpoints = implode( ',', $breakpoints );

		return $breakpoints;

	}

}

if( ! function_exists( 'octagon_modules_list' ) ) {

	/**
	 * Get modules list
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @return array
	 */
	function octagon_modules_list() {

		$modules = apply_filters( 'octagon_modules_list', array(
			esc_html__( 'General', 'octagon-kc-elements' ) => array(				
				'advance_button'          => esc_html__( 'Advance Button', 'octagon-kc-elements' ),
				'advance_counter'         => esc_html__( 'Advance Counter', 'octagon-kc-elements' ),
				'content_type'            => esc_html__( 'Content Type', 'octagon-kc-elements' ),
				'content_type_list'       => esc_html__( 'Content Type List', 'octagon-kc-elements' ),
				'content_type_slider'     => esc_html__( 'Content Type Slider', 'octagon-kc-elements' ),
				'gradient_text'           => esc_html__( 'Gradient Text', 'octagon-kc-elements' ),
				'image_box'               => esc_html__( 'Image Box', 'octagon-kc-elements' ),
				'icon_box'                => esc_html__( 'Icon Box', 'octagon-kc-elements' ),
				'image_mask'              => esc_html__( 'Image Mask', 'octagon-kc-elements' ),
				'info_icons'              => esc_html__( 'Info Icons', 'octagon-kc-elements' ),
				'timeline'                => esc_html__( 'Timeline', 'octagon-kc-elements' ),
				'slide_all'               => esc_html__( 'Slide All', 'octagon-kc-elements' ),
				'slick_gallery'           => esc_html__( 'Slick Gallery', 'octagon-kc-elements' ),
				'portfolio'               => esc_html__( 'Portfolio', 'octagon-kc-elements' ),
				'portfolio_slider'        => esc_html__( 'Portfolio Slider', 'octagon-kc-elements' ),
				'portfolio_extend_slider' => esc_html__( 'Portfolio Extend Slider', 'octagon-kc-elements' ),
				'team'                    => esc_html__( 'Team', 'octagon-kc-elements' ),
				'team_slider'             => esc_html__( 'Team Slider', 'octagon-kc-elements' ),
				'testimonial_slider'      => esc_html__( 'Testimonial Slider', 'octagon-kc-elements' ),
				'video_popup'             => esc_html__( 'Video Popup', 'octagon-kc-elements' )
			),
			esc_html__( 'WooCommerce', 'octagon-kc-elements' ) => array(
				'products'         => esc_html__( 'Products', 'octagon-kc-elements' ),
				'products_slider'  => esc_html__( 'Products Slider', 'octagon-kc-elements' ),
				'products_list'    => esc_html__( 'Products List', 'octagon-kc-elements' ),
				'compare_products' => esc_html__( 'Compare Products', 'octagon-kc-elements' ),
				'wishlist'         => esc_html__( 'Wishlist', 'octagon-kc-elements' )
			)
		) );

		return $modules;
	}
}

if( ! function_exists( 'octagon_get_active_modules_list' ) ) {

	/**
	 * Get active modules list
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @return array
	 */
	function octagon_get_active_modules_list() {

		$modules = get_theme_mod( 'octagon_kc_elements_modules', array() );

		return $modules;
	}
}

if( ! function_exists( 'octagon_get_gradient_palette' ) ) {

	/**
	 * Get gradient palattes
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @return string
	 */
	function octagon_get_gradient_palette() {		
		return array();
	}
}

if( ! function_exists( 'octagon_get_color_codes' ) ) {

	/**
	 * Get primary color
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @return string
	 */
	function octagon_get_color_codes() {		
		return '';
	}
}

if( ! function_exists( 'octagon_all_consequence_term_ids' ) ) {

	/**
	 * Returns all related term ids based on posts
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  int  $id 	Post ID
	 * @param  string  $taxonomy Taxonomy
	 * @return array
	 */
	function octagon_all_consequence_term_ids( $id = 0, $taxonomy = 'category' ) {

		$value = array();

		$terms = get_the_terms( $id, $taxonomy );
		
		if( ! empty( $terms ) ) {
			foreach( $terms as $key => $term ) {
				$value[] = $term->term_id;
			}
		}

		return $value;

	}

}

if( ! function_exists( 'octagon_all_consequence_term_slugs' ) ) {

	/**
	 * Returns all related term slugs based on posts
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  int  $id 	Post ID
	 * @param  string  $taxonomy Taxonomy
	 * @return array
	 */
	function octagon_all_consequence_term_slugs( $id = 0, $taxonomy = 'category' ) {

		$value = array();

		$terms = get_the_terms( $id, $taxonomy );
		
		if( ! empty( $terms ) ) {
			foreach( $terms as $key => $term ) {
				$value[] = $term->slug;
			}
		}

		return $value;

	}

}

if( ! function_exists( 'octagon_get_excerpt' ) ) {

	/**
	 * Get excerpt
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  int  $charlength Character Length
	 * @return string
	 */
	function octagon_get_excerpt( $charlength = 150 ) {

		return octagon_short_text( get_the_excerpt(), $charlength );

	}

}



if( ! function_exists( 'octagon_get_meta' ) ) {

	/**
	 * Get metabox value
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  int  	$post_id 	Post ID
	 * @param  string  	$key 		Meta Key
	 * @param  string  	$default 	Default Value
	 * @return string
	 */
	function octagon_get_meta( $post_id = null, $key = '', $default = '' ) {

		$value = get_post_meta( $post_id, $key, true );

		$value = ( null == $value || '' == $value ) ? $default : $value;

		return $value;

	}

}



if( ! function_exists( 'octagon_pagination' ) ) {

	/**
	 * Get pagination
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  string 	$style 	Style
	 * @param  array 	$value 	Required Values
	 * @return mixed
	 */
	function octagon_pagination( $style = 'number', $value = array( 'type' => 'page', 'args' => array(), 'options' => array(), 'max' => null, 'ajax' => '' ) ) {

		$pagination = '';

		$type    = isset( $value['type'] ) ? $value['type'] : 'page';
		$args    = isset( $value['args'] ) ? $value['args'] : array();
		$options = isset( $value['options'] ) ? $value['options'] : array();
		$max     = isset( $value['max'] ) ? $value['max'] : null;
		$ajax    = isset( $value['ajax'] ) ? $value['ajax'] : 'post_loadmore';

		if( ! isset( $max ) || null == $max ) {
			global $wp_query;
			$max = $wp_query->max_num_pages;
		}

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

		$paginate = array(
			'base'               => esc_url_raw( str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ) ),
			'format'             => '?paged=%#%',
			'total'              => $max,
			'current'            => max( 1, $paged ),
			'show_all'           => false,
			'end_size'           => 3,
			'mid_size'           => 3,
			'prev_next'          => true,
			'prev_text'          => esc_html__( 'Previous', 'octagon-kc-elements' ),
			'next_text'          => esc_html__( 'Next', 'octagon-kc-elements' ),
			'type'               => 'list',
			'add_args'           => false
		);

		$uid = octagon_random();

		$object = array( 
			$uid => array(
				'options' => ! empty( $options ) ? $options : array(),
				'args'    => ! empty( $args ) ? $args : array(),
				'max'     => $max,
				'isotope' => isset( $options['isotope'] ) && ( $options['isotope'] ) ? true : false,
				'ajax'    => $ajax
			)
		);

		octagon_concatenate_localize_scripts( 'octagon-core-tools', 'octagon_localize', $object );

		ob_start();

		if( 'number' == $style ) :
			?>

			<nav class="pagination">
				<?php echo paginate_links( $paginate ); ?>
			</nav> <!-- .pagination -->

			<?php
		elseif( 'next-prev' == $style ) :
			?>
			<nav class="pagination">
				<ul>
					<?php if( get_previous_posts_link() ) : ?>
						<li class="previous"><?php echo get_previous_posts_link( esc_html__( 'Previous', 'octagon-kc-elements' ) ); ?></li>
					<?php endif;
					if( get_next_posts_link( '', $max ) ) : ?>
						<li class="next"><?php echo get_next_posts_link( esc_html__( 'Next', 'octagon-kc-elements' ), $max ); ?></li>
					<?php endif; ?>
				</ul>
			</nav> <!-- .pagination -->
			<?php 
		elseif( 'loadmore' == $style ) :
			?>

			<div class="btn-loadmore" data-type="<?php echo esc_attr( $type ); ?>" data-uid="<?php echo esc_attr( $uid ); ?>" data-paged="<?php echo esc_attr( $paged ); ?>">
	
				<?php if( get_next_posts_link( '', $max ) ) : ?>
					<a href="<?php echo esc_url( get_next_posts_page_link() ); ?>" class="btn btn-size-mini btn-type-solid-ellipse btn-color-gradient">
						<div class="loader"><div></div></div>
						<?php esc_html_e( 'Loadmore', 'octagon-kc-elements' ) ?>
					</a>
				<?php endif; ?>

			</div> <!-- .btn-loadmore -->
			<?php
		elseif( 'infinite-scroll' == $style ) :
			?>

			<div class="btn-loadmore infinite-scroll" data-type="<?php echo esc_attr( $type ); ?>" data-uid="<?php echo esc_attr( $uid ); ?>" data-paged="<?php echo esc_attr( $paged ); ?>">
	
				<?php if( get_next_posts_link( '', $max ) ) : ?>
					<a href="<?php echo esc_url( get_next_posts_page_link() ); ?>" class="btn">
						<div class="loader"><div></div></div>
						<?php esc_html_e( 'Loadmore', 'octagon-kc-elements' ) ?>
					</a>
				<?php endif; ?>

			</div> <!-- .btn-loadmore -->

			<?php
		endif;

		$pagination = ob_get_clean();

		return $pagination;
	}

}