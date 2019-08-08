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

// AJAX purpose( It overrides normal values on ajax call )
$options = isset( $_POST['options'] ) ? (array) $_POST['options'] : array();

if( ! is_array( $options ) ) {
	return;
}

if( ! empty( $options ) ) {
	extract( $options );
}

$wrapper_class[] = 'content-type loop-container';
$wrapper_class[] = $style;
$wrapper_class[] = $ex_class;

$wrapper_class = array_filter( $wrapper_class );

// AJAX purpose( It overrides normal values on ajax call )
$args          = isset( $_POST['args'] ) ? (array) $_POST['args'] : $args;
$args['paged'] = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : $paged;

if( ! is_array( $args ) || ! octagon_is_number( $args['paged'] ) ) {
	return;
}

$q = new WP_Query( $args );
$max = $q->max_num_pages;

if( $q->have_posts() ):
	?>

	<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

		<div class="post-inner post-loop ajax-content-pull">

			<?php
			$post_count = 1;
			while( $q->have_posts() ):
				$q->the_post();

				$permalink = get_permalink();		
				?>

				<article <?php post_class( 'element post col-md-6' ); ?>>

					<div class="post-details">

						<?php if( has_post_thumbnail() ) : ?>
							<div class="post-media">
								<?php echo octagon_get_cropped_image( '', 200, 200, false ); ?>
							</div> <!-- .post-media -->
						<?php endif; ?>

						<div class="post-content">

							<?php if( 'none' != $meta ) : ?>
								<div class="meta-group">
									<?php octagon_meta( $meta ); ?>
								</div> <!-- .meta-group -->
							<?php endif; ?>

							<?php
							the_title( '<'. esc_html( $title_tag ) .' class="post-tile title"><a href="'. esc_url( $permalink ) .'">', '</a></'. esc_html( $title_tag ) .'>' );
							
							if( 'show' == $show_btn ) :
								$btn_class   = array( 'btn' );
								$btn_class[] = $btn_size;
								$btn_class[] = $btn_type;
								$btn_class[] = $btn_color;

								?>
								<a href="<?php echo esc_url( $permalink ); ?>" class="<?php echo esc_attr( implode( ' ', $btn_class ) ); ?>"><?php echo esc_html( $btn_text ); ?></a>
								<?php
							endif; ?>

						</div> <!-- .post-content -->

					</div> <!-- .post-details -->

				</article> <!-- article -->

			<?php
			$post_count++; endwhile;
			wp_reset_postdata();
			?>

		</div> <!-- .post-inner -->

		<?php 
		$values = array( 
			'type'    => 'query', 
			'args'    => $args, 
			'options' => array_merge( $atts, array( 'isotope' => true ) ), 
			'max'     => $max, 
			'ajax'    => 'octagon_kc_elements_content_type_loadmore'
		);
		echo octagon_pagination( $pagination, $values ); ?>

	</div> <!-- .content-type-masonry -->

	<?php

endif;