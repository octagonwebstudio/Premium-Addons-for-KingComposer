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

?>

<header>
	<div class="brand">
		<div class="logo">
			<div>
				<p class="theme-name"><?php esc_html_e( 'Octagon KC Elements', 'octagon-kc-elements' ); ?></p>				
				<p class="version"><?php echo sprintf( esc_html__( 'Version %s', 'octagon-kc-elements' ), OCTAGON_KC_ELEMENTS_VERSION ); ?></p>
			</div>
		</div>
		<a href="mailto:octagonwebstudio@gmail.com" class="bttn bttn-gradient bttn-medium"><?php esc_html_e( 'Support Forum', 'octagon-kc-elements' ); ?></a>
	</div>
	<p class="desc"><?php esc_html_e( 'Octagon KC Elements is a unique shortcode elements addon for KingComposer Page Builder. For any assistance, Please contact us via our support forum.', 'octagon-kc-elements' ); ?></p>
</header>