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

<div class="octagon-admin-page">

	<?php
	include_once OCTAGON_CORE_PATH . '/views/html-header.php';
	?>
	
	<div class="welcome-info grids two-column">

		<div class="column">

			<div class="grid">
				<div class="title-area">
					<div class="info">
						<p class="main-title"><?php esc_html_e( 'Theme Requirements', 'octagon-kc-elements' ); ?></p>
						<p class="sub"><?php esc_html_e( 'Theme and Server requirements listed here.', 'octagon-kc-elements' ); ?></p>
					</div>
				</div>

				<div class="content-area">
					<ul class="status-list">
						<?php
						if( isset( $this->error['status'] ) ) :
							foreach( $this->error['status'] as $key => $error ) :
								?>
								<li>
									<?php echo wp_kses( $error['batch'], array( 'span' => array( 'class' => array() ) ) ); ?>
									<span class="list-title"><?php echo esc_html( $error['title'] ); ?></span>
									<?php echo esc_html( $error['value'] ); ?>
									<?php echo wp_kses( $error['info'], array( 'span' => array( 'class' => array() ), 'strong' => array() ) ); ?>
								</li>
								<?php
							endforeach;
						else :
							?>
							<li><?php esc_html_e( 'Looks good!!', 'octagon-kc-elements' ); ?></li>
							<?php
						endif;
						?>
					</ul>
				</div>
				
			</div>

		</div>
		<div class="column">

			<div class="grid">
				<div class="title-area">
					<div class="info">
						<p class="main-title"><?php esc_html_e( 'Recent Logs', 'octagon-kc-elements' ); ?></p>
						<p class="sub"><?php esc_html_e( 'New features and Bug fixes.', 'octagon-kc-elements' ); ?></p>
					</div>
					<div class="mini-link">
						<a href="//octagonwebstudio.com/" class="simple-link"><?php esc_html_e( 'View Logs', 'octagon-kc-elements' ); ?></a>
					</div>
				</div>

				<div class="content-area">

					<span class="batch batch-green"><?php esc_html_e( 'Info', 'octagon-kc-elements' ); ?></span>
					<ul>
						<li><?php esc_html_e( 'Initial Release.', 'octagon-kc-elements' ); ?></li>
					</ul>
				</div>				
			</div>

		</div>
		
	</div> <!-- .welcome-info -->

</div> <!-- .octagon-admin-page -->