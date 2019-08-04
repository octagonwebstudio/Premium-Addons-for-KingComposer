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

wp_enqueue_style( 'octagon-kc-element-products-list' );

$wrapper_class[] = 'products-list recent-products loop-container';
$wrapper_class[] = $style;
$wrapper_class[] = $ex_class;

$wrapper_class = array_filter( $wrapper_class );

$q = new WP_Query( $args );

if( $q->have_posts() ):
	?>

	<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

		<ul class="products">

			<?php
			while( $q->have_posts() ):
				$q->the_post();

				global $product;

				$id = $product->get_id();
				?>

				<li <?php wc_product_class( 'element' ); ?>>

					<div class="product-thumb">
						<?php echo octagon_get_cropped_image( '', 80, 80, false ); ?>
					</div>
					

					<div class="product-content">

						<?php the_title( '<h3 class="title"><a href="'. esc_url( get_permalink() ) .'">', '</a></h3>' );
						?>

						<p class="price"><?php echo $product->get_price_html(); ?></p>
						
					</div> <!-- ..product-content -->

				</li> <!-- .product -->				

			<?php
			endwhile;
			?>

		</ul> <!-- .products -->

	</div> <!-- .recent-products -->

	<?php

endif;
wp_reset_postdata();