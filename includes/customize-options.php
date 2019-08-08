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



/*----------------------------------------------------------------------------
    TABLE OF CONTENTS:
------------------------------------------------------------------------------
	# Typography
	# Styling Options

------------------------------------------------------------------------------ */





add_action( 'init', 'octagon_kc_elements_customizer_options' );

if( ! function_exists( 'octagon_kc_elements_customizer_options' ) ) {

	/**
	 * Customizer Options
	 * 
	 * 
	 * @version 1.0
	 * @since  1.0
	 */
	function octagon_kc_elements_customizer_options() {

		if( class_exists( 'Kirki' ) ) {

			/* ---------------------------------------------------------------------------
			 * Global Variables
			------------------------------------------------------------------------------ */

			$gradient_palette = octagon_get_gradient_palette();



			/* ---------------------------------------------------------------------------
			 * Font
			------------------------------------------------------------------------------ */


			Kirki::add_panel( 'octagon_elements_fonts', array(
				'title'       => esc_attr_x( 'Octagon Elements: Shortcode Fonts', 'customizer', 'octagon-kc-elements' ),
				'description' => esc_attr_x( 'Set the font', 'customizer', 'octagon-kc-elements' ),
				'priority'    => 3
			) );


			/* Font Family --------------------------------------------------------------- */

			Kirki::add_section( 'octagon_element_content_type', array(
			    'title'          => esc_attr_x( 'Content Type', 'customizer', 'octagon-kc-elements' ),
			    'description'    => esc_attr_x( 'Choose the default fonts', 'customizer', 'octagon-kc-elements' ),
			    'panel'          => 'octagon_elements_fonts'
			) );

			Kirki::add_field( 'content_type_title', array(
				'type'        => 'typography',
				'settings'    => 'content_type_title',
				'label'       => esc_attr_x( 'Title Font', 'customizer', 'octagon-kc-elements' ),
				'description' => esc_attr_x( 'Adjust font settings.', 'customizer', 'octagon-kc-elements' ),
				'section'     => 'octagon_element_content_type',
				'default'     => array(
					'font-family'    => 'inherit',
					'font-size'      => '15px',
					'variant'        => 'regular',
					'line-height'    => '2',
					'text-transform' => 'none',
					'letter-spacing' => '0px'
				)
			) );

		}

	}

}