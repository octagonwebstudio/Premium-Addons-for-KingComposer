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

wp_enqueue_style( 'octagon-kc-element-team' );

$wrapper_class[] = 'team loop-container';
$wrapper_class[] = $style;
$wrapper_class[] = $ex_class;

$wrapper_class = array_filter( $wrapper_class );

$q = new WP_Query( $args );

if( $q->have_posts() ):
	?>

	<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

		<div class="post-inner post-loop">

			<div class="row">

				<?php

				$post_count = 1;

				while( $q->have_posts() ):
					$q->the_post();

					$id = get_the_ID();

					$class[] = 'member';
					$class[] = $columns;

					?>

					<article <?php post_class( implode( ' ', $class ) ); ?>>

						<div class="post-details">

							<div class="team-thumbnail">

								<?php echo octagon_get_cropped_image( '', 720, 800, true ); ?>

							</div> <!-- .team-thumbnail -->

							<div class="post-content">
								
								<div class="content-group">
									<?php 
									the_title( '<'. esc_html( $title_tag ) .' class="title">', '</'. esc_html( $title_tag ) .'>' );

									if( 'show' == $show_job ) :
										?>
										<div class="meta-group">
											<?php
											$term = octagon_first_term( $id, 'octagon_member_job' );

											if( ! empty( $term ) ) :
												?>
												<p class="category"><?php echo esc_html( $term['name'] ); ?></p>
												<?php 
											endif;
											?>
										</div> <!-- .meta-group -->
										<?php 
									endif;
									?>
									
								</div> <!-- .content-group -->
								
							</div> <!-- .post-content -->

						</div> <!-- .post-details -->

					</article> <!-- article -->

				<?php
				$post_count++; endwhile;
				wp_reset_postdata();
				?>

			</div> <!-- .row -->

		</div> <!-- .post-inner -->

	</div> <!-- .team -->

	<?php

endif;