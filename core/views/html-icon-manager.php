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

$icon_set = Octagon_Core_Icon_Manager::get_icon_set();
?>

<div class="octagon-admin-page">

	<?php
	include_once OCTAGON_CORE_PATH . '/views/html-header.php';
	?>

	<div class="icon-manager"> 
		
		<div class="grids one-column"> 

			<div class="column">
				<div class="grid">

					<div class="title-area">
						<div class="info">
							<p class="main-title"><?php esc_html_e( 'Inbuilt Icons', 'octagon-kc-elements' ); ?></p>
							<p class="sub"><?php esc_html_e( 'Pick the icon set which are going to use on website.', 'octagon-kc-elements' ); ?></p>
						</div>
					</div>

					<div class="content-area">
						
						<form method="post" class="icon-manager-form">
							
							<div class="options-group">

								<?php 
								if( isset( $_POST['save_icon_set'] ) ) :

									$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : array();

									if( wp_verify_nonce( $nonce, 'nonce-octagon-icon-set' ) ) {

										$value = isset( $_POST['icon_set'] ) && octagon_in_array_all( $_POST['icon_set'], array_keys( $icon_set ) ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['icon_set'] ) ) : array();

										update_option( 'octagon_icon_set', $value );

									}
									
								endif;

								$active_icon_set = get_option( 'octagon_icon_set', array() );

								if( isset( $icon_set ) && ! empty( $icon_set ) ) : 
									foreach( $icon_set as $key => $icons ) :

										if( in_array( $key, $active_icon_set ) ) :
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
											<p><?php echo esc_html( ucwords( $key ) ); ?></p>

											<div class="toggle">
												<input type="checkbox" name="icon_set[]" value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $checked ); ?>>

												<span data-value="<?php echo esc_attr( $key ); ?>" class="<?php echo esc_attr( $active ); ?>"><?php esc_html_e( 'Yes', 'octagon-kc-elements' ); ?></span>
												<span data-value="" class="<?php echo esc_attr( $in_active ); ?>"><?php esc_html_e( 'No', 'octagon-kc-elements' ); ?></span>

											</div>
										</div>

										<?php
									endforeach;
								endif;

								$nonce = wp_create_nonce( 'nonce-octagon-icon-set' );
								?>

							</div>

							<input type="hidden" name="nonce" value="<?php echo esc_attr( $nonce ); ?>">
							<button name="save_icon_set" class="bttn bttn-gradient bttn-medium"><?php esc_html_e( 'Save Icon', 'octagon-kc-elements' ); ?></button>
							
						</form>
					</div>
					
				</div>
			</div>

		</div>

	</div> <!-- .icon-manager -->

</div> <!-- .octagon-admin-page -->