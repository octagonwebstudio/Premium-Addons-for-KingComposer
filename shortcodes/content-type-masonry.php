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

wp_enqueue_style( 'octagon-kc-element-content-type' );
wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'imageloaded' );

// AJAX purpose( It overrides normal values on ajax call )
$options = isset( $_POST['options'] ) ? (array) $_POST['options'] : array();

if( ! is_array( $options ) ) {
	return;
}

if( ! empty( $options ) ) {
	extract( $options );
}

$wrapper_class[] = 'content-type content-type-masonry masonry loop-container';
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

			<div class="isotope-item-sizer col-md-1"></div>

			<?php
			$post_count = 1;
			while( $q->have_posts() ):
				$q->the_post();

				$permalink = get_permalink();		
				?>

				<article <?php post_class( 'element post isotope-item '. $columns ); ?>>

					<div class="post-details">

						<?php
						if( has_post_thumbnail() ) :
							
							$width  = ! empty( $custom_width ) ? $custom_width : 700;
							$height = ! empty( $custom_height ) ? $custom_height : null;
							?>

							<div class="post-media">
								<?php echo octagon_get_cropped_image( '', $width, $height, false, array( '1024' => array( $width, $height ), '768' => array( 768, null ) ) ); ?>
							</div> <!-- .post-media -->

							<?php 
						endif; ?>

						<div class="post-content">
							
							<?php if( 'none' != $meta ) : ?>
								<div class="meta-group">
									<?php octagon_meta( $meta ); ?>
								</div> <!-- .meta-group -->
							<?php endif; ?>
							
							<?php
							the_title( '<'. esc_html( $title_tag ) .' class="title"><span class="line"></span><a href="'. esc_url( $permalink ) .'">', '</a></'. esc_html( $title_tag ) .'>' );

							if( 'show' == $excerpt ) :
								?>
								<p class="excerpt"><?php echo octagon_get_excerpt( $excerpt_limit ); ?></p>
								<?php 
							endif;

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
		echo octagon_pagination( $pagination, $values );
		?>

	</div> <!-- .content-type-masonry -->

	<?php

endif;