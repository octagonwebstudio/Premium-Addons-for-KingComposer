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

wp_enqueue_style( 'octagon-kc-element-testimonial-slider' );
wp_enqueue_style( 'slick' );
wp_enqueue_script( 'slick' );

$wrapper_class[] = 'testimonial-slider';
$wrapper_class[] = $style;
$wrapper_class[] = $ex_class;

$wrapper_class = array_filter( $wrapper_class );

$q = new WP_Query( $args );

if( $q->have_posts() ):
	?>

	<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

		<div class="testimonial-posts slick-slider" <?php echo esc_attr( implode( ' ', $slide_data ) ); ?>>

			<?php
			$post_count = 1;
			while( $q->have_posts() ):
				$q->the_post();

				$id = get_the_ID();	
				?>

				<article <?php post_class(); ?>>

					<p class="excerpt"><?php echo octagon_get_excerpt( $excerpt_limit ); ?></p>
						
					<?php if( has_post_thumbnail() ) : ?>

						<div class="avatar">
							<?php echo wp_kses( octagon_get_cropped_image( '', 80, 80 ), array( 'img' => array( 'src' => array(), 'alt' => array() ) ) ); ?>
						</div>

					<?php endif;

					the_title( '<p class="client-name sub-title">', '</p>' );

					$job = octagon_first_term( $id, 'octagon_testimonial_job' );
					if( ! empty( $job ) ) {
						printf( '<p class="client-job sub-title">%s</p>', esc_html( $job['name'] ) );
					}

					$rating = octagon_get_meta( $id, 'client_rating', '5' );

					$rating_icon = '';
					for( $i=1; $i<=5; $i++ ) {
						$star_class = ( $i <= (int)$rating ) ? 'oct-basic-star-filled' : 'oct-basic-star';
						$rating_icon .= '<span class="'. esc_attr( $star_class ) .'"></span>';						
					}
					?>

					<p class="rating"><?php echo wp_kses( $rating_icon, array( 'span' => array( 'class' => array() ) ) ); ?></p>

				</article> <!-- article -->

			<?php
			$post_count++; endwhile;
			wp_reset_postdata();
			?>

		</div> <!-- .testimonial-posts -->

	</div> <!-- .testimonial-slider -->

	<?php

endif;