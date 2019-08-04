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

$wrapper_class[] = 'portfolio-slider portfolio loop-container';
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

						<div class="portfolio-thumbnail image-overflow">
							<?php echo octagon_get_cropped_image( $thumbnail, 675, 600, true ); ?>
							<div class="image-overlay"></div>
						</div> <!-- .portfolio-thumbnail -->

						<div class="post-content">
							
							<div class="content-group">
								<?php the_title( '<'. esc_html( $title_tag ) .' class="title"><a href="'. esc_url( $permalink ) .'">', '</a></'. esc_html( $title_tag ) .'>' ); ?>

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
							</div>
							
						</div> <!-- .post-content -->

						<?php

							if( in_array( $id, $like ) ) {
								$like_class = 'in-the-like';
								$icon_class = 'oct-basic-heart-fill';
							}
							else {
								$like_class = '';
								$icon_class = 'oct-basic-heart';
							}

							echo sprintf( '<a href="#" class="js-octagon-like portfolio-like %s" data-id="%s">%s %s</a>', $like_class, $id, apply_filters( 'octagon_like_icon_html', '<span class="'. esc_attr( $icon_class ) .'"></span>' ), '<div class="loader"><div></div></div>' );
						?>

					</div> <!-- .post-details -->

				</article> <!-- article -->

			<?php
			$post_count++; endwhile;
			wp_reset_postdata();
			?>

		</div>

	</div> <!-- .portfolio-slider -->

	<?php

endif;