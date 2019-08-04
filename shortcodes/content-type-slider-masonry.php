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
wp_enqueue_style( 'octagon-kc-element-content-type-slider' );
wp_enqueue_style( 'slick' );
wp_enqueue_script( 'slick' );

$wrapper_class[] = 'content-type-slider content-type-masonry masonry loop-container';
$wrapper_class[] = $style;
$wrapper_class[] = $ex_class;

$wrapper_class = array_filter( $wrapper_class );

$q = new WP_Query( $args );

if( $q->have_posts() ):
	?>

	<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

		<div class="content-type-posts post-inner post-loop no-isotope slick-slider" <?php echo esc_attr( implode( ' ', $slide_data ) ); ?>>

			<?php
			$post_count = 1;
			while( $q->have_posts() ):
				$q->the_post();

				$permalink = get_permalink();		
				?>

				<article <?php post_class( 'element post' ); ?>>

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

							<div class="meta-group">
								<?php octagon_meta( 'category' ); ?>
							</div> <!-- .meta-group -->
							
							<?php
							the_title( '<'. esc_html( $title_tag ) .' class="title"><span class="line"></span><a href="'. esc_url( $permalink ) .'">', '</a></'. esc_html( $title_tag ) .'>' );

							if( 'show' == $excerpt ) :
								?>
								<p class="excerpt"><?php echo octagon_get_excerpt( $excerpt_limit ); ?></p>
								<?php 
							endif; ?>
							<a href="<?php echo esc_url( $permalink ); ?>" class="btn btn-size-mini btn-type-no-bg"><?php echo esc_html( $btn_text ); ?></a>
						</div> <!-- .post-content -->

					</div> <!-- .post-details -->

				</article> <!-- article -->

			<?php
			$post_count++; endwhile;
			wp_reset_postdata();
			?>

		</div> <!-- .post-inner -->

	</div> <!-- .content-type-slider -->

	<?php

endif;