<?php
/**
 *
 * @package Octagon Core
 * @author Octagon
 * @version 1.0
 * @since 1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<div class="octagon-admin-page">

	<?php
	include_once OCTAGON_CORE_PATH . '/views/html-header.php';

	global $wp_registered_sidebars; 

	$custom_sidebar_lists = get_option( 'octagon_custom_sidebar', array() );
	?>

	<div class="register-sidebar"> 
		
		<div class="grids one-column"> 

			<div class="column">
				<div class="grid">

					<div class="title-area">
						<div class="info">
							<p class="main-title"><?php esc_html_e( 'Register Widget Area', 'octagon-kc-elements' ); ?></p>
							<p class="sub"><?php esc_html_e( 'Add custom widget area.', 'octagon-kc-elements' ); ?></p>
						</div>
					</div>

					<div class="content-area">
						<div class="add-sidebar-form"> 
							<input type="text" class="custom_sidebar">
							<a href="#" class="add_custom_sidebar bttn bttn-gradient bttn-medium">
								<div class="loader"><div></div></div>
								<?php esc_html_e( 'Add Sidebar', 'octagon-kc-elements' ); ?>
							</a>
						</div>
					</div>
					
				</div>
			</div>

		</div>

		<div class="sidebar-lists grids two-column"> 

			<div class="column">
				<div class="grid">

					<div class="title-area">
						<div class="info">
							<p class="main-title"><?php esc_html_e( 'Predefined Sidebar', 'octagon-kc-elements' ); ?></p>
							<p class="sub"><?php esc_html_e( 'Predefined widget area can\'t delete.', 'octagon-kc-elements' ); ?></p>
						</div>
					</div>
				
					<div class="default-sidebar content-area">
						<ul>
							<?php foreach( $wp_registered_sidebars as $key => $sidebar ) : 

								if( ! array_key_exists( $sidebar['id'], $custom_sidebar_lists ) ) : ?>

									<li data-id="<?php echo esc_attr( $sidebar['id'] ); ?>">
										<?php echo esc_html( $sidebar['name'] ); ?>
									</li>

								<?php endif;

							endforeach; ?>

						</ul>
					</div>
				</div>
			</div>

			<div class="column">
				<div class="grid">

					<div class="title-area">
						<div class="info">
							<p class="main-title"><?php esc_html_e( 'Custom Sidebar', 'octagon-kc-elements' ); ?></p>
							<p class="sub"><?php esc_html_e( 'Once you added you can assign it in options.', 'octagon-kc-elements' ); ?></p>
						</div>
					</div>

					<?php if( ! empty( $custom_sidebar_lists ) ) :?>
						<div class="custom-sidebar content-area">
							<ul>
								<?php foreach( $custom_sidebar_lists as $key => $sidebar ) : ?>

									<li data-id="<?php echo esc_attr( $key ); ?>">
										<span class="sidebar-name"><?php echo esc_html( $sidebar ); ?></span>
										<span class="remove_custom_sidebar btn-red" data-sidebar-id="<?php echo esc_attr( $key ); ?>">
											<div class="loader"><div></div></div>
											<?php esc_html_e( 'Remove', 'octagon-kc-elements' ); ?>
										</span>
									</li>

								<?php endforeach; ?>
							</ul>
						</div>
					<?php else: ?>
						<div class="custom-sidebar content-area">
							<ul>
								<li><?php esc_html_e( 'No custom sidebar are available.', 'octagon-kc-elements' ); ?></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</div> <!-- .sidebar-lists -->

	</div> <!-- .register-sidebar -->

</div> <!-- .octagon-admin-page -->