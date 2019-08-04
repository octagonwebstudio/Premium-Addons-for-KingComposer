<?php
/**
 *
 * @package Quirk Core
 * @author Octagon
 * @version 1.0
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$wrapper_class[] = 'portfolio-extend-slider portfolio loop-container';
$wrapper_class[] = $style;
$wrapper_class[] = $ex_class;

$wrapper_class = array_filter( $wrapper_class );

$q = new WP_Query( $args );

if( $q->have_posts() ):
	?>

	<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

		<div class="portfolio-posts post-inner post-loop no-isotope slick-slider" <?php echo esc_attr( implode( ' ', $slide_data ) ); ?>>

			<?php

			$post_count = 1;

			$like = octagon_get_cookie( 'octagon-post-likes' );
			$like = ! empty( $like ) ? explode( ',', trim( $like ) ) : array();

			while( $q->have_posts() ):
				$q->the_post();

				$id = get_the_ID();

				$permalink = get_permalink();

				$thumbnail = octagon_get_meta( $id, 'thumbnail', '' );
				$thumbnail = ! empty( $thumbnail ) ? $thumbnail : get_post_thumbnail_id();

				$class = array( 'element portfolio-post' );

				?>

				<article <?php post_class( implode( ' ', $class ) ); ?>>

					<div class="post-details">

						<div class="portfolio-thumbnail">

							<?php echo octagon_get_cropped_image( $thumbnail, 1400, 900, true ); ?>

						</div> <!-- .portfolio-thumbnail -->

						<div class="post-content">
							
							<div class="content-group">

								<div class="meta-group">
									<?php
									$term = octagon_first_term( $id, 'octagon_portfolio_cat' );

									if( ! empty( $term ) ) :
										?>
										<p class="category">
											<a href="<?php echo esc_url( get_term_link( $term['id'], 'octagon_portfolio_cat' ) ); ?>"><?php echo esc_html( $term['name'] ); ?></a>
										</p>
										<?php 
									endif;
									?>
								</div> <!-- .meta-group -->

								<?php the_title( '<'. esc_html( $title_tag ) .' class="title"><a href="'. esc_url( $permalink ) .'">', '</a></'. esc_html( $title_tag ) .'>' ); ?>
							</div>
							
							<div class="portfolio-link">
								<a href="<?php echo esc_url( $permalink ); ?>" class="btn btn-type-simple btn-size-mini btn-color-black"><?php esc_html_e( 'View Project', 'octagon-kc-elements' ); ?></a>
							</div>
							
						</div> <!-- .post-content -->

					</div> <!-- .post-details -->

				</article> <!-- article -->

			<?php
			$post_count++; endwhile;
			wp_reset_postdata();
			?>

		</div>

	</div> <!-- .portfolio-extend-slider -->

	<?php

endif;