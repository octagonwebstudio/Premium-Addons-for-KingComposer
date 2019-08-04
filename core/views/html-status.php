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

<div class="status grids two-column">

	<div class="column">

		<div class="grid">
			<div class="title-area">
				<div class="info">
					<p class="main-title"><?php esc_html_e( 'WordPress environment', 'octagon-kc-elements' ); ?></p>
				</div>
			</div>

			<div class="content-area">
				<ul class="status-list">
					<li><span class="list-title"><?php esc_html_e( 'Home URL:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['homeurl'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'Site URL:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['siteurl'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'WordPress Version:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['wp_version'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'WordPress Multisite:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['multisite'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'Debug Mode:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['debug'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'Language:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['language'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'Text Direction:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['text_direction'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'Child Theme:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['child_theme'] ); ?></li>
				</ul>
			</div>
		</div>

	</div>
	<div class="column">

		<div class="grid">
			<div class="title-area">
				<div class="info">
					<p class="main-title"><?php esc_html_e( 'Server environment', 'octagon-kc-elements' ); ?></p>
				</div>
			</div>

			<div class="content-area">
				<ul class="status-list">
					<?php if( isset( $this->data['status']['server'] ) && ! empty( $this->data['status']['server'] ) ) : ?>
						<li><span class="list-title"><?php esc_html_e( 'Server Info:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['server'] ); ?></li>
					<?php endif; ?>
					<li><span class="list-title"><?php esc_html_e( 'MySQL version:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['mysql'] ); ?></li>
					<li>						
						<?php echo wp_kses( $this->data['notice']['memory_limit']['batch'], array( 'span' => array( 'class' => array() ) ) ); ?>
						<span class="list-title"><?php esc_html_e( 'Memory Limit:', 'octagon-kc-elements' ); ?></span>
						<?php echo esc_html( size_format( $this->data['status']['memory_limit'] ) ); ?>						
						<?php echo wp_kses( $this->data['notice']['memory_limit']['info'], array( 'span' => array( 'class' => array() ), 'strong' => array() ) ); ?>
					</li>
					<li>						
						<?php echo wp_kses( $this->data['notice']['php_version']['batch'], array( 'span' => array( 'class' => array() ) ) ); ?>
						<span class="list-title"><?php esc_html_e( 'PHP Version:', 'octagon-kc-elements' ); ?></span>
						<?php echo esc_html( $this->data['status']['php_version'] ); ?>
						<?php echo wp_kses( $this->data['notice']['php_version']['info'], array( 'span' => array( 'class' => array() ), 'strong' => array() ) ); ?>
					</li>
					<li>
						<?php echo wp_kses( $this->data['notice']['post_max_size']['batch'], array( 'span' => array( 'class' => array() ) ) ); ?>
						<span class="list-title"><?php esc_html_e( 'Post Max Size:', 'octagon-kc-elements' ); ?></span>
						<?php echo esc_html( size_format( $this->data['status']['post_max_size'] ) ); ?>
						<?php echo wp_kses( $this->data['notice']['post_max_size']['info'], array( 'span' => array( 'class' => array() ), 'strong' => array() ) ); ?>
					</li>
					<li>
						<?php echo wp_kses( $this->data['notice']['time_limit']['batch'], array( 'span' => array( 'class' => array() ) ) ); ?>
						<span class="list-title"><?php esc_html_e( 'Time Limit:', 'octagon-kc-elements' ); ?></span>
						<?php echo esc_html( $this->data['status']['time_limit'] ); ?>
						<?php echo wp_kses( $this->data['notice']['time_limit']['info'], array( 'span' => array( 'class' => array() ), 'strong' => array() ) ); ?>
					</li>
					<li>
						<?php echo wp_kses( $this->data['notice']['max_input_vars']['batch'], array( 'span' => array( 'class' => array() ) ) ); ?>
						<span class="list-title"><?php esc_html_e( 'Max Input Vars:', 'octagon-kc-elements' ); ?></span>
						<?php echo esc_html( $this->data['status']['max_input_vars'] ); ?>						
						<?php echo wp_kses( $this->data['notice']['max_input_vars']['info'], array( 'span' => array( 'class' => array() ), 'strong' => array() ) ); ?>
					</li>
					<li><span class="list-title"><?php esc_html_e( 'Max Upload Size:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['upload_size'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'cURL:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['curl'] ); ?></li>
					<li><span class="list-title"><?php esc_html_e( 'DOMDocument:', 'octagon-kc-elements' ); ?></span><?php echo esc_html( $this->data['status']['dom'] ); ?></li>
				</ul>
			</div>				
		</div>

	</div>
	
</div> <!-- .status -->