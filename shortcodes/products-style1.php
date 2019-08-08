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

		<ul class="products ajax-content-pull <?php echo esc_attr( $columns ); ?>">

			<?php
			while( $q->have_posts() ):
				$q->the_post();

				global $product;

				$id = $product->get_id();
				?>

				<li <?php wc_product_class( 'element' ); ?>>
					<div class="product-item">
					<?php
					$attachment_ids = $product->get_gallery_image_ids();

					if( has_post_thumbnail() ) {

						echo '<div class="product-thumbnail">';

							echo octagon_get_cropped_image( '', $width, $height, false, array(), array( 'class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"' ) );

							if( ! empty( $attachment_ids ) ) {
								foreach( $attachment_ids as $key => $id ) {
									echo octagon_get_cropped_image( $id, $width, $height, false, array(), array( 'class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image wp-post-image-secondary"' ) );
									break;
								}
							}

						echo '</div>'; // .product-thumbnail

					}

					echo '<ul class="product-icons" data-id="'. esc_attr( $id ) .'">';

						// Wishlist
						if( 'show' == $show_wishlist ) {

							$wishlist_items = octagon_get_cookie( 'octagon-wishlist' );
							$wishlist_items = ! empty( $wishlist_items ) ? explode( ',', $wishlist_items ) : array();

							if( in_array( $id, $wishlist_items ) ) {
								$wishlist_class = 'in-the-wishlist';
								$icon_class = 'oct-basic-heart-fill';
							}
							else {
								$wishlist_class = '';
								$icon_class = 'oct-basic-heart';
							}

							echo sprintf( '<li><a href="#" class="octagon-wishlist %s">%s %s</a></li>', $wishlist_class, apply_filters( 'octagon_wishlist_icon_html', '<span class="'. esc_attr( $icon_class ) .'"></span>' ), '<div class="loader"><div></div></div>' );
						}

						// Compare Products
						if( 'show' == $show_compare ) {

							$compare_products_items = octagon_get_cookie( 'octagon-compare-products' );
							$compare_products_items = ! empty( $compare_products_items ) ? explode( ',', $compare_products_items ) : array();

							$compare_products_class = in_array( $id, $compare_products_items ) ? 'in-the-compare-products' : '';

							echo sprintf( '<li><a href="#" class="octagon-compare-product %s">%s %s</a></li>', $compare_products_class, apply_filters( 'octagon_compare_icon_html', '<span class="oct-basic-random"></span>' ), '<div class="loader"><div></div></div>' );
						}

						// Lightbox or Quick View
						if( 'light_box' == $view ) {
							$attachment_url = octagon_get_cropped_url();

							echo sprintf( '<li class="view"><a href="'. esc_url( $attachment_url ) .'" class="magnify-image">%s</a></li>', apply_filters( 'octagon_product_view_icon_html', '<span class="icon-plus"></span>' ) );
						}
						elseif( 'quick_view' == $view ) {

							echo sprintf( '<li class="view"><a href="#" class="octagon-quick-view">%s %s</a></li>', apply_filters( 'octagon_product_view_icon_html', '<span class="oct-basic-plus-light"></span>' ), '<div class="loader"><div></div></div>' );
						}

					echo '</ul>'; // .product-icons
					?>

					<div class="product-content">

						<h2 class="woocommerce-loop-product__title title">
							<?php
							woocommerce_template_loop_product_link_open();
								echo esc_html( get_the_title() );
							woocommerce_template_loop_product_link_close();
							?>
						</h2>
						<?php
						woocommerce_template_loop_rating();
						woocommerce_template_loop_price();
						?>
						
					</div> <!-- ..product-content -->
					
					<?php
					woocommerce_template_loop_add_to_cart();
					?>
					</div>
				</li> <!-- .product -->				

			<?php
			endwhile;
			?>

		</ul> <!-- .products -->

		<?php echo octagon_pagination( $pagination, array( 'type' => 'query', 'args' => $args, 'options' => $atts, 'max' => $max, 'ajax' => 'octagon_kc_elements_products_loadmore' ) ); ?>

	</div> <!-- .recent-products -->

	<?php

endif;
wp_reset_postdata();