<?php
/**
 *
 * @package Octagon KC Elements
 * @author Octagon
 * @version 1.0
 * @since 1.0
 */

if( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$post_types = array();

$active_modules = octagon_get_active_modules_list();

$content_type_modules = array(
	'portfolio'   => array( 'portfolio', 'portfolio_slider', 'portfolio_extend_slider' ),
	'team'        => array( 'team', 'team_slider' ),
	'testimonial' => array( 'testimonial_slider' )
);

if( class_exists( 'Octagon_Core_Post_type' ) ) {

	if( octagon_in_array_any( $content_type_modules['portfolio'], $active_modules ) ) {

		$post_types['portfolio'] = array(
			'id'       => 'octagon_portfolio',
			'name'     => esc_html__( 'Portfolio', 'octagon-kc-elements' ),
			'singular' => esc_html__( 'Portfolio', 'octagon-kc-elements' ),
			'labels'   => array(
				'all_items' => esc_html__( 'All Portfolio', 'octagon-kc-elements' ),
			),
			'options'  => array(
				'menu_icon' => 'dashicons-format-image',
				'supports'  => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
				'has_archive'  => true,
				'rewrite' 	=> array(
					'slug' => 'portfolio-archive'
				)
			),
			'taxonomy'  => array(

				array(
					'id'       => 'octagon_portfolio_cat',
					'name'     => esc_html__( 'Categories', 'octagon-kc-elements' ),
					'singular' => esc_html__( 'Category', 'octagon-kc-elements' ),
					'labels'   => array(
						'name'      => esc_html__( 'Portfolio Categories', 'octagon-kc-elements' ),
						'all_items' => esc_html__( 'All Categories', 'octagon-kc-elements' )
					),
					'options'  => array(
						'hierarchical' => true,
						'rewrite' 	=> array(
							'slug' => 'portfolio-cat'
						)
					),
				)
				
			)
		);

	}
	

	if( octagon_in_array_any( $content_type_modules['team'], $active_modules ) ) {

		$post_types['member'] = array(
			'id'       => 'octagon_member',
			'name'     => esc_html__( 'Team', 'octagon-kc-elements' ),
			'singular' => esc_html__( 'Member', 'octagon-kc-elements' ),
			'labels'   => array(
				'all_items' => esc_html__( 'All Members', 'octagon-kc-elements' ),
			),
			'options'  => array(
				'menu_icon' => 'dashicons-businessman',
				'supports'  => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'has_archive'  => 'team-archive'
			),
			'taxonomy'  => array(

				array(
					'id'       => 'octagon_member_job',
					'name'     => esc_html__( 'Jobs', 'octagon-kc-elements' ),
					'singular' => esc_html__( 'Job', 'octagon-kc-elements' ),
					'labels'   => array(
						'name'      => esc_html__( 'Team Jobs', 'octagon-kc-elements' ),
						'all_items' => esc_html__( 'All Jobs', 'octagon-kc-elements' )
					),
					'options'  => array(
						'hierarchical' => true
					),
				)
				
			)
		);

	}

	if( octagon_in_array_any( $content_type_modules['testimonial'], $active_modules ) ) {

		$post_types['testimonial'] = array(
			'id'       => 'octagon_testimonial',
			'name'     => esc_html__( 'Testimonials', 'octagon-kc-elements' ),
			'singular' => esc_html__( 'Testimonial', 'octagon-kc-elements' ),
			'labels'   => array(
				'all_items' => esc_html__( 'All Testimonials', 'octagon-kc-elements' ),
			),
			'options'  => array(
				'menu_icon' => 'dashicons-star-half',
				'supports'  => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'has_archive'  => 'testimonial-archive'
			),
			'taxonomy'  => array(

				array(
					'id'       => 'octagon_testimonial_job',
					'name'     => esc_html__( 'Jobs', 'octagon-kc-elements' ),
					'singular' => esc_html__( 'Job', 'octagon-kc-elements' ),
					'labels'   => array(
						'name'      => esc_html__( 'Testimonial Jobs', 'octagon-kc-elements' ),
						'all_items' => esc_html__( 'All Jobs', 'octagon-kc-elements' )
					),
					'options'  => array(
						'hierarchical' => true
					),
				)
				
			)
		);

	}

	$post_types = apply_filters( 'octagon_custom_post_types', $post_types );

	if( ! empty( $post_types ) ) {
		foreach( $post_types as $key => $value ) {
			new Octagon_Core_Post_type( $value );
		}		
	}

}