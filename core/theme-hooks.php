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
	


add_action( 'wp_footer', 'octagon_wp_footer', 10, 1 );
function octagon_wp_footer() {
	?>

	<div id="dialog-popup">
		<div class="overlay-box"></div>
		<div id="dialog-content"></div>
	</div>
	<?php
}
