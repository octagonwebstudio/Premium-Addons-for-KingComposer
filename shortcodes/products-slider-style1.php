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

wp_enqueue_style( 'octagon-kc-element-products' );
wp_enqueue_style( 'octagon-kc-element-product-slider' );

$wrapper_class[] = 'products-slider recent-products loop-container';
$wrapper_class[] = $style;
$wrapper_class[] = $ex_class;

$wrapper_class = array_filter( $wrapper_class );

$q = new WP_Query( $args );

if( $q->have_posts() ):
	?>

	<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

		<ul class="products slick-slider" <?php echo esc_attr( implode( ' ', $slide_data ) ); ?>>

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
					octagon_loop_product_icons_group();
					?>

					<div class="product-content">

						<?php
						octagon_loop_product_title();
						woocommerce_template_loop_rating();
						woocommerce_template_loop_price();
						?>
						
					</div> <!-- ..product-content -->
					
					<?php
					woocommerce_template_loop_add_to_cart();
					octagon_loop_product_link_close();
					?>
				</li> <!-- .product -->				

			<?php
			endwhile;
			?>

		</ul> <!-- .products -->

	</div> <!-- .products-slider -->

	<?php

endif;
wp_reset_postdata();