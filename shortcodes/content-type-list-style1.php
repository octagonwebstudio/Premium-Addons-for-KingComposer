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

wp_enqueue_style( 'octagon-kc-element-content-type-list' );

// AJAX purpose( It overrides normal values on ajax call )
$options = isset( $_POST['options'] ) ? (array) $_POST['options'] : array();

if( ! is_array( $options ) ) {
	return;
}

if( ! empty( $options ) ) {
	extract( $options );
}

$wrapper_class[] = 'content-type-list loop-container';
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

				<article <?php post_class( 'post element' ); ?>>

					<div class="post-details">

						<div class="post-content">
							
							<?php if( 'category' == $meta || 'date' == $meta ) : ?>
								<div class="meta-group">
									<?php 
									if( 'category' == $meta ) :

										$term = get_the_category();
										$term_id = isset( $term[0] ) ? $term[0]->term_id : '';

										if( ! empty( $term_id ) ) :
										?>
											<p class="category"><a href="<?php echo esc_url( get_category_link( $term_id ) ); ?>"><?php echo esc_html( $term[0]->cat_name ); ?></a></p>

										<?php endif;

									elseif( 'date' == $meta ) : 
										$year  = get_the_time( 'Y' );
										$month = get_the_time( 'm' );
										?>

										<p class="date"><a href="<?php echo esc_url( get_month_link( $year, $month ) ); ?>"><?php echo esc_html( get_the_date() ); ?></a></p>

									<?php endif; ?>
								</div> <!-- .meta-group -->

							<?php endif;

							the_title( '<'. esc_html( $title_tag ) .' class="post-tile title"><a href="'. esc_url( $permalink ) .'">', '</a></'. esc_html( $title_tag ) .'>' );
							?>

							<a href="<?php echo esc_url( $permalink ); ?>" class="btn btn-type-simple"><?php echo esc_html( $btn_text ); ?></a>

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
			'options' => $atts, 
			'max'     => $max, 
			'ajax'    => 'octagon_kc_elements_content_type_list_loadmore'
		);
		echo octagon_pagination( $pagination, $values );
		?>

	</div> <!-- .content-type-list -->

	<?php

endif;