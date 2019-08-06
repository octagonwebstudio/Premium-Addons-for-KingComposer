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
$options = isset( $_POST['options'] ) ? (array) $_POST['options'] : '';

if( ! is_array( $options ) ) {
	return;
}

if( ! empty( $options ) ) {
	extract( $options );
}

$wrapper_class[] = 'recent-products loop-container';
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

		<ul class="products ajax-content-pull <?php echo esc_attr( $columns .' '. $style ); ?>">

			<?php
			while( $q->have_posts() ):
				$q->the_post();

				global $product;

				$id = $product->get_id();
				?>

				<li <?php wc_product_class( 'element' ); ?>>
					<?php

					octagon_loop_product_link_open();
					octagon_loop_product_thumbnail();
					?>

					<div class="product-content">

						<?php
						$term = octagon_first_term( $id, 'product_cat' );

						if( ! empty( $term ) ) :
							?>
							<p class="category">
								<a href="<?php echo esc_url( get_term_link( $term['id'], 'product_cat' ) ); ?>"><?php echo esc_html( $term['name'] ); ?></a>
							</p>
							<?php 
						endif;
						
						octagon_loop_product_title();
						woocommerce_template_loop_rating();
						woocommerce_show_product_loop_sale_flash();
						?>
						
					</div> <!-- ..product-content -->

					<div class="product-loop-footer">
						<?php 
						woocommerce_template_loop_price();
						woocommerce_template_loop_add_to_cart();

						octagon_loop_product_icons_text_group();
						?>
					</div>
					
					<?php
					octagon_loop_product_link_close();
					?>
				</li> <!-- .product -->				

			<?php
			endwhile;
			?>

		</ul> <!-- .products -->

		<?php echo octagon_pagination( $pagination, array( 'type' => 'query', 'args' => $args, 'options' => $atts, 'max' => $max, 'ajax' => 'octagon_core_products_loadmore' ) ); ?>

	</div> <!-- .recent-products -->

	<?php

endif;
wp_reset_postdata();