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

wp_enqueue_style( 'octagon-kc-element-portfolio' );
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

$wrapper_class[] = 'portfolio js-portfolio-isotope loop-container';
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

		<?php if( 'show' == $show_filter ) :

			$all_terms = get_terms( array(
			    'taxonomy' => 'octagon_portfolio_cat',
			    'hide_empty' => true
			) );
			?>

			<div class="filter-cover">

				<ul class="filter">

					<li class="active" data-filter="*"><?php esc_html_e( 'All', 'octagon-kc-elements' ); ?></li>
					<?php foreach( $all_terms as $key => $terms ) : ?>
						<li data-filter=".octagon_portfolio_cat-<?php echo esc_attr( $terms->slug ); ?>"><?php echo sprintf( '%s', esc_html( $terms->name ) ); ?></li>
					<?php endforeach; ?>

				</ul> <!-- .filter -->

			</div> <!-- .filter-cover -->

		<?php endif; ?>

		<div class="post-inner post-loop ajax-content-pull">

			<div class="isotope-item-sizer col-md-1"></div>

			<?php

			$post_count = 1;

			$like = octagon_get_cookie( 'octagon-post-likes' );
			$like = ! empty( $like ) ? explode( ',', trim( $like ) ) : array();

			while( $q->have_posts() ):
				$q->the_post();

				$id = get_the_ID();

				$live_preview_link = octagon_get_meta( $id, 'live_preview', '' );

				$permalink = ( 'disable' == $live_preview ) || empty( $live_preview_link ) ? get_permalink() : $live_preview_link;

				$thumbnail = octagon_get_meta( $id, 'thumbnail', '' );
				$thumbnail = ! empty( $thumbnail ) ? $thumbnail : get_post_thumbnail_id();

				$term_obj = get_the_terms( $id, 'octagon_portfolio_cat' );

				$class = array( 'element portfolio-post isotope-item' );
				$class[] = $columns;

				?>

				<article <?php post_class( implode( ' ', $class ) ); ?>>

					<div class="post-details">

						<div class="portfolio-thumbnail">

							<?php echo octagon_get_cropped_image( $thumbnail, 767, 600, true ); ?>

						</div> <!-- .portfolio-thumbnail -->

						<div class="post-content">
							
							<div class="content-group">
								<?php the_title( '<'. esc_html( $title_tag ) .' class="title"><a href="'. esc_url( $permalink ) .'">', '</a></'. esc_html( $title_tag ) .'>' ); ?>
								
								<?php if( 'show' == $show_category ) : ?>
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
								<?php endif; ?>

							</div>
							
							<div class="portfolio-link">
								<a href="<?php echo esc_url( $permalink ); ?>"><span class="oct-basic-long-arrow-right"></span></a>
							</div>
							
						</div> <!-- .post-content -->

						<?php 
						if( 'show' == $show_like ) :

							if( in_array( $id, $like ) ) {
								$like_class = 'in-the-like';
								$icon_class = 'oct-basic-heart-fill';
							}
							else {
								$like_class = '';
								$icon_class = 'oct-basic-heart';
							}

							echo sprintf( '<a href="#" class="js-octagon-like portfolio-like %s" data-id="%s">%s %s</a>', $like_class, $id, apply_filters( 'octagon_like_icon_html', '<span class="'. esc_attr( $icon_class ) .'"></span>' ), '<div class="loader"><div></div></div>' );
							
						endif;
						?>

					</div> <!-- .post-details -->

				</article> <!-- article -->

			<?php
			$post_count++; endwhile;
			wp_reset_postdata();
			?>

		</div>

		<?php 
		$values = array( 
			'type'    => 'query', 
			'args'    => $args, 
			'options' => array_merge( $atts, array( 'isotope' => true ) ), 
			'max'     => $max, 
			'ajax'    => 'octagon_kc_elements_portfolio_loadmore'
		);
		echo octagon_pagination( $pagination, $values ); ?>

	</div> <!-- .portfolio -->

	<?php

endif;