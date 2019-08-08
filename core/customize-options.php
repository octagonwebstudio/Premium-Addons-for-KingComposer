<?php
/**
 *
 * @package Octagon Core
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





add_action( 'init', 'octagon_core_customizer_options' );

if( ! function_exists( 'octagon_core_customizer_options' ) ) {

	/**
	 * Customizer Options
	 * 
	 * 
	 * @version 1.0
	 * @since  1.0
	 */
	function octagon_core_customizer_options() {

		if( class_exists( 'Kirki' ) ) {

			/* ---------------------------------------------------------------------------
			 * Global Variables
			------------------------------------------------------------------------------ */

			$gradient_palette = octagon_get_gradient_palette();



			/* ---------------------------------------------------------------------------
			 * Font
			------------------------------------------------------------------------------ */


			Kirki::add_panel( 'font', array(
				'title'       => esc_attr_x( 'Font', 'customizer', 'octagon-kc-elements' ),
				'description' => esc_attr_x( 'Set the font', 'customizer', 'octagon-kc-elements' ),
				'priority'    => 1
			) );


			/* Font Family --------------------------------------------------------------- */

			Kirki::add_section( 'default_typography', array(
			    'title'          => esc_attr_x( 'Font Family', 'customizer', 'octagon-kc-elements' ),
			    'description'    => esc_attr_x( 'Choose the default fonts', 'customizer', 'octagon-kc-elements' ),
			    'panel'          => 'font'
			) );

			Kirki::add_field( 'heading_font', array(
				'type'        => 'select',
				'settings'    => 'heading_font',
				'label'       => esc_attr_x( 'Heading Font', 'customizer', 'octagon-kc-elements' ),
				'description' => esc_attr_x( 'Please choose a heading font.', 'customizer', 'octagon-kc-elements' ),
				'section'     => 'default_typography',
				'default'     => 'Arsenal',
				'choices'     => array_merge( array( 'inherit' => esc_attr__( 'Inherit', 'octagon-kc-elements' ) ), Kirki_Fonts::get_font_choices() )
			) );

			Kirki::add_field( 'content_font', array(
				'type'        => 'select',
				'settings'    => 'content_font',
				'label'       => esc_attr_x( 'Content Font', 'customizer', 'octagon-kc-elements' ),
				'description' => esc_attr_x( 'Please choose a content font.', 'customizer', 'octagon-kc-elements' ),
				'section'     => 'default_typography',
				'default'     => 'Open Sans',
				'choices'     => array_merge( array( 'inherit' => esc_attr__( 'Inherit', 'octagon-kc-elements' ) ), Kirki_Fonts::get_font_choices() )
			) );

			Kirki::add_field( 'font_weight', array(
				'type'        => 'multicheck',
				'settings'    => 'font_weight',
				'label'       => esc_attr_x( 'Font Weight', 'customizer', 'octagon-kc-elements' ),
				'description' => esc_attr_x( 'Please select font weights( You should select regular, 500, 600 and 700 to run the site properly ).', 'customizer', 'octagon-kc-elements' ),
				'section'     => 'default_typography',
				'default'     => array( 'regular', '100', '500', '600', '700' ),
				'choices'     => array(
					'regular'   => 'regular',
					'italic'    => 'italic',
					'100'       => '100',
					'100italic' => '100italic',
					'300'       => '300',
					'300italic' => '300italic',
					'500'       => '500',
					'500italic' => '500italic',
					'600'       => '600',
					'600italic' => '600italic',
					'700'       => '700',
					'700italic' => '700italic',
					'900'       => '900',
					'900italic' => '900italic'
				),
			) );

			Kirki::add_field( 'font_subsets', array(
				'type'        => 'multicheck',
				'settings'    => 'font_subsets',
				'label'       => esc_attr_x( 'Subsets', 'customizer', 'octagon-kc-elements' ),
				'description' => esc_attr_x( 'Please choose the font subsets.', 'customizer', 'octagon-kc-elements' ),
				'section'     => 'default_typography',
				'default'     => array( 'latin' ),
				'choices'     => array(
					'latin'        => esc_html_x( 'Latin', 'customizer', 'octagon-kc-elements' ),
					'latin-ext'    => esc_html_x( 'Latin Extended', 'customizer', 'octagon-kc-elements' ),
					'cyrillic'     => esc_html_x( 'Cyrillic', 'customizer', 'octagon-kc-elements' ),
					'cyrillic-ext' => esc_html_x( 'Cyrillic Extended', 'customizer', 'octagon-kc-elements' ),
					'greek'        => esc_html_x( 'Greek', 'customizer', 'octagon-kc-elements' ),
					'greek-ext'    => esc_html_x( 'Greek Extended', 'customizer', 'octagon-kc-elements' ),
					'vietnamese'   => esc_html_x( 'Vietnamese', 'customizer', 'octagon-kc-elements' )
				),
			) );



			/* ---------------------------------------------------------------------------
			 * Custom Style
			------------------------------------------------------------------------------ */


			Kirki::add_panel( 'custom_style', array(
			    'title'       => esc_attr_x( 'Custom Style', 'customizer', 'octagon-kc-elements' ),
			    'description' => esc_attr_x( 'Those settings applies globally.', 'customizer', 'octagon-kc-elements' ),
			    'priority' => 2
			) );


			/* Content Color ------------------------------------------------------------- */

			Kirki::add_section( 'content_custom_style', array(
			    'title'          => esc_attr_x( 'Content Color', 'customizer', 'octagon-kc-elements' ),
			    'panel'          => 'custom_style'
			) );

			Kirki::add_field( 'title_color', array(
				'type'        => 'color',
				'settings'    => 'title_color',
				'label'       => esc_attr_x( 'Title Color', 'customizer', 'octagon-kc-elements' ),
				'section'     => 'content_custom_style',
				'default'     => ''
			) );

		}
		
	}

}