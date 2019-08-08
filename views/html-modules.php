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

?>

<div class="octagon-admin-page">

	<?php

	if( defined( 'OCTAGON_CORE_PATH' ) ) {
		include_once OCTAGON_CORE_PATH . '/views/html-header.php';
	}

	$modules_group = octagon_modules_list();
	$modules_list = array_keys( call_user_func_array( 'array_merge', $modules_group ) );

	if( isset( $_POST['save-octagon-kc-elements'] ) ) :

		$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : array();

		if( wp_verify_nonce( $nonce, 'nonce-octagon-kc-elements' ) ) {

			$modules = isset( $_POST['modules'] ) && ( octagon_in_array_all( $_POST['modules'], $modules_list ) ) ? (array) $_POST['modules'] : array();

			set_theme_mod( 'octagon_kc_elements_modules', $modules );

		}

	endif;
	?>
	
	<div class="modules grids one-column">

		<div class="column">

			<div class="grid">
				<div class="title-area">
					<div class="info">
						<p class="main-title"><?php esc_html_e( 'Modules', 'octagon-kc-elements' ); ?></p>
						<p class="sub"><?php esc_html_e( 'Select the shortcode elements.', 'octagon-kc-elements' ); ?></p>
					</div>
				</div>

				<div class="content-area">
					<form method="post">
						<?php
						$active_modules = octagon_get_active_modules_list();

						foreach( $modules_group as $key => $modules ) :
							?>
							<div class="options-group">
								<h3><?php echo esc_html( $key ); ?></h3>
								<?php

								foreach( $modules as $key => $module ) :

									if( in_array( $key, $active_modules ) ) :
										$active = 'active';
										$in_active = 'in-active';
										$checked = 'checked="checked"';
									else :
										$active = 'in-active';
										$in_active = 'active';
										$checked = '';
									endif;
									?>
									<div class="toggle-switch">
										<p><?php echo esc_html( $module ); ?></p>

										<div class="toggle">
											<input type="checkbox" name="modules[]" value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $checked ); ?>>

											<span data-value="<?php echo esc_attr( $key ); ?>" class="<?php echo esc_attr( $active ); ?>"><?php esc_html_e( 'Yes', 'octagon-kc-elements' ); ?></span>
											<span data-value="" class="<?php echo esc_attr( $in_active ); ?>"><?php esc_html_e( 'No', 'octagon-kc-elements' ); ?></span>

										</div>
									</div>
									<?php
								endforeach;
								?>
							</div>
							<?php
						endforeach;

						$nonce = wp_create_nonce( 'nonce-octagon-kc-elements' );
						?>
						<input type="hidden" name="nonce" value="<?php echo esc_attr( $nonce ); ?>">
						<button name="save-octagon-kc-elements" class="bttn bttn-gradient bttn-medium"><?php esc_html_e( 'Save', 'octagon-kc-elements' ); ?></button>
					</form>
					
				</div>
				
			</div>

		</div>
		
	</div> <!-- .modules -->

</div> <!-- .octagon-admin-page -->