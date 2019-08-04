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

/* ---------------------------------------------------------------------------
 * Shortcode Modules
------------------------------------------------------------------------------ */

$active_modules = octagon_get_active_modules_list();

if( ! empty( $active_modules ) ) {
	foreach( $active_modules as $key => $value ) {

		$slug = str_replace( '_', '-', $value );

		$filename = OCTAGON_KC_ELEMENTS_PATH . '/modules/'. $slug .'.php';

		if( file_exists( $filename ) ) {
			include $filename;
		}
		
	}
}