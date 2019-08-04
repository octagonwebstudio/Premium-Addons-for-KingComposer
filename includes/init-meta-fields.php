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

if( ! class_exists( 'Octagon_Core_Metabox' ) ) {
	return;
}

add_action( 'init', 'octagon_init_metaboxes' );

if( ! function_exists( 'octagon_init_metaboxes' ) ) {

	function octagon_init_metaboxes() {

		/* ---------------------------------------------------------------------------
		 * Global Variables
		------------------------------------------------------------------------------ */

		$current_post_type = octagon_get_current_post_type();

		$page_id = isset( $_GET['post'] ) ? (int) $_GET['post'] : 0;


		/* ---------------------------------------------------------------------------
		 * Meta Fields
		------------------------------------------------------------------------------ */


		/* Testimonial --------------------------------------------------------------- */

		$testimonial[] = array(
			'id'          => 'client_rating',
			'title'       => esc_html__( 'Rating', 'octagon-kc-elements' ),
			'description' => esc_html__( 'Choose rating.', 'octagon-kc-elements' ),
			'type'        => 'select',
			'default'     => '5',
			'options'     => array(
				'1' => esc_html__( 'Bad', 'octagon-kc-elements' ),
				'2' => esc_html__( 'OK', 'octagon-kc-elements' ),
				'3' => esc_html__( 'Average', 'octagon-kc-elements' ),
				'4' => esc_html__( 'Good', 'octagon-kc-elements' ),
				'5' => esc_html__( 'Better', 'octagon-kc-elements' )
			),
			'class'       => ''
		);


		/* ---------------------------------------------------------------------------
		 * Prepare Meta Fields
		------------------------------------------------------------------------------ */	
		
		
		/* Testimonial --------------------------------------------------------------- */
		
		$testimonial_field[ esc_html__( 'Testimonial', 'octagon-kc-elements' ) ] = $testimonial;



		/* ---------------------------------------------------------------------------
		 * Create Metabox
		------------------------------------------------------------------------------ */


		/* Testimonial Metabox ------------------------------------------------------- */

		new Octagon_Core_Metabox( array(
			'id'            => 'octagon_testimonial_metabox',
			'title'         => esc_html__( 'Testimonial Options', 'octagon-kc-elements' ),
			'content_types' => array( 'octagon_testimonial' ),
			'show_on_cb'    => true,
			'context'       => 'side',
			'priority'      => 'high',
			'classes'       => '',
			'fields'		=> $testimonial_field
		) );

	}

}